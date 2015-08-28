<?php 
/**
 * Noworriesturf_Shippingg extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category   	Noworriesturf
 * @package		Noworriesturf_Shippingg
 * @copyright  	Copyright (c) 2013
 * @license		http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Shippingg default helper
 *
 * @category	Noworriesturf
 * @package		Noworriesturf_Shippingg
 * @author Ultimate Module Creator
 */
class Noworriesturf_Shippingg_Helper_Data extends Mage_Core_Helper_Abstract{
    public function getAccessToken() {
        return Mage::getStoreConfig('noworriesturf/access_token');
    }
    
    public function getCubicVariable() {
        return Mage::getStoreConfig('noworriesturf/cubic_variable');
    }
    
    public function getGst() {
        return Mage::getStoreConfig('noworriesturf/gst');
    }
    
    public function getInsurance() {
        return Mage::getStoreConfig('noworriesturf/insurance');
    }
    
    public function getHomeDeliveryEstimate($pid, $pc, $qty) {
        $cv = $this->getCubicVariable();
        $gst = ($this->getGst() + 100) / 100;
        $product = Mage::getModel('catalog/product')->load($pid);        
        $price = false;        
        $depo = $this->getDepoName($product);		
        $weight = $product->getWeight();
        
        $length = $product->getLength()/100;
        $width = $product->getWidth()/100;
        $depth = $product->getDepth()/100;
        
        $cubicWeight = $length * $width * $depth * $cv;
        list($basicCharge, $costPerKg) = $this->getBasicChargeCostPerKg($depo, $pc);
        
		
		$surcharge = $this->getProductSurcharge($cubicWeight);
		
        if (!$basicCharge || !$costPerKg) {
            throw new Exception('Basic charge or cost per kg not found.');
        }
        
        if (!$surcharge) {
            throw new Exception('Surcharge not found.');
        }
        
        $price = ( ( ( $cubicWeight * $costPerKg ) + $basicCharge ) * $gst ) + $surcharge;
        $price *= $qty;
        $price = round($price, 2);
		
		//echo $price;
        
        if (!$price) {
            throw new Exception('Price couldnt be calculated.');
        }
        
        return $price;
        //return $gst ;
    }
    
