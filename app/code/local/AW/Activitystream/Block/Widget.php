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
class AW_Activitystream_Block_Widget extends AW_Activitystream_Block_Stream implements Mage_Widget_Block_Interface {
    
    /**
     * 
     */
    protected function __getRecordsCount() {
        $__count = $this->_getData('number_of_activities_to_display');
        
        return Mage::helper('activitystream/dataValidation')->castToValid(
            AW_Activitystream_Helper_DataValidation::CASTING_TYPE_INTEGER,
            $__count,
            array(
                AW_Activitystream_Helper_Data::OVERLAY_RECORDS_COUNT_CONSTRAINT_L,
                AW_Activitystream_Helper_Data::OVERLAY_RECORDS_COUNT_CONSTRAINT_R
            ),
            AW_Activitystream_Helper_Data::STREAM_NUMBEROFACTIVITIES_DEFAULT
        );
    }
    
    
    /**
     * 
     */
    protected function __getStoreFilter() {
        return $this->_getData('activity_store_filter');
    }
    
    
    /**
     *
     */
    protected function __getUpdatePeriod() {
        return $this->_getData('update_period');
    }
}