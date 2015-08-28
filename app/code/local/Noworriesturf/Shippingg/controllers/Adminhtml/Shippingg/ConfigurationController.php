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
class Noworriesturf_Shippingg_Adminhtml_Shippingg_ConfigurationController extends Noworriesturf_Shippingg_Controller_Adminhtml_Shippingg{
 	/**
	 * default action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function indexAction() {
		$this->loadLayout();
		$this->_title(Mage::helper('shippingg')->__('Shipping'))
			 ->_title(Mage::helper('shippingg')->__('Configuration'));
			 
		//	 $config = Mage::getStoreConfig('noworriesturf/cubic_variable');
			 
		$this->renderLayout();
	}
        
        public function saveAction() {
           
		   $request = $this->getRequest()->getParams();
		   
		   
		    try {
				
				
                $access_token = isset($_POST['access_token']) ? $_POST['access_token'] : 'B937834782834F048E3D3415CF4830C4';
                $cubic_variable = isset($_POST['cubic_variable']) ? $_POST['cubic_variable'] : 250;
                $gst = isset($_POST['gst']) ? $_POST['gst'] : 30;
                $insurance = isset($_POST['insurance']) ? $_POST['insurance'] : 5;
                
          // $config = Mage::getModel('core/config');
		  $config = new Mage_Core_Model_Config();
                
           $data = array('access_token'=>$access_token,
		   				 'cubic_variable'=>$cubic_variable,
						 'gst'=>$gst,
						 'insurance'=>$insurance,
		   				);
						
			
		   $config->saveConfig('noworriesturf/access_token', trim($access_token));
           $config->saveConfig('noworriesturf/cubic_variable', (int)$cubic_variable);
           $config->saveConfig('noworriesturf/gst', (int)$gst);
           $config->saveConfig('noworriesturf/insurance', (int)$insurance);

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The configuration has been saved.'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving configuration.'));
            }

            return $this->_redirect("*/*/index");
        }
}