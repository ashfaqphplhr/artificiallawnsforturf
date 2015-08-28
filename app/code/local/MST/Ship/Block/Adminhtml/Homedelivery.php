<?php

class MST_Ship_Block_Adminhtml_Homedelivery extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'adminhtml_homedelivery';
        $this->_blockGroup = 'ship';
        $this->_headerText = Mage::helper('ship')->__('Manage Home Delivery Surcharges');
        //$this->_addButtonLabel = Mage::helper('ship')->__('Add New Rule');
        
         $this->_addButton('save_homedelivery', array(
            'label'     => Mage::helper('adminhtml')->__('Add New Rule'),
            'class'     => 'add add_homedelivery_btn',
        	'onclick'=>"MST.addHomedelivery();"
        ));
        
        parent::__construct();
        $this->removeButton('add');//After return parent::__construct();
    }
}