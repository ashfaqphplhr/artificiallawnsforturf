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


class FME_Prodfaqs_Helper_Data extends Mage_Core_Helper_Abstract
{

	const XML_PATH_LIST_PAGE_TITLE				=	'prodfaqs/list/page_title';
	const XML_PATH_LIST_IDENTIFIER				=	'prodfaqs/list/identifier';
	const XML_PATH_LIST_META_DESCRIPTION			=	'prodfaqs/list/meta_description';
	const XML_PATH_LIST_META_KEYWORDS			=	'prodfaqs/list/meta_keywords';
	const XML_PATH_LIST_SORTING				=	'prodfaqs/list/sort_by';
	const XML_PATH_LIST_LIKE				=	'prodfaqs/list/like';
	
	const XML_PRODUCT_PAGE_FAQS_ENABLE			=	'prodfaqs/product_page/enable';
	const XML_PRODUCT_PAGE_TITLE				=	'prodfaqs/product_page/title';
	const XML_PRODUCT_FAQ_RATING_ENABLE			=	'prodfaqs/product_page/enable_rating';
	const XML_PRODUCT_FAQ_RATING_CUSTOMERS			=	'prodfaqs/product_page/allow_customers';
	const XML_PRODUCT_FAQ_ACCORDION				=	'prodfaqs/product_page/enable_accordion';
	const XML_PRODUCT_FAQ_SORTING				=	'prodfaqs/product_page/sort_by';
	const XML_PRODUCT_FAQ_LIKE				=	'prodfaqs/product_page/like';
	
	const XML_PRODUCT_ASK_ENABLE				=	'prodfaqs/product_ask/enable';
	const XML_PRODUCT_OPEN_FORM				=	'prodfaqs/product_ask/open_form';
	
	const XML_MODERATOR_EMAIL_SUBJECT			=	'prodfaqs/email_settings/moderator_email_subject';
	const XML_MODERATOR_EMAIL_ID				=	'prodfaqs/email_settings/moderator_email';
	const XML_MODERATOR_EMAIL_TEMPLATE			=	'prodfaqs/email_settings/moderator_email_template';
	const XML_SENDER_EMAIL					=	'prodfaqs/email_settings/email_sender';
	const XML_CLIENT_EMAIL_SUBJECT				=	'prodfaqs/email_settings/client_email_subject';
	const XML_CLIENT_EMAIL_TEMPLATE				=	'prodfaqs/email_settings/client_email_template';
	
	const XML_PATH_DETAIL_TITLE_PREFIX			=	'prodfaqs/detail/title_prefix';
	const XML_PATH_DETAIL_DEFAULT_META_DESCRIPTION		=	'prodfaqs/detail/default_meta_description';
	const XML_PATH_DETAIL_DEFAULT_META_KEYWORDS		=	'prodfaqs/detail/default_meta_keywords';
	const XML_PATH_SEO_URL_SUFFIX				=	'prodfaqs/seo/url_suffix';
	
	protected $array_of_replies_child = array();
	
	
	
	public function getListPageTitle()
	{
		return Mage::getStoreConfig(self::XML_PATH_LIST_PAGE_TITLE);
	}
	
	public function getListIdentifier()
	{
		$identifier = Mage::getStoreConfig(self::XML_PATH_LIST_IDENTIFIER);
		if ( !$identifier ) {
			$identifier = 'prodfaqs';
		}
		return $identifier;
	}
	
	public function getNewUrl()
	{
		$url = Mage::getUrl('') . self::getListIdentifier() . self::getSeoUrlSuffix();
		return $url;
	}
	
	
	public function getUrl($identifier = null)
	{
		
		if (is_null($identifier)) {
			$url = Mage::getUrl('') . self::getListIdentifier() . self::getSeoUrlSuffix();
		} else {
			$url = Mage::getUrl(self::getListIdentifier()) . $identifier . self::getSeoUrlSuffix();
		}
		return $url;
		
	}
	
	public function getGeneralFaqSorting()
	{
		return Mage::getStoreConfig(self::XML_PATH_LIST_SORTING);
	}
	public function getProductFaqSorting()
	{
		return Mage::getStoreConfig(self::XML_PRODUCT_FAQ_SORTING);
	}
	
	public function isGeneralFaqLikeEnable()
	{
		return Mage::getStoreConfig(self::XML_PATH_LIST_LIKE);
	}
	public function isProductFaqLikeEnable()
	{
		return Mage::getStoreConfig(self::XML_PRODUCT_FAQ_LIKE);
	}
	
