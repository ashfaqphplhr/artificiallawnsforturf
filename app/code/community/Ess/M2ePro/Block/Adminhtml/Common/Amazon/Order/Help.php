<?php

/*
 * @copyright  Copyright (c) 2013 by  ESS-UA.
 */

class Ess_M2ePro_Block_Adminhtml_Common_Amazon_Order_Help extends Mage_Adminhtml_Block_Widget_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->setTemplate('M2ePro/common/amazon/order/help.phtml');
    }

    public function getContainerId()
    {
        return 'block_notice_amazon_orders_list';
    }
}