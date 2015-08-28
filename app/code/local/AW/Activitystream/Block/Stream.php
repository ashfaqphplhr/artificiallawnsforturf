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
class AW_Activitystream_Block_Stream extends Mage_Core_Block_Template {
    
    /**
     * 
     */
    const UPDATE_CONTROLLER_ROUTE  = 'activitystream/index/index';
    
    
    /**
     * 
     */
    private $__activities          = null;
    private $__recordsCount        = null;
    private $__updatePeriod        = null;
    private $__storeFilter         = null;
    private $__htmlID              = null;
    
    
    /**
     * 
     */
    protected function _prepareLayout() {
        $__result = parent::_prepareLayout();
        $this->getLayout()->getBlock('head')->addJs('activitystream/stream.js');
        return $__result;
    }
    
    
    /**
     * 
     */
    public function getHtmlId() {
        if ( is_null($this->__htmlID) ) {
            $this->__htmlID = Mage::helper('core')->uniqHash('activitystream_Stream_');
        }
        
        return $this->__htmlID;
    }
    
    
    /**
     * 
     */
    public function getUpdateControllerURL() {
        return $this->getUrl(
            $this->__getUpdateControllerRoute(),
            array( '_secure' => Mage::app()->getFrontController()->getRequest()->isSecure() )
        );
    }
    
    
    /**
     * 
     */
    public function getUpdatePeriod() {
        if ( is_null($this->__updatePeriod) ) {
            $this->__updatePeriod = $this->__getUpdatePeriod();
        }
        
        return $this->__updatePeriod;
    }
    
    
    /**
     * 
     */
    public function getActivities() {
        if (!$this->__activities) {
            $this->__activities = $this->__loadActivities();
        }
        
        return $this->__activities;
    }
    
    
    /**
     * 
     */
    public function getActivitiesCount() {
        return count($this->getActivities());
    }
    
    
    /**
     * 
     */
    public function getLatestActivityTimestamp() {
        $__timestamp = null;
        
        foreach ($this->getActivities() as $__activity) {
            if ( $__activity->getCreationTimestamp() > $__timestamp ) {
                $__timestamp = $__activity->getCreationTimestamp();
            }
        }
        
        return $__timestamp;
    }
    
    
    /**
     * 
     */
    public function getRecordsCount() {
        if ( is_null($this->__recordsCount) ) {
            $this->__recordsCount = $this->__getRecordsCount();
        }
        
        return $this->__recordsCount;
    }
    
    
    /**
     * 
     */
    public function setRecordsCount($count) {
        if ( intval($count) > 0 ) $this->__recordsCount = $__count;
        
        return $this;
    }
    
    
    /**
     * 
     */
    public function getStoreFilter() {
        if ( is_null($this->__storeFilter) ) {
            $this->__storeFilter = $this->__getStoreFilter();
        }
        
        return $this->__storeFilter;
    }
    
    
    /**
     * @param Varien_Object $activity
     */
    public function renderActivity($activity) {
        return Mage::helper('activitystream')->renderActivity($activity);
    }
    
    
    /**
     * 
     */
    protected function __getUpdateControllerRoute() {
        return self::UPDATE_CONTROLLER_ROUTE;
    }
    
    
    /**
     * 
     */
    protected function __getRecordsCount() {
        return AW_Activitystream_Helper_Data::STREAM_NUMBEROFACTIVITIES_DEFAULT;
    }
    
    
    /**
     *
     */
    protected function __getUpdatePeriod() {
        return AW_Activitystream_Helper_Data::STREAM_UPDATEPERIOD_DEFAULT;
    }
    
    
    /**
     * 
     */
    protected function __getStoreFilter() {
        return AW_Activitystream_Helper_Data::STREAM_STOREFILTER_DEFAULT;
    }
    
    
    /**
     * 
     */
    protected function __loadActivities() {
        $__VH = Mage::helper('activitystream/dataValidation');
        
        try {
            $__activityModel = Mage::getModel('activitystream/activity');
            $__VH->mustbeavalidVarienObject($__activityModel);
            $__activityCollection = $__activityModel->getCollection();
            $__VH->mustbeavalidObject($__activityCollection);
            
            $__activityCollection
                ->joinDetails()
                ->newestFirst()
                ->filterByTypes( Mage::helper('activitystream/adminhtml')->getEnabledActivityTypes() )
            ;
            $__recordsCount = $this->getRecordsCount();
            if ( $__recordsCount ) $__activityCollection->setPageSize($__recordsCount)->setCurPage(0);
            
            $__storeFilter = $this->getStoreFilter();
            switch ( $__storeFilter ) {
                case AW_Activitystream_Helper_Data::STREAM_STOREFILTER_STOREVIEW:
                    $__activityCollection->filterByStoreView(Mage::app()->getStore()->getStoreId());
                break;
                case AW_Activitystream_Helper_Data::STREAM_STOREFILTER_STORE:
                    $__activityCollection->filterByStoreGroup(Mage::app()->getStore()->getGroupId());
                break;
                case AW_Activitystream_Helper_Data::STREAM_STOREFILTER_WEBSITE:
                    $__activityCollection->filterByWebsite(Mage::app()->getStore()->getWebsiteId());
                break;
            }
            
            $__activityCollection->load();
            $__items = array_reverse($__activityCollection->getItems());
        }
        catch (Exception $__E) {
            Mage::logException($__E);
            $__items = array();
        }
        
        return $__items;
    }
}