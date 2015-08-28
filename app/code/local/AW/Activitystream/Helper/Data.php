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
class AW_Activitystream_Helper_Data extends Mage_Core_Helper_Abstract {
    
    /**
     * 
     */
    const CONFIG_PATH_GENERAL_MODULEENABLED       = 'activitystream/general/module_enabled';
    const CONFIG_PATH_GENERAL_VISIBLETOGUESTS     = 'activitystream/general/visible_to_guests';
    
    const CONFIG_PATH_LSOVERLAY_POSITION          = 'activitystream/live_stream_overlay/position';
    const CONFIG_PATH_LSOVERLAY_WIDTH             = 'activitystream/live_stream_overlay/outer_rectangle_width';
    const CONFIG_PATH_LSOVERLAY_NUMBER            = 'activitystream/live_stream_overlay/number_of_activities_to_display';
    const CONFIG_PATH_LSOVERLAY_BGCOLOR           = 'activitystream/live_stream_overlay/background_color';
    const CONFIG_PATH_LSOVERLAY_TEXTCOLOR         = 'activitystream/live_stream_overlay/text_color';
    const CONFIG_PATH_LSOVERLAY_LINKCOLOR         = 'activitystream/live_stream_overlay/link_color';
    const CONFIG_PATH_LSOVERLAY_BGOPACITY         = 'activitystream/live_stream_overlay/background_opacity';
    const CONFIG_PATH_LSOVERLAY_STOREFILTER       = 'activitystream/live_stream_overlay/activity_store_filter';
    const CONFIG_PATH_LSOVERLAY_UPDATEPERIOD      = 'activitystream/live_stream_overlay/update_period';
    
    
    const STREAM_STOREFILTER_STOREVIEW            = 'storeview';
    const STREAM_STOREFILTER_STORE                = 'store';
    const STREAM_STOREFILTER_WEBSITE              = 'website';
    const STREAM_STOREFILTER_DISPLAYALL           = 'all';
    const STREAM_STOREFILTER_DEFAULT              = self::STREAM_STOREFILTER_STOREVIEW;
    
    const STREAM_NUMBEROFACTIVITIES_DEFAULT       = 5;
    const STREAM_OPACITY_DEFAULT                  = 50;
    const STREAM_UPDATEPERIOD_DEFAULT             = 3;
    
    
    const OVERLAY_POSITION_NONE                   = '';
    const OVERLAY_POSITION_TOPLEFT                = 'tl';
    const OVERLAY_POSITION_TOPCENTER              = 'tc';
    const OVERLAY_POSITION_TOPRIGHT               = 'tr';
    const OVERLAY_POSITION_BOTTOMLEFT             = 'bl';
    const OVERLAY_POSITION_BOTTOMCENTER           = 'bc';
    const OVERLAY_POSITION_BOTTOMRIGHT            = 'br';
    const OVERLAY_POSITION_DEFAULT                = self::OVERLAY_POSITION_NONE;
    
    const OVERLAY_WIDTH_DEFAULT                   = 600;
    
    const OVERLAY_RECORDS_COUNT_CONSTRAINT_L      =   1;
    const OVERLAY_RECORDS_COUNT_CONSTRAINT_R      =  50;
    
    
    const ACTIVITY_RENDER_BLOCK_NAME              = '__aw_activitystream_helper_activityRenderBlock';
    
    
    const HTML_PIXELS                             = 'px';
    const HTML_PERCENTS                           = '%';
    
    
    /**
     * 
     */
    private $__activityRenderBlock                = null;
    
    
    /**
     * @todo
     */
    public function registerActivity($type) {
        
    }
    
    
    /**
     * @param AW_Activitystream_Model_Activity $activity
     */
    public function renderActivity($activity) {
        $__html = $this->__getActivityRenderBlock()->setActivity($activity)->toHtml();
        $__html = preg_replace('|\s{2,}|', '', $__html);
        $__html = preg_replace('|&nbsp;|', ' ', $__html);
        return $__html;
    }
    
    
    /**
     * 
     */
    protected function __getActivityRenderBlock() {
        if ( !$this->__activityRenderBlock ) {
            $this->__activityRenderBlock = $this->__getLayout()
                ->createBlock('activitystream/activityRecord')
                ->setAlias(self::ACTIVITY_RENDER_BLOCK_NAME)
                ->setTemplate('activitystream/activity_record.phtml')
            ;
        }
        
        return $this->__activityRenderBlock;
    }
    
    
    /**
     * 
     */
    private function __getLayout() {
        return Mage::app()->getFrontController()->getAction()->getLayout();
    }
}