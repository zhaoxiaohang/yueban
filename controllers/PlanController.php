<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/19
 * Time: 13:18
 */
namespace app\controllers;

use yii\web\Controller;

class PlanController extends Controller{


    //计划详情页
    public function actionDetail(){

        $request = \Yii::$app ->request;
        $planId = $request ->get('id',0);
        if($planId == 0){
            $this ->redirect(['index/index']);
        }

        return $this ->render("detail");
    }

    //发布信息页
    public function actionPublish(){

        return $this->render('publish');
    }

}