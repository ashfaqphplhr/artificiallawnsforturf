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

class FME_Prodfaqs_Adminhtml_ProdfaqsController extends Mage_Adminhtml_Controller_action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('prodfaqs/items')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Manage Faqs'), Mage::helper('adminhtml')->__('Manage Faqs'));
		return $this;
	}   
 
	public function indexAction() {
			$this->_initAction()
			->renderLayout();
	}

	public function editAction() {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('prodfaqs/prodfaqs')->load($id);

		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('faqs_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('prodfaqs/items');
			$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Manage Faqs'), Mage::helper('adminhtml')->__('Manage Faqs'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
			

			$this->_addContent($this->getLayout()->createBlock('prodfaqs/adminhtml_prodfaqs_edit'))
				->_addLeft($this->getLayout()->createBlock('prodfaqs/adminhtml_prodfaqs_edit_tabs'));
				
			$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('prodfaqs')->__('Faq does not exist'));
			$this->_redirect('*/*/');
		}
	}
 
	public function newAction() {
		$this->_forward('edit');
	}
 
	public function saveAction() {
		
		
		$session = Mage::getSingleton('adminhtml/session');
		if ($data = $this->getRequest()->getPost()) {
			  			
			$model = Mage::getModel('prodfaqs/prodfaqs');		
			$model->setData($data)->setId($this->getRequest()->getParam('id'));
			
			
			
			try {
				if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
					$model->setCreatedTime(now())
						->setUpdateTime(now());
				} else {
					$model->setUpdateTime(now());
				}	
				
				
				$model->save();
				
				if($data['customer_email'] != '' && $data['send_mail_to']==1){
					
					 Mage::helper('prodfaqs')->sendEmailToClient($data);
					
				}
				
				
				

				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('prodfaqs')->__('Faq was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $model->getId()));
					return;
				}
				$this->_redirect('*/*/');
				return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('prodfaqs')->__('Unable to find Faq to save'));
        $this->_redirect('*/*/');
	}
	
	
	
	protected function _initProductFaqs() {
		
		$productfaqsId  = (int) $this->getRequest()->getParam('id');
		
		if (!$productfaqsId) {
		    return false;
		}
		
		$producfaqs = Mage::getModel('prodfaqs/prodfaqs');
		if ($productfaqsId) {
			$producfaqs->load($productfaqsId);
		}
		
			
		Mage::register('current_products_faqs', $producfaqs);
		
		return $producfaqs;
			
	}
	
	public function productsAction(){
		
		$this->_initProductFaqs();
		
		
		$this->loadLayout();		
		
		$this->getLayout()->getBlock('prodfaqs.edit.tab.products')
		 		->setProductsRelatedFaqs($this->getRequest()->getPost('products_related_faqs', null));
		
		$this->renderLayout();		
	}
	
	
	public function productsGridAction(){
		
		$this->_initProductFaqs();
		   //Push Existing Values in Array
		   $productsarray = array();
		   $Id  = (int) $this->getRequest()->getParam('id');
		   
		      
		   if($Id != 0) {
			   foreach (Mage::registry('current_products_faqs')->getRelatedProductFaqs($Id) as $products) {
			      $productsarray = $products["product_id"];
			   }
			   
			   if($productsarray){ 
				   array_push($_POST["products_related_faqs"],$productsarray);
			   }
			   Mage::registry('current_products_faqs')->setProductsRelatedFaqs($productsarray);
		   }
		   
		$this->loadLayout();
		$this->getLayout()->getBlock('prodfaqs.edit.tab.products')
					  ->setProductsRelatedFaqs($this->getRequest()->getPost('products_related_faqs', null));
		$this->renderLayout();
	}
	
	
	//----------Replies Section-------------
	
	protected function _initReplyFaqs() {
		
		$replyFaqId  = (int) $this->getRequest()->getParam('id');
		
		if (!$replyFaqId) {
			Mage::register('current_faq_replies', -1);
		    return false;
		}
		
				
		Mage::register('current_faq_replies', $replyFaqId);
		
			
	}
	
	
	public function repliesAction()
	{
		
		$this->_initReplyFaqs();
		
		$this->loadLayout();
		$this->getLayout()->getBlock('prodfaqs.edit.tab.replies');
					
		$this->renderLayout();
		
	}
	
	
	public function editreplyAction()
	{
		
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('prodfaqs/prodfaqs')->load($id);

		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('faq_reply_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('prodfaqs/items');

			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('FAQ Manager'), Mage::helper('adminhtml')->__('Faq Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('FAQ Manager'), Mage::helper('adminhtml')->__('Faq Manager'));

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
			$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);

			$this->_addContent($this->getLayout()->createBlock('prodfaqs/adminhtml_reply_editreply'))
				->_addLeft($this->getLayout()->createBlock('prodfaqs/adminhtml_reply_editreply_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('prodtestimonial')->__('Replies does not exist'));
			$this->_redirect('*/*/');
		}
			
	}
	
	//--------------------------------------------
 
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('prodfaqs/prodfaqs');
				 
				$model->setId($this->getRequest()->getParam('id'))
					->delete();
					 
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Faq was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}

    public function massDeleteAction() {
        $faqsIds = $this->getRequest()->getParam('prodfaqs');
        if(!is_array($faqsIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select Faq(s)'));
        } else {
            try {
                foreach ($faqsIds as $faqsId) {
                    $faqs = Mage::getModel('prodfaqs/prodfaqs')->load($faqsId);
                    $faqs->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($faqsIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
	
    public function massStatusAction()
    {
        $faqsIds = $this->getRequest()->getParam('prodfaqs');
        if(!is_array($faqsIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select Faq(s)'));
        } else {
            try {
                foreach ($faqsIds as $faqsId) {
                    $faqs = Mage::getSingleton('prodfaqs/prodfaqs')
                        ->load($faqsId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($faqsIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
  
    public function exportCsvAction()
    {
        $fileName   = 'prodfaqs.csv';
        $content    = $this->getLayout()->createBlock('prodfaqs/adminhtml_prodfaqs_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'prodfaqs.xml';
        $content    = $this->getLayout()->createBlock('prodfaqs/adminhtml_prodfaqs_grid')
            ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK','');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }
    
    public function toOptionArray($isMultiselect)
    {
        if (!$this->_options) {
            $this->_options = Mage::getResourceModel('core/language_collection')->loadData()->toOptionArray();
        }
        $options = $this->_options;
        if(!$isMultiselect){
            array_unshift($options, array('value'=>'', 'label'=>''));
        }
        return $options;
    }

    
}