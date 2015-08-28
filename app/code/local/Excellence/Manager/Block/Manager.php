<?php
class Excellence_Manager_Block_Manager extends Mage_Catalog_Block_Product_View
{
    public function getChoiceFirstCollection()
    {
       
        $collection = Mage::getModel('manager/grid')->getCollection()
            ->addFieldToFilter('manager_id',1);
        return $collection;
    }
    public function getChoiceSecondCollection()
    {
       
        $collection = Mage::getModel('manager/grid')->getCollection()
            ->addFieldToFilter('manager_id',2);
        return $collection;
    }
}