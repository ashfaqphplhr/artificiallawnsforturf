<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Activitystream
 * @version    1.0.2
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


/**
 * 
 */
class AW_Activitystream_Model_AdminhtmlSystemConfigBackendTurnable extends Mage_Core_Model_Config_Data {
    
    /**
     * 
     */
    protected function _afterLoad() {
        $__result = parent::_afterLoad();
        
        $this->setValue((string)$this->getValue());
        
        $__shadowString = Mage::getModel('activitystream/shadowString');
        $__shadowString->setValue($this->getValue());
        if ( strlen($this->getValue()) == 0 ) $__shadowString->setShadowValue(Mage::getStoreConfig($this->__getReservationPath(), $this->getStore()));
        $this->setValue($__shadowString);
        
        return $__result;
    }
    
    
    /**
     * 
     */
    protected function _beforeSave() {
        $__value = $this->getValue();
        
        if ( is_array($__value) ) {
            if ( isset($__value['editbox']) ) {
                $this->setValue($__value['editbox']);
            }
            else {
                if ( isset($__value['shadow']) ) {
                    $__reservationValue = $__value['shadow'];
                    Mage::app()->getConfig()->saveConfig($this->__getReservationPath(), $__reservationValue, $this->getScope(), $this->getScopeId());
                }
                $this->setValue('');
            }
        }
    }
    
    
    private function __getReservationRegistryPath() {
        return 'mage_system_config_' . $this->getPath() . '_disabled_value';
    }
    
    
    /**
     * 
     */
    private function __getReservationPath() {
        return $this->getPath() . '_disabled_value';
    }
}