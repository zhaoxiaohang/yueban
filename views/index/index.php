<?php

?>
<!--中间内容-->
<link rel="stylesheet" href="/assets/index/css/index.css">
<div class="mid-f">
<!--    左边部分-->
    <div class="mid-f-a">
<!--        头部选项条-->
        <div class="hotPlace">
            <div>热门城市：</div>
            <ul>
                <li><a href="">全部（<?=array_sum($hotPlace)?>）</a></li>
                <?php
                foreach($hotPlace as $key => $num){
                    ?>
                    <li><a class="hotPlace1" data-value="<?= $key ?>"><?= $key ?>（<?= $num ?>）</a></li>
                    <?php
                }
                ?>


            </ul>
        </div>
        <div class="goTime">
            <div>出发时间：</div>
            <ul>
                <li><a class='goTime1' data-value="0">全部</a></li>
                <li><a class='goTime1' data-value="1">今天</a></li>
                <li><a class='goTime1' data-value="2">一个月内</a></li>
                <li><a class='goTime1' data-value="3">3个月内</a></li>
                <li><a class='goTime1' data-value="4">5个月内</a></li>
                <li><a class='goTime1' data-value="5">5个月以上</a></li>
            </ul>
        </div>
        <div class="order-publish">
            <div class="order">
                <span class="order1" data-value="1">最热结伴</span>
                <span class="order1" data-value="2">最新发布</span>
                <span class="order1" data-value="3">即将出发</span>
            </div>
            <div class="publish">
                <a href="<?php echo yii\helpers\Url::to(['plan/publish']) ?>">
                    <button class="button-a" data-toggle="modal" data-target="#myModal2">发起结伴</button>
                    <i class="i-add"></i>
                </a>
            </div>

        </div>
    </div>

    <div class="mid-f-b">
<!--        帖子部分-->
        <div class="msg">
<!--            帖子内容部分-->
            <div id="together-list">
                <ul>
                    <?php
                        foreach($planList as $plan){
                            ?>
                            <li class="item">
                                <div class="user-head">
                                    <!--                            头像和发布者名字-->
                                    <div>
                                        <a href="/user/detail/<?= $plan['user_id'] ?>">
                                            <img class="head-img" src="/assets/index/img/head.gif" alt="用户头像">
                                        </a>
                                    </div>
                                    <div class="name-a">
                                        <span><a href="/user/detail/<?= $plan['user_id'] ?>" ><?= $plan['user_name'] ?></a></span>
                                        <span>浏览（<?= $plan['view_time'] ?>）</span>
                                    </div>
                                </div>

                                <div class="item-info">
                                    <div class="info-a">
                                        <div class="info-title">
                                            <!--                                    标题和部分信息-->
                                            <a href="/plan/detail/<?= $plan['id'] ?>">
                                                <span><?= $plan['title'] ?></span>
                                            </a>
                                            <p class="info-abc">
                                                出发地->目的地：
                                                <span><?= $plan['start_place'] ?></span>->
                                                <span><?= $plan['destination'] ?></span> |
                                                旅行天数：<span><?= $plan['days'] ?></span>天 |
                                                期望人数：<span><?= $plan['person_limit'] ?></span>人
                                            </p>
                                        </div>
                                        <div class="info-days">
                                            <!--                                    距离出发还有的天数-->
                                            <b><?= $plan['goDays'] ?></b>&nbsp;&nbsp;&nbsp;&nbsp;天后出发
                                        </div>
                                    </div>
                                    <div class="info-b">
                                        <!--                                详细介绍-->
                                        <p class="info-bcd">
                                            <?= $plan['details'] ?>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <?php
                        }
                    ?>
                    <li class="item">

                            <div class="user-head">
    <!--                            头像和发布者名字-->
                                <div>
                                    <a href="">
                                        <img class="head-img" src="/assets/index/img/head.gif" alt="用户头像">
                                    </a>
                                </div>
                                <div class="name-a">
                                    <span><a href="" >用户名</a></span>
                                    <span>浏览（1）</span>
                                </div>
                            </div>

                        <div class="item-info">
                            <div class="info-a">
                                <div class="info-title">
