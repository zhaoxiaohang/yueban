<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 17:41
 */

namespace app\controllers;

use app\helpers\MyHelper;
use app\models\User;
use yii\web\Controller;
use \Yii;

class TestController extends Controller{

    public function actionIndex(){

    }

    //注册
    public function actionTest(){
        $request = yii::$app ->request;

        $str_tel = $request ->get('tel','');
        $str_pwd = $request ->get('pwd','123456789');

        $arr_newUser = array(
            'tel' => $str_tel,
            'pwd' => $str_pwd
        );

        $obj_newUser = new User();
        $return_user = $obj_newUser ->create($arr_newUser);

        return json_encode($return_user);
    }
}