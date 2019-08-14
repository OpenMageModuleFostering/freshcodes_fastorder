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
class Freshcodes_Fastorder_Block_Adminhtml_Fastorderdetails_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "fastorder_id";
				$this->_blockGroup = "fastorder";
				$this->_controller = "adminhtml_fastorderdetails";
				$this->_updateButton("save", "label", Mage::helper("fastorder")->__("Save Fastorder"));
				$this->_updateButton("delete", "label", Mage::helper("fastorder")->__("Delete Fastorder"));

				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("fastorder")->__("Save And Continue Edit"),
					"onclick"   => "saveAndContinueEdit()",
					"class"     => "save",
				), -100);



				$this->_formScripts[] = "

							function saveAndContinueEdit(){
								editForm.submit($('edit_form').action+'back/edit/');
							}
						";
		}

		public function getHeaderText()
		{
				if( Mage::registry("fastorderdetails_data") && Mage::registry("fastorderdetails_data")->getId() ){

				    return Mage::helper("fastorder")->__("Edit Fastorder '%s'", $this->htmlEscape(Mage::registry("fastorderdetails_data")->getId()));

				} 
				else{

				     return Mage::helper("fastorder")->__("Add Item");

				}
		}
}