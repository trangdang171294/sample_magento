<?php
/*
 * Featured product Extension Developed by Magehit
 */
?>
<?php

class Trang_Ajaxproduct_Block_Ajaxproduct extends Mage_Catalog_Block_Product_Abstract {

    public function getallproduct()
    {
        $visibility = array(
            Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
            Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG
        );
        $collection = Mage::getModel('catalog/product');
        $all_products = $collection->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('visibility', $visibility)
            ->addAttributeToSelect('status',1);
        return $all_products;
    }

    public function atotalProduct() {

        $id = isset($_GET['id']) ? $_GET['id'] : 1;
        $visibility = array(
            Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
            Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG
        );

        $_productCollection = Mage::getResourceModel('reports/product_collection')
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('visibility', $visibility)
            ->addAttributeToSelect('status',1)
            ->setPageSize(5)
            ->setCurPage($id)
        ;

        return $_productCollection;
    }

    public function totalproduct()
    {
        $visibility = array(
            Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
            Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG
        );
        $collection = Mage::getModel('catalog/product');
        $products = $collection->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('visibility', $visibility)
            ->addAttributeToSelect('status',1);
        return $products;
    }





//
}

?>
