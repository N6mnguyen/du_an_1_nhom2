<?php
require_once 'pdo.php';

function thong_ke_hang_hoa(){
     $sql = "SELECT danhmuc.id AS madm, danhmuc.name AS tendm, COUNT(sanpham.id) AS countSp, MIN(sanpham.price) AS minPrice, MAX(sanpham.price) AS maxPrice, AVG(sanpham.price) AS avgPrice
     FROM danhmuc
     LEFT JOIN sanpham ON danhmuc.id = sanpham.iddm
     GROUP BY danhmuc.id
     ORDER BY danhmuc.id";
    return pdo_query($sql);
}
function show_thong_kesp($tk_hh){
    $qq='';
    foreach($tk_hh as $thongke) {
        extract($thongke);
    $qq .='
    <tr>
        <td>'.$madm.'</td>
        <td>'.$tendm.'</td>
        <td>'.$countSp.'</td>
        <td>'.$maxPrice.'</td>
        <td>'.$minPrice.'</td>
        <td>'.$avgPrice.'</td>
        <td>
            <a href="admin.php?pg=tcthongkesp&iddm='.$madm.'" class="btn btn-success"><i class="fa-regular fa-eye"></i> Xem</a>
        </td>
    </tr>';
    }
    return $qq;

}

function thong_ke_binh_luan($limit, $limit2){
    $sql = "SELECT sanpham.id AS masp, COUNT(binhluan.id) AS countSp, sanpham.name AS Nsanpham,hinhsanpham.ten_hinh
    FROM sanpham
    LEFT JOIN binhluan ON sanpham.id = binhluan.idpro
    LEFT JOIN hinhsanpham ON sanpham.id = hinhsanpham.masp
    GROUP BY sanpham.id
    ORDER BY sanpham.id DESC limit $limit, $limit2";
   return pdo_query($sql);
}
function show_thong_kebl($tk_bl){
    
    $qq='';
    foreach($tk_bl as $thongke) {
        extract($thongke);
    $qq .='
    <tr>
        <td>'.$masp.'</td>
        <td><img src="' . IMG_PATH_ADMIN . $ten_hinh . '" alt="' . $Nsanpham . '" width="80px"></td>
        <td>'.$Nsanpham.'</td>
        <td>'.$countSp.'</td>
        <td>
            <a href="admin.php?pg=thongkebl&idpro='.$masp.'" class="btn btn-success"><i class="fa-regular fa-eye"></i> Xem</a>
        </td>
    </tr>';
    }
    return $qq;

}
function show_thong_keblct($tk_blct){
    $qq='';
    foreach($tk_blct as $thongke) {
        extract($thongke);
    $qq .='
    <tr>
        <td>'.$mabl.'</td>
        <td><img src="' . IMG_PATH_ADMIN . $ten_hinh . '" alt="" width="80px"></td>
        <td>'.$iduser.'</td>
        <td>'.$nameuser.'</td>
        <td>'.$noidung.'</td>
        <td>
            <a href="admin.php?pg=deletebl&id=' . $mabl . '&idsp='.$idsp.'" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Xóa</a>
        </td>
    </tr>';
    }
    return $qq;

}

function show_binhluan_tk($ctsp){
    $sql = "SELECT binhluan.id AS mabl,sanpham.id as idsp, sanpham.name AS Nsanpham, user.username as nameuser, binhluan.iduser as iduser, binhluan.noidung as noidung, hinhsanpham.ten_hinh
    FROM binhluan
    LEFT JOIN sanpham ON binhluan.idpro = sanpham.id
    LEFT JOIN user ON binhluan.iduser = user.id
    LEFT JOIN hinhsanpham ON binhluan.idpro = hinhsanpham.masp
    where binhluan.idpro = $ctsp" ;
   return pdo_query($sql);
}
function aa()
{
  $sql = "SELECT
  DATE(bill.ngaymua) AS ngay,
  COUNT(DISTINCT bill.id) AS tong_don_hang,
  SUM(bill.tongthanhtoan) AS tong_tien_ngay,
  SUM(cart.soluong) AS tong_so_luong
FROM
  bill
INNER JOIN
  cart ON bill.id = cart.idbill
-- WHERE bill.ngaymua BETWEEN '2023-11-01' AND '2023-11-28'
GROUP BY
  ngay
ORDER BY
  ngay 
  ";
  return pdo_query($sql);
}
function tk_sp_bc(){
    $sql="SELECT
    sp.name AS TenSanPham,
    SUM(c.soluong) AS TongSoLuong
FROM
    cart c
JOIN
    sanpham sp ON c.idpro = sp.id
GROUP BY
    c.idpro, sp.name
ORDER BY
    TongSoLuong DESC
LIMIT 3";
return pdo_query($sql);
}
