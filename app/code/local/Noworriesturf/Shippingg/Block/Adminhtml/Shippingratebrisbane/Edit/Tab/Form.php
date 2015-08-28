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
 * Shipping Rate (Brisbane) edit form tab
 *
 * @category	Noworriesturf
 * @package		Noworriesturf_Shippingg
 * @author Ultimate Module Creator
 */
class Noworriesturf_Shippingg_Block_Adminhtml_Shippingratebrisbane_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form{	
	/**
	 * prepare the form
	 * @access protected
	 * @return Shippingg_Shippingratebrisbane_Block_Adminhtml_Shippingratebrisbane_Edit_Tab_Form
	 * @author Ultimate Module Creator
	 */
	protected function _prepareForm(){
		$form = new Varien_Data_Form();
		$form->setHtmlIdPrefix('shippingratebrisbane_');
		$form->setFieldNameSuffix('shippingratebrisbane');
		$this->setForm($form);
		$fieldset = $form->addFieldset('shippingratebrisbane_form', array('legend'=>Mage::helper('shippingg')->__('Shipping Rate (Brisbane)')));

		$fieldset->addField('state', 'text', array(
			'label' => Mage::helper('shippingg')->__('State'),
			'name'  => 'state',
			'required'  => true,
			'class' => 'required-entry',

		));

		$fieldset->addField('postcode', 'text', array(
			'label' => Mage::helper('shippingg')->__('Post Code'),
			'name'  => 'postcode',
			'required'  => true,
			'class' => 'required-entry',

		));

		$fieldset->addField('basiccharge', 'text', array(
			'label' => Mage::helper('shippingg')->__('Basic Charge'),
			'name'  => 'basiccharge',
			'required'  => true,
			'class' => 'required-entry',

		));

		$fieldset->addField('costperkg', 'text', array(
			'label' => Mage::helper('shippingg')->__('Cost per KG'),
			'name'  => 'costperkg',
			'required'  => true,
			'class' => 'required-entry',

		));
		if (Mage::app()->isSingleStoreMode()){
			$fieldset->addField('store_id', 'hidden', array(
                'name'      => 'stores[]',
                'value'     => Mage::app()->getStore(true)->getId()
            ));
            Mage::registry('current_shippingratebrisbane')->setStoreId(Mage::app()->getStore(true)->getId());
		}
		if (Mage::getSingleton('adminhtml/session')->getShippingratebrisbaneData()){
			$form->setValues(Mage::getSingleton('adminhtml/session')->getShippingratebrisbaneData());
			Mage::getSingleton('adminhtml/session')->setShippingratebrisbaneData(null);
		}
		elseif (Mage::registry('current_shippingratebrisbane')){
			$form->setValues(Mage::registry('current_shippingratebrisbane')->getData());
		}
		return parent::_prepareForm();
	}
}