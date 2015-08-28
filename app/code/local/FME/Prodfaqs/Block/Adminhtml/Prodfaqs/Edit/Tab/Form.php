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


class FME_Prodfaqs_Block_Adminhtml_Prodfaqs_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
	$form = new Varien_Data_Form();
	$this->setForm($form);
	$fieldset = $form->addFieldset('faqs_form', array('legend'=>Mage::helper('prodfaqs')->__('Faq information')));
      
	$resource = Mage::getSingleton('core/resource');
	$read= $resource->getConnection('core_read');
	$topicTable = $resource->getTableName('prodfaqs_topics');
	
	$select = $read->select()
	->from($topicTable,array('topic_id as value','title as label'))
	->order('topic_id ASC') ;
	$topics = $read->fetchAll($select);
	
	$empty_topic = array('value' => '', 'lable' => '');
	array_push($topics, $empty_topic);
	
      
      $fieldset->addField('question_type', 'select', array(
          'label'     => Mage::helper('prodfaqs')->__('Question Type'),
          'name'      => 'question_type',
          'values'    => array(
			       array(
				     'value'	=> 'general_question',
				     'label'	=> Mage::helper('prodfaqs')->__('General Question'),
				     ),
			       array(
				    'value'	=> 'product_question',
				    'label'	=> Mage::helper('prodfaqs')->__('Product Question'),
				   )
			       
			       ),
      ));
      
      
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('prodfaqs')->__('Question'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
	  'style'	=> 'width:590px',
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
	
	
	
     
	    
	
	
	$fieldset->addField('topic_id', 'select', array(
          'label'     => Mage::helper('prodfaqs')->__('Add in Topic'),
          'name'      => 'topic_id',
          'values'    => $topics,
      ));
     
     
     
     $fieldset->addField('show_on_main', 'select', array(
          'label'     => Mage::helper('prodfaqs')->__('Show on main page'),
          'name'      => 'show_on_main',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('prodfaqs')->__('Yes'),
              ),

              array(
                  'value'     => 0,
                  'label'     => Mage::helper('prodfaqs')->__('No'),
              ),
          ),
	  'after_element_html'	=> '<p class="note">show on main page under category</p>',
      ));
     
     $fieldset->addField('visibility', 'select', array(
          'label'     => Mage::helper('prodfaqs')->__('Visibility'),
          'name'      => 'visibility',
          'values'    => array(
              array(
                  'value'     => 'public',
                  'label'     => Mage::helper('prodfaqs')->__('Public'),
              ),

              array(
                  'value'     => 'private',
                  'label'     => Mage::helper('prodfaqs')->__('Private'),
              ),
          ),
	  'after_element_html'	=> '<p class="note">select visibility of Question</p>',
      ));
     
     
     $fieldset->addField('faq_order', 'text', array(
	    'label'	=> Mage::helper('prodfaqs')->__('Order / Position'),
	    'name'	=> 'faq_order',
	    'class'	=> 'validate-number',
	    'after_element_html'	=> '<p class="note">order / postion of faq (0 for first)</p>',      
      ));
     
     
     
     $fieldset->addField('accordion_opened', 'select', array(
	    'label'	=> Mage::helper('prodfaqs')->__('Open In Accordion'),
	    'name'	=> 'accordion_opened',
	    'values'    => array(
		array(
		    'value'     => 1,
		    'label'     => Mage::helper('prodfaqs')->__('Yes'),
		),
  
		array(
		    'value'     => 0,
		    'label'     => Mage::helper('prodfaqs')->__('No'),
		),
	    ),
	    'after_element_html'	=> '<p class="note">open by default in Accordion, when accordian is enabled from configuration.</p>',      
      ));
     
       
	  try{
			$config = Mage::getSingleton('cms/wysiwyg_config')->getConfig(
				array(
						'add_widgets' => false,
						'add_variables' => false,
						'files_browser_window_url'=> $this->getBaseUrl().'admin/cms_wysiwyg_images/index/',
				      )
				);
			
		}
		catch (Exception $ex){
			$config = null;
		}
	  
	  $fieldset->addField('faq_answar', 'editor', array(
		  'name'      => 'faq_answar',
		  'label'     => Mage::helper('prodfaqs')->__('Answer'),
		  'title'     => Mage::helper('prodfaqs')->__('Answer'),
		  'style'     => 'width:500px; height:300px;',
		  'wysiwyg'   => true,
		  'config'    => $config	  
		));
	  
	  
	  
	  
	  
	  $fieldset->addField('send_mail_to', 'checkbox', array(
		  'name'      => 'send_mail_to',
		  'label'     => Mage::helper('prodfaqs')->__('Notify Customer by Email'),
		  'title'     => Mage::helper('prodfaqs')->__('Notify Customer by Email'),
		  'value'	=> '0',
		  'onclick'	=> "if(this.checked==true) this.value='1'; else this.value='0';",
		  
		  'after_element_html'	=> '<p class="note">Notify Customer about his/her faq answer</p>',      
	  ));
	  
	  $fieldset->addField('customer_email', 'hidden', array(
	      'label'     => Mage::helper('prodfaqs')->__('Customer Email'),
	      'name'      => 'customer_email',
	      
	  ));
	   $fieldset->addField('customer_name', 'hidden', array(
	      'label'     => Mage::helper('prodfaqs')->__('Customer Name'),
	      'name'      => 'customer_name',	      
	  ));
	  
	  
	  
	  
	  
	  
	  
	  
     
      if ( Mage::getSingleton('adminhtml/session')->getFaqsData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getFaqsData());
          Mage::getSingleton('adminhtml/session')->setFaqsData(null);
      } elseif ( Mage::registry('faqs_data') ) {
          $form->setValues(Mage::registry('faqs_data')->getData());
      }
      return parent::_prepareForm();
  }
}