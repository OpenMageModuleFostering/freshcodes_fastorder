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
class Freshcodes_Fastorder_Block_Adminhtml_Fastorderdetails_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("fastorderdetailsGrid");
				$this->setDefaultSort("fastorder_id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("fastorder/fastorderdetails")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("fastorder_id", array(
				"header" => Mage::helper("fastorder")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "fastorder_id",
				));
                
					$this->addColumn('created_date', array(
						'header'    => Mage::helper('fastorder')->__('Created At'),
						'index'     => 'created_date',
						'type'      => 'datetime',
					));
				$this->addColumn("name", array(
				"header" => Mage::helper("fastorder")->__("Name"),
				"index" => "name",
				));
				$this->addColumn("email", array(
				"header" => Mage::helper("fastorder")->__("Email"),
				"index" => "email",
				));
				$this->addColumn("phone", array(
				"header" => Mage::helper("fastorder")->__("Phone"),
				"index" => "phone",
				));
						$this->addColumn('status', array(
						'header' => Mage::helper('fastorder')->__('Status'),
						'index' => 'status',
						'type' => 'options',
						'options'=>Freshcodes_Fastorder_Block_Adminhtml_Fastorderdetails_Grid::getOptionArray5(),				
						));
						
			$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
			$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

				return parent::_prepareColumns();
		}

		public function getRowUrl($row)
		{
			   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
		}


		
		protected function _prepareMassaction()
		{
			$this->setMassactionIdField('fastorder_id');
			$this->getMassactionBlock()->setFormFieldName('fastorder_ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_fastorderdetails', array(
					 'label'=> Mage::helper('fastorder')->__('Remove Fastorderdetails'),
					 'url'  => $this->getUrl('*/adminhtml_fastorderdetails/massRemove'),
					 'confirm' => Mage::helper('fastorder')->__('Are you sure?')
				));
			return $this;
		}
			
		static public function getOptionArray5()
		{
            $data_array=array(); 
			$data_array['pending']='pending';
			$data_array['processing']='processing';
			$data_array['complete']='complete';
			$data_array['closed']='closed';
			$data_array['canceled']='canceled';
			$data_array['holded']='holded';
            return($data_array);
		}
		static public function getValueArray5()
		{
            $data_array=array();
			foreach(Freshcodes_Fastorder_Block_Adminhtml_Fastorderdetails_Grid::getOptionArray5() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		

}