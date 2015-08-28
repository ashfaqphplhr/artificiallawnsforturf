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
 * Home Delivery Surcharge model
 *
 * @category	Noworriesturf
 * @package		Noworriesturf_Shippingg
 * @author Ultimate Module Creator
 */
class Noworriesturf_Shippingg_Model_Surcharge extends Mage_Core_Model_Abstract{
	/**
	 * Entity code.
	 * Can be used as part of method name for entity processing
	 */
	const ENTITY= 'shippingg_surcharge';
	const CACHE_TAG = 'shippingg_surcharge';
	/**
	 * Prefix of model events names
	 * @var string
	 */
	protected $_eventPrefix = 'shippingg_surcharge';
	
	/**
	 * Parameter name in event
	 * @var string
	 */
	protected $_eventObject = 'surcharge';
	/**
	 * constructor
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function _construct(){
		parent::_construct();
		$this->_init('shippingg/surcharge');
	}
	/**
	 * before save home delivery surcharge
	 * @access protected
	 * @return Noworriesturf_Shippingg_Model_Surcharge
	 * @author Ultimate Module Creator
	 */
	protected function _beforeSave(){
		parent::_beforeSave();
		$now = Mage::getSingleton('core/date')->gmtDate();
		if ($this->isObjectNew()){
			$this->setCreatedAt($now);
		}
		$this->setUpdatedAt($now);
		return $this;
	}
	/**
	 * save surcharge relation
	 * @access public
	 * @return Noworriesturf_Shippingg_Model_Surcharge
	 * @author Ultimate Module Creator
	 */
	protected function _afterSave() {
		return parent::_afterSave();
	}
}