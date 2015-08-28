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

class FME_Prodfaqs_Block_Adminhtml_Reply_Editreply_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('reply_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('prodfaqs')->__('FAQ Reply Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('replyform_section', array(
          'label'     => Mage::helper('prodfaqs')->__('Reply Information'),
          'title'     => Mage::helper('prodfaqs')->__('Reply Information'),
          'content'   => $this->getLayout()->createBlock('prodfaqs/adminhtml_reply_editreply_tab_replyform')->toHtml(),
      ));
     
      
      return parent::_beforeToHtml();
  }
}