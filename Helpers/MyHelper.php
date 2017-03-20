<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 18:42
 */
namespace app\helpers;

class MyHelper{

    /**
     * todo: 验证手机号码
     * @param $str_mobile
     * @return int
     */
    public static function isMobile($str_mobile){
        $regex = '/^1[34578]{1}\d{9}$/';
        return preg_match($regex, $str_mobile);
    }

    /**
     * todo: 加密密码
     * @param $password
     * @return string
     * @throws \yii\base\Exception
     */
    public static function hashPassword($password){
        return \Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    /**
     * todo: 创建返回函数
     * @param $arr_data
     * @param string $str_msg
     * @param int $int_code
     * @return array
     */
    public static function returnArray($arr_data, $str_msg = 'success', $int_code = 0){
        return json_encode(array(
            'code' => $int_code,
            'msg' => $str_msg,
            'data' => $arr_data
        ));
    }

}