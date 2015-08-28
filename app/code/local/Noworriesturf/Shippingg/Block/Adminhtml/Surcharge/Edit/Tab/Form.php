<?php
/**
 * Noworriesturf_Shippingg extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category   	Noworriesturf
 * @package		Noworriesturf_Shippingg
 * @copyright  	Copyright (c) 2013
 * @license		http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Home Delivery Surcharge edit form tab
 *
 * @category	Noworriesturf
 * @package		Noworriesturf_Shippingg
 * @author Ultimate Module Creator
 */
class Noworriesturf_Shippingg_Block_Adminhtml_Surcharge_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form{	
	/**
	 * prepare the form
	 * @access protected
	 * @return Shippingg_Surcharge_Block_Adminhtml_Surcharge_Edit_Tab_Form
	 * @author Ultimate Module Creator
	 */
	protected function _prepareForm(){
		$form = new Varien_Data_Form();
		$form->setHtmlIdPrefix('surcharge_');
		$form->setFieldNameSuffix('surcharge');
		$this->setForm($form);
		$fieldset = $form->addFieldset('surcharge_form', array('legend'=>Mage::helper('shippingg')->__('Home Delivery Surcharge')));

		$fieldset->addField('weight_from', 'text', array(
			'label' => Mage::helper('shippingg')->__('Weight from'),
			'name'  => 'weight_from',
			'required'  => true,
			'class' => 'required-entry',

		));

		$fieldset->addField('weight_to', 'text', array(
			'label' => Mage::helper('shippingg')->__('Weight to'),
			'name'  => 'weight_to',
			'required'  => true,
			'class' => 'required-entry',

		));

		$fieldset->addField('cost', 'text', array(
			'label' => Mage::helper('shippingg')->__('Cost'),
			'name'  => 'cost',
			'required'  => true,
			'class' => 'required-entry',

		));
		if (Mage::app()->isSingleStoreMode()){
			$fieldset->addField('store_id', 'hidden', array(
                'name'      => 'stores[]',
                'value'     => Mage::app()->getStore(true)->getId()
            ));
            Mage::registry('current_surcharge')->setStoreId(Mage::app()->getStore(true)->getId());
		}
		if (Mage::getSingleton('adminhtml/session')->getSurchargeData()){
			$form->setValues(Mage::getSingleton('adminhtml/session')->getSurchargeData());
			Mage::getSingleton('adminhtml/session')->setSurchargeData(null);
		}
		elseif (Mage::registry('current_surcharge')){
			$form->setValues(Mage::registry('current_surcharge')->getData());
		}
		return parent::_prepareForm();
	}
}