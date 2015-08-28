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
 * Shipping Rate (Brisbane) admin controller
 *
 * @category	Noworriesturf
 * @package		Noworriesturf_Shippingg
 * @author Ultimate Module Creator
 */
class Noworriesturf_Shippingg_Adminhtml_Shippingg_ShippingratebrisbaneController extends Noworriesturf_Shippingg_Controller_Adminhtml_Shippingg{
	/**
	 * init the shippingratebrisbane
	 * @access protected
	 * @return Noworriesturf_Shippingg_Model_Shippingratebrisbane
	 */
	protected function _initShippingratebrisbane(){
		$shippingratebrisbaneId  = (int) $this->getRequest()->getParam('id');
		$shippingratebrisbane	= Mage::getModel('shippingg/shippingratebrisbane');
		if ($shippingratebrisbaneId) {
			$shippingratebrisbane->load($shippingratebrisbaneId);
		}
		Mage::register('current_shippingratebrisbane', $shippingratebrisbane);
		return $shippingratebrisbane;
	}
 	/**
	 * default action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function indexAction() {
		$this->loadLayout();
		$this->_title(Mage::helper('shippingg')->__('Shipping'))
			 ->_title(Mage::helper('shippingg')->__('Shipping Rates (Brisbane)'));
		$this->renderLayout();
	}
	/**
	 * grid action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function gridAction() {
		$this->loadLayout()->renderLayout();
	}
	/**
	 * edit shipping rate (brisbane) - action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function editAction() {
		$shippingratebrisbaneId	= $this->getRequest()->getParam('id');
		$shippingratebrisbane  	= $this->_initShippingratebrisbane();
		if ($shippingratebrisbaneId && !$shippingratebrisbane->getId()) {
			$this->_getSession()->addError(Mage::helper('shippingg')->__('This shipping rate (brisbane) no longer exists.'));
			$this->_redirect('*/*/');
			return;
		}
		$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
		if (!empty($data)) {
			$shippingratebrisbane->setData($data);
		}
		Mage::register('shippingratebrisbane_data', $shippingratebrisbane);
		$this->loadLayout();
		$this->_title(Mage::helper('shippingg')->__('Shippingg'))
			 ->_title(Mage::helper('shippingg')->__('Shipping Rates (Brisbane)'));
		if ($shippingratebrisbane->getId()){
			$this->_title($shippingratebrisbane->getState());
		}
		else{
			$this->_title(Mage::helper('shippingg')->__('Add shipping rate (brisbane)'));
		}
		if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) { 
			$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true); 
		}
		$this->renderLayout();
	}
	/**
	 * new shipping rate (brisbane) action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function newAction() {
		$this->_forward('edit');
	}
	/**
	 * save shipping rate (brisbane) - action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function saveAction() {
		if ($data = $this->getRequest()->getPost('shippingratebrisbane')) {
			try {
				$shippingratebrisbane = $this->_initShippingratebrisbane();
				$shippingratebrisbane->addData($data);
				$shippingratebrisbane->save();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('shippingg')->__('Shipping Rate (Brisbane) was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);
				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $shippingratebrisbane->getId()));
					return;
				}
				$this->_redirect('*/*/');
				return;
			} 
			catch (Mage_Core_Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				Mage::getSingleton('adminhtml/session')->setFormData($data);
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				return;
			}
			catch (Exception $e) {
				Mage::logException($e);
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('shippingg')->__('There was a problem saving the shipping rate (brisbane).'));
				Mage::getSingleton('adminhtml/session')->setFormData($data);
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				return;
			}
		}
		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('shippingg')->__('Unable to find shipping rate (brisbane) to save.'));
		$this->_redirect('*/*/');
	}
	/**
	 * delete shipping rate (brisbane) - action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0) {
			try {
				$shippingratebrisbane = Mage::getModel('shippingg/shippingratebrisbane');
				$shippingratebrisbane->setId($this->getRequest()->getParam('id'))->delete();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('shippingg')->__('Shipping Rate (Brisbane) was successfully deleted.'));
				$this->_redirect('*/*/');
				return; 
			}
			catch (Mage_Core_Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
			catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('shippingg')->__('There was an error deleteing shipping rate (brisbane).'));
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				Mage::logException($e);
				return;
			}
		}
		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('shippingg')->__('Could not find shipping rate (brisbane) to delete.'));
		$this->_redirect('*/*/');
	}
	/**
	 * mass delete shipping rate (brisbane) - action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function massDeleteAction() {
		$shippingratebrisbaneIds = $this->getRequest()->getParam('shippingratebrisbane');
		if(!is_array($shippingratebrisbaneIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('shippingg')->__('Please select shipping rates (brisbane) to delete.'));
		}
		else {
			try {
				foreach ($shippingratebrisbaneIds as $shippingratebrisbaneId) {
					$shippingratebrisbane = Mage::getModel('shippingg/shippingratebrisbane');
					$shippingratebrisbane->setId($shippingratebrisbaneId)->delete();
				}
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('shippingg')->__('Total of %d shipping rates (brisbane) were successfully deleted.', count($shippingratebrisbaneIds)));
			}
			catch (Mage_Core_Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
			catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('shippingg')->__('There was an error deleteing shipping rates (brisbane).'));
				Mage::logException($e);
			}
		}
		$this->_redirect('*/*/index');
	}
	/**
	 * export as csv - action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function exportCsvAction(){
		$fileName   = 'shippingratebrisbane.csv';
		$content	= $this->getLayout()->createBlock('shippingg/adminhtml_shippingratebrisbane_grid')->getCsv();
		$this->_prepareDownloadResponse($fileName, $content);
	}
	/**
	 * export as MsExcel - action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function exportExcelAction(){
		$fileName   = 'shippingratebrisbane.xls';
		$content	= $this->getLayout()->createBlock('shippingg/adminhtml_shippingratebrisbane_grid')->getExcelFile();
		$this->_prepareDownloadResponse($fileName, $content);
	}
	/**
	 * export as xml - action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function exportXmlAction(){
		$fileName   = 'shippingratebrisbane.xml';
		$content	= $this->getLayout()->createBlock('shippingg/adminhtml_shippingratebrisbane_grid')->getXml();
		$this->_prepareDownloadResponse($fileName, $content);
	}
}