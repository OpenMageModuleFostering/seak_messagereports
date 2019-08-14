<?php

/**
 * Seak Ecommerce Group :: Magento Extension Development
 *
 * NOTICE OF LICENSE
 * This source file is subject to the Open Software License (OSL 3.0)
 * @license     
 * http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
 
class Seak_Messagereports_Block_Adminhtml_Messagereports extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_messagereports';
    $this->_blockGroup = 'messagereports';
    $this->_headerText = Mage::helper('messagereports')->__('View Report Item');
    //$this->_addButtonLabel = Mage::helper('messagereports')->__('Add New Report Item');
    parent::__construct();
    
    $this->_removeButton('add');
  }
}