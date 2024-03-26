<?php
require_once 'pdo.php';
require 'global.php';
function sanpham_insert($name, $price, $iddm, $imgs, $size, $tien, $mota,$bestseller)
{
    $i = 0;
    $sql = "INSERT INTO sanpham(name, price,bestseller, iddm, mota) VALUES (?, ?, ?, ?,?)";
    $sanpham_id = pdo_execute_id($sql, $name, $price,$bestseller, $iddm, $mota);
    $sql2 = "INSERT INTO hinhsanpham(ten_hinh, masp) VALUES (?,?)";
    foreach ($imgs as $image) {
        pdo_execute($sql2, $image, $sanpham_id);
    }
    $sql3 = "INSERT INTO chitietsanpham(masp, price, kichthuoc) VALUES (?,?,?)";
    foreach ($size as $a) {
        pdo_execute($sql3, $sanpham_id, $tien[$i], $size[$i]);
        $i++;
    }
}
function sanpham_inser($name, $price, $iddm)
{
    $sql = "INSERT INTO sanpham(name, price,iddm) VALUES (?,?,?)";
    pdo_execute($sql, $name, $price, $iddm);
}

function sanpham_update($name, $price, $iddm, $id, $mota, $imgs, $idbienthe, $size, $tien, $imgold,$bestseller)
{
    // echo"<pre>";
    // print_r($idbienthe);
    // print_r($size);
    // print_r($tien);

    // echo "<pre>";
    // print_r($imgold);
    // echo "<pre>";
    // print_r($imgs);
    // echo $imgs[0];
    // die();
    $i = 0;
    $j = 0;
    $d = 10;
    $sql = "UPDATE sanpham SET name = ?, price = ?,bestseller=?, iddm = ?, mota = ? WHERE id = ?";
    pdo_execute($sql, $name, $price,$bestseller, $iddm, $mota, $id);
    $sql2 = "UPDATE hinhsanpham SET ten_hinh = ? WHERE ma_hinh = ?";
    $sql6 = "DELETE FROM hinhsanpham WHERE ma_hinh=?";
    $sql7 = "INSERT INTO hinhsanpham(ten_hinh, masp) VALUES (?,?)";
    if ($imgs[0] != '') {
        for ($j = 0; $j < $d; $j++) {

            if (isset($imgold[$j]['ma_hinh']) && isset($imgs[$j])) {
                pdo_execute($sql2, $imgs[$j], $imgold[$j]['ma_hinh']);
            }
            if (isset($imgold[$j]['ma_hinh']) && !isset($imgs[$j])) {
                pdo_execute($sql6, $imgold[$j]['ma_hinh']);
            }
            if (!isset($imgold[$j]['ma_hinh']) && isset($imgs[$j])) {
                pdo_execute($sql7, $imgs[$j], $imgold[0]['masp']);
            }

        }


    }

    $sql3 = "UPDATE chitietsanpham SET price = ?, kichthuoc = ? WHERE mactsp = ? AND masp =?";
    $sql4 = "INSERT INTO chitietsanpham(masp, price, kichthuoc) VALUES (?,?,?)";
    $sql8 = "DELETE FROM chitietsanpham WHERE mactsp=?";


    foreach ($size as $a) {
        if (isset($idbienthe[$i]['mactsp'])) {
            pdo_execute($sql3, $tien[$i], $size[$i], $idbienthe[$i]['mactsp'], $id);
        }
        if (!isset($idbienthe[$i]['mactsp'])) {
            pdo_execute($sql4, $id, $tien[$i], $size[$i]);
        }
        if($tien[$i]==''&&$size[$i]==''){
            pdo_execute($sql8, $idbienthe[$i]['mactsp']);
        }
        $i++;
    }

}

