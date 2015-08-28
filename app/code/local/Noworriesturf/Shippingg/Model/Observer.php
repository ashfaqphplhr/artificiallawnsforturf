<?php

class Noworriesturf_Shippingg_Model_Observer {
    
	private $_shippingCode = 'Depo Pickup';
	private $_country = 'AU';
	protected $_hasShipping = false;
	
	public function shipping(Varien_Event_Observer $observer) {
       // return; // !!!
        
        // sales_quote_address_collect_totals_after
        $address = $observer->getEvent()->getQuoteAddress();
        $sp = Mage::helper('shippingg')->getTotalShipping();
      //  Zend_debug::dump($address->getAddressType());
		//Zend_debug::dump($sp);
		
		$addshipping = $this->addShippings();
		
		$method = $this->getQuote()->getShippingAddress()->getShippingMethod();
		
		//Zend_debug::dump($address->getAddressType());
		//exit;
		
        if ($address->getAddressType() == 'shipping') {
            //var_dump($address->getAddressType(), $sp + $address->getShippingAmount(), get_class($address), get_class_methods($address));
            $address->setShippingAmount($sp + $address->getShippingAmount());
            $address->setBaseShippingAmount($sp + $address->getBaseShippingAmount());
            //echo '<hr />';
        }
    }
    
    public function order(Varien_Event_Observer $observer) {
        // sales_order_place_after
        $order = $observer->getEvent()->getOrder();
        
        $comment = Mage::helper('shippingg')->getDeliveryComment();
        Mage::helper('shippingg')->clearDelivery();
        
        $order->addStatusHistoryComment($comment, 'pending')
            ->setIsVisibleOnFront(false)
            ->setIsCustomerNotified(false);
			
			

        $order->save();
    }
	
	public function addShippings($params = null) {
		if (Mage::registry('checkout_addShipping')) {
			Mage::unregister('checkout_addShipping');
			return;
		}
		Mage::register('checkout_addShipping',true);
 
		$cart = Mage::getSingleton('checkout/cart');
		$quote = $cart->getQuote();
		
	
    /**
     * Set shipping method and rate if they do not exist yet
     */
   
        if(!$this->_hasShipping) {

            $this->_hasShipping = true; // This is to avoid loops on totals collecting

            $quote = Mage::helper('checkout/cart')->getQuote();
            if (!$quote->getId()) return;

            $shippingMethod = $quote->getShippingAddress()->getShippingMethod();
            if ($shippingMethod) return;

            $shippingAddress = $quote->getShippingAddress();
            $country = $this->_country; // Some country code
            $postcode = '75000'; // Some postcode
            $regionId = '0'; // Some region id
            $method = $this->_shippingCode; // Used shipping method

            $shippingAddress
                ->setCountryId($country)
                ->setRegionId($regionId)
                ->setPostcode($postcode)
                ->setShippingMethod($method)
                ->setCollectShippingRates(true)
            ;

            $shippingAddress->save();
            $quote->save();
        }
   
 
	}
		
		
		public function getQuote() {
        if (empty($this->_quote)) {
            $this->_quote = Mage::getSingleton('checkout/session')->getQuote();
        }
        return $this->_quote;
    }
}