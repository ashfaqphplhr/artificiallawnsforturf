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

class FME_Prodfaqs_Model_Prodfaqs extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('prodfaqs/prodfaqs');
    }
    
    
    public function getRelatedProductFaqs($faqId)
    {
	
        $prod_table = Mage::getSingleton('core/resource')->getTableName('prodfaqs_products'); 
        
	$collection = Mage::getModel('prodfaqs/prodfaqs')->getCollection()
				  ->addFaqFilter($faqId);
					  
	$collection->getSelect()
                        ->joinLeft(array('related' => $prod_table),
                                    'main_table.faqs_id = related.faqs_id'
                            )
			->order('main_table.created_time DESC');
			
                        
	return $collection->getData();

    }
    
    
    public function getFaqsOfProduct($prod_id){
        
        
        $faqs = $this->getResource()->loadFaqsByProduct($prod_id);
        
        return $faqs;
           
    }
    
    
    public function getChildFaqs($parent_id){
	
	  
        $collection = $this->getCollection();
        
        $collection->getSelect()->from($this->getTable('prodfaqs'))
                                        ->where('parent_faq_id = (?)', $parent_id)
                                        ->where('status = (?)', 1)
                                        ->order('created_time DESC');
                    
        	
        return $collection->getData();
	
    }
    
    public function getNewCreatedThreadFaq($f_id){
	
	    
            $row_data = $this->load($f_id);
            
        	
            return $row_data->getData();
	
    }
    
    
    
    public function getRepliesCollectionForGrid($parent_id){
        
        if($parent_id){
                
                //Recursive function that gathers the all child and subchild ids                
                Mage::helper('prodfaqs')->loadAllChildsIds($parent_id);
                
                $all_child_array =  Mage::helper('prodfaqs')->getRepliesChildIds();                
                           
                $collection = $this->getCollection()->addFieldToFilter('faqs_id', array('in' => $all_child_array));
                       
                return $collection;
                           
                
        }else{
            
            return false;
        }
        
        
    }
    
    
    
    
}