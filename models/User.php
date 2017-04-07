<?php

namespace app\models;

use app\helpers\MyHelper;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property integer $age
 * @property integer $sex
 * @property string $tel
 * @property string $password
 * @property string $weixin
 * @property string $introduction
 */
class User extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name','required','message'=>'用户名不能为空','on'=>['userReg','infoUpdate']],
            ['name','unique','message'=>'用户名已存在','on'=>['userReg','infoUpdate']],
            [['age'],'integer','message'=>'年龄应为数字','on'=>['infoUpdate']],
            ['sex','in','range'=>[0,1,2],'message'=>'性别参数有误','on'=>['infoUpdate']],
            [['name', 'weixin'], 'string', 'max' => 100],
            ['tel', 'string', 'max' => 50,'on'=>['userReg']],
            ['tel', 'match','pattern'=>'/^1[34578]{1}\d{9}$/','message'=>'用户手机号有误','on'=>['userReg','login']],
            ['tel','required','message'=>'用户手机号不能为空','on'=>['userReg','login']],
            ['tel','unique','message'=>'用户手机号已存在','on'=>['userReg']],
            ['password','required','message'=>'密码不能为空','on'=>['userReg','login']],
            ['password','string','min'=> 7 ,'message'=>'密码长度应大于6位','on'=>['userReg','login']],
            [['introduction'], 'string'],
            ['status','integer','on'=>['changeStatus']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '用户id',
            'name' => '用户姓名',
            'age' => '用户年龄',
            'sex' => '用户性别',
            'tel' => '用户手机号',
            'password' => '用户密码',
            'weixin' => '用户微信号',
            'introduction' => '用户个人介绍',
            'status' => '用户账号状态'
        ];
    }

    /*
     * todo:创建一个用户（注册）
     */
    public function reg($newUser){

        $this ->scenario = 'userReg';
        $this ->name = $newUser['name'];
        $this ->tel  = $newUser['tel'];
        $this->password = isset($newUser['password'])?$newUser['password']:'';

        if($this ->validate()){
            $this->password = md5($this->password);
            if($this ->save(false)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    //登录
    public function login($loginInfo){
        $this ->scenario = 'login';
        $this ->tel = $loginInfo['tel'];
        $this->password = isset($loginInfo['password'])?$loginInfo['password']:'';

        if($this->validate()){
            $data = $this->find()->where('tel=:tel and password=:password',
                [':tel'=>$this ->tel,':password'=>md5($this->password)])->one();
            if(is_null($data)){
                //登录失败
                $this ->addError('login','用户名或密码错误');
                return false;
            }else{
                if($data->status != 0){
                    $this ->addError('status','该用户已被锁定');
                    return false;
                }
                //登录成功
                $session = \Yii::$app ->session;
                $session['user'] = $data->toArray();
                return true;
            }
        }else{
            return false;
        }

    }

    //更新用户的个人信息（名字，年龄，性别，微信，简介）
    public function infoUpdate($infoUpdate){
        $this->scenario = 'infoUpdate';
        $this->name = ArrayHelper::getValue($infoUpdate,'name',$this->name);
        $this->age = ArrayHelper::getValue($infoUpdate,'age',$this->age);
        $this->sex = ArrayHelper::getValue($infoUpdate,'sex',$this->sex);
        $this->weixin = ArrayHelper::getValue($infoUpdate,'weixin',$this->weixin);
        $this->introduction = ArrayHelper::getValue($infoUpdate,'introduction',$this->introduction);

        if($this ->save()){
            return true;
        }else{
            return false;
        }

    }

    //修改用户的状态，（0 为正常用户，1 锁定该用户）
    public function changeStatus(){
        $this ->scenario = 'changeStatus';

        if($this ->status == 1){
            $this ->status = 0;
        }else{
            $this ->status = 1;
        }

        if($this ->save()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * todo:根据key=>value查数据库中是否已存在
     * @param $str_columnName       字段名
     * @param $value                值
     * @return bool                 是否存在
     */
    public function isExist($str_columnName,$value){

        $arr_where = array($str_columnName => $value);
        $int_count = $this ->find() -> where($arr_where) -> count();
        if($int_count){
            return true;
        }else{
            return false;
        }
    }
}
