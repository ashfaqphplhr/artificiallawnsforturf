<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Tellafriend
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com 
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Tellafriend_IndexController extends Mage_Core_Controller_Front_Action
{
    const XML_PATH_EMAIL_SENDER     = 'tellafriend/email/email_sender';
    const XML_PATH_EMAIL_TEMPLATE   = 'tellafriend/email/email_template';

    public function indexAction(){
	#$this->loadLayout();
        #$this->_initLayoutMessages('customer/session');
        #$this->_initLayoutMessages('catalog/session');
        #$this->renderLayout();
    }
   
    public function postAction()
    {
	$session            = Mage::getSingleton('core/session');
	$post		    = $this->getRequest()->getPost();
        if ( $post ) {
            $translate = Mage::getSingleton('core/translate');
            /* @var $translate Mage_Core_Model_Translate */
            $translate->setTranslateInline(false);
            try {
                $postObject = new Varien_Object();
                $postObject->setData($post);
                $postObject->setData('url', Mage::getUrl());

                $error = false;
                
                $i=0;
                $names = array();
                foreach ($post['names'] as $name) { 
                	$names[] = $name;
                	/*if (!Zend_Validate::is(trim($name) , 'NotEmpty')) {
	                    $error = true;
	                }*/
                	$i += 1; 
                }
                $mails = array();
                foreach ($post['email'] as $mail) {
                	$mails[] = $mail;
                	/*if (!Zend_Validate::is(trim($mail), 'EmailAddress')) {
	                    $error = true;
	                }*/
                }
                
                $senderData = array('name' => $post['name'],
                'email' => $post['mail']
                );
	
                
                for ($j=0;$j<$i;$j++) {
			/*****aslinya
	                if (!Zend_Validate::is(trim($post['name']) , 'NotEmpty')) {
	                    $error = true;
	                }
	
	                if (!Zend_Validate::is(trim($post['email']), 'EmailAddress')) {
	                    $error = true;
	                }
	
	                if ($error) {
	                    throw new Exception();
	                }
	                $mailTemplate = Mage::getModel('core/email_template');
	                /* @var $mailTemplate Mage_Core_Model_Email_Template 
			
	                $mailTemplate->setDesignConfig(array('area' => 'frontend'))
	                    ->setReplyTo($replyTo)
	                    ->sendTransactional(
	                        Mage::getStoreConfig(self::XML_PATH_EMAIL_TEMPLATE),
	                        Mage::getStoreConfig(self::XML_PATH_EMAIL_SENDER),
	                        $post['email'],
	                        null,
	                        array('data' => $postObject)
	                    );
	                ******/
	                /*if (!Zend_Validate::is(trim($post['name']) , 'NotEmpty')) {
	                    $error = true;
	                }*/
	
	                //if (!Zend_Validate::is(trim($mails[$j]), 'EmailAddress')) {
	                //    $error = true;
	                //}
	
	                if ($error) {
	                    throw new Exception();
	                }
	                $mailTemplate = Mage::getModel('core/email_template');
	                /* @var $mailTemplate Mage_Core_Model_Email_Template */
	                $postObject->setData('receiver', $names[$j]);
	                $postObject->setData('sender', $post['name']);
	                $postObject->setData('message', $post['message']);
			
	                $mailTemplate->setDesignConfig(array('area' => 'frontend'))
	                    ->setReplyTo($replyTo)
	                    ->sendTransactional(
	                        Mage::getStoreConfig(self::XML_PATH_EMAIL_TEMPLATE),
	                        //Mage::getStoreConfig(self::XML_PATH_EMAIL_SENDER),
	                        $senderData,
	                        $mails[$j],
	                        $names[$j],
	                        array('data' => $postObject)
	                    ); 
	                    
	                /*force add to customer*/    
	                $write = Mage::getSingleton('core/resource')->getConnection('core_write');
			$read = Mage::getSingleton('core/resource')->getConnection('core_read');
			
			$email = $mails[$j];
			
			$select2 = "SELECT * FROM customer_entity WHERE email='".$email."' LIMIT 1";
			
			$isEmail= $read->fetchOne($select2);
			
			if (!$isEmail) {
				$today = date("Y-m-d H:i:s");
				$sql  = "INSERT INTO customer_entity (entity_id, entity_type_id, attribute_set_id, website_id, email,group_id,increment_id,store_id,created_at,updated_at,is_active,disable_auto_group_change) VALUES (NULL, '1', '0', '0', '".$email."','1',NULL,'1','".$today."','".$today."','1','0')";
				$write->query($sql);
				
				$select = "SELECT entity_id FROM customer_entity ORDER BY entity_id DESC LIMIT 1";
				
				$id = $read->fetchOne($select);
				
				$name = $names[$j];
				$nm = explode(" ", $name);
				if ($nm[1]==""){
					$nm1[1]=" ";
				}
				
				$sql1  = "INSERT INTO customer_entity_varchar (value_id, entity_type_id , attribute_id , entity_id,value) VALUES (NULL, '1', '1', '".$id."', '".$nm[0]."')";
				$sql2  = "INSERT INTO customer_entity_varchar (value_id, entity_type_id , attribute_id , entity_id,value) VALUES (NULL, '1', '2', '".$id."', '".$nm[1]."')";
				
				
				$write->query($sql1);
				$write->query($sql2);
				//echo $sql;
				//echo $sql2;
			} else {
				
				
				
			}
	                /**end**/
		}
			
                if (!$mailTemplate->getSentSuccess()) {
                    throw new Exception();
                }

                $translate->setTranslateInline(true);

                $session->addSuccess(Mage::helper('tellafriend')->__('Thank you for telling your friend about us.'));
                $this->_redirectReferer();

                return;
            } catch (Exception $e) {
                $translate->setTranslateInline(true);

                $session->addError(Mage::helper('tellafriend')->__('There was some error processing your request.'));
                $this->_redirectReferer();
                return;
            }

        } else {
            $this->_redirectReferer();
        }
    	
    }
}