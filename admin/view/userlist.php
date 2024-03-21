<?php 
$html_user = showdm_admin_user($user_list);
?>

<div class="main-content">
                <h3 class="title-page">
                    Thành viên
                </h3>
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Username</th>
                            <th>Địa chỉ</th>
                            <th>Địa chỉ nhận</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Số điện thoại nhận</th>
                            <th>Quyền</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?=$html_user?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Stt</th>
                            <th>Username</th>
                            <th>Địa chỉ</th>
                            <th>Địa chỉ nhận</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Số điện thoại nhận</th>
                            <th>Quyền</th>
                            <th>Thao Tác</th>
                        </tr>
                    </tfoot>
                </table>
                <?php 
        for ($i = 1; $i <= $sotrang; $i++) {
    ?>
        <button class="phantrang"><a class="nutphantrang" href='admin.php?pg=users&page=<?=$i?>'><?=$i?></a></button>
    <?php 

    }
    ?>
            </div>
        </div>
    </div>