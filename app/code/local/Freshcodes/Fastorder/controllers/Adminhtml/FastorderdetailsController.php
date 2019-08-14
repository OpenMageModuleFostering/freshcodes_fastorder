<?php
/**
 * Freshcodes
 *
 * It is also available through the world-wide-web at this URL:
 * http://freshcodes.in
 *
 * ==============================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * ==============================================================
 * This package designed for Magento COMMUNITY edition
 * Freshcodes does not guarantee correct work of this extension
 * on any other Magento edition except Magento COMMUNITY edition.
 * Freshcodes does not provide extension support in case of
 * incorrect edition usage.
 * ==============================================================
 *
 * @category    Freshcodes
 * @package     Freshcodes_Fastorder
 * @version     0.1.0
 * @author      Freshcodes Team <developers@freshcodes.in>
 *
 */
class Freshcodes_Fastorder_Adminhtml_FastorderdetailsController extends Mage_Adminhtml_Controller_Action
{
		protected function _initAction()
		{
				$this->loadLayout()->_setActiveMenu("fastorder/fastorderdetails")->_addBreadcrumb(Mage::helper("adminhtml")->__("Fastorderdetails  Manager"),Mage::helper("adminhtml")->__("Fastorderdetails Manager"));
				return $this;
		}
		public function indexAction() 
		{
			    $this->_title($this->__("Fastorder"));
			    $this->_title($this->__("Manager Fastorderdetails"));

				$this->_initAction();
				$this->renderLayout();
		}
		public function editAction()
		{			    
			    $this->_title($this->__("Fastorder"));
				$this->_title($this->__("Fastorderdetails"));
			    $this->_title($this->__("Edit Fastorder"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("fastorder/fastorderdetails")->load($id);
				if ($model->getId()) {
					Mage::register("fastorderdetails_data", $model);
					$this->loadLayout();
					$this->_setActiveMenu("fastorder/fastorderdetails");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Fastorderdetails Manager"), Mage::helper("adminhtml")->__("Fastorderdetails Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Fastorderdetails Description"), Mage::helper("adminhtml")->__("Fastorderdetails Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("fastorder/adminhtml_fastorderdetails_edit"))->_addLeft($this->getLayout()->createBlock("fastorder/adminhtml_fastorderdetails_edit_tabs"));
					$this->renderLayout();
				} 
				else {
					Mage::getSingleton("adminhtml/session")->addError(Mage::helper("fastorder")->__("Item does not exist."));
					$this->_redirect("*/*/");
				}
		}

		public function newAction()
		{

		$this->_title($this->__("Fastorder"));
		$this->_title($this->__("Fastorderdetails"));
		$this->_title($this->__("New Item"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("fastorder/fastorderdetails")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("fastorderdetails_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("fastorder/fastorderdetails");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Fastorderdetails Manager"), Mage::helper("adminhtml")->__("Fastorderdetails Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Fastorderdetails Description"), Mage::helper("adminhtml")->__("Fastorderdetails Description"));


		$this->_addContent($this->getLayout()->createBlock("fastorder/adminhtml_fastorderdetails_edit"))->_addLeft($this->getLayout()->createBlock("fastorder/adminhtml_fastorderdetails_edit_tabs"));

		$this->renderLayout();

		}
		public function saveAction()
		{

			$post_data=$this->getRequest()->getPost();


				if ($post_data) {

					try {

						

						$model = Mage::getModel("fastorder/fastorderdetails")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->save();

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Fastorderdetails was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setFastorderdetailsData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setFastorderdetailsData($this->getRequest()->getPost());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					return;
					}

				}
				$this->_redirect("*/*/");
		}



		public function deleteAction()
		{
				if( $this->getRequest()->getParam("id") > 0 ) {
					try {
						$model = Mage::getModel("fastorder/fastorderdetails");
						$model->setId($this->getRequest()->getParam("id"))->delete();
						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
						$this->_redirect("*/*/");
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					}
				}
				$this->_redirect("*/*/");
		}

		
		public function massRemoveAction()
		{
			try {
				$ids = $this->getRequest()->getPost('fastorder_ids', array());
				foreach ($ids as $id) {
                      $model = Mage::getModel("fastorder/fastorderdetails");
					  $model->setId($id)->delete();
				}
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
			}
			$this->_redirect('*/*/');
		}
			
		/**
		 * Export order grid to CSV format
		 */
		public function exportCsvAction()
		{
			$fileName   = 'fastorderdetails.csv';
			$grid       = $this->getLayout()->createBlock('fastorder/adminhtml_fastorderdetails_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
		} 
		/**
		 *  Export order grid to Excel XML format
		 */
		public function exportExcelAction()
		{
			$fileName   = 'fastorderdetails.xml';
			$grid       = $this->getLayout()->createBlock('fastorder/adminhtml_fastorderdetails_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
		}
}
