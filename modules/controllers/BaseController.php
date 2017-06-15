<?php

namespace app\modules\controllers;

use yii\web\Controller;

class BaseController extends Controller{

    public function init()
    {
        parent::init();
        if(\Yii::$app ->session['admin']['isLogin'] != 1){
            return $this ->redirect("/admin/default/login");
        }
    }

}