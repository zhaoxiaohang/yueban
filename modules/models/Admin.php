<?php

namespace app\modules\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property string $adminid
 * @property string $adminuser
 * @property string $adminpass
 * @property string $email
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['adminuser'], 'required','message'=>'管理员账号不能为空','on' =>['login','reg']],
            [['adminpass'], 'required','message'=>'管理员密码不能为空','on' =>['login','reg']],
            [['adminuser', 'adminpass'], 'string', 'max' => 32,'on' =>['login']],
            [['adminuser'], 'unique','on' => ['reg']],
            ['email','required','message' => '管理员邮箱不能为空','on' => ['reg']],
            ['adminpass','validatePass','on' =>['login']],
        ];
    }

    //验证密码
    public function validatePass()
    {
        if (!$this->hasErrors()) {
            $data = self::find()->where('adminuser = :user and adminpass = :pass', [":user" => $this->adminuser, ":pass" => md5($this->adminpass)])->one();
            if (is_null($data)) {
                $this->addError("adminpass", "用户名或者密码错误");
            }
        }
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'adminid' => '主键ID',
            'adminuser' => '管理员账号',
            'adminpass' => '管理员密码',
            'email' => '管理员邮箱'
        ];
    }


    //用户登录
    public function login($data)
    {
        $this ->scenario = 'login';
        if ($this->load($data) && $this ->validate()) {

            //做点有意义的事
            $session = Yii::$app->session;
            $session['admin'] = [
                'adminuser' => $this->adminuser,
                'isLogin' => 1,
            ];
            return (bool)$session['admin']['isLogin'];
        }
        return false;
    }

    //添加管理员账号
    public function reg($data){
        $this->scenario = 'reg';
        if ($this->load($data) && $this->validate()) {
            $this->adminpass = md5($this->adminpass);
            if ($this->save(false)) {
                return true;
            }
            return false;
        }
        return false;
    }
}
