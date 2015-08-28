<?php
class ParadoxLabs_Requestsample_Block_Requestsample extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    public function getChoiceFirstCollection()
    {
       
        $collection = Mage::getModel('manager/grid')->getCollection()
            ->addFieldToFilter('manager_id',9);
        return $collection;
    }
    public function getChoiceSecondCollection()
    {
       
        $collection = Mage::getModel('manager/grid')->getCollection()
            ->addFieldToFilter('manager_id',2);
        return $collection;
    }
    public function getChoiceThirdCollection()
    {
       
        $collection = Mage::getModel('manager/grid')->getCollection()
            ->addFieldToFilter('manager_id',3);
        return $collection;
    }
    public function getChoiceForthCollection()
    {
       
        $collection = Mage::getModel('manager/grid')->getCollection()
            ->addFieldToFilter('manager_id',4);
        return $collection;
    }
    public function getChoiceCollection($id)
    {
       
        $collection = Mage::getModel('manager/grid')->getCollection()
            ->addFieldToFilter('manager_id',$id);
        return $collection;
    }
    
    public function getManagerCollection()
    {	
    	$collection = Mage::getModel('manager/manager')->getCollection();
    	return $collection;
    }
}