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
                        Hi,<br><br>
                        Reset your password, please click on the link below:<br><br><a href='http://localhost/voteonitnow/user/reset_password?token=" . $token . "&email=".$email."'>http://localhost/voteonitnow/user/reset_password?token=" . $token . "&email=".$email."</a><br><br>
                        Kind Regard,<br>
                        www.voteonitnow.com
                   ";
if ($mail->send()) {
    $_SESSION['sendMail'] = "<div class='alert alert-success'>Please check your email we have send a password reset link your registered email.</div>";
    header("location:" . BASE_URL . "/user/forgot");

} else {
    echo "Something wronge";
}
?>