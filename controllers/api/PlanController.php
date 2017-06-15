<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/19
 * Time: 13:25
 */
namespace app\controllers\api;

use app\helpers\MyHelper;
use app\models\Plan;
use app\models\PlanApply;
use app\models\PlanCollection;
use app\models\PlanComment;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class PlanController extends BaseController{

    //获取列表页
    public function actionList(){
        try{
            //接收条件{地点，时间，排列顺序，}

        }catch(\Exception $ex){
            return MyHelper::returnArray(
                null,
                $ex->getMessage(),
                $ex->getCode());
        }
    }

    //出行信息发布
    public function actionPublish(){
        try{
            $session_user = \Yii::$app ->session ->get('user');
            if(is_null($session_user)){
                throw new \Exception('请登录后操作',1000);
            }

            $plan = \Yii::$app ->request ->post();

            $plan['user_id'] = $session_user['id'];
            $plan['user_name'] = $session_user['name'];

            $newModel = new Plan();

            $bool_isOK = $newModel ->create($plan);

            if($bool_isOK){
                //注册完之后直接登录
                return MyHelper::returnArray($newModel->id);

            }else{
                $arr_error = $newModel ->getFirstErrors();
                $str_errorText = reset($arr_error);
                throw new \Exception($str_errorText,1);
            }

        }catch(\Exception $ex){
            return MyHelper::returnArray(
                null,
                $ex->getMessage(),
                $ex->getCode());
        }
    }

    //收藏帖子
    public function actionCollection(){
        try{
            $session_user = \Yii::$app ->session ->get('user');
            if(is_null($session_user)){
                throw new \Exception('请登录后操作',1000);
            }

            $planId = \Yii::$app ->request ->get('planId');
            if(!is_numeric($planId)){
                throw new \Exception('参数错误',1);
            }
            $userId = $session_user['id'];
            $plan = Plan::findOne($planId);
            if(is_null($plan)){
                throw new \Exception('该出行计划不存在',1);
            }

            $model = new PlanCollection();

            $model ->plan_id = $planId;
            $model ->user_id = $userId;

            if($model ->save()){

                //添加系统通知给出行信息发布者

                return MyHelper::returnArray(null,'收藏成功',0);
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

    //取消收藏
    public function actionCollectionDel(){
        try{
            $session_user = \Yii::$app ->session ->get('user');
            if(is_null($session_user)){
                throw new \Exception('请登录后操作',1000);
            }

            $planId = \Yii::$app ->request ->get('planId');
            if(!is_numeric($planId)){
                throw new \Exception('参数错误',1);
            }
            $userId = $session_user['id'];

            $collection = PlanCollection::find()
                ->where(['plan_id' => $planId,'user_id' => $userId])
                ->one();

            if($collection){
                //已关注
                $collection ->delete();

                throw new \Exception('已取消收藏',0);
            }else{
                //未关注
                throw new \Exception('未收藏此出行计划',1);
            }
        }catch(\Exception $ex){
            return MyHelper::returnArray(
                null,
                $ex->getMessage(),
                $ex->getCode());
        }
    }

    //申请结伴
    public function actionApply(){
        try{
            $session_user = \Yii::$app ->session ->get('user');
            if(is_null($session_user)){
                throw new \Exception('请登录后操作',1000);
            }

            $apply = \Yii::$app ->request ->post();
            $planId = $apply['planId'];
            if(!is_numeric($planId)){
                throw new \Exception('参数错误',1);
            }
            $userId = $session_user['id'];
            $plan = Plan::findOne($planId);
            if(is_null($plan)){
                throw new \Exception('该出行计划不存在',1);
            }

            $model = new PlanApply();

            $model ->plan_id = $planId;
            $model ->user_id = $userId;
            $model ->tel = ArrayHelper::getValue($apply,'tel');
            $model ->sex = ArrayHelper::getValue($apply,'sex');
            $model ->apply_num = ArrayHelper::getValue($apply,'apply_num');
            $model ->apply_details = ArrayHelper::getValue($apply,'apply_details');
            $model ->apply_time = date('Y-m-d');
            $model ->apply_details = 0;

            if($model ->save()){

                //添加系统通知给出行计划发布者

                return MyHelper::returnArray(null,'收藏成功',0);
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

    //通过、拒绝申请
    public function actionAnswerapply(){
        try{
            $session_user = \Yii::$app ->session ->get('user');
            if(is_null($session_user)){
                throw new \Exception('请登录后操作',1000);
            }

            $answer = \Yii::$app ->request ->post();
            $planApplyId = ArrayHelper::getValue($answer,'id');
            $yesOrNo = ArrayHelper::getValue($answer,'yesOrNo');

            if(is_null($planApplyId) || $yesOrNo == 1 || $yesOrNo == 2){
                throw new \Exception('参数错误',1);
            }

            //查询申请记录
            $modelApply = PlanApply::findOne($planApplyId);

            //检查他是否是发布者
            $plan = Plan::find()
                ->where(['id'=> $modelApply ->plan_id,'user_id' => $session_user['id']])
                ->one();

            if(is_null($plan)){
                throw new \Exception('无操作权限',1);
            }

            $modelApply ->status = $yesOrNo;

            if($modelApply ->save()){

                //添加系统通知给申请人

                return MyHelper::returnArray(
                    $modelApply ->status
                );
            }else{
                $err_msg = $modelApply ->getFirstErrors();
                throw new \Exception(reset($err_msg),1);
            }
        }catch(\Exception $ex){
            return MyHelper::returnArray(
                null,
                $ex->getMessage(),
                $ex->getCode());
        }
    }

    //留言
    public function actionComment(){
        try{
            $session_user = \Yii::$app ->session ->get('user');
            if(is_null($session_user)){
                throw new \Exception('请登录后操作',1000);
            }

            $comment = \Yii::$app ->request ->post();
            $planId = $comment['planId'];
            $text = $comment['text'];
            if(!is_numeric($planId) || $text == ''){
                throw new \Exception('参数错误',1);
            }
            $plan = Plan::findOne($planId);
            if(is_null($plan)){
                throw new \Exception('该出行计划不存在',1);
            }

            $model = new PlanComment();

            $model ->plan_id = $planId;
            $model ->content = htmlspecialchars($text);
            $model ->user_id = $session_user['id'];
            $model ->user_name = $session_user['name'];
            $model ->create_time = date('Y-m-d');



            if($model ->save()){

                //添加系统通知给出行计划发布者{有新的留言信息，请查看}

                $arr_comment = $model ->toArray();

                return MyHelper::returnArray($arr_comment);
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

}