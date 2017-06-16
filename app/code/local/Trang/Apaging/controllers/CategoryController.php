<?php
/**
 * Created by PhpStorm.
 * User: trang
 * Date: 15/06/2017
 * Time: 09:19
 */

require_once (BP.'/app/code/core/Mage/Catalog/controllers/CategoryController.php'); //BP ??
class Trang_Apaging_CategoryController extends Mage_Catalog_CategoryController
{
    //prepare layout, get from layout apaging.xml //??
    protected function _getListHtml(){
        $layout = $this->getLayout(); //getlayout from core
        $layout->getUpdate()->load('catalog_category_ajax_view');//update apaging layout
        $layout->generateXml()->generateBlocks(); //generate block???
        $output = $layout->getOutput();// return
        return $output;
    }

    public function viewAction()
    {
        $oneRequest = $this->getRequest();//get post ?? //lay request
        if($oneRequest->isXmlHttpRequest()){//???
            if ($category = $this->_initCatagory()) {//lay catagory extends category controller

                $this->getResponse()->setBody($this->_getListHtml());//tra ve setbody set layout
            }
        }else{
            parent::viewAction(); //ko lay function viewAction() from mage_catalog_Categorycontroller
        }
    }
}
//tai sao phai require trong khi da extend r?? mia