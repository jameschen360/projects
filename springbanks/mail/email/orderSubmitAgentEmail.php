<?php
include('include/emailHead.php');
include('include/emailBodyAgent.php');
include('include/emailBodyContent.php');
include('include/emailFooter.php');

$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;// or 587
$mail->IsHTML(true);
$mail->Username = $auto_email;
$mail->Password = $auto_pwd;
$mail->SetFrom($auto_email, 'Springbank Delivery New Order ID: '.$orderID);
$mail->Subject = 'Order was submitted on '.$serverCurrentTimeFull;
$mail->Body = $message;
$mail->AddAddress($auto_email);

if(!$mail->Send()) {
echo "Mailer Error: " . $mail->ErrorInfo;
} else {
echo "Message has been sent";
}
?>