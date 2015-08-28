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
class AW_Activitystream_Block_ActivityRecord extends Mage_Core_Block_Template {
    
    /**
     * 
     */
    const DATAKEY_PREFIX_DEFAULT            = 'default_';
    
    const PART_TYPE_PLAINTEXT               = 1;
    const PART_TYPE_VARIABLE                = 2;
    
    
    /**
     * 
     */
    public function getParts() {
        $__AH = Mage::helper('activitystream/adminhtml');
        
        $__recordTemplate = $__AH->getActivityRecordTemplate($this->getActivity()->getType());
        $__variablesList = $__AH->getActivityTypePossibleVariables($this->getActivity()->getType());
        
        $__parts = array();
        while ( strlen($__recordTemplate) > 0) {
            $__closestVariablePos = null;
            $__closestVariableName = null;
            foreach ($__variablesList as $__variableName) {
                $__variablePos = strpos($__recordTemplate, '{' . $__variableName . '}');
                if ($__variablePos === false) continue;
                if ( is_null($__closestVariablePos) or ($__closestVariablePos > $__variablePos) ) {
                    $__closestVariablePos = $__variablePos;
                    $__closestVariableName = $__variableName;
                }
            }
            
            if ( !is_null($__closestVariablePos) ) {
                if ($__closestVariablePos > 0) {
                    $__part = new Varien_Object();
                    $__part
                        ->setType(self::PART_TYPE_PLAINTEXT)
                        ->setContent(substr($__recordTemplate, 0, $__closestVariablePos))
                    ;
                    array_push($__parts, $__part);
                    $__recordTemplate = substr($__recordTemplate, $__closestVariablePos);
                }
                
                $__part = new Varien_Object();
                
                $__variableName = $__closestVariableName;
                $__value = $this->getActivity()->getData($__AH->getActivityRecordVariableDataKey($__variableName));
                if ( !$__value ) {
                    $__value = $this->getActivity()->getData(self::DATAKEY_PREFIX_DEFAULT . $__AH->getActivityRecordVariableDataKey($__variableName));
                    if ( !$__value ) {
                        $__value = $__AH->getActivityRecordVariableDelaultValue($this->getActivity()->getType(), $__variableName);
                        $__part->setIsValueDefault(true);
                    }
                }
                
                $__part
                    ->setType(self::PART_TYPE_VARIABLE)
                    ->setName($__variableName)
                    ->setValue($__value)
                ;
                
                if ( ! $__part->getIsValueDefault() ) {
                    if ( $__variableName == 'Product_title' ) {
                        $__product = Mage::getModel('catalog/product')->load($this->getActivity()->getProductId());
                        $__product->setStoreId($this->getActivity()->getStoreId());
                        $__part->setUrl(Mage::helper('catalog/product')->getProductUrl($__product));
                        unset($__product);
                    }
                    if ( $__variableName == 'Category_title' ) {
                        $__category = Mage::getModel('catalog/category')->load($this->getActivity()->getCategoryId());
                        $__category->setStoreId($this->getActivity()->getStoreId());
                        $__part->setUrl($this->__getCategoryUrl($__category));
                        unset($__category);
                    }
                }
                
                array_push($__parts, $__part);
                $__recordTemplate = substr($__recordTemplate, strlen($__closestVariableName) + 2);
            }
            else {
                $__part = new Varien_Object();
                $__part
                    ->setType(self::PART_TYPE_PLAINTEXT)
                    ->setContent($__recordTemplate)
                ;
                array_push($__parts, $__part);
                $__recordTemplate = '';
            }
        }
        
        return $__parts;
    }
    
    
    private function __getCategoryUrl($category) {
        $__url = null;
        
        if ( $category->hasData('request_path') && $category->getRequestPath() != '' ) {
            $__url = $category
                ->getUrlInstance()
                ->setStore($category->getStoreId())
                ->getDirectUrl(
                    $category->getRequestPath(),
                    array('_store_to_url' => $__storeToUrl)
                )
            ;
        }
        else {
            $__rewrite = $category->getUrlRewrite();
            if ( $category->getStoreId() ) $__rewrite->setStoreId($category->getStoreId());
            $__idPath = 'category/' . $category->getId();
            $__rewrite->loadByIdPath($__idPath);
            
            if ( $__rewrite->getId() ) {
                $__url = $category
                    ->getUrlInstance()
                    ->getDirectUrl(
                        $__rewrite->getRequestPath()
                    )
                ;
            }
            else {
                $__url = $category->getCategoryIdUrl();
            }
        }
        
        $__storeToUrl = Mage::app()->getStore()->getId() != $category->getStoreId() ? 1 : 0;
        $__url .= $__storeToUrl ? '?___store=' . Mage::app()->getStore($category->getStoreId())->getCode() : '';
        
        return $__url;
    }
}