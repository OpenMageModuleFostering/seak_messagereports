<?php

/**
 * Seak Ecommerce Group :: Magento Extension Development
 *
 * NOTICE OF LICENSE
 * This source file is subject to the Open Software License (OSL 3.0)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
 
class Seak_Messagereports_Block_Adminhtml_Messagereports_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('messagereports_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('messagereports')->__(''));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('messagereports')->__('General Settings'),
          'title'     => Mage::helper('messagereports')->__('General Settings'),
          'content'   => $this->getLayout()->createBlock('messagereports/adminhtml_messagereports_edit_tab_main')->toHtml(),
      ));
      
	  
      return parent::_beforeToHtml();
  }
}