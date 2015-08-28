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


/**
 * 
 */
class AW_Activitystream_Model_ResourceActivityCollection extends Mage_Core_Model_Mysql4_Collection_Abstract {
    
    /**
     * 
     */
    private $__joinTagNamesFlag = false;
    
    
    /**
     * 
     */
    protected function _initSelect() {
        $this
            ->getSelect()
            ->from(
                array('main_table' => $this->getMainTable()),
                array('id', 'type', 'store_id', 'creation_timestamp' => "UNIX_TIMESTAMP(`creation_time`)")
            )
        ;
        
        return $this; 
    }
    
    
    /**
     * 
     */
    public function joinDetails() {
        return $this->__joinAllExtras();
    }
    
    
    /**
     * 
     */
    public function newestFirst() {
        $this->getSelect()
            ->order("creation_timestamp DESC")
            ->order("id DESC")
        ;
        
        return $this;
    }
    
    
    /**
     * @param int $timestamp
     */
    public function startingFrom($time) {
        $__timestamp = intval($time);
        if ( $__timestamp ) {
            $this->getSelect()->where("UNIX_TIMESTAMP(`creation_time`) > '" . $__timestamp . "'");
        }
        
        return $this;
    }
    
    
    /**
     * @param array $typeIDs
     */
    public function filterByTypes($typeIDs) {
        if ( !is_array($typeIDs) ) {
            if (intval($typeIDs) == 0) $typeIDs = false;
            else $typeIDs = true;
        }
        
        if ( is_array($typeIDs) ) {
            $this->getSelect()
                ->where("`main_table`.`type` IN (" . join(', ', $typeIDs) . ")");
            ;
        }
        else {
            if ( !$typeIDs ) {
                $this->getSelect()
                    ->where("1 = 0")
                ;
            }
        }
        
        return $this;
    }
    
    
    /**
     * 
     */
    public function filterByStoreView($storeViewID) {
        return $this->__filterByStores($storeViewID);
    }
    
    
    /**
     * @todo make the routine more safe
     */
    public function filterByStoreGroup($storeGroupID) {
        return $this->__filterByStores(Mage::app()->getGroup($storeGroupID)->getStoreIds());
    }
    
    
    /**
     * @todo make the routine more safe
     */
    public function filterByWebsite($websiteID) {
        return $this->__filterByStores(Mage::app()->getWebsite($websiteID)->getStoreIds());
    }
    
    
    /**
     * 
     */
    protected function __filterByStores($storeIDs) {
        if ( !is_array($storeIDs) ) $storeIDs = array( $storeIDs );
        
        $this->getSelect()
            ->where("main_table.store_id IN (" . join(', ', $storeIDs) . ")")
        ;
        
        return $this;
    }
    
    
    /**
     * 
     */
    protected function __joinAllExtras() {
        $this
            ->__joinCustomerNames()
            ->__joinProductNames()
            ->__joinCategoryNames()
            ->__joinSearchingTerms()
            ->__joinTagNames()
        ;
        
        return $this;
    }
    
    
    /**
     * @todo Put determining of attribute IDs onto a hard cache
     * @todo avoid using hardcoded strings!!
     */
    protected function __joinCustomerNames() {
        $__select = $this->getConnection()->select()
            ->from(
                array('ea' => $this->getTable('eav/attribute')),
                'attribute_id'
            )
            ->join(
                array('eet' => $this->getTable('eav/entity_type')),
                "`eet`.`entity_type_id` = `ea`.`entity_type_id`",
                'entity_type_id'
            )
            ->where("`ea`.`attribute_code` = 'firstname'")
            ->where("`eet`.`entity_type_code` = 'customer'")
        ;
        $__data = $this->getConnection()->fetchRow($__select);
        
        $__customerFirstnameEntityTypeID = $__data['entity_type_id'];
        $__customerFirstnameAttributeID = $__data['attribute_id'];
        
        $this->getSelect()
            ->joinLeft(
                array(
                    'cev' => Mage::getSingleton('core/resource')->getTableName('customer_entity_varchar')
                ),
                "(`main_table`.`parameter_a` = `cev`.`entity_id`)"
                    . " AND (`cev`.`entity_type_id` = '" . $__customerFirstnameEntityTypeID . "')"
                    . " AND (`cev`.`attribute_id` = '" . $__customerFirstnameAttributeID . "')",
                array('customer_firstname' => 'value')
            )
        ;
        
        return $this;
    }
    
    
    /**
     * @todo avoid using hardcoded strings!!
     */
    protected function __joinSearchingTerms() {
        $this->getSelect()
            ->joinLeft(
                array(
                    'cq' => Mage::getSingleton('core/resource')->getTableName('catalogsearch_query')
                ),
                "(`main_table`.`type` = " . AW_Activitystream_Model_Activity::TYPE_SEARCHING_IS_PERFORMED . ")"
                    . " AND (`main_table`.`parameter_b` = `cq`.`query_id`)",
                array('search_term' => 'query_text')
            )
        ;
        
        return $this;
    }
    
    
    /**
     * @todo Put determining of attribute IDs onto a hard cache
     * @todo avoid using hardcoded strings!!
     */
    protected function __joinProductNames() {
        $__select = $this->getConnection()->select()
            ->from(
                array('ea' => $this->getTable('eav/attribute')),
                'attribute_id'
            )
            ->join(
                array('eet' => $this->getTable('eav/entity_type')),
                "`eet`.`entity_type_id` = `ea`.`entity_type_id`",
                'entity_type_id'
            )
            ->where("`ea`.`attribute_code` = 'name'")
            ->where("`eet`.`entity_type_code` = 'catalog_product'")
        ;
        $__data = $this->getConnection()->fetchRow($__select);
        
        $__productNameEntityTypeID = $__data['entity_type_id'];
        $__productNameAttributeID = $__data['attribute_id'];
        
        $this->getSelect()
            ->columns(
                array( 'product_id' => 'parameter_b' )
            )
            ->joinLeft(
                array(
                    'cpev' => Mage::getSingleton('core/resource')->getTableName('catalog_product_entity_varchar')
                ),
                "(`main_table`.`type` IN ("
                    . AW_Activitystream_Model_Activity::TYPE_PRODUCT_IS_VIEWED
                    . ", " . AW_Activitystream_Model_Activity::TYPE_ITEM_IS_ADDED_FOR_COMPARISON
                    . ", " . AW_Activitystream_Model_Activity::TYPE_ITEM_IS_ADDED_TO_WISHLIST
                    . ", " . AW_Activitystream_Model_Activity::TYPE_ITEM_IS_ADDED_TO_SHOPPING_CART
                    . ", " . AW_Activitystream_Model_Activity::TYPE_PRODUCT_IS_PURCHASED
                    . ", " . AW_Activitystream_Model_Activity::TYPE_REVIEW_IS_ADDED
                . "))"
                    . " AND (`cpev`.`entity_id` = `main_table`.`parameter_b`)"
                    . " AND (`cpev`.`store_id` = `main_table`.`store_id`)"
                    . " AND (`cpev`.`entity_type_id` = '" . $__productNameEntityTypeID . "')"
                    . " AND (`cpev`.`attribute_id` = '" . $__productNameAttributeID . "')",
                array(
                    'product_name' => 'value'
                )
            )
            ->joinLeft(
                array(
                    'cpev2' => Mage::getSingleton('core/resource')->getTableName('catalog_product_entity_varchar')
                ),
                "(`main_table`.`type` IN ("
                    . AW_Activitystream_Model_Activity::TYPE_PRODUCT_IS_VIEWED
                    . ", " . AW_Activitystream_Model_Activity::TYPE_ITEM_IS_ADDED_FOR_COMPARISON
                    . ", " . AW_Activitystream_Model_Activity::TYPE_ITEM_IS_ADDED_TO_WISHLIST
                    . ", " . AW_Activitystream_Model_Activity::TYPE_ITEM_IS_ADDED_TO_SHOPPING_CART
                    . ", " . AW_Activitystream_Model_Activity::TYPE_PRODUCT_IS_PURCHASED
                    . ", " . AW_Activitystream_Model_Activity::TYPE_REVIEW_IS_ADDED
                . "))"
                    . " AND (`cpev2`.`entity_id` = `main_table`.`parameter_b`)"
                    . " AND (`cpev2`.`store_id` = 0)"
                    . " AND (`cpev2`.`entity_type_id` = '" . $__productNameEntityTypeID . "')"
                    . " AND (`cpev2`.`attribute_id` = '" . $__productNameAttributeID . "')",
                array(
                    'default_product_name' => 'value'
                )
            )
        ;
        
        return $this;
    }
    
    
    /**
     * 
     */
    protected function __joinCategoryNames() {
        $__select = $this->getConnection()->select()
            ->from(
                array('ea' => $this->getTable('eav/attribute')),
                'attribute_id'
            )
            ->join(
                array('eet' => $this->getTable('eav/entity_type')),
                "`eet`.`entity_type_id` = `ea`.`entity_type_id`",
                'entity_type_id'
            )
            ->where("`ea`.`attribute_code` = 'name'")
            ->where("`eet`.`entity_type_code` = 'catalog_category'")
        ;
        $__data = $this->getConnection()->fetchRow($__select);
        
        $__categoryNameEntityTypeID = $__data['entity_type_id'];
        $__categoryNameAttributeID = $__data['attribute_id'];
        
        $this->getSelect()
            ->columns(
                array( 'category_id' => 'parameter_b' )
            )
            ->joinLeft(
                array(
                    'ccev' => Mage::getSingleton('core/resource')->getTableName('catalog_category_entity_varchar')
                ),
                "(`main_table`.`type` = " . AW_Activitystream_Model_Activity::TYPE_CATEGORY_IS_VIEWED . ")"
                    . " AND (`ccev`.`entity_id` = `main_table`.`parameter_b`)"
                    . " AND (`ccev`.`store_id` = `main_table`.`store_id`)"
                    . " AND (`ccev`.`entity_type_id` = '" . $__categoryNameEntityTypeID . "')"
                    . " AND (`ccev`.`attribute_id` = '" . $__categoryNameAttributeID . "')",
                array('category_name' => 'value')
            )
            ->joinLeft(
                array(
                    'ccev2' => Mage::getSingleton('core/resource')->getTableName('catalog_category_entity_varchar')
                ),
                "(`main_table`.`type` = " . AW_Activitystream_Model_Activity::TYPE_CATEGORY_IS_VIEWED . ")"
                    . " AND (`ccev2`.`entity_id` = `main_table`.`parameter_b`)"
                    . " AND (`ccev2`.`store_id` = 0)"
                    . " AND (`ccev2`.`entity_type_id` = '" . $__categoryNameEntityTypeID . "')"
                    . " AND (`ccev2`.`attribute_id` = '" . $__categoryNameAttributeID . "')",
                array('default_category_name' => 'value')
            )
        ;
        
        return $this;
    }
    
    
    /**
     * 
     */
    protected function __joinTagNames() {
        $this->__joinTagNamesFlag = true;
        
        $this->getSelect()
            ->joinLeft(
                array(
                    't' => Mage::getSingleton('core/resource')->getTableName('tag')
                ),
                "(`main_table`.`type` = " . AW_Activitystream_Model_Activity::TYPE_PRODUCT_TAG_IS_ADDED . ")"
                    . " AND (`t`.`tag_id` = `main_table`.`parameter_b`)",
                array('tag_id', 'tag_name' => 'name')
            )
        ;
    }
    
    
    /**
     * 
     */
    protected function _afterLoad() {
        $__result = parent::_afterLoad();
        
        if ( $this->__joinTagNamesFlag ) {
            $__SQLParts = array();
            foreach ($this->getItems() as $__item) {
                if (
                    ( $__item->getType() == AW_Activitystream_Model_Activity::TYPE_PRODUCT_TAG_IS_ADDED )
                    and
                    ( $__item->getData('tag_id') )
                ) {
                    array_push(
                        $__SQLParts,
                        "REPEAT(" . $__item->getData('id') . ", 1) as `id`"
                        . ", REPEAT(" . $__item->getData('store_id') . ", 1) as `store_id`"
                        . ", REPEAT(" . $__item->getData('tag_id') . ", 1) as tag_id"
                    );
                }
            }
            
            if ( count($__SQLParts) > 0 ) {
                $__select = $this->getConnection()->select()
                    ->from(
                        array('ea' => $this->getTable('eav/attribute')),
                        'attribute_id'
                    )
                    ->join(
                        array('eet' => $this->getTable('eav/entity_type')),
                        "`eet`.`entity_type_id` = `ea`.`entity_type_id`",
                        'entity_type_id'
                    )
                    ->where("`ea`.`attribute_code` = 'name'")
                    ->where("`eet`.`entity_type_code` = 'catalog_product'")
                ;
                $__data = $this->getConnection()->fetchRow($__select);
                
                $__productNameEntityTypeID = $__data['entity_type_id'];
                $__productNameAttributeID = $__data['attribute_id'];
                
                $__select = $this->getConnection()
                    ->select()
                    ->from(
                        null,
                        join(" UNION SELECT ", $__SQLParts)
                    )
                ;
                
                $__select = $this->getConnection()
                    ->select()
                    ->from(
                        array('main_table' => $__select),
                        array('id')
                    )
                    ->joinLeft(
                        array(
                            'tr' => Mage::getSingleton('core/resource')->getTableName('tag_relation')
                        ),
                        "`tr`.`tag_id` = `main_table`.`tag_id`"
                    )
                    ->group( 'main_table.id' )
                    ->joinLeft(
                        array(
                            'cpev1' => Mage::getSingleton('core/resource')->getTableName('catalog_product_entity_varchar')
                        ),
                        "(`cpev1`.`entity_id` = `tr`.`product_id`)"
                        . " AND (`cpev1`.`store_id` = `main_table`.`store_id`)"
                        . " AND (`cpev1`.`entity_type_id` = '" . $__productNameEntityTypeID . "')"
                        . " AND (`cpev1`.`attribute_id` = '" . $__productNameAttributeID . "')",
                        array('tagged_product_name' => 'value')
                    )
                    ->joinLeft(
                        array(
                            'cpev2' => Mage::getSingleton('core/resource')->getTableName('catalog_product_entity_varchar')
                        ),
                        "(`cpev2`.`entity_id` = `tr`.`product_id`)"
                        . " AND (`cpev2`.`store_id` = 0)"
                        . " AND (`cpev2`.`entity_type_id` = '" . $__productNameEntityTypeID . "')"
                        . " AND (`cpev2`.`attribute_id` = '" . $__productNameAttributeID . "')",
                        array('default_tagged_product_name' => 'value')
                    )
                ;
                
                $__tagExtraData = array();
                foreach ($this->getConnection()->query($__select->__toString())->fetchAll() as $__item) {
                    $__tagExtraData[$__item['id']] = array( $__item['tagged_product_name'], $__item['default_tagged_product_name'] );
                }
                
                foreach ($this->getItems() as $__item) {
                    if ( isset($__tagExtraData[$__item->getId()]) ) {
                        $__item->setProductName($__tagExtraData[$__item->getId()][0]);
                        $__item->setDefaultProductName($__tagExtraData[$__item->getId()][1]);
                    }
                }
            }
        }
        
        return $__result;
    }
}