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

class Fontis_Paymate_Block_Form extends Mage_Payment_Block_Form
{
    protected function _toHtml()
    {
        $_code = $this->getMethodCode();
        $html = '<ul id="payment_form_' . $_code . '" class="form-list" style="display:none"><li>';
        $html .= $this->__('You will be redirected to the Paymate website when you place an order.');
        $html .= '</li></ul>';
        return $html;
    }
}
