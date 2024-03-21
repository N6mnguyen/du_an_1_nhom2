<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class Mailer
{

    public function dathangmail($maildathang, $tieude, $noidung)
    {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Nó tả về kiểu dữ liệu
            $mail->SMTPDebug = 0; // Im re luôn
            $mail->isSMTP(); // Gửi mail SMTP
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'namnvph38661@fpt.edu.vn'; // SMTP username (your Gmail email)
            $mail->Password = 'azxx uzou sluz dwdz'; // SMTP password or token (use app password or token for security)
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption
            $mail->Port = 587; // TCP port to connect to

            // Recipients
            $mail->setFrom('namnvph38661@fpt.edu.vn', 'Coffe House');
            $mail->addAddress($maildathang, 'Khách Hàng'); // Add recipient email and name

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $tieude; // Tiêu đề
            $mail->Body = $noidung;

            $mail->send();
            // echo 'Gửi thành công';
        } catch (Exception $e) {
            echo "Không gửi được bị lỗi: {$mail->ErrorInfo}";
        }
    }
}

