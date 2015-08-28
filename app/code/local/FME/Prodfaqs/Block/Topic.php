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

class FME_Prodfaqs_Block_Topic extends Mage_Core_Block_Template
{
	
	public function _prepareLayout()
    {
    	
    	 if ( Mage::getStoreConfig('web/default/show_cms_breadcrumbs') && ($breadcrumbs = $this->getLayout()->getBlock('breadcrumbs')) ) {
            $breadcrumbs->addCrumb('home', array('label'=>Mage::helper('cms')->__('Home'), 'title'=>Mage::helper('cms')->__('Go to Home Page'), 'link'=>Mage::getBaseUrl()));
            $breadcrumbs->addCrumb('faqs_home', array('label' => Mage::helper('prodfaqs')->getListPageTitle(), 'title' => Mage::helper('prodfaqs')->getListPageTitle()));
        }
        
        if ($head = $this->getLayout()->getBlock('head')) {
            $head->setTitle(Mage::helper('prodfaqs')->getListPageTitle());
            $head->setDescription(Mage::helper('prodfaqs')->getListMetaDescription());
            $head->setKeywords(Mage::helper('prodfaqs')->getListMetaKeywords());
        }
		
        return parent::_prepareLayout();
        
    }
    
    
    /* Get all topics by Order ASC */    
     public function getTopics()     
     {	
		$collection = Mage::getModel('prodfaqs/topic')->getCollection()
					->addStoreFilter(Mage::app()->getStore(true)->getId())
					->addFieldToFilter('status',1)
					->setOrder('main_table.topic_order','ASC')
					->getData();
			
        if (!$this->hasData('topic')) {
            $this->setData('topic', $collection);
        }
        return $this->getData('topic');
        
    }
    
    
    /* Get SELECTED topics by Order ASC */    
     public function getSelectedTopics()     
     {	
		$collection = Mage::getModel('prodfaqs/topic')->getCollection()
					->addStoreFilter(Mage::app()->getStore(true)->getId())
					->addFieldToFilter('status',1)
					->addFieldToFilter('main_table.show_on_main',1)
					->setOrder('main_table.topic_order','ASC')
					->getData();
			
        if (!$this->hasData('topic')) {
            $this->setData('topic', $collection);
        }
        return $this->getData('topic');
        
    }
    
    
    
    /* Get General FAQs of topics by faq Order ASC*/    
     public function getFaqsOfTopics($topicId){
	
	//Sorting condition for topic's faqs
	$sort_by = Mage::helper('prodfaqs')->getGeneralFaqSorting();
	
	if($sort_by == 'helpful'):
	
		$condition = 'main_table.rating_stars';
		$cond_value = 'DESC';
	
	elseif($sort_by == 'order'):
		
		$condition = 'main_table.faq_order';
		$cond_value = 'ASC';
	
	else :	
		$condition = 'main_table.created_time';
		$cond_value = 'DESC';
	endif;
	
	
	
	if(Mage::helper('customer')->isLoggedIn()): //Access the private questions also
	
		$collection = Mage::getModel('prodfaqs/prodfaqs')->getCollection()
						->addFieldToFilter('topic_id',$topicId)
						->addFieldToFilter('status',1)
						->addFieldToFilter('main_table.show_on_main',1)
						->addFieldToFilter('main_table.parent_faq_id',0)
						->setOrder($condition,$cond_value)
						->getData();
	
	else : //Access only public questions
		
		$collection = Mage::getModel('prodfaqs/prodfaqs')->getCollection()
						->addFieldToFilter('topic_id',$topicId)
						->addFieldToFilter('status',1)
						->addFieldToFilter('main_table.show_on_main',1)
						->addFieldToFilter('main_table.visibility','public')
						->addFieldToFilter('main_table.parent_faq_id',0)
						->setOrder($condition,$cond_value)
						->getData();
		
		
	endif;
	
	
	return $collection;
	
	
    }
}