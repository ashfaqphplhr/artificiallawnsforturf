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
 * Shipping Rate (Melbourne) admin controller
 *
 * @category	Noworriesturf
 * @package		Noworriesturf_Shippingg
 * @author Ultimate Module Creator
 */
class Noworriesturf_Shippingg_Adminhtml_Shippingg_ShippingrateController extends Noworriesturf_Shippingg_Controller_Adminhtml_Shippingg{
	/**
	 * init the shippingrate
	 * @access protected
	 * @return Noworriesturf_Shippingg_Model_Shippingrate
	 */
	protected function _initShippingrate(){
		$shippingrateId  = (int) $this->getRequest()->getParam('id');
		$shippingrate	= Mage::getModel('shippingg/shippingrate');
		if ($shippingrateId) {
			$shippingrate->load($shippingrateId);
		}
		Mage::register('current_shippingrate', $shippingrate);
		return $shippingrate;
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
			 ->_title(Mage::helper('shippingg')->__('Shipping Rates (Melbourne)'));
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
	 * edit shipping rate (melbourne) - action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function editAction() {
		$shippingrateId	= $this->getRequest()->getParam('id');
		$shippingrate  	= $this->_initShippingrate();
		if ($shippingrateId && !$shippingrate->getId()) {
			$this->_getSession()->addError(Mage::helper('shippingg')->__('This shipping rate (melbourne) no longer exists.'));
			$this->_redirect('*/*/');
			return;
		}
		$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
		if (!empty($data)) {
			$shippingrate->setData($data);
		}
		Mage::register('shippingrate_data', $shippingrate);
		$this->loadLayout();
		$this->_title(Mage::helper('shippingg')->__('Shippingg'))
			 ->_title(Mage::helper('shippingg')->__('Shipping Rates (Melbourne)'));
		if ($shippingrate->getId()){
			$this->_title($shippingrate->getState());
		}
		else{
			$this->_title(Mage::helper('shippingg')->__('Add shipping rate (melbourne)'));
		}
		if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) { 
			$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true); 
		}
		$this->renderLayout();
	}
	/**
	 * new shipping rate (melbourne) action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function newAction() {
		$this->_forward('edit');
	}
	/**
	 * save shipping rate (melbourne) - action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function saveAction() {
		if ($data = $this->getRequest()->getPost('shippingrate')) {
			try {
				$shippingrate = $this->_initShippingrate();
				$shippingrate->addData($data);
				$shippingrate->save();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('shippingg')->__('Shipping Rate (Melbourne) was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);
				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $shippingrate->getId()));
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
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('shippingg')->__('There was a problem saving the shipping rate (melbourne).'));
				Mage::getSingleton('adminhtml/session')->setFormData($data);
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				return;
			}
		}
		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('shippingg')->__('Unable to find shipping rate (melbourne) to save.'));
		$this->_redirect('*/*/');
	}
	/**
	 * delete shipping rate (melbourne) - action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0) {
			try {
				$shippingrate = Mage::getModel('shippingg/shippingrate');
				$shippingrate->setId($this->getRequest()->getParam('id'))->delete();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('shippingg')->__('Shipping Rate (Melbourne) was successfully deleted.'));
				$this->_redirect('*/*/');
				return; 
			}
			catch (Mage_Core_Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
			catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('shippingg')->__('There was an error deleteing shipping rate (melbourne).'));
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				Mage::logException($e);
				return;
			}
		}
		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('shippingg')->__('Could not find shipping rate (melbourne) to delete.'));
		$this->_redirect('*/*/');
	}
	/**
	 * mass delete shipping rate (melbourne) - action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function massDeleteAction() {
		$shippingrateIds = $this->getRequest()->getParam('shippingrate');
		if(!is_array($shippingrateIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('shippingg')->__('Please select shipping rates (melbourne) to delete.'));
		}
		else {
			try {
				foreach ($shippingrateIds as $shippingrateId) {
					$shippingrate = Mage::getModel('shippingg/shippingrate');
					$shippingrate->setId($shippingrateId)->delete();
				}
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('shippingg')->__('Total of %d shipping rates (melbourne) were successfully deleted.', count($shippingrateIds)));
			}
			catch (Mage_Core_Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
			catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('shippingg')->__('There was an error deleteing shipping rates (melbourne).'));
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
		$fileName   = 'shippingrate.csv';
		$content	= $this->getLayout()->createBlock('shippingg/adminhtml_shippingrate_grid')->getCsv();
		$this->_prepareDownloadResponse($fileName, $content);
	}
	/**
	 * export as MsExcel - action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function exportExcelAction(){
		$fileName   = 'shippingrate.xls';
		$content	= $this->getLayout()->createBlock('shippingg/adminhtml_shippingrate_grid')->getExcelFile();
		$this->_prepareDownloadResponse($fileName, $content);
	}
	/**
	 * export as xml - action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function exportXmlAction(){
		$fileName   = 'shippingrate.xml';
		$content	= $this->getLayout()->createBlock('shippingg/adminhtml_shippingrate_grid')->getXml();
		$this->_prepareDownloadResponse($fileName, $content);
	}
}