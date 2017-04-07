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
use app\models\UserFocus;

class UserController extends Controller
{

    /**
     * todo:用户信息详情页
     * 注：用户可以查看自己的详情页，也可以查看其他用户的详情页
     * 在自己的详情页中没有关注按钮，在其他用户页中是有关注按钮的。
     * 在没有登录的情况下，用户也是可以查看其他用户的个人主页的。
     */
    public function actionDetail(){
        try {
            $int_userId = \Yii::$app->request->get('id', 0);
            $session_user = \Yii::$app->session->get('user');
            if(is_null($session_user)){
                //未登录，不能查看用户信息
                throw new \Exception('未登录不能查看用户信息，请登录',1000);
            }
            $userInfo = array();
            if ($int_userId == $session_user['id']) {
                //用户访问自己的主页
                $userInfo = $session_user;
                $userInfo['focusStatus'] = 2;//不显示关注按钮
            } else {
                //访问他人主页
                $userInfo = User::findOne([
                    'id' => $int_userId,
                    'status' => 0
                ]);
                if(is_null($userInfo)){
                    //访问的用户首页不存在，跳转错误连接
                    throw new \Exception('您访问的用户不存在或者给用户已被锁定',404);
                }

                //查看是否已关注该用户


            }

            //查询关注人数和粉丝数   及每个人的信息id，name
            $modelUserFocus = new UserFocus();
            $arr_focusFans = $modelUserFocus ->getFocusFans($int_userId);

            $arr_return = array(
                'userInfo' => $userInfo,
                'focusFan' => $arr_focusFans
            );

            return $this ->render('detail',$arr_return);
        }catch(\Exception $ex){
            //出现错误，跳转错误页面
            return $this->render('error', [
                'errorCode' => $ex ->getCode(),
                'errorMsg' => $ex->getMessage()
                ]);
        }

    }

    //用户信息更新页
    public function actionUpdate(){
        try {
            $session_user = \Yii::$app->session->get('user');
            if(is_null($session_user)){
                //未登录，不能发布信息
                throw new \Exception('请登录后修改个人信息',1000);
            }
            unset($session_user['password']);
            unset($session_user['status']);

            return $this->render('update',array(
                'user' =>$session_user
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