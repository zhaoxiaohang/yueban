<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/15
 * Time: 22:24
 */
namespace app\controllers;

use yii\web\Controller;
use app\models\User;

class UserController extends Controller
{
    /**
     * todo:用户信息详情页
     */
    public function actionDetail(){
        $int_userId = \Yii::$app ->request->get('id');

        $arr_userInfo = User::findOne($int_userId)->toArray();
        return $this->render('detail',['userInfo'=>$arr_userInfo]);
    }

    //用户信息更新
    public function actionUpdate(){
        $session = \Yii::$app ->session;
        var_dump($session['user']);die();
        if(is_null($session['user'])){

        }
        return $this->render('update');
    }
}