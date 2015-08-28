<?php
class MST_Ship_Model_Mysql4_Homedelivery extends Mage_Core_Model_Mysql4_Abstract
{

    public function _construct()
    {
        $this->_init('ship/homedelivery', 'id');
    }
}