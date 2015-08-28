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
 
class FME_Prodfaqs_Block_Adminhtml_Prodfaqs_Edit_Tab_Replies extends Mage_Adminhtml_Block_Widget_Grid
{
 
    /**
     * Set grid params
     *
     */
    public function __construct(){
      
	parent::__construct();
        $this->setId('replies_faqs_grid');
        $this->setDefaultSort('parent_faq_id');
        //$this->setUseAjax(true);
	//$this->setSaveParametersInSession(true);
        //$this->setFilterVisibility(false);
    }
    
    
    protected function _getReply()
    {
        return Mage::registry('current_faq_replies');
    }
    
    //override to hide the filter btns
    public function getMainButtonsHtml()
    {
	return '';
    }


    public function _prepareCollection(){
      
	$collection = Mage::getModel('prodfaqs/prodfaqs')->getRepliesCollectionForGrid($this->_getReply());
	   
      
	$this->setCollection($collection);	
	return parent::_prepareCollection();
      
    }
    
    protected function _prepareColumns(){
      
      	
	$this->addColumn('faqs_id', array(
          'header'    => Mage::helper('prodfaqs')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'faqs_id',
	));
  
	$this->addColumn('customer_name_g', array(
	    'header'    => Mage::helper('prodfaqs')->__('Contact Name'),
	    'align'     =>'left',
	    'width'     => '150px',
	    'index'     => 'customer_name',
	));
	   
	    
	$this->addColumn('customer_email_g', array(
	    'header'    => Mage::helper('prodfaqs')->__('Email'),
	    'align'     =>'left',
	    'width'     => '220px',
	    'index'     => 'customer_email',
	));
	
	$this->addColumn('title_g', array(
	    'header'    => Mage::helper('prodfaqs')->__('Reply'),
	    'align'     =>'left',
	    'width'     => '220px',
	    'index'     => 'title',
	));
	
	$this->addColumn('status_g', array(
          'header'    => Mage::helper('prodfaqs')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              0 => 'Disabled',
          ),
	));
	
	 $this->addColumn('action', array(
                'header'    =>  Mage::helper('prodfaqs')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('prodfaqs')->__('Edit'),
                        'url'       => array('base'=> '*/*/replyedit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
	));
		
	
	return parent::_prepareColumns();
      
    }
    
        
    public function getRowUrl($row){
	
	return $this->getUrl('*/*/editreply', array('id' => $row->getId()));
    }
 
 
 
 
 
 
}