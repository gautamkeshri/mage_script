<?php
require_once('../app/Mage.php');
ini_set("display_errors", 1);
set_time_limit(0);
umask(0);
Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

Class InfoBase
{
	public function read($length='255') 
	{ 
	   if (!isset ($GLOBALS['StdinPointer'])) 
	   { 
	      $GLOBALS['StdinPointer'] = fopen ("php://stdin","r"); 
	   } 
	   $line = fgets ($GLOBALS['StdinPointer'],$length); 
	   return trim ($line); 
	}
}

Class Getstoreinfo extends InfoBase
{
	public function getBasedir() { // 1
		return Mage::getBaseDir();
	}

	public function getBaseUrl(){ // 2
		return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
	}

	public function configStockcheck(){ // 3
		return Mage::helper('cataloginventory')->isShowOutOfStock();
	}

	public function getProdcollection()	{ // 4
		$products = 
		array(
			"Simple" => count(Mage::getResourceModel('catalog/product_collection')
                ->addAttributeToFilter('type_id', array('eq' => 'simple'))),
			"Configurable" => count(Mage::getResourceModel('catalog/product_collection')
                ->addAttributeToFilter('type_id', array('eq' => 'configurable'))),
			"Bundle" => count(Mage::getResourceModel('catalog/product_collection')
                ->addAttributeToFilter('type_id', array('eq' => 'bundle'))),
			"Grouped" => count(Mage::getResourceModel('catalog/product_collection')
                ->addAttributeToFilter('type_id', array('eq' => 'grouped'))),
			"Virtual" => count(Mage::getResourceModel('catalog/product_collection')
                ->addAttributeToFilter('type_id', array('eq' => 'virtual')))
			);
		return json_encode($products);
	}

	public function showoutofstock_option(){ // 5
		return Mage::helper('cataloginventory')->isShowOutOfStock() ? "Yes" : "No";
	}
	
}

$obj = new Getstoreinfo();
$class_methods = get_class_methods($obj);
$i=0;
foreach ($class_methods as $method_name) {
    echo ++$i." $method_name\n";
}

echo "Enter your choise number: "; 
$operation = $obj->read(); 

switch($operation)
{
	case 1: 
		echo $class_methods[0]."\n";
		echo $obj->{$class_methods[0]}();
		break;
	case 2:
		echo $class_methods[1]."\n";
		echo $obj->{$class_methods[1]}();
		break;
	case 3:
		echo $class_methods[2]."\n";
		echo $obj->{$class_methods[2]}();
		break;
	case 4:
		echo $class_methods[3]."\n";
		echo $obj->{$class_methods[3]}();
		break;
	case 5:
		echo $class_methods[4]."\n";
		echo $obj->{$class_methods[4]}();
		break;
	case 6:
		echo $class_methods[5]."\n";
		echo $obj->{$class_methods[5]}();
		break;
	case 7:
		echo $class_methods[6]."\n";
		echo $obj->{$class_methods[6]}();
		break;					
	default:
		echo "sorry";
		break;		
}
echo "\n";


?>