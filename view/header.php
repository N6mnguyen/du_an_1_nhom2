<?php

if (isset($_SESSION['s_user']) && ($_SESSION['s_user'] > 0)) {
    extract($_SESSION['s_user']);
    $html_account = '<a href="index.php?pg=myaccount">' . $username . '</a></a>
    <a href="index.php?pg=dangxuat">Thoát</a>';
} else {
    $html_account = '   <a href="index.php?pg=dangky" class="menu_link" >ĐĂNG KÝ</a>
                        <a href="index.php?pg=dangnhap" class="menu_link" >ĐĂNG NHẬP</a>';
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffe House</title>
    <link rel="stylesheet" href="layout/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
</head>

<body>
    <div class="header">
        <div class="header_inner">
            <div class="logo">
                <a href="index.php">
                    <img src="layout/images/Web_Photo_Editor.jpg" alt="">
                </a>
            </div>
            <nav>
                <div class="menu-icon">☰</div>
                <ul class="menu">
                    <li class="menu_item"><a href="index.php" class="menu_link">TRANG CHỦ</a></li>
                    <li class="menu_item">
                        <a href="index.php?pg=sanpham" class="menu_link">SẢN PHẨM</a>
                        <div class="menu_child">
                            <div class="menu_child-item">
                                <h4><a href="">Tất cả</a></h4>

                            </div>
                            <!--  -->
                            <div class="menu_child-item">
                                <div class="menudoc">
                                    <h4><a href="">Tea</a></h4>
                                    <ul class="menu_child-list">
                                        <li><a href="">Trà trái cây</a></li>
                                        <li><a href="">Trà thái</a></li>
                                        <li><a href="">Trà sữa Matcha</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!--  -->
                            <div class="menu_child-item">
                                <div class="menudoc">
                                    <h4><a href="">Tea</a></h4>
                                    <ul class="menu_child-list">
                                        <li><a href="">Trà trái cây</a></li>
                                        <li><a href="">Trà thái</a></li>
                                        <li><a href="">Trà sữa Matcha</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!--  -->
                            <div class="menu_child-item">
                                <div class="menudoc">
                                    <h4><a href="">Tea</a></h4>
                                    <ul class="menu_child-list">
                                        <li><a href="">Trà trái cây</a></li>
                                        <li><a href="">Trà thái</a></li>
                                        <li><a href="">Trà sữa Matcha</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="menu_child-item">
                                <div class="menudoc">
                                    <h4><a href="">Tea</a></h4>
                                    <ul class="menu_child-list">
                                        <li><a href="">Trà trái cây</a></li>
                                        <li><a href="">Trà thái</a></li>
                                        <li><a href="">Trà sữa Matcha</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="menu_item"><a href="index.php?pg=danhmuc" class="menu_link">DANH MỤC</a></li>
                    <li class="menu_item"><a href="index.php?pg=viewcart" class="menu_link">GIỎ HÀNG</a></li>
                    <li class="menu_item"><a href="index.php?pg=mybill" class="menu_link">ĐƠN CỦA TÔI</a></li>
                    <li class="menu_item"><a href="" class="menu_link">
                            <?= $html_account ?>
                        </a></li>
                </ul>
            </nav>

            <form action="index.php?pg=sanpham" method="get">
                <div class="tks">
                    <input type="hidden" name="pg" value="sanpham">
                    <input class="inputs" type="text" name="kyw" placeholder="Tìm Từ khoá Tìm Kiếm">
                    <input class="bttons" type="submit" name="timkiem" value="Go">
                </div>
            </form>
        </div>
    </div>

    <div class="containerfull">
        <div class="banner">
            <img id="banner" src="layout/images/anh0.jpg" alt="">
            <!-- <button class="pre" onclick="pre()">&#10094;</button>
            <button class="next" onclick="next()">&#10095;</button> -->
        </div>
    </div>
    <script>
        var album = [];
        for (var i = 0; i < 3; i++) {
            album[i] = new Image();
            album[i].src = "layout/images/anh" + i + ".jpg";
        }
        var interval = setInterval(slideshow, 4000);
        index = 0;
        function slideshow() {
            index++;
            if (index > 3) {
                index = 0;
            }
            document.getElementById("banner").src = album[index].src;


        }
        function next() {
            index++;
            if (index > 3) {
                index = 0;
            }
            document.getElementById("banner").src = album[index].src;

        }
        function pre() {
            index--;
            if (index < 0) {
                index = 3;
            }
            document.getElementById("banner").src = album[index].src;

        }
    </script>




    <style>
        body {
            font-family: "Montserrat", sans-serif;
            margin: 0 auto;
            padding: 0;
        }

        nav {
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu-icon {
            color: black;
            display: none;
            font-size: 1.5em;
            cursor: pointer;
        }

        .header {
            background-color: #fff;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center;
            position: relative;
            z-index: 1;
            margin-bottom: -20px;
        }

        .header_inner {
            width: 100%;
            /* Để logo và menu chiếm toàn bộ width */
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Chỉnh lại style cho menu */
        .menu {
            display: flex;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        @media screen and (max-width: 1490px) {
            .menu {
                display: none;
            }

            .menu-icon {
                color: black;
                display: block;
                /* Hoặc display: inline; hoặc display: inline-block; */
                font-size: 1.5em;
                cursor: pointer;
            }

            .menu.show {
                display: flex;
                flex-direction: column;
                position: absolute;
                background-color: #fff;
                /* Đặt màu nền trắng */
                top: 100px;
                left: 0;
                right: 0;
                z-index: 2;
                transition: .25s linear;
            }
        }


        /*  */

        .menu_item {
            margin: 0 1rem;
            /* Giới hạn chiều rộng tối đa của menu_item */
            max-width: 200px;
            white-space: nowrap;
            /* Ngăn chữ xuống dòng */
            /* Ẩn nội dung bị tràn */
            text-overflow: ellipsis;
            /* Hiển thị dấu ba chấm (...) khi nội dung bị tràn */
        }
        .menu_item a{
            font-size: 0.8rem;
        }

        .menu_item:hover .menu_child {
            /* opacity: 1;
            visibility: visible; */
        }

        .menu_child {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: white;
            display: flex;
            opacity: 0;
            visibility: hidden;
            transition: .25s linear;
        }

        .menu_child-item {
            width: 100%;
            padding: 2rem;
        }

        .menu_child-item h4 {
            color: white;
            font-size: 1.4rem;
            text-align: center;
        }

        .menu_child-item h4 a {
            text-decoration: underline;
            color: black;
        }

        .menu_child-item h4 a:hover {
            color: #993300;
        }

        .menu_child-list li a {
            color: gray;
        }

        .menu_child-list li a:hover {
            color: #993300;
        }

        .menu_child-item li {}

        .menudoc {
            width: 300px;
        }

        .menudoc .menu_child-list {
            padding-left: 7rem;
        }

        .menu-link {
            color: black;

        }
    </style>

    <script>
        document.querySelector(".menu-icon").addEventListener("click", function () {
            document.querySelector(".menu").classList.toggle("show");
        });

        document.querySelector(".menu-icon").addEventListener("click")

        document.querySelector(".menu-icon")

        document.querySelector(".menu-icon").addEventListener("click", function () {
            document.querySelector(".menu").classList.toggle("show");
        });
    </script>