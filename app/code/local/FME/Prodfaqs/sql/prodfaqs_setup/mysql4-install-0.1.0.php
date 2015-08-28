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

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('prodfaqs')};
CREATE TABLE {$this->getTable('prodfaqs')} (                                  
            `faqs_id` int(11) unsigned NOT NULL auto_increment,      
            `topic_id` int(11) default NULL,                         
            `question_type` varchar(255) NOT NULL default '',        
            `title` varchar(255) NOT NULL default '',                
            `show_on_main` smallint(6) NOT NULL default '0',         
            `faq_answar` text NOT NULL,                              
            `faq_order` smallint(6) NOT NULL default '0',            
            `rating_num` bigint(20) NOT NULL default '0',            
            `rating_count` bigint(20) NOT NULL default '0',          
            `rating_stars` decimal(12,4) NOT NULL default '0.0000',  
            `accordion_opened` smallint(6) NOT NULL default '0',     
            `visibility` varchar(255) default '',                    
            `status` smallint(6) NOT NULL default '0',               
            `created_time` datetime default NULL,                    
            `update_time` datetime default NULL,                     
            `customer_name` varchar(255) default '',                 
            `customer_email` varchar(255) default '',                
            `faq_like` varchar(255) default '',                      
            `parent_faq_id` int(11) NOT NULL default '0',            
            PRIMARY KEY  (`faqs_id`)                                 
          ) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
          

DROP TABLE IF EXISTS {$this->getTable('prodfaqs_topics')};
CREATE TABLE {$this->getTable('prodfaqs_topics')} (                        
                   `topic_id` int(11) unsigned NOT NULL auto_increment,  
                   `title` varchar(255) NOT NULL default '',             
                   `identifier` varchar(255) NOT NULL default '',        
                   `status` smallint(6) NOT NULL default '0',            
                   `default` smallint(6) NOT NULL default '2',           
                   `show_on_main` smallint(6) NOT NULL default '0',      
                   `topic_order` smallint(6) NOT NULL default '0',       
                   `created_time` datetime default NULL,                 
                   `update_time` datetime default NULL,                  
                   PRIMARY KEY  (`topic_id`)                             
                 ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
                 


DROP TABLE IF EXISTS {$this->getTable('prodfaqs_store')};
CREATE TABLE {$this->getTable('prodfaqs_store')} (                             
                  `topic_id` int(11) unsigned NOT NULL,                     
                  `store_id` smallint(5) unsigned NOT NULL,                 
                  PRIMARY KEY  (`topic_id`,`store_id`),                     
                  KEY `FK_PRODFAQS_STORE_STORE` (`store_id`)                
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Faqs Stores';
                
DROP TABLE IF EXISTS {$this->getTable('prodfaqs_products')};                
CREATE TABLE {$this->getTable('prodfaqs_products')} (                      
                     `faqs_product_id` int(11) NOT NULL auto_increment,    
                     `faqs_id` int(11) default NULL,                       
                     `product_id` int(11) default NULL,                    
                     UNIQUE KEY `faqs_product_id` (`faqs_product_id`)      
                   ) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

");




$installer->setConfigData('prodfaqs/list/page_title','Faqs');
$installer->setConfigData('prodfaqs/list/identifier','faqs');
$installer->setConfigData('prodfaqs/list/meta_keywords','Faqs');
$installer->setConfigData('prodfaqs/list/meta_description','Faqs');
$installer->setConfigData('prodfaqs/list/display_categories','all');
$installer->setConfigData('prodfaqs/list/show_number_of_questions','3');
$installer->setConfigData('prodfaqs/list/enable_view_more','1');
$installer->setConfigData('prodfaqs/list/enable_accordion','1');
$installer->setConfigData('prodfaqs/list/sort_by','helpful');
$installer->setConfigData('prodfaqs/list/like','1');

$installer->setConfigData('prodfaqs/product_page/enable','1');
$installer->setConfigData('prodfaqs/product_page/title','Product Faqs');
$installer->setConfigData('prodfaqs/product_page/enable_accordion','1');
$installer->setConfigData('prodfaqs/product_page/enable_rating','1');
$installer->setConfigData('prodfaqs/product_page/show_faqs_on','under_product');
$installer->setConfigData('prodfaqs/product_page/sort_by','helpful');
$installer->setConfigData('prodfaqs/product_page/like','1');
$installer->setConfigData('prodfaqs/product_page/reply','1');
$installer->setConfigData('prodfaqs/product_page/admin_approval','1');
$installer->setConfigData('prodfaqs/product_page/allow_customers','all');

$installer->setConfigData('prodfaqs/product_ask/enable','1');
$installer->setConfigData('prodfaqs/product_ask/open_form','slide');

$installer->setConfigData('prodfaqs/rating/enable','1');
$installer->setConfigData('prodfaqs/rating/allow_customers','all');

$installer->setConfigData('prodfaqs/general/faq_block','1');
$installer->setConfigData('prodfaqs/general/faq_search_block','1');
$installer->setConfigData('prodfaqs/general/faq_maxtopic','5');

$installer->setConfigData('prodfaqs/themes/select_theme','theme5');

$installer->setConfigData('prodfaqs/email_settings/email_sender','general');
$installer->setConfigData('prodfaqs/email_settings/enable_moderator_notification','1');
$installer->setConfigData('prodfaqs/email_settings/moderator_email','support@fmeextensions.com');
$installer->setConfigData('prodfaqs/email_settings/moderator_email_subject','New Question Posted');
$installer->setConfigData('prodfaqs/email_settings/moderator_email_template','prodfaqs_email_settings_moderator_email_template');
$installer->setConfigData('prodfaqs/email_settings/enable_client_notification','1');
$installer->setConfigData('prodfaqs/email_settings/client_email_subject','Your Question Posted');
$installer->setConfigData('prodfaqs/email_settings/client_email_template','prodfaqs_email_settings_client_email_template');

$installer->setConfigData('prodfaqs/seo/url_suffix','.html');

$installer->endSetup(); 