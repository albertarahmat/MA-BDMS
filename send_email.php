<?php

date_default_timezone_set('Etc/UTC');

require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP(); 
$mail->SMTPAuth = true;
$mail->SMTPDebug = 2; 

$mail->Host ='mail.baramultigroup.co.id'; 
$mail->Username = 'alberta_r@baramultigroup.co.id';
$mail->Password = '@Lb3rt4r';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('alberta_r@baramultigroup.co.id', 'Alberta');
$mail->addAddress('andreas_rw@baramultigroup.co.id', 'wiwit');
$mail->Subject = 'PHPMailer = test';
$mail->msgHTML("BISA NIH"); 
$mail->AltBody = 'HTML messaging not supported';

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

?>