<?php
// require_once 'pdo.php';


function bill_user_insert_id($madh, $iduser, $total,
$pttt,$ghichu,
$nguoinhan_ten, $nguoinhan_diachi, $nguoinhan_tel, $ship, $tongthanhtoan,$voucher,$id_trangthai,$ngaymua)
{
  $sql = "INSERT INTO bill(madh, iduser, total,
pttt,ghichu, 
  nguoinhan_ten, nguoinhan_diachi, nguoinhan_tel, ship, tongthanhtoan,voucher,id_trangthai,ngaymua) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
  return pdo_execute_id($sql, $madh, $iduser, $total,
  $pttt,$ghichu,
  $nguoinhan_ten, $nguoinhan_diachi, $nguoinhan_tel, $ship, $tongthanhtoan,$voucher,$id_trangthai,$ngaymua);
}

function donhang_new_limit()
{
  $sql = "SELECT bill.*, tbl_trangthai.id_trangthai, tbl_trangthai.tentrangthai 
        FROM bill 
        LEFT JOIN tbl_trangthai ON bill.id_trangthai = tbl_trangthai.id_trangthai 
        ORDER BY bill.id DESC LIMIT 5";
  return pdo_query($sql);
}
function donhang_new($limit, $limit2)
{
  $sql = "SELECT bill.*, tbl_trangthai.id_trangthai, tbl_trangthai.tentrangthai 
        FROM bill 
        LEFT JOIN tbl_trangthai ON bill.id_trangthai = tbl_trangthai.id_trangthai 
        ORDER BY bill.id DESC LIMIT $limit, $limit2";
  return pdo_query($sql);
}
function sotrangdonhang($itemsPerPage){
  $sql = "SELECT COUNT(*) as total FROM bill WHERE 1";
  $ww = pdo_query($sql);
  foreach ($ww as $a) {
      $total_pages = ceil($a['total'] / $itemsPerPage);
  }
  return $total_pages;
}
function donhang_all()
{
  $sql = "SELECT * FROM bill ";
  return pdo_query($sql);
}
function donhang_limit()
{
  $sql = "SELECT * FROM bill LIMIT 5";
  return pdo_query($sql);
}
function donhang_id($iduser, $limit, $limit2)
{
  $sql = "SELECT bill.*, tbl_trangthai.id_trangthai, tbl_trangthai.tentrangthai 
        FROM bill 
        LEFT JOIN tbl_trangthai ON bill.id_trangthai = tbl_trangthai.id_trangthai 
        WHERE bill.iduser = ? 
        ORDER BY bill.id DESC limit $limit, $limit2";
  return pdo_query($sql, $iduser);
}
function donhang_idbill($idbill)
{
  $sql = "SELECT bill.*, tbl_trangthai.id_trangthai, tbl_trangthai.tentrangthai 
        FROM bill 
        LEFT JOIN tbl_trangthai ON bill.id_trangthai = tbl_trangthai.id_trangthai 
        WHERE bill.id = ? 
        ORDER BY bill.id DESC";
  return pdo_query($sql, $idbill);
}
function show_trangthai($dstt,$idtt)
{
 
    $html_tt='';
    foreach ($dstt as $tt) {
        extract($tt);
        if($id_trangthai==$idtt) {
        $st='selected'; 
        } else {
            $st ="";
        }
        
        $html_tt.=' <option value="'.$id_trangthai.'" '.$st.' >'.$tentrangthai.'</option>';
    
      }
      return $html_tt;
}

function showsp_donhang($dssp)
{
  $html_dssp = '';
  $i = 1;
  foreach ($dssp as $sp) {
    extract($sp);
    $html_dssp .= '<tr>
   <td>' . $i . '</td>
   <td>' . $madh . '</td>
   <td>' . number_format($tongthanhtoan,0,',','.') . ' VNĐ</td>
</tr>';
    $i++;
  }
  return $html_dssp;
}


function tong_doanhthu($dssp)
{
  $tong = 0;
  foreach ($dssp as $sp) {
    extract($sp);
    $tong += $tongthanhtoan;
  }
  return $tong;
}
function get_trangthai(){
  $sql = "SELECT * FROM tbl_trangthai";
  return pdo_query($sql);
}
function show_dh_new($dssp)
{
  $html_dssp = '';
  foreach ($dssp as $sp) {
    extract($sp);
    $html_dssp .= '<tr>
   <td>' . $madh . '</td>
   <td>' . $tentrangthai . '</td>
</tr>';
  }
  return $html_dssp;
}



