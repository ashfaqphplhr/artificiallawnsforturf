<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Activitystream
 * @version    1.0.2
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


$__installer = $this;
$__installer->startSetup();

/**
 * Existing "_getColumnDefinition" method indicates the expanded
 * version of Varien Mysql PDO adapter implementation
 *
 * Expanded version appeared in 1.6.x and is 100% suitable for
 * object-oriented DB manipulations
 */

try {
    /**
     * Create table `aw_activitystream_activity`
     */
    if ( method_exists($__installer->getConnection(), '_getColumnDefinition') ) {
        $__table = $__installer->getConnection()
            ->newTable($__installer->getTable('activitystream/activity'))
            ->addColumn(
                'id',
                Varien_Db_Ddl_Table::TYPE_INTEGER,
                11,
                array( 'identity' => true, 'nullable' => false, 'primary' => true ),
                'Activity instance ID'
            )
            ->addColumn(
                'type',
                Varien_Db_Ddl_Table::TYPE_SMALLINT,
                null,
                array( 'nullable' => false ),
                'Activity type'
            )
            ->addColumn(
                'store_id',
                Varien_Db_Ddl_Table::TYPE_SMALLINT,
                null,
                array( 'nullable' => false ),
                'ID of the store the activity happens within'
            )
            ->addColumn(
                'parameter_a',
                Varien_Db_Ddl_Table::TYPE_INTEGER,
                11,
                array( 'identity' => false, 'nullable' => true, 'primary' => false ),
                'Activity first parameter (meaning depends on the type value)'
            )
            ->addColumn(
                'parameter_b',
                Varien_Db_Ddl_Table::TYPE_INTEGER,
                11,
                array( 'identity' => false, 'nullable' => true, 'primary' => false ),
                'Activity second parameter (meaning depends on the type value)'
            )
            ->addColumn(
                'creation_time',
                Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
                null,
                array(),
                'Activity instance creation time'
            )
            ->setComment('Activity Stream module, Activitiy table')
        ;
        
        $__installer->getConnection()->createTable($__table);
    }
    else {
        $__installer->run("
            CREATE TABLE IF NOT EXISTS `" . $__installer->getTable('activitystream/activity') . "` (
                `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Activity instance ID',
                `type` smallint(6) NOT NULL COMMENT 'Activity type',
                `store_id` smallint(6) NOT NULL COMMENT 'ID of the store the activity happens within',
                `parameter_a` int(11) DEFAULT NULL COMMENT 'Activity first parameter (meaning depends on the type value)',
                `parameter_b` int(11) DEFAULT NULL COMMENT 'Activity second parameter (meaning depends on the type value)',
                `creation_time` timestamp COMMENT 'Activity instance creation time',
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Activity Stream module, Activitiy table' AUTO_INCREMENT=1;
        ");
    }
}
catch (Exception $__E) {
    Mage::logException($__E);
}


$__installer->endSetup();