    public function getSuburb($pc) {
        $at = $this->getAccessToken();
        $h = array('AccessToken: ' . $at);
        $q = '?q=' . intval($pc);
        $u = 'https://www.bigpost.com.au/api/suburbs' . $q;
        
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $u);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $h);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $rs = curl_exec($curl);
        $rs = json_decode($rs);
		
		//var_dump($rs);
		
        
        return isset($rs[0]) && is_object($rs[0]) && isset($rs[0]->Suburb) ? $rs[0]->Suburb : null;
    }
    
    public function getDepotPickupDepots($pc) {
        $su = $this->getSuburb($pc);
        
        if (!$su) {
            throw new Exception('Suburb for post code "' . $pc . '" was not found.');
        }
        
        $at = $this->getAccessToken();
        $h = array('AccessToken: ' . $at);
        $q = '?p=' . intval($pc) . '&s=' . urlencode($su);
        $u = 'https://www.bigpost.com.au/api/depots' . $q;
        
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $u);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $h);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $rs = curl_exec($curl);
		//var_dump($rs);
		
        $dec = json_decode($rs);
        //$rs = json_decode($rs);
        
		//var_dump($dec);
		
        if (!empty($dec) && is_array($dec)) {
            return $rs;
        } else {
            throw new Exception('No depot found.');
        }
    }
    
    public function getDepotPickupEstimate($depots, $pid, $pc, $qty) {
        $p = Mage::getModel('catalog/product')->load($pid);
        $depoName = $this->getDepoName($p);		
        $depotName = $this->getDepoName2($depoName);
		$stateName = $this->getState($depoName);
        $depoPc = $this->getDepotPostCode($depoName);
       
	   
	   $su = $this->getSuburb($pc);
		if (!$su) {
            throw new Exception('Suburb for post code "' . $pc . '" was not found.');
        }
        
        $at = $this->getAccessToken();
        $h = array('AccessToken: ' . $at);
		$depots= (array)json_decode($depots);
		
		////if there is only one dept
		
      
	   foreach($depots as $depot){
	      $depot = (array)$depot;
	     //Zend_debug::dump($depot);
	    $qa = array(
            'DeliveryType' => 'DEPOT',
            'DepotId' => intval($depot['DepotId']),
            //'SellerId' => '',
            //'SellerName' => '',
            'FromSuburb' => $depotName,
            'FromPostcode' => $depoPc,
            'FromState' => $stateName,
            'ToSuburb' => $su,
            'ToPostcode' => intval($pc),
            'ToState' => 'Australia',
            'DeliveryItems' => array()
        );
        
        $qa['DeliveryItems'][] = array(
            'DeadWeight' => $p->getWeight(),
            'Depth' => $p->getLength(),
            //'Height' => $p->getLength(),
            'Length' => $p->getLength(),
            'Height' => $p->getDepth(),
            'Width' => $p->getWidth(),
            'Quantity' => $qty,
            'Item Description' => $p->getName()
        );
        
        $q = http_build_query($qa);
        $u = 'https://www.bigpost.com.au/api/requestquote';
        
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $u);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $q);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $h);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);        
        $rs = curl_exec($curl);
		$result = json_decode($rs);	
		
		 //$test = var_dump($qa);
        $insurance = ($this->getInsurance() + 100) / 100;
		
		if (!empty($result) && is_object($result)) {            
			//return $test.' '.$rs->Total;
           // $mresult = str_replace('$', '', $result->Total);
           
		    $ntotal = ((float)$result->TotalPrice)*$insurance;
			  $nresult['Charge'] = $result->Charge;
			  $nresult['GST'] = $result->GST;
			  $nresult['Total'] = $result->Total;
			  $nresult['Error'] = $result->Error;
			  $nresult['TotalPrice'] = $ntotal;
           //$result->Total = $ntotal;
		  // echo $r;
		   // return round($r,2);
		  
        } else {
            throw new Exception('No shipping rate found.');
        }
			
		$collection[]=$nresult;
		
       
		
	}
	   $i=0;
	   $finals = array();
	   foreach($collection as $item){
		//var_dump($item);
		$finals[]= array('depotinfo_'.$i =>$depots[$i],
						 'depotvals_'.$i=>$item,
						);	
		$i++;					
	  }
	
	
	return $finals;
		
        
        
    }
    
    public function getDeliveryComment() {
        $data = isset($_SESSION['shippingg']) && !empty($_SESSION['shippingg']) ? $_SESSION['shippingg'] : array();
        $rows = array();
        $session = Mage::getSingleton('checkout/session');
        
        foreach ($session->getQuote()->getAllItems() as $item) {
            $pids[] = $item->getProductId();
        }
        
        foreach($data as $pid => $v) {
            if ( (!empty($pids) && in_array($pid, $pids)) || empty($pids)) {
                $p = Mage::getModel('catalog/product')->load($pid);
                $type = isset($v['depo']) ? 'depot pickup' : 'home delivery';

                $row = 'Deliver product ' . $p->getName() . ' (sku: ' . $p->getSku() . ') to post code ' . $v['pc'] . ' by ' . $type . ' for $' . $v['price'];

                if ($type == 'depot pickup') {
                    $row .= PHP_EOL . '<br />destination depot: ' . $v['depo'];
                }

                $rows[] = $row;
            }
        }
        
        return implode(PHP_EOL . '<br />' . PHP_EOL . '<br />', $rows);
    }
    
    function clearDelivery() {
        //$_SESSION['shippingg'] = array();
    }
    
    function getProductSurcharge($weight) {
        $surcharge = false;
        $weight = floatval($weight);
        
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $tableName = $resource->getTableName('shippingg/surcharge');
        
        $query = 'SELECT * FROM ' . $tableName . ' WHERE weight_from <= ' . $weight . ' AND weight_to >= ' . $weight;
        $rs = $readConnection->fetchAll($query);
		
		//var_dump($rs);
        
        if (isset($rs) && isset($rs[0]) && isset($rs[0]['cost'])) {
            $surcharge = $rs[0]['cost'];
        }
        
        return $surcharge;
    }
    
    function getBasicChargeCostPerKg($depo, $pc) {
        $return = false;
        $pc = intval($pc);
        
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        
        $modelName = $this->getModelClassName($depo);
        $tableName = $resource->getTableName($modelName);
        
        $query = 'SELECT * FROM ' . $tableName . ' WHERE postcode = ' . $pc;
        $rs = $readConnection->fetchAll($query);
        
		
        if (isset($rs) && isset($rs[0]) && isset($rs[0]['basiccharge']) && isset($rs[0]['costperkg'])) {
            $return = array(
                $rs[0]['basiccharge'],
                $rs[0]['costperkg']
            );
        }
        
        return $return;
    }
    
    function getDepoName(&$product) {
       // return $product->getData('depo');	   
	    $attribute = $product->getAttributeText('depo');
	    $deponame = strip_tags($attribute);
		//echo $deponame;
	 // $attributes =  $product->getResource()->getAttributes();
	 // Zend_debug::dump($attributes);
	   return $deponame;	   
       // return $product->getResource()->getAttribute('depo')->getSource()->getOptionText($product->getDepo());
    }
    
    function getDepoName2($type) {
        switch($type) {
            case 'Brisbane':
                $m = 'Yatala';
                break;
            case 'Melbourne':
                $m = 'Sunshine';
                break;
            default:
                throw new Exception('Invalid depot type "' . $type . '", expected "Brisbane" or "Melbourne".');
                break;
        }

        return $m;
    }
    
    function getState($type) {
        switch($type) {
            case 'Brisbane':
                $m = 'Queensland';
                break;
            case 'Melbourne':
                $m = 'Victoria';
                break;
            default:
                throw new Exception('Invalid depot type "' . $type . '", expected "Brisbane" or "Melbourne".');
                break;
        }

        return $m;
    }
    
    function getModelClassName($type) {
        switch($type) {
            case 'Brisbane':
                $m = 'shippingg/shippingratebrisbane';
                break;
            case 'Melbourne':
                $m = 'shippingg/shippingrate';
                break;
            default:
                throw new Exception('Invalid depot type "' . $type . '", expected "Brisbane" or "Melbourne".');
                break;
        }

        return $m;
    }
    
    function getDepotPostCode($type) {
        switch($type) {
            case 'Brisbane':
                $m = 4207;
                break;
            case 'Melbourne':
                $m = 3020;
                break;
            default:
                throw new Exception('Invalid depot type "' . $type . '", expected "Brisbane" or "Melbourne".');
                break;
        }

        return $m;
    }
    
    function getPickupDepoById($depos, $did) {
        $depos = json_decode($depos);
        $did = 153;
		
        if (!empty($depos) && is_array($depos)) {
            foreach($depos as $depo) {
              // var_dump($depo);
			   
			    
				if ($depo->DepotId == $did) {
                    return '#' . $depo->DepotId . ' ' . $depo->DepotName . ' ' . $depo->Suburb . ' ' . $depo->Address . ' ' . $depo->Postcode . ' ' . $depo->State;
                }
            }
        }
    }
	
    
    function getTotalShipping() {
        $data = isset($_SESSION['shippingg']) && !empty($_SESSION['shippingg']) ? $_SESSION['shippingg'] : array();
        $pids = array();
        $price = 0;
        $session = Mage::getSingleton('checkout/session');
        
        foreach ($session->getQuote()->getAllItems() as $item) {
            if ($item->getParentItemId()) {
                continue;
            }
            
            if ($item->getProductType() == 'configurable') {
                $c = $item->getChildren();
                $c = $c[0];
                $pids[$c->getProductId()] = $item->getQty();
            } else {
                $pids[$item->getProductId()] = $item->getQty();
            }
        }
        
        foreach($data as $pid => $v) {
            if (isset($pids[$pid])) {
                if ($v['qty'] != $pids[$pid]) {
                    if (isset($v['depo'])) {
                        $_SESSION['shippingg'][$pid]['price'] = $this->getDepotPickupEstimate($v['depo_id'], $pid, $v['pc'], $pids[$pid]);
                    } else {
                        $_SESSION['shippingg'][$pid]['price'] = $this->getHomeDeliveryEstimate($pid, $v['pc'], $pids[$pid]);
                    }
                    
                    $_SESSION['shippingg'][$pid]['qty'] = $pids[$pid];
                }
                
                $price += $v['price'];
            }
        }
        
        return $price;
    }
	
	
	///attribute toOptionArray();
	
	public function toOptionArray() 
{
    $attributes = Mage::getResourceModel('catalog/product_attribute_collection')->addVisibleFilter();
    $attributeArray = array();

    foreach($attributes as $attribute){
            $attributeArray[] = array(
                'label' => $attribute->getData('frontend_label'),
                'value' => $attribute->getData('attribute_code')
            );
    }
    return $attributeArray; 
}
}