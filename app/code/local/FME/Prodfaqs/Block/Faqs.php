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


class FME_Prodfaqs_Block_Faqs extends Mage_Core_Block_Template
{
    public function _prepareLayout()
    {
    	
		try {
    		$item = $this->getFaqs();
		} catch (Exception $e) {}
		    	
    	if ( Mage::getStoreConfig('web/default/show_cms_breadcrumbs') && ($breadcrumbs = $this->getLayout()->getBlock('breadcrumbs')) ) {
    		$breadcrumbs->addCrumb('home', array('label'=>Mage::helper('page')->__('Home'), 'title'=>Mage::helper('page')->__('Go to Home Page'), 'link'=>Mage::getBaseUrl()));
			$breadcrumbs->addCrumb('faqs_home', array('label' => Mage::helper('prodfaqs')->getListPageTitle(), 'title' => Mage::helper('prodfaqs')->getListPageTitle(), 'link' => Mage::helper('prodfaqs')->getUrl()));
			try {
				$breadcrumbs->addCrumb('faqs', array('label' => $item[0]['cat'], 'title' => $item[0]['cat']));
			} catch (Exception $e) {}
    	}
        
        if ($head = $this->getLayout()->getBlock('head')) {
			try {
            $head->setTitle(Mage::helper('prodfaqs')->getDetailTitlePrefix() . $item[0]['cat']);
			} catch (Exception $e) {}
        }

        return parent::_prepareLayout();
        
    }
    
     public function getFaqs()     
     {	
        if (!$this->hasData('faqs')) {
            $this->setData('faqs', Mage::registry('faqs'));
	
        }
        return $this->getData('faqs');
    }
    
}