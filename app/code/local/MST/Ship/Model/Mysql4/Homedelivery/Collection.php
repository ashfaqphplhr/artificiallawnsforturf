<?php
class MST_Ship_Model_Mysql4_Homedelivery_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('ship/homedelivery');
    }

}