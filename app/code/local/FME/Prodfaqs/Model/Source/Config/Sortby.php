<?php
/**
 * FAQs And Product Questions
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   FME
 * @package    FAQs And Product Questions
 * @author     Asif Hussain <support@fmeextensions.com>
 * 	       
 * @copyright  Copyright 2012 © www.fmeextensions.com All right reserved
 */


class FME_Prodfaqs_Model_Source_Config_Sortby
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'latest', 'label'=>Mage::helper('prodfaqs')->__('Latest')),
            array('value' => 'helpful', 'label'=>Mage::helper('prodfaqs')->__('Helpfull Rating')),
            array('value' => 'order', 'label'=>Mage::helper('prodfaqs')->__('Order')),
        );
    }

}
