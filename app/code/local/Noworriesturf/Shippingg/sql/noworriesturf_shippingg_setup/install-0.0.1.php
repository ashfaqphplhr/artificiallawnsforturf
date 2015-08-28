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
 * Shippingg module install script
 *
 * @category	Noworriesturf
 * @package		Noworriesturf_Shippingg
 * @author Ultimate Module Creator
 */
$this->startSetup();
$table = $this->getConnection()
	->newTable($this->getTable('shippingg/surcharge'))
	->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'identity'  => true,
		'nullable'  => false,
		'primary'   => true,
		), 'Home Delivery Surcharge ID')
	->addColumn('weight_from', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
		'nullable'  => false,
		), 'Weight from')

	->addColumn('weight_to', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
		'nullable'  => false,
		), 'Weight to')

	->addColumn('cost', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
		'nullable'  => false,
		), 'Cost')

	->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
		), 'Home Delivery Surcharge Creation Time')
	->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
		), 'Home Delivery Surcharge Modification Time')
	->setComment('Home Delivery Surcharge Table');
$this->getConnection()->createTable($table);

$table = $this->getConnection()
	->newTable($this->getTable('shippingg/surcharge_store'))
	->addColumn('surcharge_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
		'nullable'  => false,
		'primary'   => true,
		), 'Home Delivery Surcharge ID')
	->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
		'unsigned'  => true,
		'nullable'  => false,
		'primary'   => true,
		), 'Store ID')
	->addIndex($this->getIdxName('shippingg/surcharge_store', array('store_id')), array('store_id'))
	->addForeignKey($this->getFkName('shippingg/surcharge_store', 'surcharge_id', 'shippingg/surcharge', 'entity_id'), 'surcharge_id', $this->getTable('shippingg/surcharge'), 'entity_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
	->addForeignKey($this->getFkName('shippingg/surcharge_store', 'store_id', 'core/store', 'store_id'), 'store_id', $this->getTable('core/store'), 'store_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
	->setComment('Home Delivery Surcharges To Store Linkage Table');
$this->getConnection()->createTable($table);
$table = $this->getConnection()
	->newTable($this->getTable('shippingg/shippingratebrisbane'))
	->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'identity'  => true,
		'nullable'  => false,
		'primary'   => true,
		), 'Shipping Rate (Brisbane) ID')
	->addColumn('state', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		'nullable'  => false,
		), 'State')

	->addColumn('postcode', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'nullable'  => false,
		'unsigned'  => true,
		), 'Post Code')

	->addColumn('basiccharge', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
		'nullable'  => false,
		), 'Basic Charge')

	->addColumn('costperkg', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
		'nullable'  => false,
		), 'Cost per KG')

	->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
		), 'Shipping Rate (Brisbane) Creation Time')
	->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
		), 'Shipping Rate (Brisbane) Modification Time')
	->setComment('Shipping Rate (Brisbane) Table');
$this->getConnection()->createTable($table);

$table = $this->getConnection()
	->newTable($this->getTable('shippingg/shippingratebrisbane_store'))
	->addColumn('shippingratebrisbane_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
		'nullable'  => false,
		'primary'   => true,
		), 'Shipping Rate (Brisbane) ID')
	->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
		'unsigned'  => true,
		'nullable'  => false,
		'primary'   => true,
		), 'Store ID')
	->addIndex($this->getIdxName('shippingg/shippingratebrisbane_store', array('store_id')), array('store_id'))
	->addForeignKey($this->getFkName('shippingg/shippingratebrisbane_store', 'shippingratebrisbane_id', 'shippingg/shippingratebrisbane', 'entity_id'), 'shippingratebrisbane_id', $this->getTable('shippingg/shippingratebrisbane'), 'entity_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
	->addForeignKey($this->getFkName('shippingg/shippingratebrisbane_store', 'store_id', 'core/store', 'store_id'), 'store_id', $this->getTable('core/store'), 'store_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
	->setComment('Shipping Rates (Brisbane) To Store Linkage Table');
$this->getConnection()->createTable($table);
$table = $this->getConnection()
	->newTable($this->getTable('shippingg/shippingrate'))
	->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'identity'  => true,
		'nullable'  => false,
		'primary'   => true,
		), 'Shipping Rate (Melbourne) ID')
	->addColumn('state', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		'nullable'  => false,
		), 'State')

	->addColumn('postcode', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'nullable'  => false,
		'unsigned'  => true,
		), 'Post Code')

	->addColumn('basiccharge', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
		'nullable'  => false,
		), 'Basic Charge')

	->addColumn('costperkg', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
		'nullable'  => false,
		), 'Cost per KG')

	->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
		), 'Shipping Rate (Melbourne) Creation Time')
	->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
		), 'Shipping Rate (Melbourne) Modification Time')
	->setComment('Shipping Rate (Melbourne) Table');
$this->getConnection()->createTable($table);

$table = $this->getConnection()
	->newTable($this->getTable('shippingg/shippingrate_store'))
	->addColumn('shippingrate_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
		'nullable'  => false,
		'primary'   => true,
		), 'Shipping Rate (Melbourne) ID')
	->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
		'unsigned'  => true,
		'nullable'  => false,
		'primary'   => true,
		), 'Store ID')
	->addIndex($this->getIdxName('shippingg/shippingrate_store', array('store_id')), array('store_id'))
	->addForeignKey($this->getFkName('shippingg/shippingrate_store', 'shippingrate_id', 'shippingg/shippingrate', 'entity_id'), 'shippingrate_id', $this->getTable('shippingg/shippingrate'), 'entity_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
	->addForeignKey($this->getFkName('shippingg/shippingrate_store', 'store_id', 'core/store', 'store_id'), 'store_id', $this->getTable('core/store'), 'store_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
	->setComment('Shipping Rates (Melbourne) To Store Linkage Table');
$this->getConnection()->createTable($table);
$this->endSetup();