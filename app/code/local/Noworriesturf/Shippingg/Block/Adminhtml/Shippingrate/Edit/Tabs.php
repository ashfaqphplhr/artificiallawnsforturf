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
 * Shipping Rate (Melbourne) admin edit tabs
 *
 * @category	Noworriesturf
 * @package		Noworriesturf_Shippingg
 * @author Ultimate Module Creator
 */
class Noworriesturf_Shippingg_Block_Adminhtml_Shippingrate_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs{
	/**
	 * constructor
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function __construct(){
		parent::__construct();
		$this->setId('shippingrate_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(Mage::helper('shippingg')->__('Shipping Rate (Melbourne)'));
	}
	/**
	 * before render html
	 * @access protected
	 * @return Noworriesturf_Shippingg_Block_Adminhtml_Shippingrate_Edit_Tabs
	 * @author Ultimate Module Creator
	 */
	protected function _beforeToHtml(){
		$this->addTab('form_shippingrate', array(
			'label'		=> Mage::helper('shippingg')->__('Shipping Rate (Melbourne)'),
			'title'		=> Mage::helper('shippingg')->__('Shipping Rate (Melbourne)'),
			'content' 	=> $this->getLayout()->createBlock('shippingg/adminhtml_shippingrate_edit_tab_form')->toHtml(),
		));
		if (!Mage::app()->isSingleStoreMode()){
			$this->addTab('form_store_shippingrate', array(
				'label'		=> Mage::helper('shippingg')->__('Store views'),
				'title'		=> Mage::helper('shippingg')->__('Store views'),
				'content' 	=> $this->getLayout()->createBlock('shippingg/adminhtml_shippingrate_edit_tab_stores')->toHtml(),
			));
		}
		return parent::_beforeToHtml();
	}
}