function sanpham_delete($id)
{
    echo $id;
    $sql0 = "DELETE FROM hinhsanpham WHERE masp=?";
    pdo_execute($sql0, $id);
    $sql1 = "DELETE FROM binhluan WHERE idpro=?";
    pdo_execute($sql1, $id);
    $sql2 = "DELETE FROM chitietsanpham WHERE masp=?";
    pdo_execute($sql2, $id);
    $sql = "DELETE FROM sanpham WHERE  id=?";
    pdo_execute($sql, $id);


}
function sanpham_dm($iddm)
{
    $sql = "SELECT * FROM sanpham WHERE iddm = $iddm";
    return pdo_query($sql);
}
function selectall_sanpham()
{
    $sql = "SELECT sanpham.id, sanpham.name, sanpham.price, sanpham.iddm,sanpham.bestseller, sanpham.mota, hinhsanpham.ma_hinh, hinhsanpham.ten_hinh
    FROM sanpham
    INNER JOIN hinhsanpham ON sanpham.id = hinhsanpham.masp";
    $result = pdo_query($sql);
    return $result;
}



// function get_dssp_new($limi)
// {
//     $sql = "SELECT sanpham.id, sanpham.name, sanpham.price, sanpham.iddm, sanpham.bestseller, sanpham.mota, hinhsanpham.ma_hinh, hinhsanpham.ten_hinh 
//     FROM sanpham
//     INNER JOIN hinhsanpham ON sanpham.id = hinhsanpham.masp
//     ORDER BY sanpham.id DESC
//     LIMIT " . $limi;
//     return pdo_query($sql);
// }





function get_dssp_lienquan($iddm, $id, $limi)
{
    $sql = "SELECT sanpham.id, sanpham.name, sanpham.price, sanpham.iddm, sanpham.bestseller, sanpham.mota, hinhsanpham.ma_hinh, hinhsanpham.ten_hinh
    FROM sanpham
    INNER JOIN hinhsanpham ON sanpham.id = hinhsanpham.masp
    WHERE iddm=? AND id<>? ORDER BY sanpham.id DESC limit " . $limi;
    return pdo_query($sql, $iddm, $id);
}

function get_dssp_best($limi)
{
    $sql = "SELECT sanpham.id, sanpham.name, sanpham.price, sanpham.iddm,sanpham.bestseller, sanpham.mota, hinhsanpham.ma_hinh, hinhsanpham.ten_hinh
    FROM sanpham
    INNER JOIN hinhsanpham ON sanpham.id = hinhsanpham.masp WHERE bestseller=1 ORDER BY id DESC limit " . $limi;
    return pdo_query($sql);
}
function get_dssp_view($limi)
{
    $sql = "SELECT * FROM sanpham ORDER BY view DESC limit " . $limi;
    return pdo_query($sql);
}
// sản phẩm admin
function get_dssp_new($limit, $limit2)
{
    $sql = "SELECT sanpham.id, sanpham.name, sanpham.price, sanpham.iddm, sanpham.bestseller, sanpham.mota, MIN(hinhsanpham.ma_hinh) AS ma_hinh, hinhsanpham.ten_hinh 
    FROM sanpham
    LEFT JOIN hinhsanpham ON sanpham.id = hinhsanpham.masp
    GROUP BY sanpham.id
    ORDER BY sanpham.id DESC
    LIMIT $limit, $limit2";

    return pdo_query($sql);
}

function get_dssp_newtrangchu($limit)
{
    $sql = "SELECT sanpham.id, sanpham.name, sanpham.price, sanpham.iddm, sanpham.bestseller, sanpham.mota, MIN(hinhsanpham.ma_hinh) AS ma_hinh, hinhsanpham.ten_hinh 
    FROM sanpham
    LEFT JOIN hinhsanpham ON sanpham.id = hinhsanpham.masp
    GROUP BY sanpham.id
    ORDER BY sanpham.id DESC
    LIMIT " . $limit;

    return pdo_query($sql);
}

