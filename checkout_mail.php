<?php
include('smtp/PHPMailerAutoload.php');

function checkout_mailer($email){
    $mail = new PHPMailer();
    $mail->SMTPDebug  = 0;
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Username = "greendream2701@gmail.com";
    $mail->Password = "idfxbyztumokmdct";
    $mail->SetFrom("greendream2701@gmail.com ", "Fluids24");
    $mail->Subject = "You placed an order through Fluids24";
    $mail->Body ="<html><body> <h1>Hey <b>".$_SESSION['username']."</b>,</h1><p>Your order has been placed successfully.</p>";
    $mail->AddAddress($email);
    $mail->SMTPOptions=array('ssl'=>array(
        'verify_peer'=>false,
        'verify_peer_name'=>false,
        'allow_self_signed'=>false
    ));
    if(!$mail->Send()){
        $mail->ErrorInfo;
    }
}

?>