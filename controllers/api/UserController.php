<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/15
 * Time: 16:01
 */

namespace app\controllers\api;

use app\helpers\MyHelper;
use app\models\User;
use app\models\UserFocus;
use yii\web\Controller;

class UserController extends Controller
{
    private $obj_user;

    public function init()
    {
        $this ->obj_user = new User();
    }


    public function actionTest(){
        \Yii::$app->cache->flush();
    }

    /**
     * TODO：用户登录接口
     */
    public function actionLogin()
    {
        try {
            $userLogin = new User();
            if (\Yii::$app->request->isGet) {
                $login = \Yii::$app->request->get();
                if ($userLogin->login($login)) {
                    //登录成功，直接重定向到首页
                    $this ->redirect(['index/index']);
                } else {
                    //登录失败，返回错误信息
                    $arr_error = $userLogin ->getFirstErrors();
                    $str_errorText = reset($arr_error);
                    throw new \Exception($str_errorText,1);
                }
            }else{
                throw new \Exception('登录失败',1);
            }
        }catch(\Exception $e){
            return MyHelper::returnArray(
                null,
                $e->getMessage(),
                $e->getCode());
        }
    }

    /**
     *todo: 用户退出
     */
    public function actionLogout()
    {
        \Yii::$app->session ->remove('user');
        if(!isset(\Yii::$app->session['user'])){
            return $this ->goHome();
        }
    }

    /**
     * todo: 用户注册
     */
    public function actionReg()
    {
        try {
            $obj_newUser = new User;

            $request = \Yii::$app->request;
            $arr_newUser = $request->get();

            $bool_isOK = $obj_newUser ->reg($arr_newUser);
            if($bool_isOK){
                //注册完之后直接登录
                $arr_newUser = $obj_newUser ->toArray();
                $session = \Yii::$app ->session;
                unset($arr_newUser['password']);
                $session['user'] = $arr_newUser;

                $this ->redirect(['user/update']);
//                return myHelper::returnArray($arr_newUser);
            }else{
                $arr_error = $obj_newUser ->getFirstErrors();
                $str_errorText = reset($arr_error);
                throw new \Exception($str_errorText,1);
            }


        }catch(\Exception $e){
            return MyHelper::returnArray(
                null,
                $e->getMessage(),
                $e->getCode());
        }


    }

    /**
     * todo: 用户个人信息修改，保存
     */
    public function actionUpdateInfo()
    {
        try{
            $session_user = \Yii::$app ->session ->get('user');
            if(is_null($session_user)){
                throw new \Exception('请登录后修改个人信息',1000);
            }

            $user_model = User::findOne($session_user['id']);

            $post = \Yii::$app ->request ->get();
            if(empty($post)){
                throw new \Exception('无保存内容',1);
            }
            $isOk = $user_model ->infoUpdate($post);

            if($isOk){
                //修改session中的信息，并返回ture
                \Yii::$app->session ->set('user',$user_model->toArray());
                return MyHelper::returnArray(null,'保存成功',0);

            }else{
                //获取错误信息，并抛出错误
                $err_msg = $user_model ->getFirstErrors();
                throw new \Exception(reset($err_msg),1);
            }
        }catch(\Exception $ex){
            return MyHelper::returnArray(
                null,
                $ex->getMessage(),
                $ex->getCode());
        }
    }

    //修改用户状态，管理员用户可以进行操作
    public function actionChangeStatus(){
        try{
            $session_admin = \Yii::$app ->session ->get('admin');
            if(is_null($session_admin)){
                throw new \Exception('请登录管理员账户',1000);
            }

            $user_id = \Yii::$app ->request ->get('uid');

            $user_model = User::findOne($user_id);
            if(is_null($user_model)){
                throw new \Exception('无此用户',4000);
            }

            $isOk = $user_model ->changeStatus();

            if($isOk){
                return MyHelper::returnArray(array(
                    'uid'=> $user_id,
                    'status' => $user_model ->status
                ));
            }else{
                $err_msg = $user_model ->getFirstErrors();
                throw new \Exception(reset($err_msg),1);
            }

        }catch(\Exception $ex){
            return MyHelper::returnArray(
                null,
                $ex->getMessage(),
                $ex->getCode());
        }
    }

    //关注用户
    public function actionFocusUser(){
        try{
            $session_user = \Yii::$app ->session ->get('user');
            if(is_null($session_user)){
                throw new \Exception('请登录后操作',1000);
            }

            $focusId = \Yii::$app ->request ->get('focusId');
            $fansId = $session_user['id'];
            $user = User::findOne($focusId);
            if(is_null($user)){
                throw new \Exception('该用户不存在',1);
            }

            $model = new UserFocus();

            $new_focus = array(
                'fans_id' => $fansId,
                'focus_id' =>$focusId
            );

            if($model ->focus($new_focus)){
                return MyHelper::returnArray(null,'关注成功',0);
            }else{
                $err_msg = $model ->getFirstErrors();
                throw new \Exception(reset($err_msg),1);
            }

        }catch(\Exception $ex){
            return MyHelper::returnArray(
                null,
                $ex->getMessage(),
                $ex->getCode());
        }
    }

    //取消关注
    public function actionDelFocus(){
        try{
            $session_user = \Yii::$app ->session ->get('user');
            if(is_null($session_user)){
                throw new \Exception('请登录后操作',1000);
            }

            $focusId = \Yii::$app ->request ->get('focusId');
            $fansId = $session_user['id'];

            $model = UserFocus::find()
                ->where(['fans_id' => $fansId,'focus_id' => $focusId])
                ->one();

            if($model){
                $model ->delete();
                throw new \Exception('已取消关注',0);
            }else{
                throw new \Exception('未关注该用户',1);
            }

        }catch(\Exception $ex){
            return MyHelper::returnArray(
                null,
                $ex->getMessage(),
                $ex->getCode());
        }
    }

}