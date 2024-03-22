<?php
if (is_array($us) && (count($us) > 0)) {
    extract($us);
}
?>
<div class="main-content">
    <h3 class="title-page">
        Quyền user:
    </h3>

    <form class="addPro" action="admin.php?pg=addrole" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="categories">Danh mục:</label>
            <select class="form-select" name="role" aria-label="Default select example">
                <option value="0" <?= $role == 0 ? 'selected' : '' ?>>Khách Hàng</option>
                <option value="1" <?= $role == 1 ? 'selected' : '' ?>>Quyền Admin</option>
            </select>
            <input type="hidden" name="id" value="<?= $id ?>">
        </div>
        <div class="form-group">
            <div class="form-group">
                <button type="submit" name="addus" class="btn btn-primary">Sửa Quyền</button>
            </div>
    </form>
</div>

<script>
    new DataTable('#example');
</script>
