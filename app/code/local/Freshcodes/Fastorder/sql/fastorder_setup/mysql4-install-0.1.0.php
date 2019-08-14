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
$installer = $this;

$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS {$this->getTable('fastorderdetails')};
CREATE TABLE {$this->getTable('fastorderdetails')} (
  `fastorder_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created_date` datetime NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `comment` text NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`fastorder_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS {$this->getTable('fastorderproduct')};
CREATE TABLE {$this->getTable('fastorderproduct')} (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fastorder_id` int(11) NOT NULL,
  `product_sku` text NOT NULL,
  `product_name` text NOT NULL,
  `qty` int(5) NOT NULL,
  `product_price` text NOT NULL,
  `product_discount` decimal(11,2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS {$this->getTable('fastorderproductoption')};
CREATE TABLE {$this->getTable('fastorderproductoption')} (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `productdetails_id` int(11) NOT NULL,
  `label` text NOT NULL,
  `value` text NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

");

$installer->endSetup(); 


	 