	public function isProductFaqsEnable()
	{
		return Mage::getStoreConfig(self::XML_PRODUCT_PAGE_FAQS_ENABLE);
	}
	public function getProductFaqsTitle()
	{
		return Mage::getStoreConfig(self::XML_PRODUCT_PAGE_TITLE);
	}
	public function isProductFaqsRatingEnable()
	{
		return Mage::getStoreConfig(self::XML_PRODUCT_FAQ_RATING_ENABLE);
	}
	public function getProductFaqsRatingCustomers()
	{
		return Mage::getStoreConfig(self::XML_PRODUCT_FAQ_RATING_CUSTOMERS);
	}
	public function isProductFaqsAccordionEnable()
	{
		return Mage::getStoreConfig(self::XML_PRODUCT_FAQ_ACCORDION);
	}	
	
	public function isProductFaqsAskQuestionEnable()
	{
		return Mage::getStoreConfig(self::XML_PRODUCT_ASK_ENABLE);
	}
	
	public function getProductFaqsFormOpen()
	{
		return Mage::getStoreConfig(self::XML_PRODUCT_OPEN_FORM);
	}
	
		
		
	public function getListMetaDescription()
	{
		return Mage::getStoreConfig(self::XML_PATH_LIST_META_DESCRIPTION);
	}
	
	public function getListMetaKeywords()
	{
		return Mage::getStoreConfig(self::XML_PATH_LIST_META_KEYWORDS);
	}
	
	public function getSeoUrlSuffix()
	{
		return Mage::getStoreConfig(self::XML_PATH_SEO_URL_SUFFIX);
	}
	
	public function getDetailDefaultMetaDescription()
	{
		return Mage::getStoreConfig(self::XML_PATH_DETAIL_DEFAULT_META_DESCRIPTION);
	}
	
	public function getDetailDefaultMetaKeywords()
	{
		return Mage::getStoreConfig(self::XML_PATH_DETAIL_DEFAULT_META_KEYWORDS);
	}
	
	public function getDetailTitlePrefix()
	{
		return Mage::getStoreConfig(self::XML_PATH_DETAIL_TITLE_PREFIX);
	}
	
	public function recursiveReplace($search, $replace, $subject)
	{
		if(!is_array($subject))
		    return $subject;
	
		foreach($subject as $key => $value)
		    if(is_string($value))
			$subject[$key] = str_replace($search, $replace, $value);
		    elseif(is_array($value))
			$subject[$key] = self::recursiveReplace($search, $replace, $value);
	
		return $subject;
	}

