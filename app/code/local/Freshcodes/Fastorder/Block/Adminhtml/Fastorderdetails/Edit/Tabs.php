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
class Freshcodes_Fastorder_Block_Adminhtml_Fastorderdetails_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("fastorderdetails_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("fastorder")->__("Fastorder Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("fastorder")->__("Fastorder Information"),
				"title" => Mage::helper("fastorder")->__("Fastorder Information"),
				"content" => $this->getLayout()->createBlock("fastorder/adminhtml_fastorderdetails_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