function show_donhang($dssp){
  
  $html_dssp = '';
  $i = 1;
  $ee='';
  foreach ($dssp as $sp) {
    extract($sp);
    if ($id_trangthai!=5 && $id_trangthai!=6) {
      $ee=' <a href="admin.php?pg=updatebill&idbill='.$id.'" class="btn btn-warning"><i class="fa-solid fa-pen-to-square" aria-hidden="true"></i> Sửa</a>';
    }else{
      $ee='';
    }
    if($pttt==1){
      $pt='Tiền mặt';
    }else if($pttt==2){
      $pt='Vnpay';
    }else if($pttt==3){
      $pt='Momo';
    }
    $html_dssp .= '<td>' . $i . '</td>
   <td>' . $madh . '</td>
   <td>' . $nguoinhan_ten . '</td>
   <td>' . $nguoinhan_tel . '</td>
   <td>' . $nguoinhan_diachi . '</td>
   <td>' . number_format($tongthanhtoan, 0,',','.') . ' VNĐ</td>
   <td>' . $pt . '</td>
   <td>' . $tentrangthai . '</td>
   <td>
   <a href="admin.php?pg=onebill&idbill='.$id.'" class="btn btn-success"><i class="fa-regular fa-eye" aria-hidden="true"></i> Xem</a>
   '.$ee.'
    </td>
</tr>';
    $i++;
  }
  return $html_dssp;
}
function update_bill($idbill,$idtt){
  $sql = "UPDATE bill SET id_trangthai=? WHERE id=?";
  pdo_execute($sql,$idtt,$idbill);

}
function show_donhang_user($dssp)
{

  $html_dssp = '';
  $i = 1;
  foreach ($dssp as $sp) {
    extract($sp);

    if ($id_trangthai == 1||$id_trangthai==7) {
      $yy = '<div class="nut" ><a href="index.php?pg=deletedh&id=' . $id . '&idtt='.$id_trangthai.'&idtht='.$pttt.'" class="btn btn-danger">Huỷ</a></div>';
    } else {
      $yy = '';
    }
    if($pttt==1){
      $pt='Tiền mặt';
    }else if($pttt==2){
      $pt='Vnpay';
    }else if($pttt==3){
      $pt='Momo';
    }

    $html_dssp .= '<tr>
       <td>' . $i . '</td>
       <td>' . $madh . '</td>
       <td>' . $nguoinhan_ten . '</td>
       <td>' . $nguoinhan_tel . '</td>
       <td>' . $nguoinhan_diachi . '</td>
       <td>' . number_format($tongthanhtoan,0,',','.') . ' VNĐ</td>
       <td>' . $pt . '</td>
       <td>' . $tentrangthai . '</td>
       <td>
           ' . $yy . '
           
           <div class="nut2"><a href="index.php?pg=chitietdonhang&idbill=' . $id . '" class="btn btn-danger">Xem</a></div>
       </td>
    </tr>';
    $i++;
  }
  return $html_dssp;
}


function donhang_delete($id)
{
  $sql = "DELETE FROM bill WHERE id=?";
  pdo_execute($sql, $id);

}
function chitietdh($idbill){
  $sql="SELECT 
  b.nguoinhan_ten,
  b.nguoinhan_diachi,
  b.nguoinhan_tel,
  b.total,
  b.tongthanhtoan,
  b.id_trangthai,
  b.voucher,
  b.ngaymua,
  tt.tentrangthai
FROM 
  bill b
JOIN 
  tbl_trangthai tt ON b.id_trangthai = tt.id_trangthai
WHERE 
  b.id = $idbill;";
 return pdo_query($sql);
}

function chitietgh($idbill){
  $sql="SELECT
  c.thanhtien,
  c.soluong,
  c.size,
  s.name AS product_name,
  hs.ten_hinh AS image_name
FROM
  cart c
JOIN
  sanpham s ON c.idpro = s.id
JOIN
  hinhsanpham hs ON c.idpro = hs.masp
WHERE
  c.idbill = $idbill;";
 return pdo_query($sql);
}