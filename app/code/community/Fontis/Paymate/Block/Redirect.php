<?php
/**
 * Fontis Paymate Extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so one can be sent to you a copy immediately.
 *
 * @category   Fontis
 * @package    Fontis_Paymate
 * @author     Lloyd Hazlett
 * @author     Chris Norton
 * @copyright  Copyright (c) 2010 Fontis Pty. Ltd. (http://www.fontis.com.au)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Fontis_Paymate_Block_Redirect extends Mage_Core_Block_Abstract
{
    protected function _toHtml()
    {
        $paymate = Mage::getModel('paymate/paymate');

        $form = new Varien_Data_Form();
        $form->setAction($paymate->getUrl())
            ->setId('paymate_checkout')
            ->setName('paymate_checkout')
            ->setMethod('GET')
            ->setUseContainer(true);
        foreach ($paymate->getCheckoutFormFields() as $field=>$value) {
            $form->addField($field, 'hidden', array('name'=>$field, 'value'=>$value));
        }
        $html = '<html><body>';
        $html.= $this->__('You will be redirected to PayMate in a few seconds.');
        $html.= $form->toHtml();
        $html.= '<script type="text/javascript">document.getElementById("paymate_checkout").submit();</script>';
        $html.= '</body></html>';

        return $html;
    }
}
