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
class Freshcodes_Fastorder_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function login()
	{
		if(!Mage::getStoreConfig('fastorder/general/guestcust'))
		{
			if(Mage::getSingleton('customer/session')->isLoggedIn()) 
			{
				return true;
			}
		}
		else
		{
			return true;
		}
	}
	
	public function status()
	{
		if(Mage::getStoreConfig('fastorder/general/status'))
		{
			return Mage::getStoreConfig('fastorder/general/status');
		}
		else
		{
			return 'pending';
		}
	}
	public function success()
	{
				if(Mage::getStoreConfig('fastorder/general/success'))
				{
					return Mage::getStoreConfig('fastorder/general/success');
				}
				else
				{
					return 'Your order successfully submited!';
				}
	}
	public function failured()
	{
				if(Mage::getStoreConfig('fastorder/general/failured'))
				{
					return Mage::getStoreConfig('fastorder/general/failured');
				}
				else
				{
					return 'Sorry! Your order not submited!';
				}
	}
	public function clearCart()
	{
				if(Mage::getStoreConfig('fastorder/general/cartempty'))
				{
					return true;
				}
	}
}
	 