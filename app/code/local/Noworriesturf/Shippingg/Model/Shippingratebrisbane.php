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
 * Shipping Rate (Brisbane) model
 *
 * @category	Noworriesturf
 * @package		Noworriesturf_Shippingg
 * @author Ultimate Module Creator
 */
class Noworriesturf_Shippingg_Model_Shippingratebrisbane extends Mage_Core_Model_Abstract{
	/**
	 * Entity code.
	 * Can be used as part of method name for entity processing
	 */
	const ENTITY= 'shippingg_shippingratebrisbane';
	const CACHE_TAG = 'shippingg_shippingratebrisbane';
	/**
	 * Prefix of model events names
	 * @var string
	 */
	protected $_eventPrefix = 'shippingg_shippingratebrisbane';
	
	/**
	 * Parameter name in event
	 * @var string
	 */
	protected $_eventObject = 'shippingratebrisbane';
	/**
	 * constructor
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function _construct(){
		parent::_construct();
		$this->_init('shippingg/shippingratebrisbane');
	}
	/**
	 * before save shipping rate (brisbane)
	 * @access protected
	 * @return Noworriesturf_Shippingg_Model_Shippingratebrisbane
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
	 * save shippingratebrisbane relation
	 * @access public
	 * @return Noworriesturf_Shippingg_Model_Shippingratebrisbane
	 * @author Ultimate Module Creator
	 */
	protected function _afterSave() {
		return parent::_afterSave();
	}
}