function so_trang_admin($itemsPerPage)
{
    $sql = "SELECT COUNT(*) as total FROM sanpham WHERE 1";
    $ww = pdo_query($sql);
    foreach ($ww as $a) {
        $total_pages = ceil($a['total'] / $itemsPerPage);
    }
    return $total_pages;

}
function so_trangdh($itemsPerPage, $iduser){
    $sql = "SELECT COUNT(*) as total FROM bill WHERE iduser = $iduser";
    $ww = pdo_query($sql);
    foreach ($ww as $a) {
        $total_pages = ceil($a['total'] / $itemsPerPage);
    }
    return $total_pages;
}
function so_trang($itemsPerPage,$iddm,$min,$max,$kyw)
{
    $sql = "SELECT COUNT(*) as total FROM sanpham WHERE 1";

    if ($iddm!=='') {
        $sql.= " AND sanpham.iddm =$iddm" ;
    }

    if($min!=''&& $max==''){
        $sql.= " AND sanpham.price >=$min" ;
    }
    if ($kyw != "") {
        $sql .= " AND name like '%" . $kyw . "%'";

    }

    if($min==''&& $max!=''){
        $sql.= " AND sanpham.price <=$max" ;
    }

    if($min!=''&& $max!=''){
        $sql.= " AND sanpham.price >= $min AND sanpham.price <=$max" ;
    }
    $ww = pdo_query($sql);
    foreach ($ww as $a) {
        $total_pages = ceil($a['total'] / $itemsPerPage);
    }
    return $total_pages;
}

function get_dssp($kyw, $iddm, $limit, $limit2, $min, $max)
{

    $sql = "SELECT sanpham.id, sanpham.name, sanpham.price, sanpham.iddm,sanpham.bestseller, sanpham.mota, hinhsanpham.ma_hinh, hinhsanpham.ten_hinh
    FROM sanpham
    INNER JOIN hinhsanpham ON sanpham.id = hinhsanpham.masp WHERE 1";
    if ($iddm > 0) {
        $sql .= " AND iddm=" . $iddm;
    }
    if ($kyw != "") {
        $sql .= " AND name like '%" . $kyw . "%'";

    }
    if($min!=''&& $max==''){
        $sql.= " AND sanpham.price >=$min" ;
    }
    if($min==''&& $max!=''){
        $sql.= " AND sanpham.price <=$max" ;
    }
    if($min!=''&& $max!=''){
        $sql.= " AND sanpham.price >= $min AND sanpham.price <=$max" ;
    }
    $sql .= " ORDER BY id DESC limit $limit, $limit2";
    return pdo_query($sql);
}


function get_sp_by_id($id)
{
    $sql = "SELECT sanpham.id, sanpham.name, sanpham.price, sanpham.iddm,sanpham.bestseller, sanpham.mota, hinhsanpham.ma_hinh, hinhsanpham.ten_hinh
    FROM sanpham
    INNER JOIN hinhsanpham ON sanpham.id = hinhsanpham.masp WHERE sanpham.id= $id";
    return pdo_query_one($sql);
}
function get_sp__by_id($id)
{
    $sql = "SELECT sanpham.id, sanpham.name, sanpham.price, sanpham.iddm, sanpham.bestseller, sanpham.mota,
            hinhsanpham.ma_hinh, hinhsanpham.ten_hinh, chitietsanpham.mactsp, chitietsanpham.soluong, chitietsanpham.kichthuoc
    FROM sanpham
    INNER JOIN hinhsanpham ON sanpham.id = hinhsanpham.masp
    INNER JOIN chitietsanpham ON sanpham.id = chitietsanpham.masp
    WHERE sanpham.id = $id";

    return pdo_query_one($sql);
}

function delete_soluong_size($soluong,$kichthuong)

{
    $sql0 = "DELETE FROM hinhsanpham WHERE masp=?";
    $sql = "DELETE FROM sanpham
    INNER JOIN chitietsanpham ON sanpham.id = chitietsanpham.masp
    WHERE chitietsanpham.soluong, chitietsanpham.kichthuoc = $soluong,$kichthuong";

    return pdo_query_one($sql);
}
function get_img($id)
{
    $sql = "SELECT * FROM hinhsanpham WHERE hinhsanpham.masp=$id";
    $getimg = pdo_query($sql);
    return $getimg;
}

