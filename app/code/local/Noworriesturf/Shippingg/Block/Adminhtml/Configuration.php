<?php

class Noworriesturf_Shippingg_Block_Adminhtml_Configuration extends Mage_Adminhtml_Block_Abstract {
    public function __construct() {
        parent::__construct();
        
        $this->setTemplate('noworriesturf_shippingg/configuration.phtml');
    }
    
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
}