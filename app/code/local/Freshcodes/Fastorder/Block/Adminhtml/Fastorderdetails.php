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
class Freshcodes_Fastorder_Block_Adminhtml_Fastorderdetails extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_fastorderdetails";
	$this->_blockGroup = "fastorder";
	$this->_headerText = Mage::helper("fastorder")->__("Fastorder Manager");
	//$this->_addButtonLabel = Mage::helper("fastorder")->__("Add New Item");
	parent::__construct();
	$this->_removeButton('add');
	
	}

}