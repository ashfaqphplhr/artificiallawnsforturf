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


class FME_Prodfaqs_Block_Adminhtml_Topic_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('topic_form', array('legend'=>Mage::helper('prodfaqs')->__('Topic information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('prodfaqs')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));
      
      $fieldset->addField('identifier', 'text', array(
            'name'      => 'identifier',
            'label'     => Mage::helper('prodfaqs')->__('SEF URL Identifier'),
            'title'     => Mage::helper('prodfaqs')->__('SEF URL Identifier'),
            'required'  => true,
            'class'     => 'validate-identifier',
            //'after_element_html' => '<p class="nm"><small>' . Mage::helper('faqs')->__('(eg: domain.com/faqs/identifier)') . '</small></p>',
        ));
    
      $fieldset->addField('show_on_main', 'select', array(
          'label'     => Mage::helper('prodfaqs')->__('Show on main page'),
          'name'      => 'show_on_main',
	  'values'	=>array(
		array(
                  'value'     => 1,
                  'label'     => Mage::helper('prodfaqs')->__('Yes'),
              ),
		array(
                  'value'     => 0,
                  'label'     => Mage::helper('prodfaqs')->__('No'),
              ),
	  ),
	'after_element_html'	=> "<p class='note'>show/hide from main page, if from config 'Display Topic is selected'</p>",  
	
      ));
      
      $fieldset->addField('topic_order', 'text', array(
	    'label'	=> Mage::helper('prodfaqs')->__('Order / Position'),
	    'name'	=> 'topic_order',
	    'class'	=> 'validate-number',
	    'after_element_html'	=> '<p class="note">order / postion of faq (0 for first)</p>',      
      ));
    
    
    
    
    
	
		$fieldset->addField('store_id','multiselect',array(
			'name'      => 'store_id[]',
			'label'     => Mage::helper('prodfaqs')->__('Store View'),
			'title'     => Mage::helper('prodfaqs')->__('Store View'),
			'required'  => true,
			'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true)
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
                  'value'     => 2,
                  'label'     => Mage::helper('prodfaqs')->__('Disabled'),
              ),
          ),
      ));
      
      if ( Mage::getSingleton('adminhtml/session')->getTopicData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getTopicData());
          Mage::getSingleton('adminhtml/session')->setTopicData(null);
      } elseif ( Mage::registry('topic_data') ) {
          $form->setValues(Mage::registry('topic_data')->getData());
      }
      return parent::_prepareForm();
  }
}