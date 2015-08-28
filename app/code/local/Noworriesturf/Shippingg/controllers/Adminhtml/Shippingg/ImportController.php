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
class Noworriesturf_Shippingg_Adminhtml_Shippingg_ImportController extends Noworriesturf_Shippingg_Controller_Adminhtml_Shippingg{
 	/**
	 * default action
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function indexAction() {
		$this->loadLayout();
		$this->_title(Mage::helper('shippingg')->__('Shipping'))
			 ->_title(Mage::helper('shippingg')->__('Import Shipping Rates'));
		$this->renderLayout();
	}
        
        public function saveAction() {
            try {
                $storeId = 0;
                $type = isset($_POST['type']) ? $_POST['type'] : null;
                
                if (!$type) {
                    throw new Exception('No import type.');
                }
                
                $file = isset($_FILES['file']) && !empty($_FILES['file']) ? $_FILES['file'] : null;
                
                if (!$file) {
                    throw new Exception('No import file.');
                }
                
                $this->importData($storeId, $file, $type);
                
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The shipping rates has been imported.'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while importing shipping rates. (' . $e->getMessage() . ')'));
            }

            return $this->_redirect("*/*/index");
        }
        
        protected function uploadFile($file) {
            if ($file['error'] != UPLOAD_ERR_OK) {
                throw new Exception('File upload error.');
            }
            
            $d = Mage::getBaseDir('var');
            $d .= '/tmp';
            
            if (!is_dir($d) && !mkdir($d)) {
                throw new Exception('File upload error - upload directory "' . $d . '" was not found and couldnt be created.');
            }
            
            $f = $d . '/' . basename($file['name']);
            
            if (!is_uploaded_file($file['tmp_name'])) {
                throw new Exception('File upload error - not uploaded file.');
            }
            
            if (!move_uploaded_file($file['tmp_name'], $f)) {
                throw new Exception('File upload error - couldnt move file to upload directory.');
            }
            
            return $f;
        }
        
        protected function parseData($filename) {
            if (!is_file($filename) || !is_readable($filename)) {
                throw new Exception('File parsing error - file "' . $filename . '" is not readable.');
            }
            
            $data = array();
            
            $f = fopen($filename, 'r');
            $h = array();
            $i = 0;
            $pcs = array();
            
            if (!$f) {
                throw new Exception('File parsing error - file "' . $filename . '" couldnt be open.');
            }
            
            while (($row = fgetcsv($f)) !== FALSE) {
                $skip = false;
                
                if ($i == 0) {
                    $h = $row;
                    
                    foreach(array('State', 'Post Code', 'Basic Charge', 'Cost per KG') as $c) {
                        if (!in_array($c, $h)) {
                            throw new Exception('Required column "' . $c . '" not found in CSV file.');
                        }
                    }

                    $i++;
                    continue;
                }
                
                $tmp = array();
                
                foreach($h as $j => $c) {
                    if ($c == 'Post Code') { // skip duplicates
                        if (isset($pcs[$row[$j]])) {
                            $skip = true;
                            break;
                        }
                        $pcs[$row[$j]] = true;
                    }
                    
                    $tmp[$c] = $row[$j];
                }
                
                if ($skip) {
                    $i++;
                    continue;
                }
                
                $data[] = $tmp;
                
                $i++;
            }
            
            fclose($f);
            
            return $data;
        }
        
        protected function importData($storeId, $file, $type) {
            $filename = $this->uploadFile($file);
            $data = $this->parseData($filename);
            
            try {
                $appEmulation = Mage::getSingleton('core/app_emulation');
                $initialEnvironmentInfo = $appEmulation->startEnvironmentEmulation($storeId);
                
                $rows = $this->getAllRows($type);
            
                foreach($data as $row) {
                    $this->importRow($storeId, $type, $row, $rows);
                }
            } catch (Exception $e) {
                $appEmulation->stopEnvironmentEmulation($initialEnvironmentInfo);
                throw $e;
            }
        }
        
        protected function getAllRows($type) {
            $m = $this->getModelClassName($type);
            
            $src = Mage::getModel($m)->getCollection();
            $src->load();
            $return = array();
            
            foreach($src as $sr) {
                $return[$sr->getPostcode()] = $sr->getData();
            }

            return $return;
        }
        
        protected function getModelClassName($type) {
            switch($type) {
                case 'Brisbane':
                    $m = 'shippingg/shippingratebrisbane';
                    break;
                case 'Melbourne':
                    $m = 'shippingg/shippingrate';
                    break;
                default:
                    throw new Exception('Invalid import type "' . $type . '", expected "Brisbane" or "Melbourne".');
                    break;
            }
            
            return $m;
        }
        
        protected function importRow($storeId, $type, $row, &$rows) {
            $m = $this->getModelClassName($type);
            $sr = Mage::getModel($m);
            
            if (isset($rows[$row['Post Code']])) {
                $data = $rows[$row['Post Code']];
                $sr = $sr->load($data['entity_id']);
            } else {
                $sr->setStores(array($storeId));
                $sr->setState($row['State']);
                $sr->setPostcode($row['Post Code']);
            }
            
            $sr->setBasiccharge($row['Basic Charge']);
            $sr->setCostperkg($row['Cost per KG']);

            $sr->save();
        }
}