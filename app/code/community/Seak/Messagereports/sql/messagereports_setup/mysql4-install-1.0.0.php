<?php

/**
 * Seak Ecommerce Group :: Magento Extension Development
 *
 * NOTICE OF LICENSE
 * This source file is subject to the Open Software License (OSL 3.0)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

$installer = $this;
//$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();
 
$installer->run("
				
DROP TABLE IF EXISTS {$this->getTable('messagereports')};
CREATE TABLE {$this->getTable('messagereports')} ( 
   `id` smallint(6) NOT NULL AUTO_INCREMENT,
   `message_content` text default NULL,
   `message_type` varchar(255) default NULL,
   `message_url` varchar(255) default NULL,
   `message_action` varchar(255) default NULL,
   `message_website` varchar(255) default NULL,
   `message_store` varchar(255) default NULL,
   `customer_id` text default NULL,
   `admin_notes` text default NULL,                        
   `created_time` datetime default NULL,                   
   `update_time` datetime default NULL,
                      
   PRIMARY KEY  (`id`)                             
 ) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

 DROP TABLE IF EXISTS {$this->getTable('messagereports_store')};
CREATE TABLE {$this->getTable('messagereports_store')} (                                
 `id` int(11) NOT NULL,                               
 `store_id` smallint(5) unsigned NOT NULL,                    
 PRIMARY KEY  (`id`,`store_id`),                      
 KEY `FK_MESSAGEREPORTS_STORE_STORE` (`store_id`)                    
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Seak Message Reports Store View';
");
 
$installer->endSetup();