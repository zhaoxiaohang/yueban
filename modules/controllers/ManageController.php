<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/11
 * Time: 21:29
 */
namespace app\modules\controllers;

use app\helpers\MyHelper;
use app\modules\models\Admin;
use yii\data\Pagination;
use yii;

class ManageController extends BaseController{


    //管理员列表
    public function actionManagers()
    {
        $this->layout = 'layout1';
        $model = Admin::find();
        $count = $model ->count();
        $pageSize = \Yii::$app ->params['managersPageSize'];
        $page = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $managers = $model ->offset($page ->offset) ->limit($page ->limit) ->all();
        return $this ->render('managers',['managers'=> $managers,'page'=> $page]);

    }

    //添加管理员
    public function actionReg(){

        $this ->layout = 'layout1';
        $model = new Admin;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->reg($post)) {
                $this ->redirect(['manage/managers']);
            } else {
                Yii::$app->session->setFlash('info', '添加失败');
            }
        }
        $model->adminpass = '';
        return $this ->render('reg', ['model' => $model]);

    }

    //删除管理员api
    public function actionDel(){
        try{
            $adminId = Yii::$app ->request ->get('adminId');
            if(!is_numeric($adminId)){
                throw new \Exception('删除失败',1);
            }

            $model = Admin::findOne($adminId);

            if($model){
                $model ->delete();

                return MyHelper::returnArray(null,
                    '删除成功',
                    0);

            }else{
                throw new \Exception('删除失败',1);
            }

        }catch(\Exception $ex){
            return MyHelper::returnArray(
                null,
                $ex->getMessage(),
                $ex->getCode());
        }

    }
}