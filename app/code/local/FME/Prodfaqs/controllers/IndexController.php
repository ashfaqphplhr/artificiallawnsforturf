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

 
class FME_Prodfaqs_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction() 
	{
		$this->loadLayout();		
		$this->renderLayout();
    }
    
 
    public function ratingAction() 
    {
	

	if($data = $this->getRequest()->getPost()){
	    
	    try{
	    
		$read_connection = Mage::getSingleton('core/resource')->getConnection('core_read');
		$faqsTable = Mage::getSingleton('core/resource')->getTableName('prodfaqs/prodfaqs');
		$select = $read_connection->select()->from($faqsTable, array('*'))->where('faqs_id=(?)', $data['faq_id']); 
		$result_row =$read_connection->fetchRow($select);
	      
    
		if($result_row != null){
		    $write_connection = Mage::getSingleton('core/resource')->getConnection('core_write');
		    $write_connection->beginTransaction();
		    
		    $fields = array();	    
		    $fields['rating_num']	= $result_row['rating_num']+$data['value'];
		    $fields['rating_count']	= $result_row['rating_count']+1;
		    $fields['rating_stars']	= $fields['rating_num']/$fields['rating_count'];
		    
		    $where = $write_connection->quoteInto('faqs_id =?', $data['faq_id']);
		    $write_connection->update($faqsTable, $fields, $where);
		    $write_connection->commit();
		    
		    
		    //Check session for faqs id
		    $faqs_session_array = Mage::getSingleton('customer/session')->getRatedFaqsId();
		    
		    if(!is_array($faqs_session_array)){		    
			$faqs_session_array = array();
		    }
		    
		    // check this array and increment the index to save next faq id
		       
		    $faqs_session_array[] = $data['faq_id'];
		    Mage::getSingleton('customer/session')->setRatedFaqsId($faqs_session_array);
		    
		    echo Mage::helper('prodfaqs')->__('Thankyou for Rating ');
		}
	    }catch (Exception $e){
		
		echo Mage::helper('prodfaqs')->__('Unable to process Rating ');
	    }
	    
	}
	
	
    }
    
    
    
    public function saveAction() {
	
	$post = $this->getRequest()->getPost();
	if ( $post ) {
			
		$store = Mage::app()->getStore();
		$storeId = $store->getId();
			
		$translate = Mage::getSingleton('core/translate');
		$translate->setTranslateInline(false);
           
		$postObject = new Varien_Object();
		$postObject->setData($post);
			
			
			try {
				
				/***************************************************************
				these variables are set default value as false
				further they will be used as to check which required fields
				are not validating
				***************************************************************/
				$nameerror = false;
				$emailerror = false;
				$questionerror = false;
				$captchaerror = false;
				
				/***************************************************************
				zend validator validates the required fields
				***************************************************************/
				if (!Zend_Validate::is(trim($post['customer_name']) , 'NotEmpty')) { 
					$nameerror = true;
				}	
				if (!Zend_Validate::is(trim($post['customer_email']), 'EmailAddress')) {
					$emailerror = true;
				}
				if (!Zend_Validate::is(trim($post['title']) , 'NotEmpty')) {
					$questionerror = true;
				}
				if (!Zend_Validate::is(trim($post['security_code']) , 'NotEmpty')) { 
					$captchaerror = true;
				}
				/***************************************************************
				if error returned by zend validator then add an error message
				***************************************************************/
				if ($nameerror) {
					$translate->setTranslateInline(true);
					echo '<ul class="messages"><li class="error-msg"><ul><li>'.Mage::helper('faqs')->__('Please Enter your Name.').'</li></ul></li><ul>';
					return;
				}
				if ($emailerror) {
					$translate->setTranslateInline(true);
					echo '<ul class="messages"><li class="error-msg"><ul><li>'.Mage::helper('faqs')->__('Please Enter a valid Email Address.').'</li></ul></li><ul>';
					return;
				}
				if ($questionerror) {
					$translate->setTranslateInline(true);
					echo '<ul class="messages"><li class="error-msg"><ul><li>'.Mage::helper('faqs')->__('Please ask some thing.').'</li></ul></li><ul>';
					return;
				}
				if ($captchaerror) {
					$translate->setTranslateInline(true);
					echo '<ul class="messages"><li class="error-msg"><ul><li>'.Mage::helper('faqs')->__('Please Enter verification text.').'</li></ul></li><ul>';
					return;
				}	
				
				if (!$captchaerror && $post['security_code']!= $post['captacha_code']) {
					$translate->setTranslateInline(true);
					echo '<ul class="messages"><li class="error-msg"><ul><li>'.Mage::helper('faqs')->__('Sorry The Security Code You Entered Was Incorrect.').'</li></ul></li><ul>';
					return;
				}
				
			} catch (Exception $e) {
				Mage::logException($e);
				Mage::log($e);
			}
			
			
			$model = Mage::getModel('prodfaqs/prodfaqs');		
			$model->setData($post)
				->setId($this->getRequest()->getParam('id'));
			
			if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
				$model->setCreatedTime(now())
					->setUpdateTime(now());
			} else {
				$model->setUpdateTime(now());
			}
			
			$model->save();	
			
			
			/* Send E-mail notification to Moderator / Client */
			
				if(Mage::getStoreConfig('prodfaqs/email_settings/enable_moderator_notification') == 1){
				    
				    Mage::helper('prodfaqs')->sendEmailToModerator($post);		    
				    
				}
				
				if(Mage::getStoreConfig('prodfaqs/email_settings/enable_client_notification') == 1){
				    
				    Mage::helper('prodfaqs')->sendEmailToClient($post);
				    
				}
			
			echo "Question Posted Successfully";
		} else {
			echo '<ul class="messages"><li class="error-msg"><ul><li>'.Mage::helper('faqs')->__('There is some issue try again later.').'</li></ul></li><ul>';
		}
    }

	
        
    public function viewAction()
    {
	   
		$post = $this->getRequest()->getPost();
		if($post){
		    
			$sterm=$post['faqssearch'];
			$this->_redirect('*/*/search', array('term' => $sterm));
				return;   
		}
		
		$topicId = $this->_request->getParam('id', null);
	
    	if ( is_numeric($topicId) ) {
			
			$faqsTable = Mage::getSingleton('core/resource')->getTableName('prodfaqs');
			$faqsTopicTable = Mage::getSingleton('core/resource')->getTableName('prodfaqs_topics');
			$faqsStoreTable = Mage::getSingleton('core/resource')->getTableName('prodfaqs_store');
			
			//Sorting condition for topic's detail page faqs
			$sort_by = Mage::helper('prodfaqs')->getGeneralFaqSorting();
			
			if($sort_by == 'helpful'):
			
				$condition = 'f.rating_stars DESC';
				
			elseif($sort_by == 'order'):
				
				$condition = 'f.faq_order ASC';
				
			else :	
				$condition = 'f.created_time DESC';
				
			endif;		
			
			
			
			if(Mage::helper('customer')->isLoggedIn()):
			    $sqry = "select f.*,t.title as cat from ".$faqsTable." f, ".$faqsTopicTable." t where f.topic_id='$topicId' and f.status=1 and f.parent_faq_id=0 and t.topic_id='$topicId' ORDER BY $condition"; 
			else:
			    $sqry = "select f.*,t.title as cat from ".$faqsTable." f, ".$faqsTopicTable." t where f.topic_id='$topicId' and f.visibility='public' and f.parent_faq_id=0 and f.status=1 and t.topic_id='$topicId' ORDER BY $condition"; 
			endif;
			
			$connection = Mage::getSingleton('core/resource')->getConnection('core_read');
			$select = $connection->query($sqry);
			$collection = $select->fetchAll();
			
			
			if(count($collection) != 0){
				Mage::register('faqs', $collection);
			} else {
				Mage::register('faqs', NULL); 
			}
			
    	} else {
			
			Mage::register('faqs', NULL); 
		}
		
		$this->loadLayout();   
		$this->renderLayout();	
    }
    
    public function searchAction()
    {
    	
		$faqsTable = Mage::getSingleton('core/resource')->getTableName('prodfaqs');
		$faqsTopicTable = Mage::getSingleton('core/resource')->getTableName('prodfaqs_topics');
		$faqsStoreTable = Mage::getSingleton('core/resource')->getTableName('prodfaqs_store');
		
		$sterm = $this->getRequest()->getParam('term');
		$post = $this->getRequest()->getPost();
		if($post){  
			$sterm=$post['faqssearch'];    
		}
		
		
		
		if(isset($sterm)){
			
			//Sorting condition for topic's detail page faqs
			$sort_by = Mage::helper('prodfaqs')->getGeneralFaqSorting();
			
			if($sort_by == 'helpful'):
			
				$condition = 'f.rating_stars DESC';
				
			elseif($sort_by == 'order'):
				
				$condition = 'f.faq_order ASC';
				
			else :	
				$condition = 'f.created_time DESC';
				
			endif;
			
			if(Mage::helper('customer')->isLoggedIn()):
			    $sqry = "select * from ".$faqsTable." f,".$faqsStoreTable." fs where (f.title like '%$sterm%' or f.faq_answar like '%$sterm%') and (status=1)
			    and f.topic_id = fs.topic_id
			    and (fs.store_id =".Mage::app()->getStore()->getId()." OR fs.store_id=0) ORDER BY $condition";
			else:
			    
			    $sqry = "select * from ".$faqsTable." f,".$faqsStoreTable." fs where (f.title like '%$sterm%' or f.faq_answar like '%$sterm%') and (status=1)
			    and f.topic_id = fs.topic_id and f.visibility = 'public'
			    and (fs.store_id =".Mage::app()->getStore()->getId()." OR fs.store_id=0) ORDER BY $condition";
			    
			endif;
			
			$connection = Mage::getSingleton('core/resource')->getConnection('core_read');
			$select = $connection->query($sqry);
			
			$sfaqs = $select->fetchAll();
			
			if(count($sfaqs) != 0){
				Mage::register('faqs', $sfaqs);
			} 
		}
		
		
		$this->loadLayout();   
		$this->renderLayout();

    }

    public function topicsAction()
    {
		$this->loadLayout();   
		$this->renderLayout();
    }
    
    
    
    public function productfaqsAction()
    {
	   
	$prodId = $this->_request->getParam('id', null);
	
	//Load faqs of this product
	$product_faqs = Mage::getModel('prodfaqs/prodfaqs')->getFaqsOfProduct($prodId);
	
	
	if($product_faqs){
	    
	    Mage::register('nextpagefaqs',$product_faqs);
	    
	}else{
	    
	    Mage::register('nextpagefaqs',NULL);
	}
	
	
	//Load product for beadcrumbs
	$p_model = Mage::getModel('catalog/product');
	$current_product = $p_model->load($prodId);
	Mage::register('current_faqs_product',$current_product);
	
	
	$this->loadLayout();   
	$this->renderLayout();
	
    }
    
    
    public function likeAction() 
    {
	
	if($data = $this->getRequest()->getPost()){
	    
	       
	    
	    try{
		
		$faq_id		=	$data['like_object_id'];
		$customer_id	=	$data['likeby_id'];		
		$action		=	$data['act'];
		
		
		$read_connection=	Mage::getSingleton('core/resource')->getConnection('core_read');
		$table_name	=	Mage::getSingleton('core/resource')->getTableName('prodfaqs/prodfaqs');
		$select		= 	$read_connection->select()->from($table_name, array('*'))->where('faqs_id=(?)', $faq_id); 
		$result_row	=	$read_connection->fetchRow($select);
		
		$faq_like_str	=	$result_row['faq_like'];
		$faq_like_arr	=	explode(',',$faq_like_str);
		
		
		
		
		$write_connection = Mage::getSingleton('core/resource')->getConnection('core_write');
		$write_connection->beginTransaction();
		$fields = array();
		
		if($action == 'add'):
		    
		    
		    if($faq_like_str == ''){
			
			$fields['faq_like'] = $customer_id;
		    }else{
			
			$fields['faq_like'] = $faq_like_str.','.$customer_id;
		    }
		    
		elseif($action == 'delete'):
		
		    //check is customer id exist, then delete that id		   
		    
		    $key = array_search($customer_id,$faq_like_arr);
		    unset($faq_like_arr[$key]);
		    
		    $faq_like_arr = array_values($faq_like_arr);
		    
		    $fields['faq_like'] = implode(',',$faq_like_arr);
		      
		    
		endif;
		
		$where = $write_connection->quoteInto('faqs_id =?', $faq_id);
		$write_connection->update($table_name, $fields, $where);
		$write_connection->commit();
		
		
		
	    } catch (Exception $e){
		
		
	    }
	     
	    
	}
	
    }
    
    
    
    public function commentreplyAction()
    {
	
	if($post = $this->getRequest()->getPost()){
	    
	    try{
		
		    $post['title'] = $post['reply_comments'];
		    $post['customer_name'] = $post['customer_name'];
		    $post['customer_email'] = $post['customer_email'];
		    
		    
		    //Check whether admin approval needed
		    if(Mage::getStoreConfig('prodfaqs/product_page/admin_approval')){
			
			$post['status'] = 0;
			
		    }else{
			
			$post['status'] = 1;
		    }
		    
		    
		    $model = Mage::getModel('prodfaqs/prodfaqs');		
		    $model->setData($post)->setId($this->getRequest()->getParam('id'));
				
		    if ($model->getCreatedTime() == NULL || $model->getUpdateTime() == NULL) {
			$model->setCreatedTime(now())->setUpdateTime(now());
		    } else {
			$model->setUpdateTime(now());
		    }	
					
		    $model->save();
		    
		    //new created thread_id  
		    echo $model->getId();
		    
	    }catch(Exception $e){
		
		echo Mage::helper('prodfaqs')->__('Unable to process reply');
		
	    }
	
	}
	
	
    }
    
 
}
