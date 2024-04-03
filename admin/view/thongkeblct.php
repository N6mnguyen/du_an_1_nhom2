<?php 
$ss =show_thong_keblct($tk_blct);
?>
<div class="main-content">
    <h3 class="title-page">BINH LUAN: <?=$tk_blct!=[]?$tk_blct[0]['Nsanpham']:'' ?></h3>
    <table id="example" class="table table-striped" style="width: 100%">
        <thead>
            <tr>
                <th>ID BINH LUAN</th>
                <th>ANH SAN PHAM</th>
                <th>ID USER</th>
                <th>Tên USER</th>
                <th>NOI DUNG BINH LUAN</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        
        <tbody>
            <?= $ss ?>
        </tbody>
        <tfoot>
            <tr>
                <th>ID BINH LUAN</th>
                <th>ANH SAN PHAM</th>
                <th>ID USER</th>
                <th>Tên USER</th>
                <th>NOI DUNG BINH LUAN</th>
                <th>Thao Tác</th>
            </tr>
        </tfoot>
    </table>
</div>
</div>
</div>
<script src="assets/js/main.js"></script>
<script>
    new DataTable("#example");
</script>
