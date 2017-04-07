<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/19
 * Time: 13:18
 */
namespace app\controllers;

use app\models\Plan;
use yii\web\Controller;

class PlanController extends Controller{


    //计划详情页
    public function actionDetail(){

        $request = \Yii::$app ->request;
        $planId = $request ->get('id',0);
        if($planId == 0){
            $this ->redirect(['index/index']);
        }


        $plan = Plan::findOne($planId)->toArray();

        return $this ->render("detail");
    }

    //发布信息页-- ok
    public function actionPublish(){
        // 登录用户可以发布
      try {
          $session_user = \Yii::$app->session->get('user');
          if(is_null($session_user)){
              //未登录，不能发布信息
              throw new \Exception('未登录不能发布出行信息，请登录',1000);
          }
          $arr_user = array(
              'id' => $session_user['id'],
              'name' => $session_user['name'],
              'tel' => $session_user['tel']
          );

          return $this->render('publish',array(
              'user' =>$arr_user
          ));
      }catch(\Exception $ex){
          //出现错误，跳转错误页面
          return $this->render('//user/error', [
              'errorCode' => $ex ->getCode(),
              'errorMsg' => $ex->getMessage()
          ]);
      }
    }

}