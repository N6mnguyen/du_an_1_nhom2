<?php
session_start();
include "../dao/pdo.php";
include "../dao/binhluan.php";
$hoten ='';
$checkuserbl=[];
if (isset($_SESSION['s_user'])) {
    $iduser = $_SESSION['s_user']['id'];
    $hoten = $_SESSION['s_user']['username'];
    $checkuserbl=checkuserbl($_GET['idpro'], $_SESSION['s_user']['id']);

}
if (isset($_POST['guibinhluan'])) {
    $sobl=0;
     foreach( countbluser($iduser)as $value){
        $sobl =$value['soLuongBinhLuan'];
     };
     $userComment = $_POST['noidung'];

     // Danh sách các từ cấm
     $blacklist = array("dm", "cứt", "cc");
     
     // Kiểm tra xem bình luận có chứa từ cấm hay không
     $containsForbiddenWord = false;
     foreach ($blacklist as $word) {
         if (stripos($userComment, $word) !== false) {
             $containsForbiddenWord = true;
             break;
         }
     }
     
     if ($containsForbiddenWord) {
        echo '<script>alert("Nội dung nhạy cảm!!")</script>';

     } else {
       
         if ($sobl<5) {
             $idpro = $_POST['idpro'];
             $noidung = $_POST['noidung'];
             date_default_timezone_set('Asia/Bangkok');
             $ngaybl = date('H:i:s d/m/Y');
             $iduser = $_SESSION['s_user']['id'];
             $hoten = $_SESSION['s_user']['username'];
             binhluan_insert( $noidung, $ngaybl,$idpro,$iduser);
         }else{
             echo '<script>alert("Số lượng bình luận đã đạt đến giới hạn!")</script>';
         }
     }
}
$dsbl = binhluan_sp($_GET['idpro']);
// echo'<pre>';
// print_r($dsbl);
$html_bl = "";
$avbackup='avata.jpg';
foreach ($dsbl as $bl) {
    extract($bl);
    if ($anh=='') {
        $image='../uploads/'.$avbackup;
    }else{
        $image='../uploads/'.$anh;
    }
    $html_bl .= '<p class="bl" >
                     <div>
                        <img class="avata" style="width:40px; height:40px;" src="'.$image.'" alt="">  
                        <div class="name">  ' . $username. ' - (' . $ngaybl . ')
                        </div>
                    </div>
                <p> ' . $noidung . '</p>
                </p> 
                <hr>';
}

?>
<link rel="stylesheet" href="../layout/css/style.css">
<h3>Bình luận sản phẩm</h3>

<?php
if (isset($_SESSION['s_user']) && (count($_SESSION['s_user']) > 0) && $checkuserbl!=[]) {


    ?>

    <form action="/duan1/view/binhluan.php?idpro=<?=$_GET['idpro'] ?>" method="post">
        <input type="hidden" name="idpro" value="<?=$_GET['idpro'];?>">                                                                            
        <textarea name="noidung" id="" cols="100" rows="5" required placeholder="Nhập bình luận của bạn..."></textarea> <br>
        <br>
        <button type="submit" class="button" name="guibinhluan">Gửi bình luận</button>
    </form>
    <?php
} else {
    $_SESSION['trang'] = "sanphamchitiet";
    $_SESSION['idpro'] = $_GET['idpro'];
    echo "<a href='../index.php?pg=dangnhap' target='_parent' >Bạn phải đăng nhập và mua sản phẩm để sử dụng chức năng này!</a>";
}
?>
<div class="dsbl">
    <?= $html_bl ?>
</div>
<style>
      body {
    font-family: Arial, sans-serif;
}

#comments-container {
    margin-bottom: 20px;
}

.comment {
    background-color: #f0f0f0;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
}

#comment-form {
    display: flex;
    flex-direction: column;
}

#comment-text {
    margin-bottom: 10px;
    padding: 5px;
}
.button {
    background-color: #715445;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    
}

.button:hover {
    background-color: #615445;
}

.button:active {
    background-color: #615445;
}
.bl {
    margin-bottom: 20px;
}

.avata {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
}

.name {
    font-weight: bold;
}

p {
    margin: 10px 0;
}

/* Optional: Style for the comment date */
.date {
    color: #777;
    font-size: 12px;
}

/* Optional: Style for the comment text */
.comment-text {
    color: #333;
    line-height: 1.5;
}
</style>