<!--                                    标题和部分信息-->
                                    <a href="">
                                        <span>2017南法普罗旺斯-圣十字湖休闲深度游普罗旺斯-圣十字湖休闲普罗旺斯-圣十字湖休闲普罗旺斯-圣十字湖休闲</span>
                                    </a>
                                    <p class="info-abc">
                                        目的地：<span>法国</span> |
                                        旅行天数：<span>10</span>天 |
                                        期望人数：<span>5</span>人
                                    </p>
                                </div>
                                <div class="info-days">
<!--                                    距离出发还有的天数-->
                                    <b>19</b>&nbsp;&nbsp;&nbsp;&nbsp;天后出发
                                </div>
                            </div>
                            <div class="info-b">
<!--                                详细介绍-->
                                <p class="info-bcd">
                                    普罗旺斯的薰衣草花海只盛开6-8月这一点点时间。。。
                                    时间：楼主7月初考完试，出发时间7月10-19号都可以，10-14天左右休闲度假游。
                                    方式：自驾+火车
                                    出发地点：打算直接阿维尼翁见面取车自驾！打算直接阿维尼翁见面取车自驾打算直接阿维尼翁见面取车自驾打算直接阿维尼翁见面取车自驾打算直接阿维尼翁见面取车自驾！！巴黎见坐火车再去阿维尼翁也可以！！！

                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
                
            </div>
        </div>
        <div class="pageBar">
<!--            分页条-->
            <div>
                <a href="" class="pre-a">上一页</a>
                <span class="num">
                    <span class="page-index"><?= $pageInfo['pageIndex'] ?></span>/
                    <span class="page-total"><?= $pageInfo['pageTotal'] ?></span>
                </span>
                <a href="" class="nex-a">下一页</a>
            </div>
        </div>

    </div>
</div>
<div class="mid-r">
<!--    右边部分-->
    <div class="mid-r-a">
<!--        系统通知框-->
        <span class="sys-title"><b>系统通知</b>：</span>
        <div class="sys-notice">
            <ul>
                <li><a href=""><i class="dian"></i>用户张三收藏了您的出行计划</a></li>
                <li><a href=""><i class="dian"></i>用户李四关注了您</a></li>
                <li><a href=""><i class="dian"></i>用户张三申请结伴</a></li>
                <li><a href=""><i class="dian"></i>用户李四申请结伴</a></li>
                <li><a href=""><i class="dian"></i>管理员关闭了您的结伴信息</a></li>
            </ul>
        </div>
        <div>
            <span class="more-a"><a href="" class="more-b">more>>></a></span>
        </div>
    </div>
    <div class="mid-r-b">
<!--        用户收藏框-->
        <span class="my-collection-title"><b>我的收藏</b>：</span>
        <div class="my-collection">
            <ul>
                <li><a href=""><i class="dian"></i>圣十字湖休闲深度游</a></li>
                <li><a href=""><i class="dian"></i>一起去西藏</a></li>
                <li><a href=""><i class="dian"></i>一起去北京</a></li>
                <li><a href=""><i class="dian"></i>寻觅小伙伴4.2-4.8出游捷克小镇</a></li>
                <li><a href=""><i class="dian"></i>一起去香港</a></li>
                <li><a href=""><i class="dian"></i>测试标题	</a></li>
            </ul>
        </div>
        <div>
            <span class="more-a"><a href=""  class="more-b">more>>></a></span>
        </div>
    </div>
</div>
<script>
    var hotPlace = <?= $condition['hotPlace'] ?>;
    var goTime = <?= $condition['goTime'] ?>;
    var orderBy = <?= $condition['orderBy'] ?>;




</script>
