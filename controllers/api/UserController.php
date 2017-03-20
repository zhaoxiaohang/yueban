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
use yii\web\Controller;

class UserController extends Controller
{
    private $obj_user;

    public function init()
    {
        $this ->obj_user = new User();
    }

    public function actionIndex(){
        return json_encode(array('aaa','abbaaa'));
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
            }
        }catch(\Exception $e){
            return MyHelper::returnArray(
                null,
                $e->getMessage(),
                $e->getCode());
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
     * 不用了
     * todo:用户手机号，用户名检测
     */
    private function actionCheck()
    {
        try {

            $request = \Yii::$app->request;
            $str_name = $request->get('name');
            $str_tel = $request->get('tel');

            if (!MyHelper::isMobile($str_tel)) {
                throw new \Exception('手机号有误',1);
            }

            $bool_name = $this->obj_user->isExist('name', $str_name);
            $bool_tel = $this->obj_user->isExist('tel', $str_tel);

            $int_returnSign = 0;
            //0表示都不存在均可用,1表示用户名不可用，2表示手机号不可用,3表示都不可用
            if ($bool_name) {
                $int_returnSign += 1;
            }

            if($bool_tel){
                $int_returnSign += 2;
            }

            return MyHelper::returnArray($int_returnSign);

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
    public function actionUpdateInfo(){

    }
}