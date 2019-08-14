<?php

/**
 * Seak Ecommerce Group :: Magento Extension Development
 *
 * NOTICE OF LICENSE
 * This source file is subject to the Open Software License (OSL 3.0)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Seak_Messagereports_Helper_Data extends Mage_Core_Helper_Abstract
{

     public function getCount()
	{
	
    $messagereports = Mage::getModel('messagereports/messagereports')->getCollection();
    return count($messagereports);
        
    }


}