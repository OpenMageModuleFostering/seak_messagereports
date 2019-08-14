<?php

/**
 * Seak Ecommerce Group :: Magento Extension Development
 *
 * NOTICE OF LICENSE
 * This source file is subject to the Open Software License (OSL 3.0)
 * @license     
 * http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
 
 class Seak_Messagereports_Block_Adminhtml_Renderer_Type extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract 
 {
  
    public function render(Varien_Object $row) {
    

    if($row->getMessageType() == 'error') {
	
	return '<span class="grid-severity-critical"><span>Error Message</span></span>';
		
	}elseif($row->getMessageType()== 'success'){
	
	return '<span class="grid-severity-notice"><span>Success Message</span></span>';
	
	}elseif($row->getMessageType()== 'warning'){
	
	return '<span class="grid-severity-major"><span>Warning Message</span></span>';	

	}elseif($row->getMessageType()== 'notice'){
	
	return '<span class="grid-severity-minor"><span>Notice Message</span></span>';	
	}
  
  }
  
}