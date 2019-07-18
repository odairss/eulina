<?php

//echo '<META HTTP-EQUIV="REFRESH" CONTENT="15; URL=http://www.orquestrasinfonicadorn.com.br/contato">';

/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

require '../vendor/autoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$emailRemetente = $_POST["emailRemetente"];
$nomeRemetente = $_POST["nomeRemetente"];
$mensagem = $_POST["mensagem"];
$telephony = $_POST["telephony"];
$message_body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>Mensagem via website da OSRN</title>
</head>
<body>
<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 13px;">
      <p>' . $mensagem . '</p>
          <p>Enviado por: ' . $nomeRemetente . '<br/>Contato: ' . $telephony . '<br/>E-mail: ' . $emailRemetente . '</p>
</div>
</body>
</html>';

//$mail->isSMTP();


$mail->Host = "p3plcpnl0558.prod.phx3.secureserver.net"; //relay-hosting.secureserver.net
$mail->Port = 25;
$mail->SMTPDebug = 0;
$mail->SMTPSecure = "none";
$mail->SMTPAuth = false;
$mail->Username = "";
$mail->Password = "";


//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
//$mail->SMTPDebug = 2;
//Set the hostname of the mail server
//$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
//$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
//$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
//$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
//$mail->Username = "orquestrasinfonicarn@gmail.com";
//Password to use for SMTP authentication
//$mail->Password = "quartasclassicas";
//Set who the message is to be sent from
$mail->setFrom("osrn@orquestrasinfonicadorn.com.br", "OSRN");
//Set an alternative reply-to address
$mail->addReplyTo($emailRemetente, $nomeRemetente);
//Set who the message is to be sent to
$mail->addAddress('orquestrasinfonicarn@gmail.com', 'OSRN');
//Set the subject line
$mail->Subject = 'contato via website';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);

$mail->Body = $message_body;
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
$mail->addAttachment('../img/logos/logoosrn.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
//    echo "Message sent!";
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    if (save_mail($mail)) {
        echo "Message saved!";
    }
    header('Location:http://www.orquestrasinfonicadorn.com.br/contato/sent');
}

//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl') to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
function save_mail($mail) {
    //You can change 'Sent Mail' to any other folder or tag
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);
    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);
    return $result;
}
