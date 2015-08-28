<?php

class Noworriesturf_Shippingg_IndexController extends Mage_Core_Controller_Front_Action {
    public function homedeliveryAction() {
        $pid = $this->getProductId();
        $pc = $this->getPostCode();
        $qty = $this->getQty();
        $method= $this->getMethod();
        
        try {
           $price = Mage::helper('shippingg')->getHomeDeliveryEstimate($pid, $pc, $qty);
        } catch (Exception $e) {
            $price = '';
            Mage::logException($e);
        }
        
        /*if (!isset($_SESSION['shippingg']) || !is_array($_SESSION['shippingg'])) {
            $_SESSION['shippingg'] = array();
        }
        
        $_SESSION['shippingg'][$pid] = array(
            'qty' => $qty,
            'pc' => $pc,
            'price' => $price,
            'method' => $method,
        );*/
        
        echo $price;
        exit();
    }
    
    public function depotpickupAction() {
        $pid = $this->getProductId();
        $pc = $this->getPostCode();
        $qty = $this->getQty();
        $depot = $this->getDepot();
        $method= $this->getMethod();
		
		$data[] = array('pid'=>$pid,
						'pc'=>$pc,
						'qty'=>$qty,
						'depot'=>$depot,
						'method'=>$method,
						);
        
        try {
            if ($depot) {
                // get price
      $depos = Mage::helper('shippingg')->getDepotPickupDepots($pc);                
	  	  
	 // $depo = Mage::helper('shippingg')->getPickupDepoById($depos, $depot);		        
     // $rs = Mage::helper('shippingg')->getDepotPickupEstimate($depot, $pid, $pc, $qty);
	  
	  $rs = Mage::helper('shippingg')->getDepotPickupEstimate($depos, $pid, $pc, $qty); 		      $output = (array)$rs;
	  // $output = json_encode($rs);
	   
	  
	   /*if (!isset($_SESSION['shippingg']) || !is_array($_SESSION['shippingg'])) {
                    $_SESSION['shippingg'] = array();
                }
                
                $_SESSION['shippingg'][$pid] = array(
                    'depo' => $depo,
                    'depo_id' => $depot,
                    'qty' => $qty,
                    'pc' => $pc,
                    'price' => $rs,
                    'method' => $method,
                );*/
            } else {
                // get closest depots
                $rs = Mage::helper('shippingg')->getDepotPickupDepots($pc);
            }
        } catch (Exception $e) {
            //echo $e->getMessage();
            $output = -9999;
            Mage::logException($e);
        }
       
	   
	   $str ='<script>
		  <!--
		    function addtoCartDepo(val, product_id, depo_detail, postcode, suburb){				
				//console.log(depo_detail);
				
				jQuery.ajax({
					url:"'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB). 'index.php/shippingg/index/addcart",
					data:{  
							pid:product_id,
							depot:"depot",
							price:val,
							pc:postcode,
							suburb:suburb,							
							method:"depot",
							depodetail:depo_detail,
						},
					 type : "POST",
					success:function(data){
					//	console.log(data);
						},
					});
				}
		  -->
		  </script>	   	
	   ';
	   
	   
	   $str .= '<div style="color:#096; font-size:14px;">Nearest Depot Pickup:</div>';
	   $i=0;
	   $product_id = Mage::getModel('core/session')->getProduct_id();
	   
	  
	   foreach($output as $row){
	  
	 // Zend_debug::dump($row);	   
	   
	   if($i < 3){
	   
	   $depo_data[$i] = array('deponame'=>$row['depotinfo_'.$i]->DepotName,
	          			  'address'=>$row['depotinfo_'.$i]->Address,
						  'distance'=>$row['depotinfo_'.$i]->Distance,
						  'postcode'=>$row['depotinfo_'.$i]->Postcode,
						  'suburb'=>$row['depotinfo_'.$i]->Suburb,
	   					);
	   $depo_data[$i] = implode(',',$depo_data[$i]);
	   
	   $str .='	   
	            <div class="nwt-row" style="width:400px;">		   ';
		$str .='<div class="grid12-1"><input type="radio" class="depot_pickup" id="depot_pickup" name="home_delivery" onclick="addtoCartDepo(this.value, '.$product_id.', \''.$depo_data[$i].'\', \''.$row['depotinfo_'.$i]->Postcode.'\',\''.$row['depotinfo_'.$i]->Suburb.'\' )"  value="'.round($row['depotvals_'.$i]['TotalPrice'],2).'" /> </div>  <div class="grid12-7"><label id="depot_label" for="depot_pickup">"';
		   $str .= $row['depotinfo_'.$i]->DepotName;
		   $str .='"</label> &nbsp; Price:<span id="depot_delivery_value">$ '.round($row['depotvals_'.$i]['TotalPrice'],2).'</span> &nbsp; Distance: '.$row['depotinfo_'.$i]->Distance.' KM  <br/>Address: '.$row['depotinfo_'.$i]->Address.', '.$row['depotinfo_'.$i]->State.'  Postcode: '.$row['depotinfo_'.$i]->Postcode.', Suburb: '.$row['depotinfo_'.$i]->Suburb.'</div>';
		$str .= '</div>';
		
	   }
	  
	  $i++;
	   }
		
	    
        echo $str;
        exit();
    }
	
	
	
