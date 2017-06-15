<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/11
 * Time: 21:13
 */
namespace app\modules\controllers;

class IndexController extends BaseController{

    public function actionIndex(){
        $this->layout = "layout1";
        return $this->render('index');
    }

}