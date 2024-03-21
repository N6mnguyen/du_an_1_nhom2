<?php
require_once 'pdo.php';

// /**
//  * Thêm loại mới
//  * @param String $ten_danhmuc là tên loại
//  * @throws PDOException lỗi thêm mới
//  */
function danhmuc_insert($ten_danhmuc,$trangthai,$trangthai1){
    $sql = "INSERT INTO danhmuc(name,home,stt) VALUES(?,?,?)";
    pdo_execute($sql, $ten_danhmuc,$trangthai,$trangthai1);
}
// /**
//  * Cập nhật tên loại
//  * @param int $ma_danhmuc là mã loại cần cập nhật
//  * @param String $ten_danhmuc là tên loại mới
//  * @throws PDOException lỗi cập nhật
//  */
function danhmuc_update($ma_danhmuc, $ten_danhmuc){
    $sql = "UPDATE danhmuc SET name=? WHERE ma_danhmuc=?";
    pdo_execute($sql, $ten_danhmuc, $ma_danhmuc);
}
// /**
//  * Xóa một hoặc nhiều loại
//  * @param mix $ma_danhmuc là mã loại hoặc mảng mã loại
//  * @throws PDOException lỗi xóa
//  */
function danhmuc_delete($ma_danhmuc){
    $sql = "DELETE FROM danhmuc WHERE id=?";
    if(is_array($ma_danhmuc)){
        foreach ($ma_danhmuc as $ma) {
            pdo_execute($sql, $ma);
        }
    }
    else{
        pdo_execute($sql, $ma_danhmuc);
    }
}
// /**
//  * Truy vấn tất cả các loại
//  * @return array mảng loại truy vấn được
//  * @throws PDOException lỗi truy vấn
//  */
function danhmuc_all(){
    $sql = "SELECT * FROM danhmuc";
    return pdo_query($sql);
}
function dmadmin($limit, $limit2){
    $sql = "SELECT * FROM danhmuc LIMIT $limit, $limit2";
    return pdo_query($sql);
}
function danhmuc_show(){
    $sql = "SELECT * FROM danhmuc WHERE home=1 AND stt =1";
    return pdo_query($sql);
}
function showdm ($dsdm){
    $html_dm='';
    foreach ($dsdm as $dm) {
        extract($dm);
        $link='index.php?pg=sanpham&iddm='.$id;
        $html_dm.='<a href="'.$link.'">'.$name.'</a>';
    }
    return $html_dm;
}
function get_name_dm($id){
    $sql = "SELECT name from danhmuc where id=?";
    return  pdo_query_value($sql,$id);
}

//admin
function sotrangdm($itemsPerPage){
    $sql = "SELECT COUNT(*) as total FROM danhmuc WHERE 1";
    $ww = pdo_query($sql);
    foreach ($ww as $a) {
        $total_pages = ceil($a['total'] / $itemsPerPage);
    }
    return $total_pages;
}
function showdm_admin_update ($dsdm,$iddm){
    $html_dm='';
    foreach ($dsdm as $dm) {
        extract($dm);
        if($id==$iddm) {
        $st='selected'; 
        } else {
            $st ="";
        }
        $link='index.php?pg=sanpham&iddm='.$id;
        $html_dm.=' <option value="'.$id.'" '.$st.' >'.$name.'</option>';
    }
    return $html_dm;
}

function showdm_admin($dsdm){
    $html_dm='';
    foreach ($dsdm as $dm) {
        extract($dm);
        $link='index.php?pg=sanpham&iddm='.$id;
        $html_dm.=' <option value="'.$id.'" >'.$name.'</option>';
    }
    return $html_dm;
}

function show_name_danhmuc($name_dm){
        $html_namedm='';
        foreach ($name_dm as $dm) {
            extract($dm);
            $link='index.php?pg=sanpham&iddm='.$id;
            $html_namedm.='<li><a href="'.$link.'">'.$name.'</a></li>';
        }
        return $html_namedm;
}

function showdm_admin_list($dsdm){
    $html_dm='';
    $i = 1 ;
    foreach ($dsdm as $dm) {
        extract($dm);
        $link='index.php?pg=sanpham&iddm='.$id;
        $html_dm.=' 
        <tr>
        <td>'.$i.'</td>
        <td>'.$name.'</td>
        <td>
            <a href="admin.php?pg=updatedm&id='.$id.'" class="btn btn-warning"><i
            class="fa-solid fa-pen-to-square"></i> Sửa</a>
            <a href="admin.php?pg=deletedm&id='.$id.'" class="btn btn-danger"><i
            class="fa-solid fa-trash"></i> Xóa</a>
        </td>
        </tr>
      ';
      $i++;
    }
    return $html_dm;
}
 
function update_danhmuc($id,$name,$trangthai,$trangthai1){
    $sql = "UPDATE danhmuc SET name=?,home=?,stt=? WHERE id=?";
    pdo_execute($sql, $name,$trangthai,$trangthai1,$id);

}




// /**
//  * Truy vấn một loại theo mã
//  * @param int $ma_danhmuc là mã loại cần truy vấn
//  * @return array mảng chứa thông tin của một loại
//  * @throws PDOException lỗi truy vấn
//  */
function danhmuc_select_by_id($id){
    $sql = "SELECT * FROM danhmuc WHERE id=?";
    return pdo_query_one($sql, $id);
}
// /**
//  * Kiểm tra sự tồn tại của một loại
//  * @param int $ma_danhmuc là mã loại cần kiểm tra
//  * @return boolean có tồn tại hay không
//  * @throws PDOException lỗi truy vấn
//  */
// function danhmuc_exist($ma_danhmuc){
//     $sql = "SELECT count(*) FROM danhmuc WHERE ma_danhmuc=?";
//     return pdo_query_value($sql, $ma_danhmuc) > 0;
// }