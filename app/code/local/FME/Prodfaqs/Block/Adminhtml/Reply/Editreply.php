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
 
class FME_Prodfaqs_Block_Adminhtml_Reply_Editreply extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'reply_id';
        $this->_blockGroup = 'prodfaqs';
        $this->_controller = 'adminhtml_prodfaqs';
        
        $this->_updateButton('save', 'label', Mage::helper('prodfaqs')->__('Save Reply'));
        $this->_updateButton('delete', 'label', Mage::helper('prodfaqs')->__('Delete Reply'));
		
        
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('prodfaqs_reply_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'prodfaqs_reply_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'prodfaqs_reply_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/editreply/');
            }
        ";
    
	
    }

    public function getHeaderText()
    {
        if( Mage::registry('faq_reply_data') && Mage::registry('faq_reply_data')->getId() ) {
	    
	    
	    if(Mage::registry('faq_reply_data')->getCustomerName())
		return Mage::helper('prodfaqs')->__("Edit Reply '%s'", $this->htmlEscape(Mage::registry('faq_reply_data')->getCustomerName()));
	    else
		return Mage::helper('prodfaqs')->__("Edit Reply '%s'", $this->htmlEscape(Mage::registry('faq_reply_data')->getId()));
	    
	    
        } else {
            return Mage::helper('prodfaqs')->__('Add Faq');
        }
    }
}