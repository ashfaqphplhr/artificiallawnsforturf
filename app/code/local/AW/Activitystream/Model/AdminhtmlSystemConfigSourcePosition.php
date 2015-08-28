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
class AW_Activitystream_Model_AdminhtmlSystemConfigSourcePosition {
    
    /**
     * 
     */
    public function toOptionArray() {
        $__H = Mage::helper('activitystream');
        
        return array(
            array(
                'label' => $__H->__('None'),
                'value' => AW_Activitystream_Helper_Data::OVERLAY_POSITION_NONE
            ),
            array(
                'label' => $__H->__('Top Left'),
                'value' => AW_Activitystream_Helper_Data::OVERLAY_POSITION_TOPLEFT
            ),
            array(
                'label' => $__H->__('Top Center'),
                'value' => AW_Activitystream_Helper_Data::OVERLAY_POSITION_TOPCENTER
            ),
            array(
                'label' => $__H->__('Top Right'),
                'value' => AW_Activitystream_Helper_Data::OVERLAY_POSITION_TOPRIGHT
            ),
            array(
                'label' => $__H->__('Bottom Left'),
                'value' => AW_Activitystream_Helper_Data::OVERLAY_POSITION_BOTTOMLEFT
            ),
            array(
                'label' => $__H->__('Bottom Center'),
                'value' => AW_Activitystream_Helper_Data::OVERLAY_POSITION_BOTTOMCENTER
            ),
            array(
                'label' => $__H->__('Bottom Right'),
                'value' => AW_Activitystream_Helper_Data::OVERLAY_POSITION_BOTTOMRIGHT
            )
        );
    }
}