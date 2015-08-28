<?php
/**
 * Product Testimonial Extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   FME
 * @package    Product Testimonial
 * @author     Asif Hussain <support@fmeextensions.com>
 * 	       
 * @copyright  Copyright 2012 © www.fmeextensions.com All right reserved
 */

 
class FME_Prodfaqs_Block_Adminhtml_Reply_Editreply_Tab_Replyform extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('reply_form', array('legend'=>Mage::helper('prodfaqs')->__('FAQ Reply information')));
     
      $fieldset->addField('customer_name', 'text', array(
          'label'     => Mage::helper('prodfaqs')->__('Contact Name'),
          'required'  => true,
          'name'      => 'customer_name',
      ));

      $fieldset->addField('customer_email', 'text', array(
          'label'     => Mage::helper('prodfaqs')->__('Contact Email'),
          'required'  => true,
          'name'      => 'customer_email',
      ));


      
      $fieldset->addField('title', 'textarea', array(
          'label'     => Mage::helper('prodfaqs')->__('Reply Text'),
          'required'  => true,
          'name'      => 'title',
	  
      ));
      
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('prodfaqs')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('prodfaqs')->__('Enabled'),
              ),

              array(
                  'value'     => 0,
                  'label'     => Mage::helper('prodfaqs')->__('Disabled'),
              ),
          ),
      ));
	  
	  
     
      if ( Mage::getSingleton('adminhtml/session')->getFaqReplyData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getFaqReplyData());
	      Mage::getSingleton('adminhtml/session')->setFaqReplyData(null);
      } elseif ( Mage::registry('faq_reply_data') ) {
	      $form->setValues(Mage::registry('faq_reply_data')->getData());
      }
      
      
      
      return parent::_prepareForm();
  }
  
  
}