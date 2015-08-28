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
class AW_Activitystream_IndexController extends Mage_Core_Controller_Front_Action {
    
    /**
     * @todo Rename variables to carry more understandability
     */
    public function indexAction() {
        $__VH = Mage::helper('activitystream/dataValidation');
        
        $__activityModel = Mage::getModel('activitystream/activity');
        $__VH->mustbeavalidVarienObject($__activityModel);
        $__activityCollection = $__activityModel->getCollection();
        $__VH->mustbeavalidObject($__activityCollection);
        
        $__moment = $this->getRequest()->getParam('moment');
        $__storeFilter = $this->getRequest()->getParam('storefilter');
        
        $__items = $__activityCollection
            ->newestFirst()
            ->startingFrom($__moment)
            ->joinDetails()
        ;
        
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
        
        $__activityCollection
            ->filterByTypes( Mage::helper('activitystream/adminhtml')->getEnabledActivityTypes() )
            ->setPageSize(50)
            ->setCurPage(0)
        ;
        
        $__activityCollection->load();
        $__items = array_reverse($__activityCollection->getItems());
        
        $__activities = array();
        foreach ( $__items as $__item ) {
            $__activity = array(
                'DATA' => $__item->getData(),
                'RECORD_HTML' => $this->__renderActivity($__item)
            );
            array_push($__activities, $__activity);
        }
        
        $__responseObject = new Varien_Object();
        $__responseObject->setActivities(array_reverse($__activities));
        
        $this->getResponse()
            ->setHeader('Content-Type', 'application/json')
            ->setBody($__responseObject->toJson())
        ;
    }
    
    
    /**
     * 
     */
    protected function __renderActivity($activity) {
        return Mage::helper('activitystream')->renderActivity($activity);
    }
}