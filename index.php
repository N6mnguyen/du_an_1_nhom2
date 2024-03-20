<?php
session_start();
// session_destroy();
// die();
ob_start();
if (!isset($_SESSION['giohang'])) {
    $_SESSION['giohang'] = [];
}

include "dao/pdo.php";
include "view/header.php";
include "dao/danhmuc.php";
include "dao/sanpham.php";
include "dao/giohang.php";
include "dao/user.php";
include "dao/donhang.php";
include "dao/binhluan.php";
include "dao/voucher.php";
include "dao/mail.php";
include "dao/convnpay.php";
//data danh cho trang chu
$dssp_all = selectall_sanpham();
$dssp_new = get_dssp_newtrangchu(4);
$dssp_best = get_dssp_best(4);
$dssp_caphe = get_sp_caphe(4);
$dssp_tra = get_sp_tra(4);
$dssp_banhmi = get_sp_banhmi(4);

if (!isset($_GET['pg'])) {
    include "view/home.php";
} else {
    switch ($_GET['pg']) {
        case 'sanpham':
            $itemsPerPage = 4;
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $dsdm = danhmuc_show();

            if ($current_page == '' || $current_page == 1) {
                $begin = 0;
            } else {
                $begin = ($current_page - 1) * $itemsPerPage;
            }

            if (!isset($_GET['iddm'])) {
                $iddm = '';
                $titlepage = "";
            } else {
                $iddm = $_GET['iddm'];
                $titlepage = get_name_dm($iddm);
            }
            //kiem tra form search
            if (isset($_GET["timkiem"]) && ($_GET["timkiem"])) {
                $kyw = $_GET['kyw'];
                $titlepage = " Kết quả tìm kiếm với từ khoá :<span>  " . $kyw . "</span>";
            } else {
                $kyw = "";
            }
            if (isset($_GET['min']) || isset($_GET['max'])) {

                $min = $_GET['min'];
                $max = $_GET['max'];
            } else {
                $min = "";
                $max = "";
            }
            $total_pages = so_trang($itemsPerPage, $iddm, $min, $max, $kyw);


            $dssp = get_dssp($kyw, $iddm, $begin, $itemsPerPage, $min, $max);
            include "view/sanpham.php";
            break;
        case 'danhmuc':
            $dsdm = danhmuc_show();
            // echo "<pre>";
            // print_r($dsdm);
            // die();
            include "view/danhmuc.php";
            break;

        case 'sanphamchitiet':
            if (isset($_GET['idpro'])) {
                $id = $_GET['idpro'];
                $spchitiet = get_sp__by_id($id);
                $bienthe = get_bienthe($id);
                $dsdm = danhmuc_show();
                $iddm = $spchitiet['iddm'];
                $splienquan = get_dssp_lienquan($iddm, $id, 4);
                include "view/sanphamchitiet.php";
            } else {
                include "view/home.php";
            }
            break;

        case 'addcart':
            if (isset($_POST['addcart'])) {
                $id = $_POST['idpro'];
                $name = $_POST['tensp'];
                $idpro = $_POST['idpro'];
                $img = $_POST['img'];
                $price = $_POST['price'];
                $soluong = $_POST['soluong'];
                $tien;
                !isset($_POST['size']) ? $tien = 0 : $tien = $_POST['size'];
                $thanhtien = (int) $soluong * ((int) $price + (int) $tien);
                // $sp = [$name,$img,$price,$soluong];
                $sp = array(
                    "id" => $id,
                    "idpro" => $idpro,
                    "name" => $name,
                    "img" => $img,
                    "price" => $price,
                    "soluong" => $soluong,
                    "thanhtien" => $thanhtien,
                    "tien" => $tien
                );
                // print_r($sp);
                // die();
                if (isset($_SESSION['giohang'])) {
                    $check = false;
                    foreach ($_SESSION['giohang'] as &$value) {
                        if ($value['idpro'] == $idpro && $value['tien'] == $sp['tien']) {
                            $check = true;
                            $value['soluong'] += $soluong;
                            break;
                        }
                    }
                    if ($check == false) {
                        array_push($_SESSION['giohang'], $sp);
                    }
                } else {
                    $_SESSION['giohang'] = array($sp);
                }



                // echo'<pre>';
                // print_r($_SESSION['giohang']);
                // die();

                header('location:index.php?pg=viewcart');
            }
            break;
        case 'viewcart':

            if (isset($_GET['del']) && ($_GET['del'] == 1)) {
                unset($_SESSION["giohang"]);
                // $_SESSION['giohang']=[];
                header('location:index.php?pg=viewcart');
            } else {
                if (isset($_SESSION["giohang"])) {
                    $tongdonhang = get_tongdonhang();
                }
                $giatrivoucher = 0;
                if (isset($_GET['voucher']) && ($_GET['voucher'] == 1)) {
                    $tongdonhang = $_POST['tongdonhang'];
                    $mavoucher = $_POST['mavoucher'];
                    // so sanh voi dtb de lay gia tri ve
                    $giatrivoucher = 10;
                }
                if ($tongdonhang == 0) {
                    $giatrivoucher = 0;
                }
                $thanhtoan = $tongdonhang - $giatrivoucher;

                include "view/donhang.php";
            }
            break;

        case 'xoasp':

            if (isset($_GET['remove'])) {
                $idpro_to_remove = $_GET['remove'];

                // Loop through the cart and find the item with the specified product ID
                foreach ($_SESSION['giohang'] as $key => $sp) {


                    if ($sp['idpro'] == $idpro_to_remove) {
                        // Remove the item from the cart
                        unset($_SESSION['giohang'][$key]);
                        break; // Stop the loop after removing the item
                    }
                }
            }

            // Redirect back to the viewcart page

            header('location: index.php?pg=viewcart');
            include "view/viewcart.php";
            break;
        case 'dangnhap':
            include "view/dangnhap.php";
            if (isset($_POST['submit']) && ($_POST["submit"])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $kq = checkuser($username, $password);

                if (is_array($kq) && (count($kq))) {
                    $_SESSION['s_user'] = $kq;
                    header('location:index.php');
                } else {
                    $tb = "Tài khoản không tồn tại khoặc sai";
                    $_SESSION['tb_dangnhap'] = $tb;
                    header('location:index.php?pg=dangnhap');
                }
            }
            break;
        case 'dangky':
            include "view/dangky.php";
            break;
        case 'adduser':
            if (isset($_POST['submit']) && ($_POST["submit"])) {
                $password = $_POST['password'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                if (checkuseremail($email) == []) {
                    $iduser = user_insert_id($username, $password, $email);
                    usernh_insert_id($iduser, '', '');
                    header('location:index.php?pg=dangnhap');
                } else {
                    $_SESSION['error_email'] = 'Email đã tồn tại!';
                    header('location:index.php?pg=dangky');
                }
            }
            break;
        case 'dangxuat':
            if (isset($_SESSION['s_user']) && ($_SESSION['s_user'] > 0)) {
                unset($_SESSION['s_user']);
                header('location:index.php');
            }
            header('location:index.php');
            break;
        case 'quenmk':
            if (isset($_POST['guiemail']) && ($_POST['guiemail'])) {
                $email = $_POST['email'];
                $checkemail = kiemtraemail($email);
                if (is_array($checkemail)) {
                    submit_mailpass($checkemail['password'], $checkemail['email']);
                    echo '<script>alert("Chúng tôi đã cấp cho bạn mật khẩu vui lòng check mail của bạn.")</script>';
                    echo '<script>window.location.href = "index.php?pg=dangnhap";</script>';
                } else {
                    $thongbao = "Email này không tồn tại!";
                }
            }
            include "view/quenmk.php";
            break;
        case 'myaccount':
            if (isset($_SESSION['s_user']) && ($_SESSION['s_user'] > 0)) {
                include "view/myaccount.php";
            }
            break;
        case 'thaydoimatkhau':
            if (isset($_SESSION['s_user']) && ($_SESSION['s_user'] > 0)) {
                include "view/thaydoimatkhau.php";
            }
            break;
        case 'updatauser':
            if (isset($_POST['capnhat']) && ($_POST["capnhat"])) {
                $username = $_POST['username'];

                $email = $_POST['email'];
                $dienthoai = $_POST['dienthoai'];
                $diachi = $_POST['diachi'];
                $id = $_POST['id'];
                $img = $_FILES['image'];
                if ($img['name'] != '') {
                    $imgold = './uploads/' . $_SESSION['s_user']['anh'];
                            if (is_file($imgold)) {
                                unlink($imgold);
                            }
                    $target_file = './uploads/' . $img['name'];
                    move_uploaded_file($img['tmp_name'], $target_file);
                }
                // echo '<pre>';
                // print_r($img);
                // die();
                if ($email != $_SESSION['s_user']['email']) {
                    if (checkuseremail($email) != []) {
                        $_SESSION['error_email'] = 'Email đã tồn tại!';
                        header('location:index.php?pg=myaccount');
                    } else {
                        user_update($username, $email, $diachi, $dienthoai, $id,$img['name']);
                    }
                } else {
                    user_update($username, $email, $diachi, $dienthoai, $id,$img['name']);
                }
            }
            include "view/myaccount_confirm.php";
            break;
        case 'donhang':
            //             echo $_POST['pttt'];
            //             $a = noinhanhang($_SESSION['s_user']['id']);
            // print_r($a);
            //             die();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_SESSION['s_user']) && $_SESSION['giohang'] != []) {
                    $a = noinhanhang($_SESSION['s_user']['id']);
                    foreach ($a as $value) {
                        extract($value);
                        $nguoinhan_diachi = $noinhan;
                        $nguoinhan_tel = $sdt;
                    }
                    if($nguoinhan_diachi == ''||$nguoinhan_tel==''){
                        update_noinhan($_SESSION['s_user']['id'], $_SESSION['s_user']['dienthoai'], $_SESSION['s_user']['diachi']);
                        $nguoinhan_diachi = $_SESSION['s_user']['diachi'];
                        $nguoinhan_tel = $_SESSION['s_user']['dienthoai'];
                    }
                    $nguoinhan_ten = $_SESSION['s_user']['username'];
                    $pttt = $_POST['pttt'];
                    $ghichu = isset($_SESSION['ghichu']) ? $_SESSION['ghichu'] : '';
                    $iduser = $_SESSION['s_user']['id'];
                    $_SESSION['madon'] = "xshop" . $iduser . "-" . date("His-dmY");
                    $id_trangthai = 1;
                    $total = get_tongdonhang();
                    $ship = 0;
                    $voucher = $_POST['tienvouch'];
                    $tongthanhtoan =  $_POST['tongtien'];
                    $idvoucher = $_POST['idvouch'];

                    // echo $pttt;
                    // die();


                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $ngaymua = date("Y-m-d H:i:s");
                    $_SESSION['bill']=[
                        $_SESSION['madon'],
                        $iduser,
                        $total,
                        $pttt,
                        $ghichu,
                        $nguoinhan_ten,
                        $nguoinhan_diachi,
                        $nguoinhan_tel,
                        $ship,
                        $tongthanhtoan,
                        $voucher,
                        $id_trangthai,
                        $ngaymua,
                        $idvoucher];

                    if ($pttt == 2) {
                        $vnp_OrderInfo = "Thanh toán đơn hàng đặt tại Coffe chòi";
                        $vnp_OrderType = "Billpayment";
                        $vnp_Amount = $tongthanhtoan * 100; //Giá tiền
                        $vnp_Locale = "VN";
                        $vnp_BankCode = "NCB";
                        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
                        $vnp_ExpireDate = $expire;
                        $vnp_TxnRef = $_SESSION['madon'];
                        // echo  $vnp_ExpireDate;
                        // die
                        $inputData = array(
                            "vnp_Version" => "2.1.0",
                            "vnp_TmnCode" => $vnp_TmnCode,
                            "vnp_Amount" => $vnp_Amount,
                            "vnp_Command" => "pay",
                            "vnp_CreateDate" => date('YmdHis'),
                            "vnp_CurrCode" => "VND",
                            "vnp_IpAddr" => $vnp_IpAddr,
                            "vnp_Locale" => $vnp_Locale,
                            "vnp_OrderInfo" => $vnp_OrderInfo,
                            "vnp_OrderType" => $vnp_OrderType,
                            "vnp_ReturnUrl" => $vnp_Returnurl,
                            "vnp_TxnRef" => $vnp_TxnRef,
                            "vnp_ExpireDate" => $vnp_ExpireDate
                        );

                        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                            $inputData['vnp_BankCode'] = $vnp_BankCode;
                        }

                        // var_dump($inputData);
                        // die();

                        ksort($inputData);
                        $query = "";
                        $i = 0;
                        $hashdata = "";
                        foreach ($inputData as $key => $value) {
                            if ($i == 1) {
                                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                            } else {
                                $hashdata .= urlencode($key) . "=" . urlencode($value);
                                $i = 1;
                            }
                            $query .= urlencode($key) . "=" . urlencode($value) . '&';
                        }

                        $vnp_Url = $vnp_Url . "?" . $query;
                        if (isset($vnp_HashSecret)) {
                            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                        }
                        $returnData = array(
                            'code' => '00',
                            'message' => 'success',
                            'data' => $vnp_Url
                        );

                        if (isset($_POST['submit'])) {
                            // echo $vnp_Url;
                            header("location:" . $vnp_Url);
                            // echo $vnp_Url;
                            die();
                        } else {
                            echo json_encode($returnData);
                        }
                    }
                    if ($pttt == 3) {
                        
                        header('Content-type: text/html; charset=utf-8');
                        
                        function execPostRequest($url, $data)
                        {
                            $ch = curl_init($url);
                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt(
                                $ch,
                                CURLOPT_HTTPHEADER,
                                array(
                                    'Content-Type: application/json',
                                    'Content-Length: ' . strlen($data)
                                )
                            );
                            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                            //execute post
                            $result = curl_exec($ch);
                            //close connection
                            curl_close($ch);
                            return $result;
                        }
    
    
                        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
    
    
                        $partnerCode = 'MOMOBKUN20180529';
                        $accessKey = 'klm05TvNBzhg7h7j';
                        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
    
                        $orderInfo = "Thanh toán qua MoMo";
                        $amount = $tongthanhtoan;
                        $orderId =  $_SESSION['madon'] ;
                        // $orderId = time() . "";
                        $redirectUrl = "http://localhost/duan1/index.php?pg=billconfirm";
                        $ipnUrl = "http://localhost/duan1/index.php?pg=billconfirm";
                        $extraData = "";
    
                        $requestId = time() . "";
                        $requestType = "payWithATM";
                        $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
    
                        //before sign HMAC SHA256 signature
                        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                        $signature = hash_hmac("sha256", $rawHash, $secretKey);
                        $data = array(
                            'partnerCode' => $partnerCode,
                            'partnerName' => "Test",
                            "storeId" => "MomoTestStore",
                            'requestId' => $requestId,
                            'amount' => $amount,
                            'orderId' => $orderId,
                            'orderInfo' => $orderInfo,
                            'redirectUrl' => $redirectUrl,
                            'ipnUrl' => $ipnUrl,
                            'lang' => 'vi',
                            'extraData' => $extraData,
                            'requestType' => $requestType,
                            'signature' => $signature
                        );
                        $result = execPostRequest($endpoint, json_encode($data));
                        $jsonResult = json_decode($result, true);  // decode json
    
                        //Just a example, please check more in there
    
                        header('Location: ' . $jsonResult['payUrl']);

                        // echo "alooo";
                        // die();
                    }
                    
                    if ($pttt !=2 && $pttt!=3 ) {
                        header("Location:index.php?pg=billconfirm");
                    }
                } else {
                    header('location:index.php?pg=viewcart');
                }
            } else {
                // print_r($);
                //     die();

                include "view/donhang.php";
            }

            break;
        case 'updatedcnhan':
            if (isset($_SESSION['s_user'])) {
                extract($_SESSION['s_user']);
                # code...
                echo 'hello';
                $diachi = $_POST['diachi_nguoinhan'];
                $sdt = $_POST['dienthoai_nguoinhan'];
                update_noinhan($id, $sdt, $diachi);
                $ghichu = $_POST['ghichu'];
                if ($ghichu != '') {
                    if (isset($_SESSION['ghichu'])) {
                        unset($_SESSION['ghichu']);
                    }
                    $_SESSION['ghichu'] = $ghichu;
                }
                header('Location:index.php?pg=donhang');
            } else {
                header('Location:index.php?pg=donhang');
            }
            break;
        case 'billconfirm':
            // echo'<pre>';
            // print_r($_SESSION['bill']);
            // die();
            if (isset($_SESSION['bill'])) {
                
            $idbill = bill_user_insert_id(
                $_SESSION['madon'],
                $_SESSION['bill'][1],
                $_SESSION['bill'][2],
                $_SESSION['bill'][3],
                $_SESSION['bill'][4],
                $_SESSION['bill'][5],
                $_SESSION['bill'][6],
                $_SESSION['bill'][7],
                $_SESSION['bill'][8],
                $_SESSION['bill'][9],
                $_SESSION['bill'][10],
                $_SESSION['bill'][11],
                $_SESSION['bill'][12]
                );
                if ($_SESSION['bill'][13] != '') {
                    voucherct($_SESSION['bill'][13], $_SESSION['s_user']['id']);
                }
                unset($_SESSION["bill"]);
                $id_giohang = cart_insert_id($_SESSION["giohang"], $_SESSION['s_user'], $idbill);
                unset($_SESSION["giohang"]);
                include "view/donhang_configm.php";
        }else{
            header('Location:index.php?pg=viewcart');
        }
            break;
        case 'mybill':
            $itemsPerPage = 4;
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $total_pages = 0;
            if ($current_page == '' || $current_page == 1) {
                $begin = 0;
            } else {
                $begin = ($current_page - 1) * $itemsPerPage;
            }
            if (isset($_SESSION['s_user'])) {
                $total_pages = so_trangdh($itemsPerPage, $_SESSION['s_user']['id']);
                $id = $_SESSION['s_user']['id'];
                $bill = donhang_id($id, $begin, $itemsPerPage);
            }
            include "view/mybill.php";
            break;
        case "delgh":
            $idsp = $_GET['idsp'];
            $tien = $_GET['tien'];
            $giohang = $_SESSION['giohang'];
            $keyToDelete = -1;
            foreach ($giohang as $key => $sp) {
                if ($sp['idpro'] == $idsp && $sp['tien'] == $tien) {
                    $keyToDelete = $key;
                    break;
                }
            }
            if ($keyToDelete != -1) {
                unset($_SESSION['giohang'][$keyToDelete]);
                // Cập nhật lại session nếu cần
            }
            header('Location:index.php?pg=viewcart');
            break;
        case "chitietdonhang":
            $chitietdh = chitietdh($_GET['idbill']);
            $chitietgh = chitietgh($_GET['idbill']);
            // echo "<pre>";
            // print_r($chitietdh);
            $ten="";
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
            $sp = "";
            foreach ($chitietdh as $value) {
                $ten=$value['nguoinhan_ten'];
                $diachi = $value['nguoinhan_diachi'];
                $sdt = $value['nguoinhan_tel'];
                $tong = $value['total'];
                $tongthanhtoan = $value['tongthanhtoan'];
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
                        <div style="display:flex;">
                            <img class="img" style="box-shadow : 0 -3px 10px 0 rgba(185, 185, 185, 0.5),0 5px 5px 0 rgba(185, 185, 185, 0.5);" src="' . IMG_PATH_USER . $ten_hinh . '" width="100px" style="float: left; margin-right: 20px;" alt="">
                            <div style="margin-left:20px;">
                                <p style="margin:0;">' . $name . '</p>
                                <p>Size: ' . $size . '</p>
                                <p>Số lượng: x' . $soluong . '</p>
                            </div>
                        </div>
                        <p class="tien">' . number_format($tien,0,',','.') . ' đ</p>
                    </div>';
            }
            // echo "<pre>";
            // print_r($chitietgh);
            // die();
            include "view/donhangchitiet.php";
            break;
        case "deletedh":
            if ($_GET['idtht']==2||$_GET['idtht']==3){
                $sql = "UPDATE bill SET id_trangthai=? WHERE id=?";
                pdo_execute($sql, 7, $_GET['id']);
                header('Location:index.php?pg=mybill');
            }
            if($_GET['idtt']==7){
                $sql = "UPDATE bill SET id_trangthai=? WHERE id=?";
                pdo_execute($sql, 1, $_GET['id']);
                header('Location:index.php?pg=mybill');
            }else if(($_GET['idtt']==1 && $_GET['idtht']==1)||($_GET['idtt']==1 && $_GET['idtht']==1)){
                $sql = "UPDATE bill SET id_trangthai=? WHERE id=?";
                pdo_execute($sql, 6, $_GET['id']);
                header('Location:index.php?pg=mybill');
            }
            break;
        default:
            break;
    }
}
include "view/footer.php";