	public function extensionEnabled($extension_name)
	{
		$modules = (array)Mage::getConfig()->getNode('modules')->children();
		if (!isset($modules[$extension_name])
			|| $modules[$extension_name]->descend('active')->asArray()=='false'
			|| Mage::getStoreConfig('advanced/modules_disable_output/'.$extension_name)
		) return false;
		return true;
	}
	
	
	public function strip_only($str, $tags, $stripContent = false) {
		$content = '';
		if(!is_array($tags)) {
			$tags = (strpos($str, '>') !== false ? explode('>', str_replace('<', '', $tags)) : array($tags));
			if(end($tags) == '') array_pop($tags);
		}
		foreach($tags as $tag) {
			if ($stripContent)
				 $content = '(.+</'.$tag.'[^>]*>|)';
			 $str = preg_replace('#</?'.$tag.'[^>]*>'.$content.'#is', '', $str);
		}
		return $str;
	}
	
	
	public function sendEmailToModerator($info_array){
		
		$m_subject = Mage::getStoreConfig(self::XML_MODERATOR_EMAIL_SUBJECT);
		$m_email = Mage::getStoreConfig(self::XML_MODERATOR_EMAIL_ID);
		$template = Mage::getStoreConfig(self::XML_MODERATOR_EMAIL_TEMPLATE);
		
		
		$sender_id = Mage::getStoreConfig(self::XML_SENDER_EMAIL);
		$sender_email = 'owner@example.com';
		$sender_name = 'Owner';
		
		if($sender_id == 'general'){
			$sender_email = Mage::getStoreConfig('trans_email/ident_general/email');
			$sender_name = Mage::getStoreConfig('trans_email/ident_general/name');
		
		}elseif($sender_id == 'sales'){
			$sender_email = Mage::getStoreConfig('trans_email/ident_sales/email');
			$sender_name = Mage::getStoreConfig('trans_email/ident_sales/name');
		
		}elseif($sender_id == 'support'){
			$sender_email = Mage::getStoreConfig('trans_email/ident_support/email');
			$sender_name = Mage::getStoreConfig('trans_email/ident_support/name');
		
		}elseif($sender_id == 'custom1'){
			$sender_email = Mage::getStoreConfig('trans_email/ident_custom1/email');
			$sender_name = Mage::getStoreConfig('trans_email/ident_custom1/name');
		
		}elseif($sender_id == 'custom2'){
			$sender_email = Mage::getStoreConfig('trans_email/ident_custom2/email');
			$sender_name = Mage::getStoreConfig('trans_email/ident_custom2/name');
		}
		
		
		
		
		
		$emailTemplate = Mage::getModel('core/email_template')->loadDefault($template);
		
		
		// Status of faq
		$faq_status = $info_array['status'];
		if($faq_status == 1){
			$faq_status = "Active.";
		}else{
			$faq_status = "Awaiting moderation.";
		}
		
		
		//array of variables to assign to template		
		$emailVars = array(
				   'customer_name'	=> 	$info_array['customer_name'],
				   'mod_email'		=> 	$info_array['customer_email'],
				   'question'		=> 	$info_array['title'],
				   'status'		=> 	$faq_status
				   );
		
		$emailTemplate->getProcessedTemplate($emailVars);
		
		
		$emailTemplate->setSenderName($sender_name);
		$emailTemplate->setSenderEmail($sender_email);
		$emailTemplate->setTemplateSubject($m_subject);
		$emailTemplate->send($m_email, 'FAQs Notification', $emailVars);
		
	}
	
	
	public function sendEmailToClient($info_array){
		
		$c_subject	=	Mage::getStoreConfig(self::XML_CLIENT_EMAIL_SUBJECT);
		$template	=	Mage::getStoreConfig(self::XML_CLIENT_EMAIL_TEMPLATE);
		
		$sender_id	=	Mage::getStoreConfig(self::XML_SENDER_EMAIL);
		$sender_email	=	'owner@example.com';
		$sender_name	=	'Owner';
		
		if($sender_id == 'general'){
			$sender_email = Mage::getStoreConfig('trans_email/ident_general/email');
			$sender_name = Mage::getStoreConfig('trans_email/ident_general/name');
		
		}elseif($sender_id == 'sales'){
			$sender_email = Mage::getStoreConfig('trans_email/ident_sales/email');
			$sender_name = Mage::getStoreConfig('trans_email/ident_sales/name');
		
		}elseif($sender_id == 'support'){
			$sender_email = Mage::getStoreConfig('trans_email/ident_support/email');
			$sender_name = Mage::getStoreConfig('trans_email/ident_support/name');
		
		}elseif($sender_id == 'custom1'){
			$sender_email = Mage::getStoreConfig('trans_email/ident_custom1/email');
			$sender_name = Mage::getStoreConfig('trans_email/ident_custom1/name');
		
		}elseif($sender_id == 'custom2'){
			$sender_email = Mage::getStoreConfig('trans_email/ident_custom2/email');
			$sender_name = Mage::getStoreConfig('trans_email/ident_custom2/name');
		}
		
		
		$emailTemplate	=	Mage::getModel('core/email_template')->loadDefault($template);
		
		
		//status of testimonial
		$faq_status = $info_array['status'];
		if($faq_status == 1){
			$faq_status = "Active.";
		}else{
			$faq_status = "Awaiting moderation.";
		}
		
		if($info_array['faq_answar'] == ''){
			$info_array['faq_answar'] = 'You will recieve an email from Administrator';
		}
		
		//array of variable to assign template
		$emailVars = array(
				   'customer_name'	=> 	$info_array['customer_name'],
				   'email'		=> 	$info_array['customer_email'],
				   'question'		=> 	$info_array['title'],
				   'answer'		=> 	$info_array['faq_answar'],
				   'status'		=> 	$faq_status
				   );
		
		$emailTemplate->getProcessedTemplate($emailVars);
		
		
		$emailTemplate->setSenderName($sender_name);
		$emailTemplate->setSenderEmail($sender_email);
		$emailTemplate->setTemplateSubject($c_subject);
		$emailTemplate->send($info_array['customer_email'], 'FAQs Notification', $emailVars);
		
		
	}
	
