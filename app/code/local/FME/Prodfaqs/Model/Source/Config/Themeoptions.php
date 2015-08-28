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


/**
 * Used in creating options for Themes config value selection
 *
 */
class FME_Prodfaqs_Model_Source_Config_Themeoptions
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'theme1', 'label'=>Mage::helper('prodfaqs')->__('Theme1')),
            array('value' => 'theme2', 'label'=>Mage::helper('prodfaqs')->__('Theme2')),
            array('value' => 'theme3', 'label'=>Mage::helper('prodfaqs')->__('Theme3')),
            array('value' => 'theme4', 'label'=>Mage::helper('prodfaqs')->__('Theme4')),
            array('value' => 'theme5', 'label'=>Mage::helper('prodfaqs')->__('Theme5')),
        );
    }

}
