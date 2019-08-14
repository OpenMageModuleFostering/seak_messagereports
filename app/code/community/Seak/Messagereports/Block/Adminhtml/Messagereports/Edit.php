<?php

/**
 * Seak Ecommerce Group :: Magento Extension Development
 *
 * NOTICE OF LICENSE
 * This source file is subject to the Open Software License (OSL 3.0)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
 
class Seak_Messagereports_Block_Adminhtml_Messagereports_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
		$this->_controller = 'adminhtml_messagereports';
        $this->_blockGroup = 'messagereports';
        
        
        $this->_updateButton('save', 'label', Mage::helper('messagereports')->__('Save Item'));


        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('messagereports_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'messagereports_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'messagereports_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('messagereports_data') && Mage::registry('messagereports_data')->getId() ) {
            return Mage::helper('messagereports')->__("Edit Item");
        } else {
            return Mage::helper('messagereports')->__('Add Item');
        }
    }
}