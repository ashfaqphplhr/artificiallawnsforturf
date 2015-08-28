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


class FME_Prodfaqs_Block_Adminhtml_Prodfaqs_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('prodfaqs_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('prodfaqs')->__('Faqs Management'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('prodfaqs')->__('Faq Information'),
          'title'     => Mage::helper('prodfaqs')->__('Faq Information'),
          'content'   => $this->getLayout()->createBlock('prodfaqs/adminhtml_prodfaqs_edit_tab_form')->toHtml(),
          'active'    => true
      ));
	  
      $this->addTab('products_section', array(
          'label'     => Mage::helper('prodfaqs')->__('Apply to Products'),
          'title'     => Mage::helper('prodfaqs')->__('Apply to Products'),
          'url'       => $this->getUrl('*/*/products', array('_current' => true)),
          'class'     => 'ajax',
      ));
      
      $this->addTab('reply_section',array(
          'label'     => Mage::helper('prodfaqs')->__('View Replies'),
          'title'     => Mage::helper('prodfaqs')->__('View Replies'),
          'url'       => $this->getUrl('*/*/replies', array('_current' => true)),
          'class'     => 'ajax',
      ));
      

    return parent::_beforeToHtml();
  }
}