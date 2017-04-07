<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/21
 * Time: 21:20
 */
namespace app\models;

use app\models\User;

class UserFocus extends \yii\db\ActiveRecord{

    public static function tableName()
    {
        return 'user_focus';
    }

    public function rules()
    {
        return [
            ['fans_id','required','message'=>'用户id不能为空'],
            ['focus_id','required','message'=>'关注用户id不能为空'],
            [['fans_id', 'focus_id'], 'integer'],
            [['fans_id','focus_id'],'unique','message'=>'该用户已关注'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '关注id',
            'fans_id' => '粉丝用户id',
            'focus_id' => '被关注用户id',
        ];
    }

    //获取用户的关注用户 和粉丝
    public function getFocusFans($int_userId){
        //关注的用户(只显示8个)
        $arr_focus = $this ->find()
            ->select('*')
            ->leftJoin(User::tableName(),'user_focus.focus_id=user.id')
            ->where(['fans_id'=>$int_userId])
            ->limit(8)
            ->asArray()
            ->all();

        //粉丝(只显示8个)
        $arr_fans = $this ->find()
            ->select('user.id,name')
            ->leftJoin(User::tableName(),'user_focus.fans_id=user.id')
            ->where(['focus_id'=>$int_userId])
            ->asArray()
            ->limit(8)
            ->all();

        return array(
            'focus' => $arr_focus,
            'fans' => $arr_fans,
            'focusCount' => count($arr_focus),
            'fansCount' => count($arr_fans)
        );

    }

    //关注
    public function focus($newFocus){
        $this ->fans_id = $newFocus['fans_id'];
        $this ->focus_id = $newFocus['focus_id'];
        if($this ->save()){
            return true;
        }else{
            return false;
        }
    }

}
