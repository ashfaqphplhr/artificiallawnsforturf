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
class AW_Activitystream_Helper_Adminhtml extends Mage_Core_Helper_Abstract {
    
    /**
     * 
     */
    const CONFIG_PATH_ACTIVITY_TYPES_PREFIX = 'activitystream/activity_types/';
    
    
    /**
     * 
     */
    private static $__activityTypesInfo = array(
        AW_Activitystream_Model_Activity::TYPE_CUSTOMER_SUBSCRIBES_TO_NEWSLETTER => array(
            'configFieldName'     => 'customer_subscribes_to_newsletter',
            'recordVariablesList' => array( 'Name' ),
        ),
        AW_Activitystream_Model_Activity::TYPE_NEW_CUSTOMER_IS_REGISTERED => array(
            'configFieldName'     => 'new_customer_is_registered',
            'recordVariablesList' => array( 'Name' )
        ),
        AW_Activitystream_Model_Activity::TYPE_CUSTOMER_IS_SIGNED_IN => array(
            'configFieldName'     => 'customer_is_signed_in',
            'recordVariablesList' => array( 'Name' )
        ),
        AW_Activitystream_Model_Activity::TYPE_SEARCHING_IS_PERFORMED => array(
            'configFieldName'     => 'searching_is_performed',
            'recordVariablesList' => array( 'Name', 'search_term' )
        ),
        AW_Activitystream_Model_Activity::TYPE_PRODUCT_IS_VIEWED => array(
            'configFieldName'     => 'product_is_viewed',
            'recordVariablesList' => array( 'Name', 'Product_title' )
        ),
        AW_Activitystream_Model_Activity::TYPE_CATEGORY_IS_VIEWED => array(
            'configFieldName'     => 'category_is_viewed',
            'recordVariablesList' => array( 'Name', 'Category_title' )
        ),
        AW_Activitystream_Model_Activity::TYPE_ITEM_IS_ADDED_FOR_COMPARISON => array(
            'configFieldName'     => 'item_is_added_for_comparison',
            'recordVariablesList' => array( 'Name', 'Product_title' )
        ),
        AW_Activitystream_Model_Activity::TYPE_ITEM_IS_ADDED_TO_WISHLIST => array(
            'configFieldName'     => 'item_is_added_to_wishlist',
            'recordVariablesList' => array( 'Name', 'Product_title' )
        ),
        AW_Activitystream_Model_Activity::TYPE_ITEM_IS_ADDED_TO_SHOPPING_CART => array(
            'configFieldName'     => 'item_is_added_to_shopping_cart',
            'recordVariablesList' => array( 'Name', 'Product_title' )
        ),
        AW_Activitystream_Model_Activity::TYPE_CUSTOMER_VIEWS_SHOPPING_CART => array(
            'configFieldName'     => 'customer_views_shopping_cart',
            'recordVariablesList' => array( 'Name' )
        ),
        AW_Activitystream_Model_Activity::TYPE_CUSTOMER_PROCEEDS_TO_CHECKOUT => array(
            'configFieldName'     => 'customer_proceeds_to_checkout',
            'recordVariablesList' => array( 'Name' )
        ),
        AW_Activitystream_Model_Activity::TYPE_PRODUCT_IS_PURCHASED => array(
            'configFieldName'     => 'product_is_purchased',
            'recordVariablesList' => array( 'Name', 'Product_title' )
        ),
        AW_Activitystream_Model_Activity::TYPE_PRODUCT_TAG_IS_ADDED => array(
            'configFieldName'     => 'product_tag_is_added',
            'recordVariablesList' => array( 'Name', 'tag', 'Product_title' ),
            'variableDefaultValues' => array(
                'Product_title' => '{Activitystream_TAGGED_PRODUCT_TITLE_default_value}'
            )
        ),
        AW_Activitystream_Model_Activity::TYPE_REVIEW_IS_ADDED => array(
            'configFieldName'     => 'review_is_added',
            'recordVariablesList' => array( 'Name', 'Product_title' ),
            'variableDefaultValues' => array(
                'Product_title' => '{Activitystream_REVIEWED_PRODUCT_TITLE_default_value}'
            )
        )
    );
    
