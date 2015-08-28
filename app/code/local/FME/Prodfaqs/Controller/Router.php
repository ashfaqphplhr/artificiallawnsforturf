<?php
/**
 * FAQs And Product Questions
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   FME
 * @package    FAQs And Product Questions
 * @author     Asif Hussain <support@fmeextensions.com>
 * 	       
 * @copyright  Copyright 2012 © www.fmeextensions.com All right reserved
 */

class FME_Prodfaqs_Controller_Router extends Mage_Core_Controller_Varien_Router_Abstract
{
    public function initControllerRouters($observer)
    {    		
        $front = $observer->getEvent()->getFront();
        $faqs = new FME_Prodfaqs_Controller_Router();
        $front->addRouter('prodfaqs', $faqs);
        
    }

    public function match(Zend_Controller_Request_Http $request)
    {
 
        if (!Mage::isInstalled()) {
            Mage::app()->getFrontController()->getResponse()
                ->setRedirect(Mage::getUrl('install'))
                ->sendResponse();
            exit;
        }
		

        $route = Mage::helper('prodfaqs')->getListIdentifier();
		
       	$identifier = trim($request->getPathInfo(), '/');
        $identifier = str_replace(Mage::helper('prodfaqs')->getSeoUrlSuffix(), '', $identifier);
                
               
        if ( $identifier == $route ) {

        	$request->setModuleName('prodfaqs')
        			->setControllerName('index')
        			->setActionName('index');
        			
        	return true;
        			
        } elseif ( strpos($identifier, $route . '/search') === 0) {
			
        	$request->setModuleName('prodfaqs')
        			->setControllerName('index')
        			->setActionName('search')
        			->setParam('id', (int)$request->getParam('id'));
        			
        	return true;
        			        
        } elseif ( strpos($identifier, $route) === 0 && strlen($identifier) > strlen($route) && strpos($identifier, '-questions') === false ) {
			
        	$identifier = trim(substr($identifier, strlen($route)), '/');        
	       	$topicId = Mage::getModel('prodfaqs/topic')->checkIdentifier($identifier, Mage::app()->getStore()->getId());
        	if ( !$topicId ) {
            	return false;
        	}
        	$request->setModuleName('prodfaqs')
            		->setControllerName('index')
            		->setActionName('view')
            		->setParam('id', $topicId);
            		
			$request->setAlias(
					Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
					$identifier
			);
			
			return true;

        } elseif ( strpos($identifier, $route) === 0 && strpos($identifier, '-questions') >= 0){
	    
		$product_identifier = trim(substr($identifier, strlen($route)), '/');
		$product_identifier = str_replace('-questions', '', $product_identifier);
		
		//Now get the product id from this identifier
		$store_id = Mage::app()->getStore()->getId();
		 
		$collection = Mage::getResourceModel('catalog/product_collection')->setStoreId($store_id);  
		Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
		Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
		$collection->addAttributeToFilter(array(
							array('attribute'=>'url_key', 'eq'=>$product_identifier)
							)
						);
		
		$data = $collection->getData();
		
		if($data){
		 
		    $prod_id = $data[0]['entity_id'];
		    
		    $request->setModuleName('prodfaqs')
            		->setControllerName('index')
            		->setActionName('productfaqs')
            		->setParam('id', $prod_id);		    
		    
		    return true;
		
		}else{
		    
		    return false;
		}
		
	    
		
	
	} 
       
        return false;

    }
}