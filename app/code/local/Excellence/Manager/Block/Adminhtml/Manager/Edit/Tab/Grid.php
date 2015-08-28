<?php
class Excellence_Manager_Block_Adminhtml_Manager_Edit_Tab_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setId('customerGrid');
		$this->setUseAjax(true); // Using ajax grid is important
		$this->setDefaultSort('entity_id');
		$this->setDefaultLimit(200);
		$this->setDefaultFilter(array('in_products'=>1)); // By default we have added a filter for the rows, that in_products value to be 1
		$this->setSaveParametersInSession(false);  //Dont save paramters in session or else it creates problems
	}

	protected function _prepareCollection()
	{
		// $collection = Mage::getResourceModel('customer/customer_collection')
		// $collection = Mage::getModel('catalog/product')->getCollection()
		//		->addNameToSelect()
		//		->addAttributeToSelect('email')
		//		->addAttributeToSelect('created_at')
		//		->addAttributeToSelect('group_id')
		//		->joinAttribute('billing_postcode', 'customer_address/postcode', 'default_billing', null, 'left')
		//		->joinAttribute('billing_city', 'customer_address/city', 'default_billing', null, 'left')
		//		->joinAttribute('billing_telephone', 'customer_address/telephone', 'default_billing', null, 'left')
		//		->joinAttribute('billing_region', 'customer_address/region', 'default_billing', null, 'left')
		//		->joinAttribute('billing_country_id', 'customer_address/country_id', 'default_billing', null, 'left')
		// ;
		$collection = Mage::getModel('catalog/product')->getCollection()
          ->addAttributeToSelect('name')
          ->addAttributeToSelect('sku')
          ->addAttributeToSelect('price')
          ->addStoreFilter($this->getRequest()->getParam('store'))
          ->addAttributeToFilter('type_id', 'configurable')
          ->joinField('position',
              'catalog/category_product',
              'position',
              'product_id=entity_id',
              'category_id='.(int) $this->getRequest()->getParam('id', 0),
              'left');

		$tm_id = $this->getRequest()->getParam('id');
		if(!isset($tm_id)) {
			$tm_id = 0;
		}
		Mage::getResourceModel('manager/grid')->addGridPosition($collection,$tm_id);
		//$collection->printLogQuery(true);
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	// protected function _addColumnFilterToCollection($column)
	// {
	// 	// Set custom filter for in product flag
	// 	if ($column->getId() == 'in_products') {
	// 		$ids = $this->_getSelectedCustomers();
	// 		if (empty($ids)) {
	// 			$ids = 0;
	// 		}
	// 		if ($column->getFilter()->getValue()) {
	// 			$this->getCollection()->addFieldToFilter('entity_id', array('in'=>$ids));
	// 		} else {
	// 			if($productIds) {
	// 				$this->getCollection()->addFieldToFilter('entity_id', array('nin'=>$ids));
	// 			}
	// 		}
	// 	} else {
	// 		parent::_addColumnFilterToCollection($column);
	// 	}
	// 	return $this;
	// }
	protected function _addColumnFilterToCollection($column)
	  {
	      // Set custom filter for in category flag
	      if ($column->getId() == 'in_category') {
	          $productIds = $this->_getSelectedProducts();
	          if (empty($productIds)) {
	              $productIds = 0;
	          }
	          if ($column->getFilter()->getValue()) {
	              $this->getCollection()->addFieldToFilter('entity_id', array('in'=>$productIds));
	          }
	          elseif(!empty($productIds)) {
	              $this->getCollection()->addFieldToFilter('entity_id', array('nin'=>$productIds));
	          }
	      }
	      else {
	          parent::_addColumnFilterToCollection($column);
	      }
	      return $this;
	  }

	// protected function _prepareColumns()
	// {

	// 	    $this->addColumn('in_products', array(
 //                'header_css_class'  => 'a-center',
 //                'type'              => 'checkbox',
 //                'name'              => 'customer',
 //                'values'            => $this->_getSelectedCustomers(),
 //                'align'             => 'center',
 //                'index'             => 'entity_id'
 //            ));
 //            $this->addColumn('entity_id', array(
 //            'header'    => Mage::helper('customer')->__('ID'),
 //            'width'     => '50px',
 //            'index'     => 'entity_id',
 //            'type'  => 'number',
 //            ));
 //            $this->addColumn('name', array(
 //            'header'    => Mage::helper('customer')->__('Name'),
 //            'index'     => 'name'
 //            ));
 //            $this->addColumn('email', array(
 //            'header'    => Mage::helper('customer')->__('Email'),
 //            'width'     => '150',
 //            'index'     => 'email'
 //            ));


 //            return parent::_prepareColumns();
	// }
    protected function _prepareColumns()
  {
      // if (!$this->getCategory()->getProductsReadonly()) {
          $this->addColumn('in_products', array(
              'header_css_class' => 'a-center',
              'type'      => 'checkbox',
              'name'      => 'in_products',
              'values'    => $this->_getSelectedProducts(),
              'align'     => 'center',
              'index'     => 'entity_id'
          ));
      // }
      $this->addColumn('entity_id', array(
          'header'    => Mage::helper('catalog')->__('ID'),
          'sortable'  => true,
          'width'     => '60',
          'index'     => 'entity_id'
      ));

      $this->addColumn('name', array(
          'header'    => Mage::helper('catalog')->__('Name'),
          'index'     => 'name'
      ));
        $this->addColumn('position', array(
	    'header'            => Mage::helper('catalog')->__('Position'),
	    'name'              => 'position',
	    'width'             => 60,
	    'type'              => 'number',
	    'validate_class'    => 'validate-number',
	    'index'             => 'position',
	    'editable'          => true,
	    'edit_only'         => true
	    ));

      return parent::_prepareColumns();
  }

  // public function getGridUrl()
  // {
  //     return $this->getUrl('*/*/grid', array('_current'=>true));
  // }

  // protected function _getSelectedProducts()
  // {
  //     $products = $this->getRequest()->getPost('selected_products');
  //     if (is_null($products)) {
  //         // $products = $this->getCategory()->getProductsPosition();
  //         return array_keys($products);
  //     }
  //     return $products;
  // }
	protected function _getSelectedProducts()   // Used in grid to return selected customers values.
	{
		$products = array_keys($this->getSelectedProducts());
		return $products;
	}

	public function getGridUrl()
	{
		return $this->_getData('grid_url') ? $this->_getData('grid_url') : $this->getUrl('*/*/customergrid', array('_current'=>true));
	}
	public function getSelectedProducts()
	{
		// Customer Data
		$tm_id = $this->getRequest()->getParam('id');
		if(!isset($tm_id)) {
			$tm_id = 0;
		}
		$collection = Mage::getModel('manager/grid')->getCollection();
		$collection->addFieldToFilter('manager_id',$tm_id);
		$custIds = array();
		foreach($collection as $obj){
			$custIds[$obj->getCustomerId()] = array('position'=>$obj->getPosition());
		}

		return $custIds;
	}


}