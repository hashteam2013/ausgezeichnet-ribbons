<?php




$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
//Server settings
$mail->SMTPDebug = 2;                                 // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.ausgezeichnet.cc';  // Specify main and backup SMTP servers
$mail->SMTPAuth = false;                               // Enable SMTP authentication
$mail->Username = 'user@example.com';                 // SMTP username
$mail->Password = 'secret';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
//Recipients
$mail->setFrom('office@ausgezeichnet.cc', 'office@ausgezeichnet');
$mail->addReplyTo('office@ausgezeichnet.cc', 'office@ausgezeichnet');

$mail->addAddress('hashkapilkalra@gmail.com', 'Kapil Kalra');     // Add a recipient

//Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Here is the subject';
$mail->Body = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if ($mail->send()) {
    echo 'Message has been sent';
} else {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
