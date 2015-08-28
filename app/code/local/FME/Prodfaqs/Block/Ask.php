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

class FME_Prodfaqs_Block_Ask extends Mage_Catalog_Block_Product_View
{
	 
	 
	 protected function _tohtml(){
	
		  if ($this->getFromXml()=='yes'&&!Mage::helper('prodfaqs')->isProductFaqsEnable())
		      return parent::_toHtml();
	  
		  $this->setLinksforProduct();		  
		  $this->setTemplate("prodfaqs/ask.phtml");
		  
		  return parent::_toHtml();
	 }
	 
	 
	 public function countFaqsofProduct($faq_product){
		  
		  $product_faqs = Mage::getModel('prodfaqs/prodfaqs')->getFaqsOfProduct($faq_product->getId());
		  
		  return count($product_faqs);
		  
	 }
	 
	 
}