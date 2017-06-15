<!-- main container -->
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div class="row-fluid header">
                <h3>管理员列表</h3>
                <div class="span10 pull-right">

                <a href="<?php echo yii\helpers\Url::to(['manage/reg']); ?>" class="btn-flat success pull-right">
                        <span>&#43;</span>
                        添加新管理员
                    </a>
                </div>
            </div>

            <!-- Users table -->
            <div class="row-fluid table">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="span2">
                                管理员ID
                            </th>
                            <th class="span2">
                                <span class="line"></span>管理员账号
                            </th>
                            <th class="span2">
                                <span class="line"></span>管理员邮箱
                            </th>
                            <th class="span2">
                                <span class="line"></span>操作
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($managers as $manager): ?>
                    <!-- row -->
                    <tr id="manager<?= $manager ->adminid ?>">
                        <td>
                            <?php echo $manager->adminid; ?>
                        </td>
                        <td>
                            <?php echo $manager->adminuser; ?>
                        </td>
                        <td>
                            <?php echo $manager->email; ?>
                        </td>
                        <td class="align-right">
                        <?php if ($manager->adminid != 1): ?>
                        <a class="managerDel" data-id="<?= $manager->adminid ?>">删除</a>
                        <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
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
    $('.managerDel').click(function(){
        var adminId = $(this).attr('data-id');

        $.ajax({
            type: 'get',
            url: 'del',
            data: {
                adminId:adminId
            },
            dataType: 'JSON',
            success: function (ReturnData) {
                if(ReturnData.code == 0){
                    $('#manager'+adminId).remove();
                }

                setTimeout(function(){
                    alert(ReturnData.msg);
                },200);
            }
        });
    });

</script>
