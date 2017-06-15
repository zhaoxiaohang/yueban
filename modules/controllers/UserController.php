<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/16
 * Time: 17:16
 */
namespace app\modules\controllers;

use app\models\User;
use yii\data\Pagination;

class UserController extends BaseController{

    //用户列表
    public function actionUsers()
    {
        $this->layout = 'layout1';
        $model = User::find();
        $count = $model ->count();
        $pageSize = \Yii::$app ->params['userListPageSize'];
        $page = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $users = $model ->offset($page ->offset) ->limit($page ->limit) ->all();
        return $this ->render('users',['users'=> $users,'page'=> $page]);

    }

}