<?php 
session_start();
ob_start();
if(isset($_SESSION['user'])&&($_SESSION['user']["role"]==1)){
    header('location:admin.php');
}else{
    header('location:login.php');
}
?>

