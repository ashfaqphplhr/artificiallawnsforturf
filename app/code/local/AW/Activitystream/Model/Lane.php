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
class AW_Activitystream_Model_Lane {
    
    /**
     * 
     */
    private $__items = null;
    
    
    /**
     * 
     */
    public function __construct() {
        $this->__initItems();
        
        return $this;
    }
    
    /**
     * 
     */
    public function addItem($addressee, $message) {
        if ( !isset($this->__items[$addressee]) ) $this->__items[$addressee] = array();
        if (!in_array($message, $this->__items[$addressee])) array_push($this->__items[$addressee], $message);
    }
    
    
    /**
     * 
     */
    public function pickItems($addressee = null) {
        if ( $addressee ) {
            if ( isset($this->__items[$addressee]) )
                return $this->__items[$addressee];
            else
                return null;
        }
        else {
            return $this->__items;
        }
    }
    
    
    /**
     * 
     */
    public function popItems($addressee) {
        if ( $addressee ) {
            if ( isset($this->__items[$addressee]) ) {
                $__items = $this->__items[$addressee];
                unset($this->__items[$addressee]);
                return $__items;
            }
            else
                return null;
        }
    }
    
    
    /**
     * 
     */
    public function removeItem($item) {
        foreach ( $this->__items as $__addressee => $__items ) {
            foreach ($__items as $__item) {
                if ( $__item == $item ) {
                    unset($this->__items[$__addressee][$__item]);
                }
            }
        }
    }
    
    
    /**
     *
     */
    protected function __initItems() {
        $this->__items = array();
        
        return $this;
    }
}