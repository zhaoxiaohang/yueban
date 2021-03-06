<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "plan".
 *
 * @property integer $id
 * @property string $title
 * @property string $tel
 * @property string $start_place
 * @property string $start_time
 * @property string $destination
 * @property integer $days
 * @property integer $person_limit
 * @property string $details
 * @property integer $user_id
 * @property string $release_time
 * @property string $user_name
 * @property integer $view_time
 * @property integer $status
 */
class Plan extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'tel', 'start_place', 'start_time', 'destination', 'days', 'person_limit', 'user_id', 'release_time', 'user_name', 'view_time', 'status'], 'required'],
            [['start_time', 'release_time'], 'safe'],
            [['days', 'person_limit', 'user_id', 'view_time', 'status'], 'integer'],
            [['details'], 'string'],
            [['title'], 'string', 'max' => 500],
            [['tel', 'start_place', 'destination', 'user_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '出行计划id',
            'title' => '计划标题',
            'tel' => '联系电话',
            'start_place' => '出发地',
            'start_time' => '出发时间',
            'destination' => '目的地',
            'days' => '行程天数',
            'person_limit' => '希望人数',
            'details' => '出行计划详情',
            'user_id' => '发布者id',
            'release_time' => '发布时间',
            'user_name' => '发布者名字',
            'view_time' => '浏览次数',
            'status' => '该计划状态',
        ];
    }


    public function create($newPlan){
        $this->title = ArrayHelper::getValue($newPlan,'title');
        $this->tel = ArrayHelper::getValue($newPlan,'tel');
        $this->start_place = ArrayHelper::getValue($newPlan,'start_place');
        $this->start_time = ArrayHelper::getValue($newPlan,'start_time');
        $this->destination = ArrayHelper::getValue($newPlan,'destination');
        $this->days = ArrayHelper::getValue($newPlan,'days');
        $this->person_limit = ArrayHelper::getValue($newPlan,'person_limit');
        $this->details = ArrayHelper::getValue($newPlan,'details');
        $this->user_id = ArrayHelper::getValue($newPlan,'user_id');
        $this->user_name = ArrayHelper::getValue($newPlan,'user_name');
        $this->release_time = date('Y-m-d');
        $this->view_time = 0;
        $this->status = 1;

        if($this ->validate()){
            if($this ->save(false)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}
