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


class FME_Prodfaqs_Block_ProductFaqs extends Mage_Catalog_Block_Product_Abstract
{
    
    protected function _tohtml(){
	
	if ($this->getFromXml()=='yes' && !Mage::helper('prodfaqs')->isProductFaqsEnable() || Mage::getStoreConfig('prodfaqs/product_page/show_faqs_on') == 'new_page')
            return parent::_toHtml();

        $this->setFormAction( Mage::getUrl('prodfaqs/index/add') );
	
	$this->setLinksforProduct();
        
	$this->setTemplate("prodfaqs/productfaqs.phtml");
	
	return parent::_toHtml();
    }
    
    
    public function getProductRelatedFaqs(){
	
	
	$product_id = $this->getProduct()->getId();
	//$product_id = Mage::registry('current_product')->getId();
	
	$product_faqs = Mage::getModel('prodfaqs/prodfaqs')->getFaqsOfProduct($product_id);
	
	
	return $product_faqs; 
    }
    
    public function getSecureImageUrl()	{
		
	$path = Mage::getBaseUrl('js');
	
	$apppath = $path. 'prodfaqs/FME_Prodfaqs' . DS . 'captcha/';
	return $apppath; 
		
    }
    
    function getNewrandCode($length){
	
	if($length>0) 
	{ 
	  $rand_id="";
	   for($i=1; $i<=$length; $i++)
	   {
		   $num = rand(1,36);
		   $rand_id .= $this->assign_rand_value($num);
	   }
	}
	return $rand_id;
    }
    
    
    function assign_rand_value($num){
	
	// accepts 1 - 36
	  switch($num)
	  {
		case "1":
		 $rand_value = "a";
		break;
		case "2":
		 $rand_value = "b";
		break;
		case "3":
		 $rand_value = "c";
		break;
		case "4":
		 $rand_value = "d";
		break;
		case "5":
		 $rand_value = "e";
		break;
		case "6":
		 $rand_value = "f";
		break;
		case "7":
		 $rand_value = "g";
		break;
		case "8":
		 $rand_value = "h";
		break;
		case "9":
		 $rand_value = "i";
		break;
		case "10":
		 $rand_value = "j";
		break;
		case "11":
		 $rand_value = "k";
		break;
		case "12":
		 $rand_value = "z";
		break;
		case "13":
		 $rand_value = "m";
		break;
		case "14":
		 $rand_value = "n";
		break;
		case "15":
		 $rand_value = "o";
		break;
		case "16":
		 $rand_value = "p";
		break;
		case "17":
		 $rand_value = "q";
		break;
		case "18":
		 $rand_value = "r";
		break;
		case "19":
		 $rand_value = "s";
		break;
		case "20":
		 $rand_value = "t";
		break;
		case "21":
		 $rand_value = "u";
		break;
		case "22":
		 $rand_value = "v";
		break;
		case "23":
		 $rand_value = "w";
		break;
		case "24":
		 $rand_value = "x";
		break;
		case "25":
		 $rand_value = "y";
		break;
		case "26":
		 $rand_value = "z";
		break;
		case "27":
		 $rand_value = "0";
		break;
		case "28":
		 $rand_value = "1";
		break;
		case "29":
		 $rand_value = "2";
		break;
		case "30":
		 $rand_value = "3";
		break;
		case "31":
		 $rand_value = "4";
		break;
		case "32":
		 $rand_value = "5";
		break;
		case "33":
		 $rand_value = "6";
		break;
		case "34":
		 $rand_value = "7";
		break;
		case "35":
		 $rand_value = "8";
		break;
		case "36":
		 $rand_value = "9";
		break;
	  }
		return $rand_value;
    }
    
    
    /***************************************************************
	this recursive function disply threads, parent, child and so on
    ***************************************************************/
	
	public function getThreads($parent_id){
		
		
		//Get all threads of this testimonial/thread
		$model = Mage::getModel('prodfaqs/prodfaqs');
		$thread_result = $model->getChildFaqs($parent_id);
		
		$customer_thumb_path = $this->getJsUrl('prodfaqs/like/dman.png');
		$thread_rating = '';
		$thread_reply = '';
		$thread_like = '';
		
		
		if($thread_result){			
			
			foreach($thread_result as $thread_val){
				
				//Create the html for thread Rating
				$thread_rating = Mage::helper('prodfaqs')->createRatingForThread($thread_val['faqs_id'],$thread_val['rating_stars']);			
				
				//Create the html for thread Reply
				$thread_reply = Mage::helper('prodfaqs')->createReplyHtmlForThread($thread_val['faqs_id']);
				
				//Create the html for thread Like/Unlike
				$thread_like = Mage::helper('prodfaqs')->createLikeUnlikeForThread($thread_val['faqs_id'],$thread_val['faq_like']);
				
				$thread_parent = $thread_val['parent_faq_id'];
				//if parent also has parent then its 3rd or plus level othervise its second
				//load that parent testimonial and check does it has parent
				$parent_record = $model->getNewCreatedThreadFaq($thread_parent);
				
				if($parent_record['parent_faq_id'] != 0){
					$level_css_style = "style='padding-left:100px; width:350px;'";
				}else{
					$level_css_style = "";
				}
				
				$thread = "<div class='testimonial-thread' ".$level_css_style." id='testimonial-thread-".$thread_val['faqs_id']."'>";
				$thread .= "<div class='customer-image'><img src='".$customer_thumb_path."' width='50px' height='50px;'></div>";
				$thread .= "<h3>".$thread_val['customer_name']."</h3>";
				$thread .= "<p>".$thread_val['title']."</p>";
				$thread .= $thread_rating;
				$thread .= $thread_like;
				$thread .= $thread_reply;
				
				$thread .= "<div id='testimonial-thread-thread-".$thread_val['faqs_id']."' class='testimonial-thread-thread'></div>";//this is to attach new thread under there
				
				$thread .= "</div>";
				
				echo $thread;
				
				
				//call to its child recursively
				$this->getThreads($thread_val['faqs_id']);
				
			}
			
			
			
		}else{
			
			return false;
			
		}
		
		
		
	}
    
    
    
    
}