function get_name_img($id)
{
    $sql = "SELECT ten_hinh FROM hinhsanpham WHERE hinhsanpham.masp=$id";
    $getimg = pdo_query($sql);
    return $getimg;
}
function get_bienthe($id)
{
    $sql = "SELECT *, price as tien FROM chitietsanpham WHERE chitietsanpham.masp=$id";
    $getbt = pdo_query($sql);
    return $getbt;
}
function get_sp_hot($iddm, $limi)
{
    $sql = "SELECT sanpham.id, sanpham.name, sanpham.price, sanpham.iddm,sanpham.bestseller, sanpham.mota, hinhsanpham.ma_hinh, hinhsanpham.ten_hinh
    FROM sanpham
    INNER JOIN hinhsanpham ON sanpham.id = hinhsanpham.masp WHERE iddm=$iddm limit " . $limi;

    return pdo_query($sql);
}
function get_sp_caphe($limi)
{
    $sql = "SELECT sanpham.id, sanpham.name, sanpham.price, sanpham.iddm,sanpham.bestseller, sanpham.mota, hinhsanpham.ma_hinh, hinhsanpham.ten_hinh
    FROM sanpham
    INNER JOIN hinhsanpham ON sanpham.id = hinhsanpham.masp WHERE iddm=4 limit " . $limi;

    return pdo_query($sql);
}
function get_sp_tra($limi)
{
    $sql = "SELECT sanpham.id, sanpham.name, sanpham.price, sanpham.iddm,sanpham.bestseller, sanpham.mota, hinhsanpham.ma_hinh, hinhsanpham.ten_hinh
    FROM sanpham
    INNER JOIN hinhsanpham ON sanpham.id = hinhsanpham.masp WHERE iddm=6 limit " . $limi;
    return pdo_query($sql);
}
function get_sp_banhmi($limi)
{
    $sql = "SELECT sanpham.id, sanpham.name, sanpham.price, sanpham.iddm,sanpham.bestseller, sanpham.mota, hinhsanpham.ma_hinh, hinhsanpham.ten_hinh
    FROM sanpham
    INNER JOIN hinhsanpham ON sanpham.id = hinhsanpham.masp WHERE iddm=5 limit " . $limi;
    return pdo_query($sql);
}
function get_sp_iddm($iddm)
{
    $sql = "SELECT danhmuc.id,danhmuc.name,sanpham.id as idsp, sanpham.name, sanpham.price, sanpham.bestseller, hinhsanpham.ten_hinh
    FROM sanpham
    INNER JOIN hinhsanpham ON sanpham.id = hinhsanpham.masp
    INNER JOIN danhmuc ON sanpham.iddm = danhmuc.id WHERE danhmuc.id = $iddm
    ";
    return pdo_query($sql);
}


function showsp($dssp)
{
    // echo'<pre>'; 
    // print_r($dssp);

    $html_dssp = '';
    foreach ($dssp as $sp) {

        extract($sp);
        if ($bestseller == 1) {
            $best = '<div class="best"></div>';
        } else {
            $best = "";
        }
        $link = "index.php?pg=sanphamchitiet&idpro=" . $id;
        $html_dssp .= '<div class="box25 mr15">
     ' . $best . '
            <a href="' . $link . '">
             <img src="' . IMG_PATH_USER . $ten_hinh . '" alt="' . IMG_PATH_USER . $ten_hinh . '">
             </a>
             <a href="' . $link . '"> <h4>' . $name . '</h4></a>
             <a href="' . $link . '">
             <span class="price">' . number_format($price, 0, ',', '.') . ' VNĐ</span></a>

             <form action="index.php?pg=addcart" method="post">
             <input type="hidden" name="idpro" value="' . $id . '">
             <input type="hidden" name="tensp" value="' . $name . '">
             <input type="hidden" name="img" value="' . $ten_hinh . '">
             <input type="hidden" name="price" value="' . $price . '">
             <input type="hidden" name="soluong" value="1">
             <button type="submit" class="button" name="addcart">Đặt hàng</button>
             </form>
             </div>';
    }
    return $html_dssp;
}
//admin