	public function getProductFaqsPageUrl($product_obj){
		
		$url = Mage::getUrl('') . self::getListIdentifier() . DS .$product_obj->getUrlKey().'-questions'.self::getSeoUrlSuffix();
		
		return $url; 
		
	}
	
	
	/***************************************************************
	this function create the reply html for each thread 
       ***************************************************************/
	
	public function createReplyHtmlForThread($faq_thread_id){
		
		$t_session = Mage::getSingleton('customer/session');
		$customer = $t_session->getCustomer();
		$customer_name = $customer->getFirstname();
			
		$comment_form_wrapper = '';
		
		
			
			$comment_form_wrapper = "<div class='clear'></div>";
			$comment_form_wrapper .= "<div class='thread-js-plugin-reply-form-wrapper' id='thread-js-plugin-reply-form-wraper".$faq_thread_id."' style='display:none;'>";
			$comment_form_wrapper .= "<form action='' id='threadReplyForm' name='threadReplyForm' method='post' enctype='multipart/form-data'>";
			$comment_form_wrapper .= "<div class='js-plugin-reply-customer-info'>";
			$comment_form_wrapper .= "<img src='".Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_JS).'prodfaqs/like/dman.png'."' class='js-plugin-customer-thumb' />";
			$comment_form_wrapper .= "<div class='js-plugin-detail'>";
			$comment_form_wrapper .= "<h3>".$customer_name."</h3>";
			$comment_form_wrapper .= "<p> Add a reply </p>";
			$comment_form_wrapper .= "</div>";
			$comment_form_wrapper .= "</div>";
			$comment_form_wrapper .= "<div class='js-plugin-reply-reply-filed'>";
			$comment_form_wrapper .= "<textarea cols='32' rows='6' name='thread-customer-reply-text' id='thread-customer-reply-text-".$faq_thread_id."' class='' ></textarea>";
			$comment_form_wrapper .= "</div>";
			$comment_form_wrapper .= "<div class='js-plugin-reply-customer-form-footer'>";
			$comment_form_wrapper .= "<img class='progress-image' id='thread-progress-image-loader-".$faq_thread_id."' title='Loading ...' alt='Loading ...' src='".Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'images/prodfaqs/loader.gif'."' >";
			$comment_form_wrapper .= "<button class='button' title='Post reply' type='button' onclick='javascript: submitAjaxThreadCommentReply(".$faq_thread_id.")'>";
			$comment_form_wrapper .= "<span><span>Post</span></span>";
			$comment_form_wrapper .= "</button>";
			$comment_form_wrapper .= "<a href='javascript: ' id='thread-js-plugin-reply-form-cancel".$faq_thread_id."'>Cancel</a>";
			$comment_form_wrapper .= "</div>";
			$comment_form_wrapper .= "</form>";
			$comment_form_wrapper .= "<div class='clear'></div>";
			$comment_form_wrapper .= "</div>";
		
		
		return $comment_form_wrapper;
		
	}
	
	
	/***************************************************************
	this function create the like/unlike html for each thread 
       ***************************************************************/
	
	public function createLikeUnlikeForThread($testimonial_thread_id,$testimonial_thread_customers_like){
		
		$thread_like_js = '';
		$thread_like_html = '';
		
		if($this->isProductFaqLikeEnable() && Mage::helper('customer')->isLoggedIn()):
		
			$t_session = Mage::getSingleton('customer/session');
			$customer = $t_session->getCustomer();
			$customer_name = $customer->getFirstname();
			$customer_id = $customer->getId();
			$customer_thumb_path = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_JS).'prodfaqs/like/dman.png'; 
			$customer_thumb = "<img src='$customer_thumb_path' style='width:15px; height:15px; margin:0 5px;'>";
    
			$thread_like_js = "<script type='text/javascript'>";				
			$thread_like_js .= "Event.observe(window, 'load', function() {";					
			$thread_like_js .= "var customer_name = '".$customer_name."';";
			$thread_like_js .= "var customer_id = '".$customer_id."';";
			$thread_like_js .= "if($('thread_like_faq_id_".$testimonial_thread_id."') != undefined){";						
			$thread_like_js .= "thread_like = new Control.Like($('thread_like_container_".$testimonial_thread_id."'),$('thread_like_element_".$testimonial_thread_id."'),$('thread_like_result_".$testimonial_thread_id."'),$('thread_likeby_text_".$testimonial_thread_id."'),$('thread_count_elements_".$testimonial_thread_id."'),
							{
							    likeby_name		: customer_name,
							    likeby_id 		: customer_id,
							    liked_obj_id 	: parseInt($('thread_like_faq_id_".$testimonial_thread_id."').readAttribute('title')),
							    likeby_avatar 	: '".$customer_thumb_path."',
							    updateUrl		: '".Mage::getUrl('prodfaqs/index/like')."',
							    updateOptions 	: {					
										    method:'post',
										    onSuccess: function(transport) {}
										   }
							    
							});";						
			$thread_like_js .= "}";			
			$thread_like_js .= "});";			
			$thread_like_js .= "</script>";
		
		

		
			$like_customer_ids = $testimonial_thread_customers_like;
			$like_customer_ids_arr = explode(',',$like_customer_ids);
			
			
			$thread_like_html = "<div class='like_dv' id='thread_like_container_".$testimonial_thread_id."'>";
			
			
			if(in_array($customer_id,$like_customer_ids_arr)){
				
				
				$thread_like_html .= "<a href='javascript:' id='thread_like_element_".$testimonial_thread_id."'>Unlike</a>";
				
				if(Mage::getStoreConfig('prodfaqs/product_page/reply') && Mage::helper('customer')->isLoggedIn()):
				
					$thread_like_html .= "<a class='js-plugin-reply-button' href='javascript: showJsCommentForm(null,".$testimonial_thread_id.")' id='thread_reply_element_".$testimonial_thread_id."'>Reply</a>";
				endif;
				
				$thread_like_html .= "<br /><div style='float:left;' id='thread_likeby_text_".$testimonial_thread_id."'>Liked by</div>";
				$thread_like_html .= "<div id='thread_like_result_".$testimonial_thread_id."' class='like_on'>".$customer_thumb."You</div>";			    
				$thread_like_html .= "<span id='thread_like_faq_id_".$testimonial_thread_id."' style='display:none;' title='".$testimonial_thread_id."'></span>";
				$thread_like_html .= "<span id='thread_count_elements_".$testimonial_thread_id."' title='";
					if($like_customer_ids!= ''){
						$thread_like_html .= count($like_customer_ids_arr);
					}else{
						$thread_like_html .= 0;
					}
				$thread_like_html .= "' style='display:none;'>".count($like_customer_ids_arr)."</span>";
				
			}else{		    
								
				$thread_like_html .= "<a href='javascript:' id='thread_like_element_".$testimonial_thread_id."'>Like</a>";
				
				if(Mage::getStoreConfig('prodfaqs/product_page/reply') && Mage::helper('customer')->isLoggedIn()):
				
					$thread_like_html .= "<a class='js-plugin-reply-button' href='javascript: showJsCommentForm(null,".$testimonial_thread_id.")' id='thread_reply_element_".$testimonial_thread_id."'>Reply</a>";
				endif;
				
				$thread_like_html .= "<br /><div style='float:left;'>";
				$thread_like_html .= "<div style='float:left;' id='thread_likeby_text_".$testimonial_thread_id."'>";
					if($like_customer_ids != ''){	$thread_like_html .="Liked by"; }
				$thread_like_html .= "</div>";
					
				$thread_like_html .= "<div id='thread_like_result_".$testimonial_thread_id."'></div>";
				$thread_like_html .= "</div>";
				
				$thread_like_html .= "<span id='thread_like_faq_id_".$testimonial_thread_id."' style='display:none;' title='".$testimonial_thread_id."'></span>";
				$thread_like_html .= "<span id='thread_count_elements_".$testimonial_thread_id."' title='";
					if($like_customer_ids!= ''){
						$thread_like_html .= count($like_customer_ids_arr);
					}else{
						$thread_like_html .= 0;
					}
				$thread_like_html .= "'></span>";
							    
			}
						
						    
			foreach($like_customer_ids_arr as $c_id):
							    
				$customer_data = Mage::getModel('customer/customer')->load($c_id);
				if($c_id != '' && $c_id != $customer_id) { 
							
					$thread_like_html .="<div class='like-customers-view'>".$customer_thumb.$customer_data->getFirstname()."</div>";
							    
				} 			
							    
			endforeach;
							
			$thread_like_html .="<div class='clear'></div>";		
			$thread_like_html .="</div>";
		
		endif; 
		
		
		
		if(Mage::getStoreConfig('prodfaqs/product_page/reply') && !$this->isProductFaqLikeEnable() && Mage::helper('customer')->isLoggedIn()):
				
					$thread_like_html .= "<div class='like_dv'><a class='js-plugin-reply-button' href='javascript: showJsCommentForm(null,".$testimonial_thread_id.")' id='thread_reply_element_".$testimonial_thread_id."' style='padding-left:0;'>Reply</a><br/></div>";
		endif;
				
				
		
		
		return $thread_like_js.$thread_like_html;
	
	}
	
	
	
	/***************************************************************
	this function create the rating html for each thread 
       ***************************************************************/
	
	public function createRatingForThread($testimonial_thread_id,$testimonial_thread_rating_stars){
		
		$testimonials_already_rated = Mage::getSingleton('customer/session')->getRatedFaqsId();
		$reate_by_customer = $this->getProductFaqsRatingCustomers();
		
		$thread_rating = '';
		$thread_rating_js = '';
		
		if($this->isProductFaqsRatingEnable()):
					
					//rating js
					$thread_rating_js = "<script type='text/javascript'>";
					
					$thread_rating_js .= "Event.observe(window, 'load', function() {";
					
					$thread_rating_js .= "var thread_rating_element = $('thread_rating_".$testimonial_thread_id."');";
					$thread_rating_js .= "if($('thread_has_rated_".$testimonial_thread_id."') != undefined){
								var thread_is_rated = $('thread_has_rated_".$testimonial_thread_id."').readAttribute('title');
								if(thread_is_rated == 'yes') thread_is_rated = true;
								else if(thread_is_rated == 'no') thread_is_rated = false;}";
					
					$thread_rating_js .= "if(thread_rating_element != undefined){
								t_rating = new Control.Rating(thread_rating_element,
								{
									rated: thread_is_rated,
									value: parseFloat($('thread_stars_".$testimonial_thread_id."').readAttribute('title')),
									faq_id: parseInt($('thread_faq_id_".$testimonial_thread_id."').readAttribute('title')),
									updateUrl:'".Mage::getUrl('prodfaqs/index/rating')."',
									updateOptions :
										{									
											method: 'post',
											onSuccess: function(transport)
												{
													$('rating-success').appear();
													$('rating_message').update(transport.responseText);
												},
											onFailure: function(transport)
												{
													$('rating-fail').appear();
													$('rating_message').update(transport.responseText);
														
												}
											
										}
									
								});
								
								}";
					
					$thread_rating_js .= "});";
					$thread_rating_js .= "</script>";
					
					
					
					
					$thread_rating = "<div class='thread_rating_dv'>";
					$thread_rating .= "<span id='thread_faq_id_".$testimonial_thread_id."' style='display:none;' title='".$testimonial_thread_id."'></span>";
					$thread_rating .= "<span id='thread_stars_".$testimonial_thread_id."' style='display:none;' title='".$testimonial_thread_rating_stars."'></span>";
					
					if($reate_by_customer == 'all' || ($reate_by_customer == 'registered' && Mage::helper('customer')->isLoggedIn())):
						if(in_array($testimonial_thread_id,$testimonials_already_rated)):
							
							$thread_rating .= "<span id='thread_has_rated_".$testimonial_thread_id."' style='display:none;' title='yes'></span>";
						else:
						
							$thread_rating .= "<span id='thread_has_rated_".$testimonial_thread_id."' style='display:none;' title='no'></span>";
							
						endif;
					else:
						$thread_rating .= "<span id='thread_has_rated_".$testimonial_thread_id."' style='display:none;' title='yes'></span>";
					
					endif;
					
					$thread_rating .= "<div id='thread_rating_".$testimonial_thread_id."' class='thread_rating_container'></div>";
						   
						    
					$thread_rating .= "</div>";
					
					
		endif;
				
			
		return $thread_rating.$thread_rating_js;
	
		
	}
	
	
	
	public function loadAllChildsIds($parent_id){
		
		
		$collection = Mage::getModel('prodfaqs/prodfaqs')->getCollection();
		
		
		
		$collection->getSelect()->from(Mage::getModel('prodfaqs/prodfaqs')->getTable('prodfaqs'))
                                        ->where('parent_faq_id = (?)', $parent_id);
                                        //->where('status = (?)', 1);
                 
		                   
                foreach($collection as $f_data){
		
			if($f_data->getFaqsId()){
				$this->array_of_replies_child[] = $f_data->getFaqsId();
				$this->loadAllChildsIds($f_data->getFaqsId());
			}
			
		}   	
		
		
		
	}
	
	public function getRepliesChildIds(){
		
		return $this->array_of_replies_child;
	}
	
	
	

}