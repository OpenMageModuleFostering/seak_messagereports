<?php

/**
 * Seak Ecommerce Group :: Magento Extension Development
 *
 * NOTICE OF LICENSE
 * This source file is subject to the Open Software License (OSL 3.0)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Seak_Messagereports_Block_Adminhtml_Messagereports_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
	  parent::__construct();
	  $this->setId('messagereportsGrid');
	  $this->setUseAjax(true);
	  $this->setDefaultSort('id');
	  $this->setDefaultDir('DESC');
	  $this->setSaveParametersInSession(true);
	}

	protected function _prepareCollection()
	{
	  $collection = Mage::getModel('messagereports/messagereports')->getCollection();
	  $this->setCollection($collection);
	  return parent::_prepareCollection();
	}

	protected function _prepareColumns()
	{

	  
	  $this->addColumn('id', array(
		  'header'    => Mage::helper('messagereports')->__('ID'),
		  'align'     =>'right',
		  'width'     => '50px',
		  'index'     => 'id',
	  ));
	    
	   $this->addColumn('message_type', array(
		  'header'    => Mage::helper('messagereports')->__('Message Type'),
		  'align'     =>'left',
		  'width'     => '100px',
		  'index'     => 'message_type',
		  'renderer'  => 'Seak_Messagereports_Block_Adminhtml_Renderer_Type',
	  ));
	  
	  $this->addColumn('message_content', array(
		  'header'    => Mage::helper('messagereports')->__('Message Content'),
		  'align'     =>'left',
		  'index'     => 'message_content',
	  ));
	  
	  $this->addColumn('message_url', array(
		  'header'    => Mage::helper('messagereports')->__('Message URL'),
		  'align'     =>'left',
		  'index'     => 'message_url',
	  ));
	 
	  $this->addColumn('message_action', array(
		  'header'    => Mage::helper('messagereports')->__('Message Action'),
		  'align'     =>'left',
		  'index'     => 'message_action',
	  ));
	  
	  $this->addColumn('customer_id', array(
		  'header'    => Mage::helper('messagereports')->__('Customer'),
		  'align'     =>'left',
		  'index'     => 'customer_id',
		  'renderer'  => 'Seak_Messagereports_Block_Adminhtml_Renderer_Customer',
	  ));
	   

	  $this->addColumn('created_time', array(
		  'header'    => Mage::helper('messagereports')->__('Created Time'),
		  'align'     =>'left',
		  'index'     => 'created_time',
	  ));

	  

	  $this->addColumn('action',
			array(
				'header'    =>  Mage::helper('messagereports')->__('Review Item'),
				'width'     => '100',
				'type'      => 'action',
				'getter'    => 'getId',
				'actions'   => array(
					array(
						'caption'   => Mage::helper('messagereports')->__('Review'),
						'url'       => array('base'=> '*/*/edit'),
						'field'     => 'id'
					),

				),
				'filter'    => false,
				'sortable'  => false,
				'index'     => 'stores',
				'is_system' => true,
		));
		
	  

		
		$this->addExportType('*/*/exportCsv', Mage::helper('messagereports')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('messagereports')->__('XML'));
	  
	  return parent::_prepareColumns();
	}

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('messagereports');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('messagereports')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('messagereports')->__('Are you sure?')
        ));
		
		
        return $this;
    }
	

	public function getRowUrl($row)
	{
	  return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}
	public function getGridUrl()
  {
      return $this->getUrl('*/*/grid', array('_current'=>true));
  }

}