    <!-- main container -->
    <div class="content">
      
        <div class="container-fluid">
            <div id="pad-wrapper" class="users-list">
                <div class="row-fluid header">
                    <h3>用户列表</h3>
                    <div class="span10 pull-right">
                    </div>
                </div>

                <!-- Users table -->
                <div class="row-fluid table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="span2">
                                    用户ID
                                </th>
                                <th class="span2">
                                    <span class="line"></span>用户名字
                                </th>
                                <th class="span2">
                                    <span class="line"></span>年龄
                                </th>
                                <th class="span2">
                                    <span class="line"></span>性别
                                </th>
                                <th class="span2">
                                    <span class="line"></span>电话
                                </th>
                                <th class="span2">
                                    <span class="line"></span>微信
                                </th>
                                <th class="span2">
                                    <span class="line"></span>操作
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($users as $user): ?>
                        <!-- row -->
                        <tr id="user<?= $user->id ?>">
                            <td><?php echo $user->id; ?></td>
                            <td><?php echo $user->name; ?></td>
                            <td><?php echo $user->age; ?></td>
                            <td><?php echo $user->sex==1?"男":"女"; ?></td>
                            <td><?php echo $user->tel; ?></td>
                            <td><?php echo $user->weixin; ?></td>
                            <td class="align-right" id="userLock<?= $user->id ?>">
                            <?php if ($user->status == 0){ ?>
                                <a class="lock" data-id="<?= $user->id ?>">锁定</a>
                            <?php }else{ ?>
                                已锁定
                            <?php } ?>
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
        $('.lock').click(function(){
            var userId = $(this).attr('data-id');

            $.ajax({
                type: 'get',
                url: '/api/user/change-status',
                data: {
                    userId:userId
                },
                dataType: 'JSON',
                success: function (ReturnData) {
                    if(ReturnData.code == 0){
                        $('#userLock'+userId).html('已锁定');

                        setTimeout(function(){
                            alert('锁定成功');
                        },200);
                    }else {
                        alert(ReturnData.msg);
                    }


                }
            });
        });

    </script>
