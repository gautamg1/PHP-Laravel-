<?php
$email = $data['email'];
$token = $data['token'];
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$mail->IsSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = TRUE;
$mail->Username = 'nitin.urvam@gmail.com';
$mail->Password = 'nitin.chavda216@';
$mail->From = 'nitin.urvam@gmail.com';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom('nitin.urvam@gmail.com', 'www.voteonitnow.com');
$mail->addAddress($email);
$mail->IsHTML(true);
$mail->Subject = 'Reset password';
$mail->Body = "
                        Dear Admin,<br><br>
                        To Reset your Password, Please Click on the Button below:<br><br>
                        <a href='http://localhost/voteonitnow/admin/login/resetpassword?token=" . $token . "&email=".$email."' style='background-color:#68b828;color:#fff;line-height:1;padding: 13px 30px;text-decoration:none'>
                        Reset Password</a><br><br>
                        Kind Regard,<br>
                        http://www.voteonitnow.com
                   ";
if ($mail->send()) {
    $_SESSION['sendMail'] = "<div class='alert alert-success'>Dear Admin,Check Your Email, We Have Sent a Password Reset Link on it.</div>";
    header("location:" . BASE_URL . "/admin/login/forgotpassword");

} else {
    echo "Something Went Wrong";
}
?>