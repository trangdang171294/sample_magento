<?php
/**
 * Created by PhpStorm.
 * User: trang
 * Date: 08/06/2017
 * Time: 16:06
 */
require_once BP.'/app/code/core/Mage/Catalog/controllers/CategoryController.php';
class Trang_Pagingajax_CategoryController extends Mage_Catalog_CategoryController
{
    //lay layout ??
    protected function _getListHtml(){
        $layout = $this->getLayout();
        $layout->getUpdate()->load('catalog_category_ajax_view');
        $layout->generateXml()->generateBlocks();
        $output = $layout->getOutput();
        return $output;
    }
//    protected function _getLayeredNavHtml(){
//        $layout = $this->getLayout();
//        $layout->getUpdate()->load('catalog_category_layered_ajax');
//        $layout->generateXml()->generateBlocks();
//        $output = $layout->getOutput();
//        return $output;
//    }
    public function viewAction()
    {
        $oneRequest = $this->getRequest();
        if($oneRequest->isXmlHttpRequest()){
            if ($category = $this->_initCatagory()) {
                //if($lnav){
                //$this->getResponse()->setBody($this->_getLayeredNavHtml());
                //}else{
                	$this->getResponse()->setBody($this->_getListHtml());
                //}
            }
        }else{
            parent::viewAction();
        }
    }
}
