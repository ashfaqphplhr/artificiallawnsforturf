<?php

class Tentura_Ngroups_Model_Ngroups extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('ngroups/ngroups');
    }
    public function getGroupSubscribers($groupId, $count = false){
        
        $subscribers = Mage::getModel('ngroups/ngroupitems')->getCollection()->addFieldToFilter("group_id", $groupId);
        if ($count){
            return sizeof($subscribers);
        }
        return $subscribers;
        
    }
    public function getSubscriberGroups($subscriberId, $count = false, $collection = false){
        
        $groups = Mage::getModel('ngroups/ngroupitems')->getCollection()->addFieldToFilter("subscriber_id", $subscriberId);
        if ($count){
            return sizeof($groups);
        }
        if ($collection){
            return $groups;
        }
        $ids = array();
        foreach ($groups as $group){
            $ids[] = $group->getGroupId();
        }
        return $ids;
        
    }
    /*
     * object Varien Collection - collection of subscribers
     */
    public function removeSubscribersFromGroup($collection, $groupId){
        
        if (!$collection){
            return true;
        }
        $collection = Mage::getModel("ngroups/ngroupitems")->getCollection()
                                                            ->addFieldToFilter('subscriber_id', $collection)
                                                            ->addFieldToFilter('group_id', $groupId);
        
        foreach ($collection as $subscriber){
            $subscriber->delete();
        }
        return true;        
    
    }
    
    public function convertEmailsToSubscribers($emailsString){
        
         // Get emails from test fields
        $emails = nl2br($emailsString);

        $newEmString = array();
        if (isset($emails) && $emails != "") {
            $mails = explode('<br />', $emails);
            foreach ($mails as $mail) {

                try {
                    if (!Zend_Validate::is($mail, 'EmailAddress')) {

                    }
                    if ($mail && $mail != "") {
                        $status = Mage::getModel('newsletter/subscriber')->subscribe(trim($mail));
                        if ($status > 0) {
                            $user = Mage::getModel('newsletter/subscriber')->loadByEmail(trim($mail));
                            $id = $user->getId();
                            $user->confirm($user->getCode());
                            $newEmString [] = $id;
                        }
                    }
                } catch (Mage_Core_Exception $e) {

                } catch (Exception $e) {

                }
            }
        }
        
        return $newEmString;
        
    }
    
    public function saveSubscribers($subscribers, $groupId){
        
        foreach ($subscribers as $subscriber){

            Mage::getModel("ngroups/ngroupitems")->setData(array('group_id'=>$groupId, 'subscriber_id'=>$subscriber))->setId(null)->save();
            
        }
        
        return true;
        
    }
    public function addSubscriber($subscriberId = false, $groupId, $email = false){
        
        if ($email){
            $subscriberId = Mage::getModel("newsletter/subscriber")->loadByEmail($email)->getId();
        }
        if (!$subscriberId){
            return false;
        }
        
        $isExists = Mage::getModel("ngroups/ngroupitems")->getCollection()
                                                ->addFieldToFilter('group_id', $groupId)
                                                ->addFieldToFilter('subscriber_id', $subscriberId)
                                                ->getFirstItem();
        if (!$isExists->getData()){
            Mage::getModel("ngroups/ngroupitems")->setData(array('group_id'=>$groupId, 'subscriber_id'=>$subscriberId))->setId(null)->save();
            return true;
        }
        return false;
        
    }
    public function removeSubscriber($subscriberId = false, $groupId = false, $email = false, $all = false){

        if ($email){
            $subscriberId = Mage::getModel("newsletter/subscriber")->loadByEmail($email)->getId();
        }
        if (!$subscriberId){
            return false;
        }
        if (!$all){
            $isExists = Mage::getModel("ngroups/ngroupitems")->getCollection()
                                                    ->addFieldToFilter('group_id', $groupId)
                                                    ->addFieldToFilter('subscriber_id', $subscriberId)
                                                    ->getFirstItem();
            if ($isExists->getData()){
                Mage::getModel("ngroups/ngroupitems")->load($isExists->getId())->delete();
                return true;
            }
        }else{
            
            $existsItems = Mage::getModel("ngroups/ngroupitems")->getCollection()
                                                    ->addFieldToFilter('subscriber_id', $subscriberId);
            foreach ($existsItems as $existsItem){
                Mage::getModel("ngroups/ngroupitems")->load($existsItem->getId())->delete();
            }
        }
        return false;
        
    }
    
    public function getVisibleGroups(){
        
        return $this->getCollection()->addFieldToFilter('visible', '1');
        
    }
    public function isSubscribed($groupId, $subscriberId = false){
        
        if (!$subscriberId){
            $subscriberId = Mage::helper('ngroups')->getSubscriberIdByEmail(Mage::getSingleton('customer/session')->getCustomer()->getEmail());
            if (!$subscriberId){
                return false;
            }
        }
        $isExists = Mage::getModel("ngroups/ngroupitems")->getCollection()
                                                    ->addFieldToFilter('group_id', $groupId)
                                                    ->addFieldToFilter('subscriber_id', $subscriberId)
                                                    ->getFirstItem();
        if (!$isExists->getData()){
            return false;
        }
        return true;
        
    }
}