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
 * Home Delivery Surcharge admin controller
 *
 * @category	Noworriesturf
 * @package		Noworriesturf_Shippingg
 * @author Ultimate Module Creator
 */
class Noworriesturf_Shippingg_Adminhtml_Shippingg_SurchargeController extends Noworriesturf_Shippingg_Controller_Adminhtml_Shippingg{
	/**
	 * init the surcharge
	 * @access protected
	 * @return Noworriesturf_Shippingg_Model_Surcharge
	 */
	protected function _initSurcharge(){
		$surchargeId  = (int) $this->getRequest()->getParam('id');
		$surcharge	= Mage::getModel('shippingg/surcharge');
		if ($surchargeId) {
			$surcharge->load($surchargeId);
		}
		Mage::register('current_surcharge', $surcharge);
		return $surcharge;
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
			 ->_title(Mage::helper('shippingg')->__('Home Delivery Surcharges'));
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
	 * edit home delivery surcharge - action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function editAction() {
		$surchargeId	= $this->getRequest()->getParam('id');
		$surcharge  	= $this->_initSurcharge();
		if ($surchargeId && !$surcharge->getId()) {
			$this->_getSession()->addError(Mage::helper('shippingg')->__('This home delivery surcharge no longer exists.'));
			$this->_redirect('*/*/');
			return;
		}
		$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
		if (!empty($data)) {
			$surcharge->setData($data);
		}
		Mage::register('surcharge_data', $surcharge);
		$this->loadLayout();
		$this->_title(Mage::helper('shippingg')->__('Shippingg'))
			 ->_title(Mage::helper('shippingg')->__('Home Delivery Surcharges'));
		if ($surcharge->getId()){
			$this->_title($surcharge->getWeightFrom());
		}
		else{
			$this->_title(Mage::helper('shippingg')->__('Add home delivery surcharge'));
		}
		if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) { 
			$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true); 
		}
		$this->renderLayout();
	}
	/**
	 * new home delivery surcharge action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function newAction() {
		$this->_forward('edit');
	}
	/**
	 * save home delivery surcharge - action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function saveAction() {
		if ($data = $this->getRequest()->getPost('surcharge')) {
			try {
				$surcharge = $this->_initSurcharge();
				$surcharge->addData($data);
				$surcharge->save();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('shippingg')->__('Home Delivery Surcharge was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);
				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $surcharge->getId()));
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
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('shippingg')->__('There was a problem saving the home delivery surcharge.'));
				Mage::getSingleton('adminhtml/session')->setFormData($data);
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				return;
			}
		}
		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('shippingg')->__('Unable to find home delivery surcharge to save.'));
		$this->_redirect('*/*/');
	}
	/**
	 * delete home delivery surcharge - action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0) {
			try {
				$surcharge = Mage::getModel('shippingg/surcharge');
				$surcharge->setId($this->getRequest()->getParam('id'))->delete();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('shippingg')->__('Home Delivery Surcharge was successfully deleted.'));
				$this->_redirect('*/*/');
				return; 
			}
			catch (Mage_Core_Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
			catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('shippingg')->__('There was an error deleteing home delivery surcharge.'));
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				Mage::logException($e);
				return;
			}
		}
		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('shippingg')->__('Could not find home delivery surcharge to delete.'));
		$this->_redirect('*/*/');
	}
	/**
	 * mass delete home delivery surcharge - action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function massDeleteAction() {
		$surchargeIds = $this->getRequest()->getParam('surcharge');
		if(!is_array($surchargeIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('shippingg')->__('Please select home delivery surcharges to delete.'));
		}
		else {
			try {
				foreach ($surchargeIds as $surchargeId) {
					$surcharge = Mage::getModel('shippingg/surcharge');
					$surcharge->setId($surchargeId)->delete();
				}
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('shippingg')->__('Total of %d home delivery surcharges were successfully deleted.', count($surchargeIds)));
			}
			catch (Mage_Core_Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
			catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('shippingg')->__('There was an error deleteing home delivery surcharges.'));
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
		$fileName   = 'surcharge.csv';
		$content	= $this->getLayout()->createBlock('shippingg/adminhtml_surcharge_grid')->getCsv();
		$this->_prepareDownloadResponse($fileName, $content);
	}
	/**
	 * export as MsExcel - action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function exportExcelAction(){
		$fileName   = 'surcharge.xls';
		$content	= $this->getLayout()->createBlock('shippingg/adminhtml_surcharge_grid')->getExcelFile();
		$this->_prepareDownloadResponse($fileName, $content);
	}
	/**
	 * export as xml - action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function exportXmlAction(){
		$fileName   = 'surcharge.xml';
		$content	= $this->getLayout()->createBlock('shippingg/adminhtml_surcharge_grid')->getXml();
		$this->_prepareDownloadResponse($fileName, $content);
	}
}