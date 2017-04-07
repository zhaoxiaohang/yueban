<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "plan_collection".
 *
 * @property integer $id
 * @property integer $plan_id
 * @property integer $user_id
 */
class PlanCollection extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan_collection';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['plan_id', 'user_id'], 'required'],
            [['plan_id', 'user_id'], 'integer'],
            [['plan_id','user_id'],'unique','message'=>'已关注']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '个人收藏id',
            'plan_id' => '出行计划id',
            'user_id' => '用户id',
        ];
    }
}
