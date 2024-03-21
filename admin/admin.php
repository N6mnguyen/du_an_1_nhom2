<?php
session_start();
ob_start();
if (isset($_SESSION['user']) && ($_SESSION['user']["role"] == 1)) {
    include '../dao/pdo.php';
    include '../dao/sanpham.php';
    include '../dao/donhang.php';
    include '../dao/danhmuc.php';
    include '../dao/binhluan.php';
    include '../dao/user.php';
    include '../dao/voucher.php';
    include '../dao/thong-ke.php';
    include("view/header.php");
    // phân trang
    $itemsPerPage = 4;
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $total_pages = so_trang_admin($itemsPerPage);
    if ($current_page == '' || $current_page == 1) {
        $begin = 0;
    } else {
        $begin = ($current_page - 1) * $itemsPerPage;
    }
    if (isset($_GET["pg"])) {
        $pg = $_GET["pg"];
        switch ($pg) {
            case "sanphamlist":
                $sanphamlist = get_dssp_new($begin, $itemsPerPage);
                include('view/sanphamlist.php');
                break;
            case "voucherlist":
                $itemsPerPage = 4;
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                if ($current_page == '' || $current_page == 1) {
                    $begin = 0;
                } else {
                    $begin = ($current_page - 1) * $itemsPerPage;
                }
                $sotrang = sotrangvoucher($itemsPerPage);
                $voucherlist = loadvoucher($begin, $itemsPerPage);
                include('view/voucherlist.php');
                break;
            case "voucheradd";
                if (isset($_POST['voucheradd'])) {
                    insertvoucher($_POST['mavoucher'], $_POST['gia'], $_POST['soluong']);
                    header('location:admin.php?pg=voucherlist');
                }
                include('view/voucheradd.php');
                break;
            case "voucherupdate";
                $voucher = loadvoucherid($_GET['id']);
                if (isset($_POST['updatevoucher'])) {
                    // echo $_GET['id'];
                    // die();
                    updatevoucher($_GET['id'], $_POST['mavoucher'], $_POST['gia'], $_POST['soluong']);
                    header('location:admin.php?pg=voucherlist');
                }
                include('view/voucherupdate.php');
                break;
            case "delvoucher";
                delvoucher($_GET['id']);
                header('location:admin.php?pg=voucherlist');
                break;
            case "updateproduct":
                if (isset($_POST["updateproduct"])) {
                    $name = $_POST['name'];
                    $price = $_POST['price'];
                    $iddm = $_POST['iddm'];
                    $id = $_POST['id'];
                    $mota = $_POST['mota'];
                    $size = $_POST['size'];
                    $tien = $_POST['tien'];
                    $bestseller = 0;
                    $imgs = $_FILES['image'];
                    $imgold = get_img($id);

                    $bienthe = get_bienthe($id);
                    if (isset($_POST['bestseller'])) {
                        $bestseller = $_POST['bestseller'];
                    }

                    if ($imgs['name'][0] != '') {
                        foreach ($imgold as $b) {
                            extract($b);
                            $img = IMG_PATH_ADMIN . $ten_hinh;
                            if (is_file($img)) {
                                unlink($img);
                            }
                        }
                        for ($i = 0; $i < count($imgs['name']); $i++) {
                            $target_file = IMG_PATH_ADMIN . $imgs['name'][$i];
                            move_uploaded_file($imgs['tmp_name'][$i], $target_file);
                        }
                    } else {
                        $imgs = [];
                    }
                    // echo "<pre>";
                    // print_r($imgs);
                    // die();
                    sanpham_update($name, $price, $iddm, $id, $mota, $imgs['name'], $bienthe, $size, $tien, $imgold, $bestseller);
                    header("Location:admin.php?pg=sanphamlist");
                }

                break;
            case "sanphamadd":
                $danhmuclist = danhmuc_all();
                include("view/sanphamadd.php");
                break;
            case "sanphamupdate":

                if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                    $id = $_GET['id'];
                    $bienthe = get_bienthe($id);
                    if ($bienthe != []) {
                        $sp = get_sp__by_id($id);
                    } else {
                        $sp = get_sp_by_id($id);
                    }
                    $img = get_name_img($id);
                    $danhmuclist = danhmuc_all();
                    $img = get_name_img($id);
                    $danhmuclist = danhmuc_all();
                    include('view/sanphamupdate.php');
                } else {
                    header("Location:admin.php?pg=sanphamlist");
                }
                break;
            case "delproduct":
                if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                    $id = $_GET['id'];
                    $a = get_name_img($id);
                    $c = get_bienthe($id);
                    // echo "<pre>";
                    // print_r($a);
                    foreach ($a as $b) {
                        extract($b);
                        $img = IMG_PATH_ADMIN . $ten_hinh;
                        if (is_file($img)) {
                            unlink($img);
                        }
                    }


                    try {
                        sanpham_delete($id);
                        header("Location:admin.php?pg=sanphamlist");
                    } catch (Throwable $th) {
                        echo "<h3 style='color:red;text-align:center;' >Sản phẩm đã có trong giỏ hàng !!! không được phép xoá</h3>";
                    }
                }

                break;
            case "addproduct":
                if (isset($_POST['addproduct'])) {
                    $name = $_POST['name'];
                    $price = $_POST['price'];
                    $iddm = $_POST['iddm'];
                    $imgs = $_FILES['image'];
                    $size = $_POST['size'];
                    $mota = $_POST['mota'];
                    $tien = $_POST['tien'];
                    $bestseller = 0;
                    if (isset($_POST['bestseller'])) {
                        $bestseller = $_POST['bestseller'];
                    }
                    for ($i = 0; $i < count($imgs['name']); $i++) {
                        $target_file = IMG_PATH_ADMIN . $imgs['name'][$i];
                        move_uploaded_file($imgs['tmp_name'][$i], $target_file);
                    }
                    // echo''. $name .''. $price .''.$iddm;
                    // echo'<pre>';
                    // print_r($imgs['name']);
                    // echo'<pre>';
                    // die();
                    sanpham_insert($name, $price, $iddm, $imgs['name'], $size, $tien, $mota, $bestseller);
                    header("Location:admin.php?pg=sanphamlist");
                } else {
                    $danhmuclist = danhmuc_all();
                    include("view/sanphamadd.php");
                }
                break;
            case "catalog":
                $itemsPerPage = 4;
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                if ($current_page == '' || $current_page == 1) {
                    $begin = 0;
                } else {
                    $begin = ($current_page - 1) * $itemsPerPage;
                }
                $sotrang = sotrangdm($itemsPerPage);
                $danhmuc_list = dmadmin($begin, $itemsPerPage);
                include("view/danhmuclist.php");
                break;
            case "danhmucadd":
                include("view/danhmucadd.php");
                break;

            case "updatedm":
                if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                    $id = $_GET['id'];
                    $dm = danhmuc_select_by_id($id);
                }
                $danhmuc_list = danhmuc_all();
                include("view/danhmucupdate.php");
                break;
            case "dmupdate":
                $trangthai = 0;
                $trangthai1 = 0;
                if (isset($_POST['trangthai'])) {
                    $trangthai = $_POST['trangthai'];
                }
                if (isset($_POST['trangthai1'])) {
                    $trangthai1 = $_POST['trangthai1'];
                }
                update_danhmuc($_POST['id'], $_POST['namedm'], $trangthai, $trangthai1);
                header("Location:admin.php?pg=catalog");
                break;
            case "deletedm":
                if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                    $id = $_GET['id'];
                    danhmuc_delete($id);
                }
                header("Location:admin.php?pg=catalog");
                break;
            case "adddanhmuc":
                if (isset($_POST['adddm'])) {
                    $name = $_POST['name'];
                    $trangthai = 0;
                    $trangthai1 = 0;
                    if (isset($_POST['trangthai'])) {
                        $trangthai = $_POST['trangthai'];
                    }
                    if (isset($_POST['trangthai1'])) {
                        $trangthai1 = $_POST['trangthai1'];
                    }
                    danhmuc_insert($name, $trangthai, $trangthai1);
                }
                $danhmuc_list = danhmuc_all();
                header("Location:admin.php?pg=catalog");
                break;
            case "admindeluser":
                deluser($_GET['id']);
                header("Location:admin.php?pg=users");
                break;
            case "users":
                $itemsPerPage = 4;
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                if ($current_page == '' || $current_page == 1) {
                    $begin = 0;
                } else {
                    $begin = ($current_page - 1) * $itemsPerPage;
                }
                $sotrang = sotranguser($itemsPerPage);
                $user_list = user_admin($begin, $itemsPerPage);
                include("view/userlist.php");
                break;
            case "adminadduser":
                if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                    $id = $_GET['id'];
                    $us = user_select_by_id($id);
                    // print_r($us);
                    // die();
                }
                $danhmuc_list = danhmuc_all();
                include("view/adduser.php");
                break;
            case "addrole":
                if (isset($_POST["addus"])) {
                    $id = $_POST["id"];
                    $role = $_POST['role'];
                    user_update_admin($id, $role);
                }
                $user_list = user_all();
                header("location:admin.php?pg=users");
                break;
            case "dangxuat":
                if (isset($_SESSION['user'])) {
                    unset($_SESSION['user']);
                    header('location:login.php');
                } else {
                    header('location:login.php');
                }
                break;
            case 'bills':
                $itemsPerPage = 4;
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                if ($current_page == '' || $current_page == 1) {
                    $begin = 0;
                } else {
                    $begin = ($current_page - 1) * $itemsPerPage;
                }
                $sotrang = sotrangdonhang($itemsPerPage);
                $show_dh = donhang_new($begin, $itemsPerPage);
                // echo "<pre>";
                // print_r($show_dh);
                // die();
                include("view/donghanglist.php");
                break;
            case 'onebill':
                $chitietdh = chitietdh($_GET['idbill']);
                $chitietgh = chitietgh($_GET['idbill']);
                // echo "<pre>";
                // print_r($chitietdh);
                // die();
                $diachi = "";
                $sdt = "";
                $tong = "";
                $tongthanhtoan = "";
                $voucher = "";
                $ngaymua = "";
                $tentrangthai = "";
                $tien = "";
                $soluong = "";
                $size = "";
                $name = "";
                $ten_hinh = "";
                $id_trangthai = "";
                $sp = "";
                foreach ($chitietdh as $value) {
                    $diachi = $value['nguoinhan_diachi'];
                    $sdt = $value['nguoinhan_tel'];
                    $tong = $value['total'];
                    $tongthanhtoan = $value['tongthanhtoan'];
                    $id_trangthai = $value['id_trangthai'];
                    $voucher = $value['voucher'];
                    $ngaymua = $value['ngaymua'];
                    $tentrangthai = $value['tentrangthai'];
                };
                foreach ($chitietgh as $ghj) {
                    if ($ghj[2] == 0) {
                        $size = "S";
                    } else if ($ghj[2] == 4000) {
                        $size = "M";
                    } else {
                        $size = "L";
                    }
                    $tien = $ghj[0];
                    $soluong = $ghj[1];
                    $name = $ghj[3];
                    $ten_hinh = $ghj[4];
                    $sp .= '<div class="product">
                            <div style="display:flex; padding-bottom: 15px;">
                                <img class="img" style="box-shadow : 0 -3px 10px 0 rgba(185, 185, 185, 0.5),0 5px 5px 0 rgba(185, 185, 185, 0.5);" src="../uploads/' . $ten_hinh . '" width="100px" style="float: left; margin-right: 20px;" alt="">
                                <div style="margin-left:20px;">
                                    <p style="margin:0;">' . $name . '</p>
                                    <p>Size: ' . $size . '</p>
                                    <p>Số lượng: x' . $soluong . '</p>
                                </div>
                            </div>
                            <p class="end">' . number_format($tien, 0, ',', '.') . ' đ</p>
                        </div>';
                }
                include("view/onebill.php");

                break;
            case 'updatebill':
                if (isset($_POST['addtt'])) {
                    $idtt = $_POST['idtt'];
                    $idbill = $_POST['idbill'];
                    update_bill($idbill, $idtt);
                    header('location:admin.php?pg=bills');
                } else {
                    $show_dh = donhang_idbill($_GET['idbill']);
                    foreach ($show_dh as $value) {
                    }
                    $show_tt = get_trangthai();
                    // echo"<pre>";
                    // print_r($show_tt);
                    // die();
                    include("view/billupdate.php");
                }
                break;
            case "delbill":
                // if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                //     $id = $_GET['id'];
                //     donhang_delete($id);
                // }
                // $show_dh = donhang_new();
                // include("view/donghanglist.php");
                break;
            case "thongke":
                $tk_hh = thong_ke_hang_hoa();
                $tk_bl = thong_ke_binh_luan($begin, $itemsPerPage);
                include("view/thongke.php");
                break;
            case "tcthongkesp":
                if (isset($_GET['iddm']) && ($_GET['iddm'] > 0)) {
                    $tk_hhct = get_sp_iddm($_GET['iddm']);
                }
                include("view/thongkespct.php");
                break;
            case "thongkebl";
                if (isset($_GET['idpro']) && ($_GET['idpro'] > 0)) {
                    $tk_blct = show_binhluan_tk($_GET['idpro']);
                }
                include("view/thongkeblct.php");
                break;
            case "deletebl";
                binhluan_delete($_GET['id']);
                header("Location:admin.php?pg=thongkebl&idpro=" . $_GET['idsp']);
                break;
            case "binhluanlist";
                $tk_bl = thong_ke_binh_luan($begin, $itemsPerPage);
                if (isset($_GET['idpro']) && ($_GET['idpro'] > 0)) {
                    $tk_blct = show_binhluan_tk($_GET['idpro']);
                }
                include("view/binhluanlist.php");
                break;
            default:
                include("view/home.php");
                break;
        }
    } else {
        $thongke_doanhthu_theo_danhmuc = thong_ke_hang_hoa();
        $label = "";
        $trungbinh = "";
        $minprice = "";
        $maxprice = ""; //
        foreach ($thongke_doanhthu_theo_danhmuc as $key => $value) {
            $label .= "'" . $value['tendm'] . "', ";
            $trungbinh .= $value['avgPrice'] . ', ';
            $maxprice .= $value['maxPrice'] . ', ';
            $minprice .= $value['minPrice'] . ', ';
        }

        $label = rtrim($label, ", ");
        $label = "[" . $label . "]";

        $trungbinh = "{name: 'Giá trung bình', data: [" . rtrim($trungbinh, ', ') . "]}";
        $minprice = "{name: 'Giá thấp nhất', data: [" .  rtrim($minprice, ', ') . "]}";
        $maxprice =  "{name: 'Giá cao nhất', data: [" . rtrim($maxprice, ', ') . "]}";

        $soluong="";
        $tensp="";
        $thong_ke_sp_ban_chay=tk_sp_bc();
        foreach($thong_ke_sp_ban_chay as $value){
            $tensp.="'".$value['TenSanPham']."',";
            $soluong.=$value['TongSoLuong'].",";
        }
        $soluong = rtrim($soluong, ", ");
        $soluong = "[" . $soluong . "]";
        $tensp = rtrim($tensp, ", ");
        $tensp = "[" . $tensp . "]";
        include("view/home.php");
    }
    include("view/footer.php");
} else {
    header('location:login.php');
}
