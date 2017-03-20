<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "plan_comment".
 *
 * @property integer $id
 * @property integer $plan_id
 * @property string $content
 * @property integer $user_id
 * @property string $user_name
 * @property string $create_time
 */
class PlanComment extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['plan_id', 'user_id', 'user_name', 'create_time'], 'required'],
            [['plan_id', 'user_id'], 'integer'],
            [['create_time'], 'safe'],
            [['content'], 'string', 'max' => 500],
            [['user_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '留言评论id',
            'plan_id' => '相关计划id',
            'content' => '评论内容',
            'user_id' => '用户id',
            'user_name' => '用户昵称',
            'create_time' => '评论时间',
        ];
    }
}
