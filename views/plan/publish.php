<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/15
 * Time: 22:33
 */
?>
<link rel="stylesheet" href="/assets/index/css/publish.css">
<div class="wrapper mod-publish">
    <h3 class="mod-title">发起结伴</h3>
    <div class="bd">
        <div class="item item-title">
            <span class="label"><em>*</em>活动标题</span>
            <div class="ui-input inp-title">
                <input id="title" type="text"  class="_j_title " placeholder="一句话开始一段靠谱旅程"/>
            </div>
        </div>
        <div class="item item-contact">
            <span class="label"><em>*</em>联系方式</span>
            <div class="ui-input inp-contact" style="width: 250px;">
                <span>手机/</span>
                <input id="tel" type="text" value="<?= $user['tel'] ?>" class="_j_phone have" style="width: 200px;">
            </div>
        </div>
        <div class="item item-place _j_select_from">
            <span class="label"><em>*</em>目的地</span>
            <div class="ui-input inp-place _j_from_mdd_list">
                <input id="destination" type="text" class="_j_from_mdd " id="place_to">
            </div>
            <ul class="_j_from_mdd_ul result hide" style="height: 150px;top: 368px;"></ul>
        </div>
        <div class="item item-place _j_select_from">
            <span class="label"><em>*</em>出发地</span>
            <div class="ui-input inp-place _j_from_mdd_list">
                <input id="start_place" type="text" class="_j_from_mdd " >
            </div>
            <ul class="_j_from_mdd_ul result hide" style="height: 150px;top: 368px;"></ul>
        </div>
        <div class="item item-date">
            <span class="label"><em>*</em>出发时间</span>
            <div class="ui-input inp-date">
                <input id="start_time" type="text" class="_j_start_date "placeholder="例：2017-04-20"><i class="icon-date _j_date"></i></div>
        </div>
        <div class="item item-days">
            <span class="label"><em>*</em>活动天数</span>
            <div class="ui-input inp-num">
                <input id="days" type="text" class="_j_count_day "></div>天
        </div>
        <div class="item item-days">
            <span class="label"><em>*</em>限制人数</span>
            <div class="ui-input inp-num"><input type="text" id="person_limit" class="_j_hope_num "></div>人
        </div>
        <div class="item item-notes">
            <span class="label"><em>*</em>结伴描述</span>
            <div class="ui-textarea">
            <textarea id="details" class="_j_description " style="width:856px;height: 244px;" placeholder="尽可能详细将你的意向说清楚，除非你愿意尝试下边的：
a.如果你想结伴无人问津
b.如果你想浪费更多时间在逐个沟通相同问题
c.如果你想让旅途遇到猪队友"></textarea>
            </div>
        </div>
        <div class="item item-action">
            <a id="plan_publish" class="btn-submit _j_submit">发表结伴</a>
        </div>
    </div>
</div>
<script>
    function check(date){
        var a = /^(\d{4})-(\d{2})-(\d{2})$/;
        if (!a.test(date)) {
            alert("日期格式不正确!");
            return false
        }
        else
            return true
    }
    //发布
    $('#plan_publish').click(function(){
        var title = $('#title').val();
        var tel = $('#tel').val();
        var start_place = $('#start_place').val();
        var start_time = $('#start_time').val();
        var destination = $('#destination').val();
        var days = $('#days').val();
        var person_limit = $('#person_limit').val();
        var details = $('#details').val();

        var data = {
            title:title,
                tel:tel,
                start_place:start_place,
                start_time:start_time,
                destination:destination,
                days:days,
                person_limit:person_limit,
                details:details
        };
        $.ajax({
            type: 'post',
            url: '/api/plan/publish',
            data: data,
            dataType: 'JSON',

            success: function (ReturnData) {
                if(ReturnData.code == 0){
                    location.href='/plan/detail/'+ReturnData.data;
                }else {
                    alert(ReturnData.msg);
                }
            }
        });
    });

</script>
