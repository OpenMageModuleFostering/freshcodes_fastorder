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
class Freshcodes_Fastorder_IndexController extends Mage_Core_Controller_Front_Action{
    public function IndexAction() {
      
	  $this->loadLayout();   
	  $this->getLayout()->getBlock("head")->setTitle($this->__("Fastorder"));
	        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
      $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home Page"),
                "title" => $this->__("Home Page"),
                "link"  => Mage::getBaseUrl()
		   ));

      $breadcrumbs->addCrumb("fastorder", array(
                "label" => $this->__("Fastorder"),
                "title" => $this->__("Fastorder")
		   ));
	   $this->_initLayoutMessages('core/session');
      $this->renderLayout(); 
	  
    }
	public function postAction() {
		
		$cart = Mage::helper('checkout/cart')->getCart()->getQuote()->getAllItems();
		$helper = Mage::helper('fastorder');
		if(!$helper->login())
		{
				Mage::getSingleton('core/session')->addError('Fastorder not enable for guest account!');
				$this->_redirect("checkout/cart");
				return;
		}
		//$status = $helper->status();
		$post = $this->getRequest()->getPost();
		$model = Mage::getModel("fastorder/fastorderdetails");
		$curent_date = date("Y-m-d H:i:s", Mage::getModel('core/date')->timestamp(time()));
		$post['created_date'] = $curent_date;
		$post['status'] = $helper->status();
		$model->setData($post);
		try {
				$model->save();
				$fastorderId = $model->getId();
				
				foreach($cart as $item) {
						if ($item->getParentItemId()) {
							continue;
						}
				        /*$productName = $item->getProduct()->getName();
						$productSku = $item->getProduct()->getSku();
						$productPrice = $item->getPrice();
						$productDis = $item->getDiscountAmount();
						$productQty = $item->getQty();*/

						$modelProduct = Mage::getModel("fastorder/fastorderproduct");
						$modelProduct->setFastorderId($fastorderId);
						$modelProduct->setProductSku($item->getProduct()->getSku());
						$modelProduct->setProductName($item->getProduct()->getName());
						$modelProduct->setQty($item->getQty());
						$modelProduct->setProductPrice($item->getPrice());
						$modelProduct->setProductDiscount($item->getDiscountAmount());
						$modelProduct->save();
						$fastorderproductId = $modelProduct->getId();
						$modelproductoption = Mage::getModel("fastorder/fastorderproductoption");
						/* get custom option value */
						$_customOptions = $item->getProduct()->getTypeInstance(true)->getOrderOptions($item->getProduct());
						$productData = array();
						foreach($_customOptions['options'] as $_option)
						{
							$modelproductoption->setProductdetailsId($fastorderproductId);
							$modelproductoption->setLabel($_option['label']);
							$modelproductoption->setValue($_option['value']);
							$modelproductoption->save();
							$modelproductoption->unsetData();
						}
						
			}
			/* send mail */
						$emailTemplate = Mage::getModel('core/email_template')->loadDefault('fastorder_email_template');

						//Getting the Store E-Mail Sender Name.
						$senderName = Mage::getStoreConfig('trans_email/ident_general/name');

						//Getting the Store General E-Mail.
						$senderEmail = Mage::getStoreConfig('trans_email/ident_general/email');

						//Variables for Confirmation Mail.
						$emailTemplateVariables = array();
						
						$emailTemplateVariables['name'] = $post['name'];
						
						//Appending the Custom Variables to Template.
						$processedTemplate = $emailTemplate->getProcessedTemplate($emailTemplateVariables);

						//Sending E-Mail to Customers.
						$mail = Mage::getModel('core/email')
						 ->setToName($post['name'])
						 ->setToEmail($post['email'])
						 ->setBody($processedTemplate)
						 ->setSubject('Fastorder Request # '.$fastorderId)
						 ->setFromEmail($senderEmail)
						 ->setFromName($senderName)
						 ->setType('html');
						 try{
						 
							//Confimation E-Mail Send
							$mail->send();
								
						 }
						 catch(Exception $error)
						 {
							 Mage::getSingleton('core/session')->addError('Enable to send mail!');
							 $this->_redirect("checkout/cart");
							 return;
						 }
						 
						/* send mail over */
				Mage::getSingleton('core/session')->addSuccess($helper->success());
				if($helper->clearCart()): 
					Mage::getSingleton('checkout/session')->clear();
				endif;
				//Mage::getSingleton('checkout/cart')->truncate();
				//Mage::getSingleton('checkout/session')->clear();
				$this->_redirect("checkout/cart");
			} 
			catch (Exception $e) {
				//$FailuredMessage = Mage::getStoreConfig('fastorder/general/failured');
				Mage::getSingleton('core/session')->addError($helper->failured());
				$this->_redirect("checkout/cart");
			}
	}
}