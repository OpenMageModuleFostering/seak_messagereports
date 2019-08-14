<?php

/**
 * Seak Ecommerce Group :: Magento Extension Development
 *
 * NOTICE OF LICENSE
 * This source file is subject to the Open Software License (OSL 3.0)
 * @license     
 * http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
 
 class Seak_Messagereports_Block_Adminhtml_Renderer_Customer extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract 
 {
  
    public function render(Varien_Object $customer_row) {
    if($customer_row->getCustomerId() == NULL){
	return 'Guest';	
	}else{
	$customer_data = Mage::getModel('customer/customer')->load($customer_row->getCustomerId());
	return ''.$customer_data->getName().'';	
	}
		
  }
  
}