	public function addshippingtocartAction(){
		
		$post = $this->getRequest()->getParams();		
		$depot = $post['depot'];
		$shipping_val = $post['shipping_val'];
		
		Mage::getSingleton('core/session')->setDepot($shipping_val);
		
		//var_dump(Mage::getSingleton('core/session')->getDepot());
		//var_dump($shipping_val);
		
		}
    
    public function addcartAction() {
       
	  //  $pid = $this->getProductId();
        $pc = $this->getPostCode();
        $qty = $this->getQty();
		// $method = $this->getMethod();
       // $price = $this->getPrice();
       //$depot = $this->getDepot();
	    $shippingdata = $this->getRequest()->getParams();
		//var_dump($shippingdata);
		
		$shipping_depo_detail =array();
		$_SESSION['depo_detail']=array(); 
	  
       
	   $pid = $shippingdata['pid'];
	   $method = $shippingdata['method'];
	   $pc = $shippingdata['pc'];
	   $qty = $shippingdata['qty'];
	   $price = $shippingdata['price'];
	   $depot = $shippingdata['depot'];
	   $depot_detail = $shippingdata['depodetail'];
	   
	   $shipping_depot = explode(',',$depot_detail);
	   $depot_name = $shipping_depot[0];
	   
	   $_SESSION['shippingg']=array();
	   
        
	if ($depot !='') {
		if (!isset($_SESSION['shippingg']) || !is_array($_SESSION['shippingg'])) {
	            	$_SESSION['shippingg'] = array();
	        }	        
	        $_SESSION['shippingg'][$pid] = array(
	        	'depo_id' => $depot,
	            'qty' => $qty,
	            'pc' => $pc,
	            'price' => $price,
	            'method' => $method,
				'depo_detail' => $depot_detail,
				'depo_name'=>$depot_name,	       
				 );	
			
			$_SESSION['depo_detail'][$pid] = array(
	        	'depo_id' => $depot,
	            'qty' => $qty,
	            'pc' => $pc,
	            'price' => $price,
	            'method' => $method,
				'depo_detail' => $depot_detail,
				'depo_name'=>$depot_name,
	        );	
				
		
	  }
     var_dump($_SESSION['shippingg']);         
     exit();
	 
    }
    
    protected function getProductId() {
        return isset($_GET['pid']) && !empty($_GET['pid']) ? $_GET['pid'] : null;
    }
    
    protected function getPostCode() {
        return isset($_GET['pc']) && !empty($_GET['pc']) ? $_GET['pc'] : null;
    }
    
    protected function getDepot() {
        return isset($_GET['depot']) && !empty($_GET['depot']) ? $_GET['depot'] : 'Brisbane';
    }
    
    protected function getQty() {
        return isset($_GET['qty']) && !empty($_GET['qty']) ? $_GET['qty'] : null;
    }
    
    protected function getMethod() {
        return isset($_GET['method']) && !empty($_GET['method']) ? $_GET['method'] : null;
    }
    
    protected function getPrice() {
        return isset($_GET['price']) && !empty($_GET['price']) ? $_GET['price'] : null;
    }
}