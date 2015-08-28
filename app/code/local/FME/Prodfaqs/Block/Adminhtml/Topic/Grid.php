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

class FME_Prodfaqs_Block_Adminhtml_Topic_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('topicGrid');
      $this->setDefaultSort('topic_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('prodfaqs/topic')->getCollection();
      
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('topic_id', array(
          'header'    => Mage::helper('prodfaqs')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'topic_id',
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('prodfaqs')->__('Title'),
          'align'     =>'left',
          'index'     => 'title',
      ));
      
      $this->addColumn('identifier', array(
          'header'    => Mage::helper('prodfaqs')->__('Identifier'),
          'align'     =>'left',
          'index'     => 'identifier',
      ));
      
      $this->addColumn('show_on_main', array(
          'header'    => Mage::helper('prodfaqs')->__('Show on main page'),
          'align'     =>'left',
          'index'     => 'show_on_main',
	  'type'	=> 'options',
	  'options'	=> array(
		0 => 'No',
		1 => 'Yes',
	  ),
      ));
      
      $this->addColumn('topic_order', array(
          'header'    => Mage::helper('prodfaqs')->__('Order / Position'),
          'align'     =>'left',
          'index'     => 'topic_order',
	  //'type'      => 'text',
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