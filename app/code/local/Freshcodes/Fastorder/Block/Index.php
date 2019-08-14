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
class Freshcodes_Fastorder_Block_Index extends Mage_Core_Block_Template{   
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
	public function getActive()     
     { 
        $totalItemsInCart = Mage::helper('checkout/cart')->getItemsCount();
        if(Mage::getStoreConfig('fastorder/general/active') && $totalItemsInCart > 0)
		{
			return true;
		}
     }
	 
	public function getCheckCart()     
     { 
		
     }
	 public function getCustomerName()
	 {
		if (Mage::getSingleton('customer/session')->isLoggedIn()) 
		{
			$customer = Mage::getSingleton('customer/session')->getCustomer();
			return $customer->getName();
		}
	 }
	 public function getCustomerEmail()
	 {
		if (Mage::getSingleton('customer/session')->isLoggedIn()) 
		{
			$customer = Mage::getSingleton('customer/session')->getCustomer();
			return $customer->getEmail();
		}
	 }
	 public function getCustomerPhone()
	 {
		if (Mage::getSingleton('customer/session')->isLoggedIn()) 
		{
			$customer = Mage::getSingleton('customer/session')->getCustomer();
			return $customer->getPrimaryBillingAddress()->getTelephone();
		}
	 }
     public function getTitle()     
     { 
		if(Mage::getStoreConfig('fastorder/general/block_title'))
		{
			return Mage::getStoreConfig('fastorder/general/block_title');
		}
		else
		{
			return "FastOrder";
		}
     }
	 public function getSuccess()     
     { 
        return Mage::getStoreConfig('fastorder/general/success_messgae');
     }
	 public function getFailured()     
     { 
        return Mage::getStoreConfig('fastorder/general/failure_messgae');
     }
	 public function enablePhone()     
     { 
        return Mage::getStoreConfig('fastorder/general/phone');
     }
	 public function enableName()     
     { 
        return Mage::getStoreConfig('fastorder/general/name');
     }
	 public function enableComment()     
     { 
        return Mage::getStoreConfig('fastorder/general/comment');
     }





}