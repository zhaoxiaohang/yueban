<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/16
 * Time: 17:15
 */
namespace app\modules\controllers;

use app\helpers\MyHelper;
use app\models\Plan;
use yii\data\Pagination;

class PlanController extends BaseController{

    //结伴信息列表
    public function actionPlans()
    {
        $this->layout = 'layout1';
        $model = Plan::find();
        $count = $model ->count();
        $pageSize = \Yii::$app ->params['planListPageSize'];
        $page = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $plans = $model ->offset($page ->offset) ->limit($page ->limit) ->all();
        return $this ->render('plans',['plans'=> $plans,'page'=> $page]);

    }

    //关闭帖子api
    public function actionClose(){
        try{
            $planId = \Yii::$app ->request ->get('planId');

            if(!is_numeric($planId)){
                throw new \Exception('参数错误',1);
            }
            $model = Plan::findOne($planId);
            if($model){
                $model ->status = 2;
                $model ->save();
                return MyHelper::returnArray(null,'已关闭',0);
            }else{
                throw new \Exception('无此记录',1);
            }


        }catch(\Exception $ex){
            return MyHelper::returnArray(
                null,
                $ex->getMessage(),
                $ex->getCode());
        }
    }
}