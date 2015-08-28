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
 * Shipping Rate (Melbourne) admin edit block
 *
 * @category	Noworriesturf
 * @package		Noworriesturf_Shippingg
 * @author Ultimate Module Creator
 */
class Noworriesturf_Shippingg_Block_Adminhtml_Shippingrate_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{
	/**
	 * constuctor
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function __construct(){
		parent::__construct();
		$this->_blockGroup = 'shippingg';
		$this->_controller = 'adminhtml_shippingrate';
		$this->_updateButton('save', 'label', Mage::helper('shippingg')->__('Save Shipping Rate (Melbourne)'));
		$this->_updateButton('delete', 'label', Mage::helper('shippingg')->__('Delete Shipping Rate (Melbourne)'));
		$this->_addButton('saveandcontinue', array(
			'label'		=> Mage::helper('shippingg')->__('Save And Continue Edit'),
			'onclick'	=> 'saveAndContinueEdit()',
			'class'		=> 'save',
		), -100);
		$this->_formScripts[] = "
			function saveAndContinueEdit(){
				editForm.submit($('edit_form').action+'back/edit/');
			}
		";
	}
	/**
	 * get the edit form header
	 * @access public
	 * @return string
	 * @author Ultimate Module Creator
	 */
	public function getHeaderText(){
		if( Mage::registry('shippingrate_data') && Mage::registry('shippingrate_data')->getId() ) {
			return Mage::helper('shippingg')->__("Edit Shipping Rate (Melbourne) '%s'", $this->htmlEscape(Mage::registry('shippingrate_data')->getState()));
		} 
		else {
			return Mage::helper('shippingg')->__('Add Shipping Rate (Melbourne)');
		}
	}
}