<?php

class MST_Ship_Adminhtml_HomedeliveryController extends Mage_Adminhtml_Controller_action
{

    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('ship/ship')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Shipping Manager'), Mage::helper('adminhtml')->__('Shipping Manager'));

        return $this;
    }

    public function indexAction()
    {
        $this->_initAction();
        $this->_addContent($this->getLayout()->createBlock('ship/adminhtml_homedelivery'));
        $this->renderLayout();
    }
    public function saveAction(){
    	if($data = $this->getRequest()->getPost()){
			try{
				$add_or_edit = $_POST['add_or_edit'];
				if($add_or_edit == ""){
					//Check exists before add
					$has = Mage::getModel('ship/homedelivery')->getCollection();
					$has->addFieldToFilter('from_price', $data['from_price']);
					$has->addFieldToFilter('to_price', $data['to_price']);
					$has->addFieldToFilter('cost', $data['cost']);
					//End check
					if(count($has)>0){
						Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ship')->__('This rule had already exists!'));
						$this->_redirect('*/*/');
					}else{
						$model = Mage::getModel('ship/homedelivery');
						$model->setData($data);
						$model->save();
					}
				}else{
					//Edit mode
					$model=Mage::getModel('ship/homedelivery');
					# Save to home delivery table
					$model->setData($data)->setId($add_or_edit);
					$model->save();
				}
			}catch(Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/');
			}
			
    		$this->_redirect('*/*/');
    	}
    }
}