    private static $__activityRecordsInfo = array(
        'Category_title' => array(
            'dataKey'      => 'category_name',
            'defaultValue' => '{Activitystream_CATEGORY_NAME_default_value}'
        ),
        'Name' => array(
            'dataKey'      => 'customer_firstname',
            'defaultValue' => '{Activitystream_CUSTOMER_NAME_default_value}'
        ),
        'Product_title' => array(
            'dataKey'      => 'product_name',
            'defaultValue' => '{Activitystream_PRODUCT_TITLE_default_value}'
        ),
        'search_term' => array(
            'dataKey'      => 'search_term',
            'defaultValue' => '{Activitystream_SEARCH_TERM_default_value}'
        ),
        'tag' => array(
            'dataKey'      => 'tag_name',
            'defaultValue' => '{Activitystream_TAG_NAME_default_value}'
        )
    );
    
    
    /**
     * 
     */
    public function getActivityTypesIDs() {
        return array_keys(self::$__activityTypesInfo);
    }
    
    
    /**
     * @param int $activityType
     */
    public function getActivityTypeConfigFieldName($activityType) {
        $__configFieldName = null;
        
        if ( isset(self::$__activityTypesInfo[$activityType]['configFieldName']) ) {
            $__configFieldName = self::$__activityTypesInfo[$activityType]['configFieldName'];
        }
        
        return $__configFieldName;
    }
    
    
    /**
     * @param int $activityType
     */
    public function getActivityRecordTemplate($activityType) {
        return Mage::getStoreConfig(
            self::CONFIG_PATH_ACTIVITY_TYPES_PREFIX
            . $this->getActivityTypeConfigFieldName($activityType)
        );
    }
    
    
    /**
     * @return array(int) Array of type IDs that are enabled in the configuration
     */
    public function getEnabledActivityTypes() {
        $__enabledActivityTypes = array();
        
        foreach ( $this->getActivityTypesIDs() as $__typeID ) {
            if ( $this->getActivityRecordTemplate($__typeID) ) {
                array_push($__enabledActivityTypes, $__typeID);
            }
        }
        
        return $__enabledActivityTypes;
    }
    
    
    /**
     * @param int $type
     */
    public function getActivityTypePossibleVariables($activityType) {
        $__variablesList = array();
        
        if ( isset(self::$__activityTypesInfo[$activityType]['recordVariablesList']) ) {
            $__variablesList = self::$__activityTypesInfo[$activityType]['recordVariablesList'];
        }
        
        return $__variablesList;
    }
    
    /**
     * 
     */
    public function getActivityRecordVariableDataKey($variableName) {
        $__dataKey = null;
        
        if ( isset(self::$__activityRecordsInfo[$variableName]['dataKey']) ) {
            $__dataKey = self::$__activityRecordsInfo[$variableName]['dataKey'];
        }
        
        return $__dataKey;
    }
    
    
    /**
     * 
     */
    public function getActivityRecordVariableDelaultValue($activityType, $variableName) {
        //print 'getActivityRecordVariableDelaultValue("' . $activityType . '", "' . $variableName . '") = "';
        $__defaultValue = null;
        
        if ( isset(self::$__activityTypesInfo[$activityType]) ) {
            $__typeInfo = self::$__activityTypesInfo[$activityType];
            if ( isset($__typeInfo['variableDefaultValues'][$variableName]) ) {
                $__defaultValue = Mage::helper('activitystream')->__(
                    $__typeInfo['variableDefaultValues'][$variableName]
                );
            }
            elseif ( isset(self::$__activityRecordsInfo[$variableName]['defaultValue']) ) {
                $__defaultValue = Mage::helper('activitystream')->__(
                    self::$__activityRecordsInfo[$variableName]['defaultValue']
                );
            }
        }
        
        //print $__defaultValue . '"<br />';
        return $__defaultValue;
    }
}