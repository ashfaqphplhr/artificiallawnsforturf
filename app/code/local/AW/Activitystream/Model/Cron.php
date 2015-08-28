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


class AW_Activitystream_Model_Cron extends Mage_Core_Model_Abstract
{
    /**
     * Clean logs
     *
     * @return Mage_Log_Model_Cron
     */
    public function streamClean()
    {
        $adapter = Mage::getSingleton('core/resource')->getConnection('write');
        $activityTableName = Mage::getSingleton('core/resource')->getTableName('activitystream/activity');

        $select = new Varien_Db_Select($adapter);
        $select
            ->from($activityTableName)
            ->reset(Zend_Db_Select::COLUMNS)
            ->columns(array('id'))
            ->order('id DESC')
            ->limit(100)
        ;

        try {
            $liveActivityList = $adapter->fetchCol($select);
            $adapter->delete(
                $activityTableName,
                array('id NOT IN (?)' => $liveActivityList)
            );
        } catch (Exception $e) {
            Mage::logException($e);
        }
        return $this;
    }
}