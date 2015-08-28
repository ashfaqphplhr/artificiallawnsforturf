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
class AW_Activitystream_Model_Activity extends Mage_Core_Model_Abstract {
    
    /**
     * 
     */
    const TYPE_CUSTOMER_SUBSCRIBES_TO_NEWSLETTER =  1;
    const TYPE_NEW_CUSTOMER_IS_REGISTERED        =  2;
    const TYPE_CUSTOMER_IS_SIGNED_IN             =  3;
    const TYPE_SEARCHING_IS_PERFORMED            =  4;
    const TYPE_PRODUCT_IS_VIEWED                 =  5;
    const TYPE_CATEGORY_IS_VIEWED                =  6;
    const TYPE_ITEM_IS_ADDED_FOR_COMPARISON      =  7;
    const TYPE_ITEM_IS_ADDED_TO_WISHLIST         =  8;
    const TYPE_ITEM_IS_ADDED_TO_SHOPPING_CART    =  9;
    const TYPE_CUSTOMER_VIEWS_SHOPPING_CART      = 10;
    const TYPE_CUSTOMER_PROCEEDS_TO_CHECKOUT     = 11;
    const TYPE_PRODUCT_IS_PURCHASED              = 12;
    const TYPE_PRODUCT_TAG_IS_ADDED              = 13;
    const TYPE_REVIEW_IS_ADDED                   = 14;
    
    
    /**
     * 
     */
    protected function _construct() {
        $this->_setResourceModel('activitystream/resourceActivity', 'activitystream/resourceActivityCollection');
    }
    
    
    /**
     * @param int $value
     */
    public function setSource($value) {
        return $this->setData('parameter_a', $value);
    }
    
    
    /**
     * @param int $value
     */
    public function setTarget($value) {
        return $this->setData('parameter_b', $value);
    }
    
    
    /**
     * 
     */
    protected function _beforeSave() {
        if ( !$this->getData('store_id') ) $this->setStoreId(Mage::app()->getStore()->getStoreId());
        $this->setCreationTime($this->__getCurrentGMT());
        
        return parent::_beforeSave();
    }
    
    
    /**
     * 
     */
    private function __getCurrentGMT() {
        return Mage::getSingleton('core/date')->gmtDate();
    }
}