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


class FME_Prodfaqs_Block_Adminhtml_Prodfaqs_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('faqsGrid');
      $this->setDefaultSort('faqs_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
   
      $collection = Mage::getModel('prodfaqs/prodfaqs')->getCollection()
						       ->addFieldToFilter('parent_faq_id', 0);
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
    $resource = Mage::getSingleton('core/resource');
	$read= $resource->getConnection('core_read');
	$topicTable = $resource->getTableName('prodfaqs_topics');
	
	$select = $read->select()
	->from($topicTable,array('title', 'topic_id'))
	->order('topic_id ASC') ;
	$topics = $read->fetchAll($select);
	
	$topicwid=array();	
	for($i=0; $i<count($topics); $i++){
	  $topicwid[$topics[$i]['topic_id']]=  $topics[$i]['title'];
	}
      $this->addColumn('faqs_id', array(
          'header'    => Mage::helper('prodfaqs')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'faqs_id',
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('prodfaqs')->__('Title'),
          'align'     =>'left',
          'index'     => 'title',
      ));
      
       $this->addColumn('question_type', array(
          'header'    => Mage::helper('prodfaqs')->__('Question Type'),
          'align'     =>'left',
          'index'     => 'question_type',
	  'type'      => 'options',
	  'options'   => array(
              'general_question' => 'General Question',
              'product_question' => 'Product Question',
          ),
      ));
       
      $this->addColumn('show_on_main', array(
          'header'    => Mage::helper('prodfaqs')->__('Show on main page'),
          'align'     =>'left',
          'index'     => 'show_on_main',
	  'type'      => 'options',
	  'options'   => array(
              0 => 'No',
              1 => 'Yes',
          ),
      ));
      
      $this->addColumn('visibility', array(
          'header'    => Mage::helper('prodfaqs')->__('Visibility'),
          'align'     =>'left',
          'index'     => 'visibility',
	  'type'      => 'options',
	  'options'   => array(
              'public' => 'Public',
              'private' => 'Private',
          ),
      ));
      
      $this->addColumn('accordion_opened', array(
          'header'    => Mage::helper('prodfaqs')->__('Open In Accordion'),
          'align'     =>'left',
          'index'     => 'accordion_opened',
	  'type'      => 'options',
	  'options'   => array(
              0 => 'No',
              1 => 'Yes',
          ),
      ));
      
      $this->addColumn('faq_order', array(
          'header'    => Mage::helper('prodfaqs')->__('Order / Position'),
          'align'     =>'left',
          'index'     => 'faq_order',
	  'type'      => 'text',
	  'width'     => '25px',
      ));
      
      
      
      $this->addColumn('topic_id', array(
          'header'    => Mage::helper('prodfaqs')->__('Topic'),
          'align'     =>'left',
	  'width'     => '150px',
          'index'     => 'topic_id',
	  'type'      => 'options',
          'options'   => $topicwid,
	  
      ));
	  
      $this->addColumn('status', array(
          'header'    => Mage::helper('prodfaqs')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('prodfaqs')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('prodfaqs')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('prodfaqs')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('prodfaqs')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('faqs_id');
        $this->getMassactionBlock()->setFormFieldName('prodfaqs');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('prodfaqs')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('prodfaqs')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('prodfaqs/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('prodfaqs')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('prodfaqs')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}