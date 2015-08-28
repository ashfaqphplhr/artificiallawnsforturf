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
class AW_Activitystream_Block_Overlay extends AW_Activitystream_Block_Stream {
    
    /**
     * 
     */
    const OPACITY_CONSTRAIN_LOWER                 =  10;
    const OPACITY_CONSTRAIN_GREATER               = 100;
    
    
    /**
     * 
     */
    private $__position  = null;
    private $__width     = null;
    private $__measure   = null;
    private $__textColor = null;
    private $__linkColor = null;
    private $__bgColor   = null;
    private $__bgOpacity = null;
    
    
    /**
     * 
     */
    protected function _prepareLayout() {
        $__result = parent::_prepareLayout();
        $this->getLayout()->getBlock('head')->addCss('css/activitystream.css');
        return $__result;
    }
    
    
    /**
     * 
     */
    protected function _toHtml() {
        if (
            ( ! Mage::getStoreConfig(AW_Activitystream_Helper_Data::CONFIG_PATH_GENERAL_MODULEENABLED) )
            or
            (
                ( ! Mage::getSingleton('customer/session')->isLoggedIn() )
                and
                ( ! Mage::getStoreConfig(AW_Activitystream_Helper_Data::CONFIG_PATH_GENERAL_VISIBLETOGUESTS) )
            )
        ) return '';
        
        return parent::_toHtml();
    }
    
    
    /**
     * 
     */
    public function getPosition() {
        if ( is_null($this->__position) ) {
            $this->__position = Mage::getStoreConfig(AW_Activitystream_Helper_Data::CONFIG_PATH_LSOVERLAY_POSITION);
        }
        
        return $this->__position;
    }
    
    
    /**
     * 
     */
    public function getWidth() {
        if ( is_null($this->__width) ) {
            $__width = trim(Mage::getStoreConfig(AW_Activitystream_Helper_Data::CONFIG_PATH_LSOVERLAY_WIDTH));
            if (
                   preg_match('|^(\d+)$|is', $__width, $__matches)
                or preg_match('|^(\d+)' . AW_Activitystream_Helper_Data::HTML_PIXELS . '$|is', $__width, $__matches)
            ) {
                $this->__width = $__matches[1];
                $this->__measure = AW_Activitystream_Helper_Data::HTML_PIXELS;
            }
            elseif ( preg_match('|^(\d+)' . AW_Activitystream_Helper_Data::HTML_PERCENTS . '$|is', $__width, $__matches) ) {
                $this->__width = $__matches[1];
                $this->__measure = AW_Activitystream_Helper_Data::HTML_PERCENTS;
            }
            else {
                $this->__width = AW_Activitystream_Helper_Data::OVERLAY_WIDTH_DEFAULT;
                $this->__measure = AW_Activitystream_Helper_Data::HTML_PIXELS;
            }
        }
        
        return $this->__width;
    }
    
    
    /**
     * 
     */
    public function getMeasure() {
        if ( is_null($this->__width) ) $this->getWidth();
        return $this->__measure;
    }
    
    
    /**
     * 
     */
    public function isPositionCentered() {
        return
            $this->getPosition() == AW_Activitystream_Helper_Data::OVERLAY_POSITION_TOPCENTER
            or
            $this->getPosition() == AW_Activitystream_Helper_Data::OVERLAY_POSITION_BOTTOMCENTER
        ;
    }
    
    
    /**
     *
     */
    public function getBackgroundColor() {
        if ( is_null($this->__bgColor) ) {
            $this->__bgColor = Mage::getStoreConfig(AW_Activitystream_Helper_Data::CONFIG_PATH_LSOVERLAY_BGCOLOR);
            if ( substr($this->__bgColor, 0, 1) != '#' ) $this->__bgColor = '#' . $this->__bgColor;
        }
        
        return $this->__bgColor;
    }
    
    
    /**
     *
     */
    public function getTextColor() {
        if ( is_null($this->__textColor) ) {
            $this->__textColor = Mage::getStoreConfig(AW_Activitystream_Helper_Data::CONFIG_PATH_LSOVERLAY_TEXTCOLOR);
            if ( substr($this->__textColor, 0, 1) != '#' ) $this->__textColor = '#' . $this->__textColor;
        }
        
        return $this->__textColor;
    }
    
    
    /**
     *
     */
    public function getLinkColor() {
        if ( is_null($this->__linkColor) ) {
            $this->__linkColor = Mage::getStoreConfig(AW_Activitystream_Helper_Data::CONFIG_PATH_LSOVERLAY_LINKCOLOR);
            if ( substr($this->__linkColor, 0, 1) != '#' ) $this->__linkColor = '#' . $this->__linkColor;
        }
        
        return $this->__linkColor;
    }
    
    
    /**
     *
     */
    public function getBackgroundOpacity() {
        if ( is_null($this->__bgOpacity) ) {
            $__opacity = Mage::getStoreConfig(AW_Activitystream_Helper_Data::CONFIG_PATH_LSOVERLAY_BGOPACITY);
            $__opacity = intval($__opacity);
            if ( ($__opacity < self::OPACITY_CONSTRAIN_LOWER) or ($__opacity > self::OPACITY_CONSTRAIN_GREATER) ) {
                $this->__bgOpacity = AW_Activitystream_Helper_Data::STREAM_OPACITY_DEFAULT;
            }
            else $this->__bgOpacity = $__opacity;
        }
        
        return $this->__bgOpacity;
    }
    
    
    /**
     *
     */
    public function getBackgroundOpacityFloat() {
        return $this->getBackgroundOpacity() / 100;
    }
    
    
    /**
     * 
     */
    protected function __getPositionClassname() {
        switch ($this->getPosition()) {
            case AW_Activitystream_Helper_Data::OVERLAY_POSITION_TOPLEFT:
                $__className = 'ActivityStream_topLeft';
            break;
            case AW_Activitystream_Helper_Data::OVERLAY_POSITION_TOPCENTER:
                $__className = 'ActivityStream_topCenter';
            break;
            case AW_Activitystream_Helper_Data::OVERLAY_POSITION_TOPRIGHT:
                $__className = 'ActivityStream_topRight';
            break;
            case AW_Activitystream_Helper_Data::OVERLAY_POSITION_BOTTOMLEFT:
                $__className = 'ActivityStream_bottomLeft';
            break;
            case AW_Activitystream_Helper_Data::OVERLAY_POSITION_BOTTOMCENTER:
                $__className = 'ActivityStream_bottomCenter';
            break;
            case AW_Activitystream_Helper_Data::OVERLAY_POSITION_BOTTOMRIGHT:
                $__className = 'ActivityStream_bottomRight';
            break;
            default:
                $__className = '';
        }
        
        return $__className;
    }
    
    
    /**
     * 
     */
    protected function __getWidthHtml() {
        return $this->getWidth() . $this->getMeasure();
    }
    
    
    /**
     * 
     */
    protected function __getHalfWidthHtml() {
        return round($this->getWidth() / 2) . $this->getMeasure();
    }
    
    
    /**
     * 
     */
    protected function __getRecordsCount() {
        $__count = Mage::getStoreConfig(AW_Activitystream_Helper_Data::CONFIG_PATH_LSOVERLAY_NUMBER);
        
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
        return Mage::getStoreConfig(AW_Activitystream_Helper_Data::CONFIG_PATH_LSOVERLAY_STOREFILTER);
    }
    
    
    /**
     *
     */
    protected function __getUpdatePeriod() {
        return Mage::getStoreConfig(AW_Activitystream_Helper_Data::CONFIG_PATH_LSOVERLAY_UPDATEPERIOD);
    }
}