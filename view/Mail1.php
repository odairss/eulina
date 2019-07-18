﻿<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

echo '<META HTTP-EQUIV="REFRESH" CONTENT="15; URL=http://www.orquestrasinfonicadorn.com.br/contato">';
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require '../plugins/phpmailer/src/PHPMailer.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'relay-hosting.secureserver.net';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 25;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = false;

//Whether to use SMTP authentication
$mail->SMTPAuth = false;



//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "orquestrasinfonicarn@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "quartasclassicas";

//Set who the message is to be sent from
$mail->setFrom("orquestrasinfonicarn@gmail.com", "Orquestra Sinfonica do Rio Grande do Norte");

//Set an alternative reply-to address
$mail->addReplyTo("orquestrasinfonicarn@gmail.com", "Orquestra Sinfonica do Rio Grande do Norte");

//Set who the message is to be sent to
$mail->addAddress('orquestrasinfonicarn@gmail.com', 'Orquestra Sinfonica do Rio Grande do Norte');

//Set the subject line
$mail->Subject = 'contato';

$message_body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>PHPMailer Test</title>
</head>
<body>
<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 13px;">
      <p>' . $_POST["mensagem"] . '</p>
          <p>Enviado por: ' . $_POST["nomeRemetente"] . '<br/>Contato: ' . $_POST["telephony"] . '<br/>E-mail: '.$_POST["emailRemetente"].'</p>
</div>
</body>
</html>';




//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($message_body);

//Replace the plain text body with one created manually
$mail->AltBody = $_POST["mensagem"];

//Attach an image file
//$mail->addAttachment('../img/logos/logoosrn.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";

    echo "<center><h1>E-mail enviado com sucesso!</h1></center>";
    echo '<META HTTP-EQUIV="REFRESH" CONTENT="7"; URL="http://www.orquestrasinfonicadorn.com.br/index.php?ctd=3">';
}
