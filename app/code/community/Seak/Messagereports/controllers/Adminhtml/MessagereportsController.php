<?php

/**
 * Seak Ecommerce Group :: Magento Extension Development
 *
 * NOTICE OF LICENSE
 * This source file is subject to the Open Software License (OSL 3.0)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
 
class Seak_Messagereports_Adminhtml_MessagereportsController extends Mage_Adminhtml_Controller_action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('seak/messagereports')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Manage Message Reports'), Mage::helper('adminhtml')->__('Manage Message Reports'));
		
		return $this;
	}   
 
	public function indexAction() {
		
		$this->loadLayout();	
		$block = $this->getLayout()->createBlock('Mage_Core_Block_Template','messagereports.info', array('template' => 'seak/extensions/messagereports/info.phtml'));
        $this->getLayout()->getBlock('content')->append($block);
		$this->renderLayout();
	}



	public function editAction() {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('messagereports/messagereports')->load($id);

		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('messagereports_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('seak/messagereports');

		
			$this->_addContent($this->getLayout()->createBlock('messagereports/adminhtml_messagereports_edit'))
				->_addLeft($this->getLayout()->createBlock('messagereports/adminhtml_messagereports_edit_tabs'));
				
			$block = $this->getLayout()->createBlock('Mage_Core_Block_Template','messagereports.info',array('template' => 'seak/extensions/messagereports/info.phtml'));
            $this->getLayout()->getBlock('content')->append($block);
			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('messagereports')->__('Item does not exist'));
			$this->_redirect('*/*/');
		}
	}
 
	public function newAction() {
		$this->_forward('edit');
	}

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody($this->getLayout()->createBlock('messagereports/adminhtml_messagereports_grid')->toHtml());
		//$this->renderLayout();
    }
	


    public function saveAction() {
        $model = Mage::getModel('messagereports/messagereports');
        if ($data = $this->getRequest()->getPost()) {


            $model = Mage::getModel('messagereports/messagereports');
			
            $model->setData($data)
                ->setId($this->getRequest()->getParam('id'));

                try {
                if ($model->getCreatedTime() == NULL || $model->getUpdateTime() == NULL) {
                    $model->setCreatedTime(now())->setUpdateTime(now());
                } else {
                    $model->setUpdateTime(now());
                }
				
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('messagereports')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('messagereports')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }
 
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('messagereports/messagereports');
				 
				$model->setId($this->getRequest()->getParam('id'))
					->delete();
					 
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}
	
	
    public function massDeleteAction() {
        $messagereportsIds = $this->getRequest()->getParam('messagereports');
        if(!is_array($messagereportsIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($messagereportsIds as $messagereportId) {
                    $messagereports = Mage::getModel('messagereports/messagereports')->load($messagereportId);
                    $messagereports->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($messagereports)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
	

    public function exportCsvAction()
    {
        $fileName   = 'seak/extensions/messagereports/messagereports.csv';
        $content    = $this->getLayout()->createBlock('messagereports/adminhtml_messagereports_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'seak/extensions/messagereports/messagereports.xml';
        $content    = $this->getLayout()->createBlock('messagereports/adminhtml_messagereports_grid')
            ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK','');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }
	

}