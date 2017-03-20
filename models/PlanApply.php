<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "plan_apply".
 *
 * @property integer $id
 * @property integer $plan_id
 * @property integer $user_id
 * @property string $tel
 * @property integer $sex
 * @property integer $apply_num
 * @property string $apply_details
 * @property string $apply_time
 * @property integer $status
 */
class PlanApply extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan_apply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['plan_id', 'user_id', 'tel', 'sex', 'apply_num', 'apply_time', 'status'], 'required'],
            [['plan_id', 'user_id', 'sex', 'apply_num', 'status'], 'integer'],
            [['apply_time'], 'safe'],
            [['tel'], 'string', 'max' => 50],
            [['apply_details'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '报名id',
            'plan_id' => '计划id',
            'user_id' => '申请人用户id',
            'tel' => '申请人联系方式',
            'sex' => '性别',
            'apply_num' => '报名人数',
            'apply_details' => '报名名单及详情',
            'apply_time' => '报名时间',
            'status' => '报名状态（0,1,2）',
        ];
    }
}
