<?php

namespace app\modules\controllers;

use \yii;
use app\modules\models\Admin;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    //管理员登录
    public function actionLogin()
    {
        $this->layout = false;
        $model = new Admin();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->login($post)) {
                $this->redirect(['index/index']);
                Yii::$app->end();
            }
        }
        return $this->render("login", ['model' => $model]);
    }

    //登出
    public function actionLogout(){
        Yii::$app ->session ->remove('admin');
        if(!isset(Yii::$app->session['admin']['isLogin'])){
            $this->redirect(['default/login']);
            Yii::$app->end();
        }else{
            $this ->goBack();
        }
    }

}
