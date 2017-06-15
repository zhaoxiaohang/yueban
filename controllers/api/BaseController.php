<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/17
 * Time: 10:03
 */

namespace app\controllers\api;

use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class BaseController extends Controller{

    public function init(){
        parent::init();
        $this->enableCsrfValidation = false;
    }

    public function behaviors()
    {
        return ArrayHelper::merge([
            [
                'class' => Cors::className(),
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => ['GET', 'POST', 'HEAD', 'OPTIONS'],
                ],
            ],
        ], parent::behaviors());
    }

}