<!-- main container -->
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div class="row-fluid header">
                <h3>结伴信息列表</h3>
                <div class="span10 pull-right">
                </div>
            </div>

            <!-- Users table -->
            <div class="row-fluid table">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="span2">
                                结伴信息ID
                            </th>
                            <th class="span2">
                                <span class="line"></span>标题
                            </th>
                            <th class="span2">
                                <span class="line"></span>出发地
                            </th>
                            <th class="span2">
                                <span class="line"></span>目的地
                            </th>
                            <th class="span2">
                                <span class="line"></span>发布人
                            </th>
                            <th class="span2">
                                <span class="line"></span>发布时间
                            </th>
                            <th class="span2">
                                <span class="line"></span>操作
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($plans as $plan){ ?>
                    <!-- row -->
                    <tr id="plan<?= $plan->id ?>">
                        <td><?php echo $plan->id; ?></td>
                        <td><?php echo $plan->title; ?></td>
                        <td><?php echo $plan->start_place; ?></td>
                        <td><?php echo $plan->destination; ?></td>
                        <td><a href=""><?php echo $plan->user_name; ?></a></td>
                        <td><?php echo $plan->release_time; ?></td>
                        <td class="align-right" id="planClose<?= $plan->id ?>">
                            <?php if ($plan->status == 1){ ?>
                                <a class="close" data-id="<?= $plan->id ?>">关闭</a>
                            <?php }else{ ?>
                                已关闭
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                   </tbody>
                </table>
                <?php
                    if (Yii::$app->session->hasFlash('info')) {
                        echo Yii::$app->session->getFlash('info');
                    }
                ?>
            </div>
            <div class="pagination pull-right">
                <?php echo yii\widgets\LinkPager::widget(['pagination' => $page, 'prevPageLabel' => '&#8249;', 'nextPageLabel' => '&#8250;']); ?>
            </div>
            <!-- end users table -->
        </div>
    </div>
</div>
<!-- end main container -->
<script>
    $('.close').click(function(){
        var planId = $(this).attr('data-id');

        $.ajax({
            type: 'get',
            url: 'close',
            data: {
                planId :planId
            },
            dataType: 'JSON',
            success: function (ReturnData) {
                if(ReturnData.code = 0){
                    $('#planClose'+planId).html('已关闭');

                    setTimeout(function(){
                        alert('已关闭');
                    },200);
                }else {
                    alert(ReturnData.msg);
                }


            }
        });
    });

</script>
