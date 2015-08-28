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
 * Home Delivery Surcharge resource model
 *
 * @category	Noworriesturf
 * @package		Noworriesturf_Shippingg
 * @author Ultimate Module Creator
 */
class Noworriesturf_Shippingg_Model_Resource_Surcharge extends Mage_Core_Model_Resource_Db_Abstract{
	/**
	 * constructor
	 * @access public
	 * @return void
	 * @author Ultimate Module Creator
	 */
	public function _construct(){
		$this->_init('shippingg/surcharge', 'entity_id');
	}
	
	/**
	 * Get store ids to which specified item is assigned
	 * @access public
	 * @param int $surchargeId
	 * @return array
	 * @author Ultimate Module Creator
	 */
	public function lookupStoreIds($surchargeId){
		$adapter = $this->_getReadAdapter();
		$select  = $adapter->select()
			->from($this->getTable('shippingg/surcharge_store'), 'store_id')
			->where('surcharge_id = ?',(int)$surchargeId);
		return $adapter->fetchCol($select);
	}
	/**
	 * Perform operations after object load
	 * @access public
	 * @param Mage_Core_Model_Abstract $object
	 * @return Noworriesturf_Shippingg_Model_Resource_Surcharge
	 * @author Ultimate Module Creator
	 */
	protected function _afterLoad(Mage_Core_Model_Abstract $object){
		if ($object->getId()) {
			$stores = $this->lookupStoreIds($object->getId());
			$object->setData('store_id', $stores);
		}
		return parent::_afterLoad($object);
	}

	/**
	 * Retrieve select object for load object data
	 *
	 * @param string $field
	 * @param mixed $value
	 * @param Noworriesturf_Shippingg_Model_Surcharge $object
	 * @return Zend_Db_Select
	 */
	protected function _getLoadSelect($field, $value, $object){
		$select = parent::_getLoadSelect($field, $value, $object);
		if ($object->getStoreId()) {
			$storeIds = array(Mage_Core_Model_App::ADMIN_STORE_ID, (int)$object->getStoreId());
			$select->join(
				array('shippingg_surcharge_store' => $this->getTable('shippingg/surcharge_store')),
				$this->getMainTable() . '.entity_id = shippingg_surcharge_store.surcharge_id',
				array()
			)
			->where('shippingg_surcharge_store.store_id IN (?)', $storeIds)
			->order('shippingg_surcharge_store.store_id DESC')
			->limit(1);
		}
		return $select;
	}
	/**
	 * Assign home delivery surcharge to store views
	 * @access protected
	 * @param Mage_Core_Model_Abstract $object
	 * @return Noworriesturf_Shippingg_Model_Resource_Surcharge
	 * @author Ultimate Module Creator
	 */
	protected function _afterSave(Mage_Core_Model_Abstract $object){
		$oldStores = $this->lookupStoreIds($object->getId());
		$newStores = (array)$object->getStores();
		if (empty($newStores)) {
			$newStores = (array)$object->getStoreId();
		}
		$table  = $this->getTable('shippingg/surcharge_store');
		$insert = array_diff($newStores, $oldStores);
		$delete = array_diff($oldStores, $newStores);
		if ($delete) {
			$where = array(
				'surcharge_id = ?' => (int) $object->getId(),
				'store_id IN (?)' => $delete
			);
			$this->_getWriteAdapter()->delete($table, $where);
		}
		if ($insert) {
			$data = array();
			foreach ($insert as $storeId) {
				$data[] = array(
					'surcharge_id'  => (int) $object->getId(),
					'store_id' => (int) $storeId
				);
			}
			$this->_getWriteAdapter()->insertMultiple($table, $data);
		}
		return parent::_afterSave($object);
	}}