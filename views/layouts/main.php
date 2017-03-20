<?php
$session_user = \Yii::$app ->session -> get('user',null);

?>
<!DOCTYPE html>
<html lang="en">
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>结伴同行 - 相约结伴同游 一起去旅行吧</title>
    <meta name="HandheldFriendly" content="true">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Le styles -->


    <link rel="shortcut icon" href="http://yueban.com/public/img/avatar32.png">
    <link href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/assets/index/css/index.css">
</head>
<body>
<div>
    <!--顶层nav-->
    <div class="top">
        <div>
            <a class="brand" href="/">
                <img src="http://yueban.com/public/img/logo.png" width="84" height="29" />
            </a>
        </div>

        <div>
            <ul class="nav">
                <li class="map-search">
                    <form action="" autocomplete="off">
                        <input type="text" name="w" placeholder="&nbsp;搜索感兴趣的地点">
                        <button class="btn btn-link"><i class="icon-search"></i>搜索</button>
                    </form>
                </li>
            </ul>
        </div>

        <div>
            <?php
            if(is_null($session_user)){
               ?>
                <a class="login-btn" data-toggle="modal" data-target="#myModal">登陆</a>
                <a class="register-btn" data-toggle="modal" data-target="#myModal">注册</a>
                <?php
            }else{
                ?>
                <a class="login-btn" data-toggle="modal" data-target="#myModal"><?= $session_user['name'] ?></a>
                <a class="register-btn" data-toggle="modal" data-target="#myModal">退出</a>
                <?php
            }
            ?>


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
                    <form action="" >
                        <div class="section-body">
                            <ul class="nav nav-tabs">
                                <li class="active-a"><a href="#login-form" data-toggle="tab">已有账号</a></li>
                                <li  class="active-b"><a href="#register-form" data-toggle="tab">注册新账号</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="login-form">
                                    <form class="form-horizontal form-login" action="/user/login" method="post">
                                        <!-- <div class="alert alert-error fade">错误信息：</div> -->
                                        <div class="control-group abc ">
                                            <label class="control-label" for="username">账号:</label>
                                            <div class="controls">
                                                <input type="text" class="username" name="username"  placeholder="作为登陆约伴的账号">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="password" >密码:</label>
                                            <div class="controls">
                                                <input type="password" class="password" name="password" placeholder="作为登陆约伴的密码">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <button type="submit" class="btn btn-danger btn-sm btn-block" data-loading-text="登陆中..." style="width: 160px;">登陆</button>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls gray-text">忘记密码了吗？
                                                <a href="/forget" class="text-info">找回密码</a>。
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="register-form">
                                    <form class="form-horizontal form-register" autocomplete="off" action="#" method="post">
                                        <!--<div class="alert alert-error fade">错误信息：</div>-->
                                        <div class="control-group">
                                            <label class="control-abc" for="inputEmail">电子邮箱:</label>
                                            <div class="controls">
                                                <input type="email" name="email" id="inputEmail" placeholder="作为登陆约伴的账号">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-abc" for="inputPassword">输入密码:</label>
                                            <div class="controls">
                                                <input type="password" name="password" id="inputPassword" placeholder="3到15位字母和数字组合">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-abc" for="reInputPassword">重复密码:</label>
                                            <div class="controls">
                                                <input type="password" name="repassword" id="reInputPassword" placeholder="重复密码">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-abc" for="inputNickname">设置昵称:</label>
                                            <div class="controls">
                                                <input type="text" name="username" id="inputNickname" placeholder="给自己取个响亮的名字~">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <button type="submit" class="btn btn-danger btn-sm btn-block" data-loading-text="加入约伴..." style="width: 180px;">加入约伴</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
        <div class="rel">
            <div class="copyright">

            </div>
            <div class="friend-links">

            </div>
        </div>
    </div>
</body>
</html>