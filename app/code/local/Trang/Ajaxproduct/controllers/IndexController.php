<?php
/**
 * Created by PhpStorm.
 * User: trang
 * Date: 09/06/2017
 * Time: 11:20
 */
class Trang_Ajaxproduct_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {

        $id = isset($_GET['id']) ? $_GET['id'] : 1;

        $visibility = array(
            Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
            Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG
        );

        $_productCollection = Mage::getResourceModel('reports/product_collection')
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('visibility', $visibility)
            ->addAttributeToSelect('status')
            ->setPageSize(5)
            ->setCurPage($id)
        ;

        $_helper = Mage::helper('catalog/output');
       // $_productCollection=Mage::getBlockSingleton('ajaxproduct/block_ajaxproduct')->atotalProduct($id);
        ?>

        <ul class="products-grid products-grid--max-3-col">
            <?php foreach ($_productCollection as $_product): ?>
                <li class="item" style="list-style-type: none; width: 210px; margin-left: 30px; display: inline-block">
                    <?php $_imgSize = 210; ?>
                    <img id="product-collection-image-<?php echo $_product->getId(); ?>" src="<?php echo Mage::helper('catalog/image')->init($_product, 'small_image')->resize($_imgSize); ?>"/>
                    <h2 class="product-name">
                        <a href="<?php echo $_product->getProductUrl() ?>" title="<?php echo $_productNameStripped; ?>"><?php echo $_helper->productAttribute($_product, $_product->getName() , 'name'); ?></a>
                    </h2>
                    <span class="price-con">
                        <?php
                        echo Mage::helper('core')->currency($_product->getFinalPrice(),true,false);
                        ?>

                    </span>
                    <span class="fadd">
                        <p>
                            <button type="button" title="<?php echo $this->__('Add to Cart') ?>" class="button btn-cart" onclick="setLocation(' <?php echo Mage::helper('checkout/cart')->getAddUrl($_product) ?>')"><span><span><?php echo $this->__('Add to Cart') ?></span></span></button>
                        </p>
                    </span>

                </li>
            <?php endforeach; ?>
        </ul>
        <?php
    }
}