<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Activitystream
 * @version    1.0.2
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


/**
 * 
 */
class AW_Activitystream_Block_AdminhtmlWidgetFieldStorefilter extends Mage_Adminhtml_Block_Widget_Form_Renderer_Fieldset_Element {
    
    public function render(Varien_Data_Form_Element_Abstract $element) {
        $__html = '';
        
        if ( ! Mage::app()->isSingleStoreMode() ) {
            $__replacingElement = new Varien_Data_Form_Element_Select();
            $__replacingElement->setData($element->getData());
            $__replacingElement->setForm($element->getForm());
            
            $__html = parent::render($__replacingElement);
        }
        
        return $__html;
    }
}