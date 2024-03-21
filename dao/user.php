<?php
// require_once 'pdo.php';

function user_insert_id($username, $password, $email)
{
  $sql = "INSERT INTO user(username, password, email) VALUES (?, ?, ?)";
  return pdo_execute_id($sql, $username, $password, $email);
}

function kiemtraemail($email)
{
  $sql = "SELECT * from user WHERE email =?";
  return pdo_query_one($sql, $email);
}

function kiemtrapassword($matkhau_cu)
{
  $sql = "select * from user where password='" . $matkhau_cu . "' limit 1";
  return pdo_query($sql);
}

function updatepassword($matkhau_moi,$id)
{
  $sql = "UPDATE `user` SET `password` = ? WHERE `user`.`id` = ?;";
  return pdo_execute_id($sql, $matkhau_moi,$id);
}


function noinhanhang($iduser)
{
  $sql = "SELECT * from diachinhan WHERE id_user =$iduser";
  return pdo_query($sql);
}
function usernh_insert_id($id_user, $sdt, $noinhan)
{
  $sql = "INSERT INTO diachinhan(id_user,sdt,noinhan) VALUES (?,?,?)";
  return  pdo_execute_id($sql, $id_user, $sdt, $noinhan);
}
function update_noinhan($id_user, $sdt, $noinhan)
{
  $sql = "UPDATE diachinhan SET sdt=?, noinhan=? WHERE id_user=?";
  return  pdo_execute_id($sql, $sdt, $noinhan, $id_user);
}
function user_admin($limit,$limit2){
  $sql = "SELECT user.*, diachinhan.id as dia_id, diachinhan.sdt, diachinhan.noinhan 
        FROM user 
        LEFT JOIN diachinhan ON user.id = diachinhan.id_user 
        ORDER BY user.id DESC 
        LIMIT $limit, $limit2";
  return pdo_query($sql);
}
function user_all()
{
  $sql = "SELECT * from user order by id asc";
  return pdo_query($sql);
}
function user_new()
{
  $sql = "SELECT * from user order by id DESC LIMIT 5";
  return pdo_query($sql);
}


function  checkuser($username, $password)
{
  $sql = "SELECT * from user WHERE username=? and password=?";
  return pdo_query_one($sql, $username, $password);

  //   if(is_array($kq)&&(count($kq))){
  //   return $kq['id']; 
  //   }else{
  //     return 0;
  //   }
}
function checkusername($username)
{
  $sql = "SELECT * from user WHERE username=?";
  return pdo_query_one($sql, $username);
}
function checkuseremail($email)
{
  $sql = "SELECT * from user WHERE email=?";
  return pdo_query_one($sql, $email);
}
function  user_update($username, $email, $diachi, $dienthoai, $id, $anh)
{

  $sql = "UPDATE  user SET username=?,email=?,diachi=?,dienthoai=?,anh=? WHERE id=?";
  pdo_execute($sql, $username, $email, $diachi, $dienthoai,$anh==''?$_SESSION['s_user']['anh']:$anh, $id);
}


function  get_user($id)
{
  $sql = "SELECT * from user WHERE id=?";
  return pdo_query_one($sql, $id);
}
function deluser($iduser){
  $sql = "DELETE FROM user WHERE id = $iduser";
  pdo_query($sql);

}

// admin 

function showdm_admin_user($dsdm)
{
  $html_dm = '';
  $i = 1;
  foreach ($dsdm as $dm) {
    extract($dm);
    if ($role == 0) {
      $quyen = "Khách Hàng";
    } else if ($role == 1) {
      $quyen = "Admin";
    }
    $html_dm .= '<tr>
          <td>' . $i . '</td>
          <td>' . $username . '</td>
          <td>' . $diachi . '</td>
          <td>' . $noinhan . '</td>
          <td>' . $email . '</td>
          <th>' . $dienthoai . '</th>
          <th>' . $sdt . '</th>
          <td>' . $quyen . '</td>
          <td>
          <a href="admin.php?pg=adminadduser&id=' . $id . '" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Sửa</a>
          <a href="admin.php?pg=admindeluser&id=' . $id . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Xóa</a>
      </td>
      </tr>
        ';
    $i++;
  }
  return $html_dm;
}

function sotranguser($itemsPerPage){
  $sql = "SELECT COUNT(*) as total FROM user WHERE 1";
  $ww = pdo_query($sql);
  foreach ($ww as $a) {
      $total_pages = ceil($a['total'] / $itemsPerPage);
  }
  return $total_pages;
}

function user_update_admin($id, $role)
{
  $sql = "UPDATE  user SET role=? WHERE id=?";
  pdo_execute($sql, $role, $id);
}

function showdm_user_new($dsdm)
{
  $html_dm = '';
  $i = 1;
  foreach ($dsdm as $dm) {
    extract($dm);
    $html_dm .= '<tr>
      <td>' . $i . '</td>
      <td>' . $username . '</td>
  </tr>
    ';
    $i++;
  }
  return $html_dm;
}

// function user_delete($ma_kh){
//     $sql = "DELETE FROM  user  WHERE ma_kh=?";
//     if(is_array($ma_kh)){
//         foreach ($ma_kh as $ma) {
//             pdo_execute($sql, $ma);
//         }
//     }
//     else{
//         pdo_execute($sql, $ma_kh);
//     }
// }

// function user_select_all(){
//     $sql = "SELECT * FROM  user";
//     return pdo_query($sql);
// }

function user_select_by_id($id)
{
  $sql = "SELECT * FROM  user WHERE id=?";
  return pdo_query_one($sql, $id);
}

// function user_exist($ma_kh){
//     $sql = "SELECT count(*) FROM  user WHERE $ma_kh=?";
//     return pdo_query_value($sql, $ma_kh) > 0;
// }

// function user_select_by_role($vai_tro){
//     $sql = "SELECT * FROM  user WHERE vai_tro=?";
//     return pdo_query($sql, $vai_tro);
// }

// function user_change_password($ma_kh, $mat_khau_moi){
//     $sql = "UPDATE  user SET mat_khau=? WHERE ma_kh=?";
//     pdo_execute($sql, $mat_khau_moi, $ma_kh);
// }

