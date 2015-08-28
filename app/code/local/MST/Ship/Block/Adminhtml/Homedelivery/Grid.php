<?php
class MST_Ship_Block_Adminhtml_Homedelivery_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('homedeliveryGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setTemplate('mst_ship/homedelivery.phtml');
    }
}