function showsp_admin($dssp)
{
    // echo"<pre>";
    // print_r($dssp);
    // die();
    $html_dssp = '';
    foreach ($dssp as $sp) {
        extract($sp);
        if ($bestseller == 1) {
            $best = '<div class="best"></div>';
        } else {
            $best = "";
        }
        $link = "index.php?pg=sanphamchitiet&idpro=" . $id;
        $html_dssp .= '<tr>
     <td>' . $id . '</td>
     <td><img src="' . IMG_PATH_ADMIN . $ten_hinh . '" alt="' . $name . '" width="80px"></td>
     <td>' . $name . '</td>
     <td>' . number_format($price, 0, ',', '.') . ' VNĐ</td>
     <td>
     <a href="admin.php?pg=sanphamupdate&id=' . $id . '" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Sửa</a>
         <a href="admin.php?pg=delproduct&id=' . $id . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Xóa</a>
     </td>
 </tr>';
    }
    return $html_dssp;
}
function get_sp_all()
{
    $sql = "SELECT * FROM sanpham ";
    return pdo_query($sql);
}


// xoá số lượng, size

// function hang_hoa_exist($ma_hh){
//     $sql = "SELECT count(*) FROM hang_hoa WHERE ma_hh=?";
//     return pdo_query_value($sql, $ma_hh) > 0;
// }

// function hang_hoa_tang_so_luot_xem($ma_hh){
//     $sql = "UPDATE hang_hoa SET so_luot_xem = so_luot_xem + 1 WHERE ma_hh=?";
//     pdo_execute($sql, $ma_hh);
// }

// function hang_hoa_select_top10(){
//     $sql = "SELECT * FROM hang_hoa WHERE so_luot_xem > 0 ORDER BY so_luot_xem DESC LIMIT 0, 10";
//     return pdo_query($sql);
// }

// function hang_hoa_select_dac_biet(){
//     $sql = "SELECT * FROM hang_hoa WHERE dac_biet=1";
//     return pdo_query($sql);
// }

// function hang_hoa_select_by_loai($ma_loai){
//     $sql = "SELECT * FROM hang_hoa WHERE ma_loai=?";
//     return pdo_query($sql, $ma_loai);
// }

// function hang_hoa_select_keyword($keyword){
//     $sql = "SELECT * FROM hang_hoa hh "
//             . " JOIN loai lo ON lo.ma_loai=hh.ma_loai "
//             . " WHERE ten_hh LIKE ? OR ten_loai LIKE ?";
//     return pdo_query($sql, '%'.$keyword.'%', '%'.$keyword.'%');
// }

// function hang_hoa_select_page(){
//     if(!isset($_SESSION['page_no'])){
//         $_SESSION['page_no'] = 0;
//     }
//     if(!isset($_SESSION['page_count'])){
//         $row_count = pdo_query_value("SELECT count(*) FROM hang_hoa");
//         $_SESSION['page_count'] = ceil($row_count/10.0);
//     }
//     if(exist_param("page_no")){
//         $_SESSION['page_no'] = $_REQUEST['page_no'];
//     }
//     if($_SESSION['page_no'] < 0){
//         $_SESSION['page_no'] = $_SESSION['page_count'] - 1;
//     }
//     if($_SESSION['page_no'] >= $_SESSION['page_count']){
//         $_SESSION['page_no'] = 0;
//     }
//     $sql = "SELECT * FROM hang_hoa ORDER BY ma_hh LIMIT ".$_SESSION['page_no'].", 10";
//     return pdo_query($sql);
// }

