<?php
/**
 * FAQs And Product Questions
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   FME
 * @package    FAQs And Product Questions
 * @author     Asif Hussain <support@fmeextensions.com>
 * 	       
 * @copyright  Copyright 2012 © www.fmeextensions.com All right reserved
 */

class FME_Prodfaqs_Model_Mysql4_Prodfaqs extends Mage_Core_Model_Mysql4_Abstract
{
	
    public function _construct()
    {    
        $this->_init('prodfaqs/prodfaqs', 'faqs_id');
    }
    
    
    protected function _afterSave(Mage_Core_Model_Abstract $object)
    {
		
        $condition = $this->_getWriteAdapter()->quoteInto('faqs_id = ?', $object->getId());
        	
		
	//Get Related Products		
		$links = $object['links'];
		if (isset($links['relatedfaqs'])) {
			$productIds = Mage::helper('adminhtml/js')->decodeGridSerializedInput($links['relatedfaqs']);
			$this->_getWriteAdapter()->delete($this->getTable('prodfaqs_products'), $condition);
			
			//Save Related Products
			foreach ($productIds as $_product) {
				$objArray = array();
				$objArray['faqs_id'] = $object->getId();
				$objArray['product_id'] = $_product;
				$this->_getWriteAdapter()->insert($this->getTable('prodfaqs_products'), $objArray);
			}
		} 
    
        return parent::_afterSave($object);
        
    }
    
    
    public function loadFaqsByProduct($product_id){
	
	//Sorting condition for Product faqs
	$sort_by = Mage::helper('prodfaqs')->getProductFaqSorting();
	
	if($sort_by == 'helpful'):
	
		$condition = 'rating_stars';
		$cond_value = ' DESC';
	
	elseif($sort_by == 'order'):
		
		$condition = 'faq_order';
		$cond_value = ' ASC';
	
	else :	
		$condition = 'created_time';
		$cond_value = ' DESC';
	endif;
	
	
	$p_faqsTable = Mage::getSingleton('core/resource')->getTableName('prodfaqs_products');
        $read_connection = Mage::getSingleton('core/resource')->getConnection('core_read');
        
	if(Mage::helper('customer')->isLoggedIn()):
	
		$select = $read_connection->select()->from(array('p_faq' => $p_faqsTable), array('*'))
	                                    ->joinLeft(array('faq' => $this->getTable('prodfaqs')), 'p_faq.faqs_id = faq.faqs_id')
					    ->where('product_id =(?)', $product_id)
					    ->where('status =(?)', 1)
					    ->where('parent_faq_id =(?)', 0)
					    ->order(array($condition.$cond_value));
        else:
		$select = $read_connection->select()->from(array('p_faq' => $p_faqsTable), array('*'))
	                                    ->joinLeft(array('faq' => $this->getTable('prodfaqs')), 'p_faq.faqs_id = faq.faqs_id')
					    ->where('product_id =(?)', $product_id)
					    ->where('status =(?)', 1)
					    ->where('parent_faq_id =(?)', 0)
					    ->where('visibility =(?)', 'public')
					    ->order(array($condition.$cond_value));
	
	
	endif;
	
	  
        $result = $read_connection->fetchAll($select);
	
	return $result;
	
    }
    
}