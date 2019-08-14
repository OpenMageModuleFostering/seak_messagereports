<?php

/**
 * Seak Ecommerce Group :: Magento Extension Development
 *
 * NOTICE OF LICENSE
 * This source file is subject to the Open Software License (OSL 3.0)
 * @license     
 * http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
 
class Seak_Messagereports_Block_Extensiondescription extends Mage_Adminhtml_Block_Abstract implements Varien_Data_Form_Element_Renderer_Interface
{
	protected $_template = 'seak/extensions/messagereports/extensiondescription.phtml';
	
	protected function _prepareLayout()
	{
		$headBlock = $this->getLayout()->getBlock('head');
		$headBlock->addCss('seak/css/messagereports/messagereports.css');
	}
	
	public function render(Varien_Data_Form_Element_Abstract $element)
	{
		return $this->toHtml();	
	}

}