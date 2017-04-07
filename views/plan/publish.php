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
            <div class="ui-input inp-title"><input type="text" value="" class="_j_title " placeholder="一句话开始一段靠谱旅程"/></div>
        </div>
        <div class="item item-contact">
            <span class="label"><em>*</em>联系方式</span>
            <div class="ui-input inp-contact" style="width: 240px;">
                <span>手机/</span>
                <input type="text" value="15537325795" class="_j_phone have" style="width: 160px;">
            </div>
            <div class="ui-input inp-contact"style="width: 240px">
                <span>QQ/</span>
                <input type="text" class="_j_qq" style="width: 160px;">
            </div>
            <div class="ui-input inp-contact inp-last" style="width: 240px;">
                <span>微信/</span>
                <input type="text" class="_j_weixin" style="width: 160px;" >
            </div>
            <span style="margin-left: 10px; ">(可选填)</span>
        </div>
        <div class="item item-place _j_select_go">
            <span class="label"><em>*</em>目的地</span>
            <div class="add-place clearfix _j_go_mdd_list">
                <input type="text" id="_j_go_mdd" class="_j_go_mdd " placeholder="输入并选择目的地">
            </div>
            <ul class="_j_go_mdd_ul result hide" style="height: 150px;"></ul>
        </div>
        <div class="item item-place _j_select_from">
            <span class="label"><em>*</em>出发地</span>
            <div class="ui-input inp-place _j_from_mdd_list">
                <input type="text" data-mddid="" value="" class="_j_from_mdd " id="_j_from_mdd" placeholder="输入并选择出发地">
            </div>
            <ul class="_j_from_mdd_ul result hide" style="height: 150px;top: 368px;"></ul>
        </div>
        <div class="item item-date">
            <span class="label"><em>*</em>出发时间</span>
            <div class="ui-input inp-date">
                <input type="text" maxlength="0" class="_j_start_date " value="" placeholder="出发日期"><i class="icon-date _j_date"></i><input type="text" class="_j_start_time" style="width: 240px;height: 32px;position: relative;left: -270px;top: 0px;opacity: 0"/></div>
        </div>
        <div class="item item-days">
            <span class="label"><em>*</em>活动天数</span>
            <div class="ui-input inp-num"><input type="text" value="" class="_j_count_day "></div>天
        </div>
        <div class="item item-days">
            <span class="label"><em>*</em>限制人数</span>
            <div class="ui-input inp-num"><input type="text" value="" class="_j_hope_num "></div>人
        </div>
        <div class="item item-notes">
            <span class="label"><em>*</em>结伴描述</span>
            <div class="ui-textarea">
            <textarea class="_j_description " style="width:856px;height: 244px;" placeholder="尽可能详细将你的意向说清楚，除非你愿意尝试下边的：
a.如果你想结伴无人问津
b.如果你想浪费更多时间在逐个沟通相同问题
c.如果你想让旅途遇到猪队友"></textarea>
            </div>
        </div>
        <div class="item item-action">
            <a class="btn-submit _j_submit">发表结伴</a>
        </div>
    </div>
</div>
