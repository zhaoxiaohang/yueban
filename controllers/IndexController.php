<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/15
 * Time: 11:03
 */
namespace app\controllers;

use app\models\Plan;
use yii\web\controller;

class IndexController extends Controller
{

    //平台首页
    public function actionIndex()
    {
        $request = \Yii::$app ->request;

        //查询条件
        $query = $request ->get('q',null);
        $hotPlace = $request ->get('h',null);
        $goTime = $request ->get('t',null);
        $orderBy = $request ->get('o',1);
        //获取session中用户id和用户名
        $session = \Yii::$app ->session;
        $arr_user = array();
        if(isset($session['user'])){
            $arr_user = array(
                'id' => $session['user']['id'],
                'name' => $session['user']['name']
            );
        }
        //热门地区
        $arr_hostPlace = array();
        $arr_hostPlaceReturn = Plan::find()->select(['destination','COUNT(destination) as placeCount'])->where(['status'=>1])
            ->groupBy('destination')->orderBy(['placeCount'=>SORT_DESC])
            ->asArray()->limit(10)->all();
        foreach($arr_hostPlaceReturn as $item){
            $arr_hostPlace[$item['destination']] = $item['placeCount'];
        }

        //分页信息{总页数、每页记录数}
        $pageIndex = 1;
        $pageSize = \Yii::$app->params['planListPageSize'];

        //页数
        $int_planCount =Plan::find() ->where(['status'=>1]) ->count();
        $int_pageTotal = ceil($int_planCount/$pageSize);

        //发布信息
        $modelPlan = Plan::find()
            ->where(['status'=>1])
            ->andWhere(['>','start_time',date('Y-m-d')]);

        //添加查询的条件
        if(!is_null($query)){
            $modelPlan ->andWhere(
                ['or',['like','title',htmlspecialchars($query)],['like','destination',htmlspecialchars($query)]]);
        }

        if(!is_null($hotPlace)){
            $modelPlan ->andWhere(['like','destination',htmlspecialchars($hotPlace)]);
        }

        if(!is_null($goTime) && $goTime != 0){
            switch($goTime){
                case 1:
                    $arr_time = ['=','start_time',date('Y-m-d')];
                    break;
                case 2:
                    $arr_time = ['<','start_time',date('Y-m-d',strtotime("+1 month"))];
                    break;
                case 3:
                    $arr_time = ['<','start_time',date('Y-m-d',strtotime("+3 month"))];
                    break;
                case 4:
                    $arr_time = ['<','start_time',date('Y-m-d',strtotime("+5 month"))];
                    break;
                case 5:
                    $arr_time = ['>','start_time',date('Y-m-d',strtotime("+5 month"))];
                    break;
                default:
                    $arr_time = [];
            }
            $modelPlan ->andWhere($arr_time);
        }

        switch($orderBy){
            case 1:
                $arr_order = ['view_time'=>SORT_DESC];
                break;
            case 2:
                $arr_order = ['release_time'=>SORT_DESC];
                break;
            case 3:
                $arr_order = ['star_time'=>SORT_ASC];
                break;
            default:
                $arr_order = ['view_time'=>SORT_DESC];
        }

        $arr_planList = $modelPlan->offset($pageIndex-1)
            ->limit($pageSize)
            ->orderBy($arr_order)
            ->asArray()->all();


        //计算出发天数
        foreach($arr_planList as $key => $plan){
            $arr_planList[$key]['goDays'] = floor((strtotime($plan['start_time'])-time())/(3600*24));
        }

        $arr_return = array(
            'condition'=>[
                'query' => $query,
                'hotPlace' => $hotPlace,
                'goTime' => $goTime,
                'orderBy'=> $orderBy
            ],
            'user' => $arr_user,
            'hotPlace' => $arr_hostPlace,
            'planList' => $arr_planList,
            'pageInfo'=>[
                'pageIndex' => $pageIndex,
                'pageTotal' => $int_pageTotal
            ]
        );
        return $this ->render("index",$arr_return);
    }
}