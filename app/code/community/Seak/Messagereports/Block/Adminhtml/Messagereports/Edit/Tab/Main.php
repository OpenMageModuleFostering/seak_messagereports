<?php

/**
 * Seak Ecommerce Group :: Magento Extension Development
 *
 * NOTICE OF LICENSE
 * This source file is subject to the Open Software License (OSL 3.0)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
 
class Seak_Messagereports_Block_Adminhtml_Messagereports_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form
{

        protected function _prepareForm()
        {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('messagereports_form', array('legend'=>Mage::helper('messagereports')->__('General Settings')));
     
        $object = Mage::getModel('messagereports/messagereports')->load( $this->getRequest()->getParam('id'));

	    //Message Type
	    if($object->getMessageType() == 'error') {
	    $result = '<span class="grid-severity-critical"><span>Error Message</span></span>';
	    }elseif($object->getMessageType()== 'success'){
	    $result = '<span class="grid-severity-notice"><span>Success Message</span></span>';
	    }elseif($object->getMessageType()== 'warning'){
	    $result = '<span class="grid-severity-major"><span>Warning Message</span></span>';	
	    }elseif($object->getMessageType()== 'notice'){
	    $result = '<span class="grid-severity-minor"><span>Notice Message</span></span>';	
	    }
	    
        $fieldset->addField('message_type', 'note', array(
            'label'     => Mage::helper('messagereports')->__('Message Type'),
			'text'      => $result,
        ));
	    
	    //Message Content
		$fieldset->addField('message_content', 'textarea', array(
            'label'     => Mage::helper('messagereports')->__('Message Content'),
            'name'      => 'message_content',
            'disabled' => true,
            'readonly' => true,
        ));
        
        $fieldset->addField('message_url', 'link', array(
            'label'     => Mage::helper('messagereports')->__('Message URL'),
            'required'  => false,
            'href'      => ''.$object->getMessageUrl().'',
            'disabled' => true,
            'readonly' => true,
        ));
        
        $fieldset->addField('message_action', 'note', array(
            'label'     => Mage::helper('messagereports')->__('Message Action'),
            'required'  => false,
            'text'      => ''.$object->getMessageAction().'',
            'disabled' => true,
            'readonly' => true,
        ));
        
       $fieldset->addField('message_website', 'note', array(
            'label'     => Mage::helper('messagereports')->__('Message Website'),
            'required'  => false,
            'text'      => ''.$object->getMessageWebsite().'',
            'disabled' => true,
            'readonly' => true,
        ));
        
        $fieldset->addField('message_store', 'note', array(
            'label'     => Mage::helper('messagereports')->__('Message Store'),
            'required'  => false,
            'text'      => ''.$object->getMessageStore().'',
            'disabled' => true,
            'readonly' => true,
        ));
        
        if($object->getCustomerId() == 'Guest'){
	    $CustomerValue = 'Guest';	
	    }else{
	    $customer_data = Mage::getModel('customer/customer')->load($object->getCustomerId());
	    $CustomerValue = ''.$customer_data->getName().'';
	    }
        //Customer ID
        $fieldset->addField('customer_id', 'note', array(
            'label'     => Mage::helper('messagereports')->__('Customer'),
            'text'      => ''.$CustomerValue.'',
            'disabled' => true,
            'readonly' => true,
        ));
        
        
        //Admin Notes
		$fieldset->addField('admin_notes', 'textarea', array(
            'label'     => Mage::helper('messagereports')->__('Admin Notes'),
            'name'      => 'admin_notes',
            'note'      => Mage::helper('messagereports')->__('Admin Notes')
        ));
        
	
		$fieldset->addField('created_time', 'label', array(
            'label'     => Mage::helper('messagereports')->__('Created/Updated Time'),
            'required'  => false,
            'name'      => 'created_time',
        ));
        
        
		
        if ( Mage::getSingleton('adminhtml/session')->getMessagereportsData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getMessagereportsData());
            Mage::getSingleton('adminhtml/session')->setMessagereportsData(null);
        } elseif ( Mage::registry('messagereports_data') ) {
            $form->setValues(Mage::registry('messagereports_data')->getData());
        }
        
        return parent::_prepareForm();
        
        }

}