<?php

class Tentura_Ngroups_Block_Adminhtml_Ngroups_Edit_Tab_Import extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $this->setTemplate('ngroups/form.phtml');

      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('ngroups_form', array('legend'=>Mage::helper('ngroups')->__('Group information')));
     
      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('ngroups')->__('Import CSV file'),
          'required'  => false,
          'name'      => 'filename'
      ));

      $fieldset->addField('emails', 'editor', array(
          'label'     => Mage::helper('ngroups')->__('Add Subscribers emails (one email per line)'),
          'class'     => '',
          'style'     => 'width:274px; height:500px;',
          'name'      => 'emails',
      ));

      
     
      if ( Mage::getSingleton('adminhtml/session')->getNgroupsData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getNgroupsData());
          Mage::getSingleton('adminhtml/session')->setNgroupsData(null);
      } elseif ( Mage::registry('ngroups_data') ) {
          $form->setValues(Mage::registry('ngroups_data')->getData());
      }
      return parent::_prepareForm();
  }
}