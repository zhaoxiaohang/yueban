<?php
$session_user = \Yii::$app ->session -> get('user',null);

?>
<!DOCTYPE html>
<html lang="en">
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>结伴同行 - 相结结伴同游 一起去旅行吧</title>
    <meta name="HandheldFriendly" content="true">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Le styles -->


    <link rel="shortcut icon" href="http://yueban.com/public/img/avatar32.png">
    <link href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/assets/index/css/main.css">
</head>
<body>
<div>
    <!--顶层nav-->
    <div class="top">
        <div>
            <a class="brand" href="/">
                <span style="font-size: large">结伴同行</span>
            </a>
        </div>

        <div>
            <ul class="nav">
                <li class="map-search">
                    <form action="" autocomplete="off">
                        <input id="queryText" type="text" name="q" placeholder="&nbsp;搜索感兴趣的地点" value="<?= isset($_GET['q'])?$_GET['q']:''?>">
                        <a class="brand" id="query">
                            <img src="http://pic.sucaibar.com/pic/201307/16/33fce1b9d9_24.png"  />
                        </a>
                    </form>
                </li>
            </ul>
        </div>

        <div>
            <?php if(is_null($session_user)):?>
                <a class="login-btn" data-toggle="modal" data-target="#myModal">登陆</a>
                <a class="register-btn" data-toggle="modal" data-target="#myModal">注册</a>
            <?php else: ?>
                您好，欢迎你 <a href="/user/detail/<?= $session_user['id'] ?>"><?= $session_user['name'] ?></a>&nbsp;&nbsp;
                <a href="<?php echo yii\helpers\Url::to(['api/user/logout'])?>">退出</a>
            <?php endif; ?>
        </div>
    </div>
    <!--模态框-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <!--<h4 class="modal-title" id="myModalLabel">登陆</h4>  -->
                </div>

                <div class="modal-body">
                        <div class="section-body">
                            <ul class="nav nav-tabs">
                                <li class="active-a"><a href="#login-form" data-toggle="tab">已有账号</a></li>
                                <li  class="active-b"><a href="#register-form" data-toggle="tab">注册新账号</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="login-form">
                                    <!-- <div class="alert alert-error fade">错误信息：</div> -->
                                        <div class="control-group abc ">
                                            <label class="control-label" for="tel">手机号:</label>
                                            <div class="controls">
                                                <input id="login-tel" type="text" class="tel" name="tel"  placeholder="作为登陆结伴的账号">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="password" >密码:</label>
                                            <div class="controls">
                                                <input id="login-password" type="password" class="password" name="password" placeholder="作为登陆结伴的密码">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <button id="login-btn" type="submit" class="btn btn-danger btn-sm btn-block" data-loading-text="登陆中..." style="width: 160px;">登陆</button>
                                            </div>
                                        </div>
                                </div>
                                <div class="tab-pane" id="register-form">
                                        <!--<div class="alert alert-error fade">错误信息：</div>-->
                                        <div class="control-group">
                                            <label class="control-abc" for="register-tel">手机号:</label>
                                            <div class="controls">
                                                <input type="text" name="tel" id="register-tel" placeholder="作为登陆结伴的账号">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-abc" for="register-password">输入密码:</label>
                                            <div class="controls">
                                                <input type="password" name="password" id="register-password" placeholder="3到15位字母和数字组合">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-abc" for="register-password1">重复密码:</label>
                                            <div class="controls">
                                                <input type="password" name="repassword" id="register-password1" placeholder="重复密码">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-abc" for="register-name">设置昵称:</label>
                                            <div class="controls">
                                                <input type="text" name="username" id="register-name" placeholder="给自己取个响亮的名字~">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <button id="register-btn" type="submit" class="btn btn-danger btn-sm btn-block" data-loading-text="加入结伴..." style="width: 180px;">加入结伴</button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <div class="top-next"></div>
    <!--中间内容-->
    <div class="mid">
        <?= $content ?>
    </div>
    <!--底部-->
    <div class="footer">
        <div class="footer-ab">
            <div class="footer-a">
                <dl>
                    <dt>国内导航：</dt>
                    <dd><a href="/map?q=西藏">西藏</a></dd>
                    <dd><a href="/map?q=云南">云南</a></dd>
                    <dd><a href="/map?q=四川">四川</a></dd>
                    <dd><a href="/map?q=重庆">重庆</a></dd>
                    <dd><a href="/map?q=贵州">贵州</a></dd>

                    <dd><a href="/map?q=广西">广西</a></dd>
                    <dd><a href="/map?q=广东">广东</a></dd>
                    <dd><a href="/map?q=海南">海南</a></dd>
                    <dd><a href="/map?q=深圳">深圳</a></dd>
                    <dd><a href="/map?q=香港">香港</a></dd>
                    <dd><a href="/map?q=澳门">澳门</a></dd>

                    <dd><a href="/map?q=福建">福建</a></dd>
                    <dd><a href="/map?q=浙江">浙江</a></dd>
                    <dd><a href="/map?q=上海">上海</a></dd>
                    <dd><a href="/map?q=安徽">安徽</a></dd>
                    <dd><a href="/map?q=江苏">江苏</a></dd>
                    <dd><a href="/map?q=山东">山东</a></dd>

                    <dd><a href="/map?q=江西">江西</a></dd>
                    <dd><a href="/map?q=湖南">湖南</a></dd>
                    <dd><a href="/map?q=湖北">湖北</a></dd>
                    <dd><a href="/map?q=河南">河南</a></dd>

                    <dd><a href="/map?q=河北">河北</a></dd>
                    <dd><a href="/map?q=北京">北京</a></dd>
                    <dd><a href="/map?q=天津">天津</a></dd>
                    <dd><a href="/map?q=内蒙古">内蒙古</a></dd>
                    <dd><a href="/map?q=山西">山西</a></dd>

                    <dd><a href="/map?q=辽宁">辽宁</a></dd>
                    <dd><a href="/map?q=吉林">吉林</a></dd>
                    <dd><a href="/map?q=黑龙江">黑龙江</a></dd>

                    <dd><a href="/map?q=陕西">陕西</a></dd>
                    <dd><a href="/map?q=宁夏">宁夏</a></dd>
                    <dd><a href="/map?q=甘肃">甘肃</a></dd>
                    <dd><a href="/map?q=青海">青海</a></dd>
                    <dd><a href="/map?q=新疆">新疆</a></dd>
                </dl>
            </div>
            <div class="footer-b">
                <dl>
                    <dt>国外导航：</dt>
                    <dd><a href="/map?q=马来西亚">马来西亚</a></dd>
                    <dd><a href="/map?q=菲律宾">菲律宾</a></dd>
                    <dd><a href="/map?q=印度">印度</a></dd>
                    <dd><a href="/map?q=泰国">泰国</a></dd>
                    <dd><a href="/map?q=尼泊尔">尼泊尔</a></dd>
                    <dd><a href="/map?q=越南">越南</a></dd>
                    <dd><a href="/map?q=柬埔寨">柬埔寨</a></dd>
                    <dd><a href="/map?q=缅甸">缅甸</a></dd>
                    <dd><a href="/map?q=德国">德国</a></dd>
                    <dd><a href="/map?q=法国">法国</a></dd>
                    <dd><a href="/map?q=意大利">意大利</a></dd>
                    <dd><a href="/map?q=加拿大">加拿大</a></dd>
                    <dd><a href="/map?q=美国">美国</a></dd>
                    <dd><a href="/map?q=巴西">巴西</a></dd>
                </dl>
            </div>
        </div>
    </div>
    <script>
        //注册
        $('#register-btn').click(function(){
            var tel = $('#register-tel').val();
            var password = $('#register-password').val();
            var password1 = $('#register-password1').val();
            var name = $('#register-name').val();
            if(password != password1){
                alert('两次密码不一致');
                return;
            }
            $.ajax({
                type: 'post',
                url: '/api/user/reg',
                data: {
                    tel:tel,
                    password:password,
                    name:name
                },
                dataType: 'JSON',
                success: function (ReturnData) {
                    if(ReturnData.code == 0){
                        location.href='/user/update';
                    }else {
                        alert(ReturnData.msg);
                    }
                }
            });
        });


        //登录
        $('#login-btn').click(function(){
            var tel = $('#login-tel').val();
            var password = $('#login-password').val();

            $.ajax({
                type: 'post',
                url: '/api/user/login',
                data: {
                    tel:tel,
                    password:password
                },
                dataType: 'JSON',
                success: function (ReturnData) {
                    if(ReturnData.code == 0){
                        location.reload();
                    }else {
                        alert(ReturnData.msg);
                    }
                }
            });
        });

        $('#query').click(function(){
            var value = $('#queryText').val();
            if(value == null || value == ''){
                location.href ='/';
            }else {
                location.href ='/?q='+value;
            }
        });
    </script>
</body>
</html>