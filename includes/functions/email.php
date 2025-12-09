<?php


// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function SendEmail($Subject, $ToEmail, $FromEmail, $FromName, $Message, $Bcc = "", $Format = "html", $FileAttachment = false, $AttachmentFileName = "") {
    return send_email($Subject, $ToEmail, $FromEmail, $FromName, $Message, $Bcc = "", $Format = "html", $FileAttachment = false, $AttachmentFileName = "");
}

function send_email($Subject, $ToEmail, $FromEmail, $FromName, $Message, $Bcc = "", $Format = "html", $FileAttachment = false, $AttachmentFileName = "") {

    $mail = new PHPMailer();
   // if (IS_SMTP == 'SMTP') {
        $mail->IsSMTP();            // send via SMTP
        $mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
        $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
        $mail->Host = "smtp.world4you.com";      // sets GMAIL as the SMTP server
        $mail->Port = 587;                   // set the SMTP port for the GMAIL server
        $mail->Username = "office@ausgezeichnet.cc";  // GMAIL username
        $mail->Password = "bandspange8612";
        #$mail->Host     = "smtp.world4you.com"; // SMTP servers
        $mail->SMTPAuth = true;     // turn on SMTP authentication	
        #$mail->Username = "office@ausgezeichnet.cc";  // SMTP username
        #$mail->Password = "bandspange8612"; // SMTP password
    //}

    $mail->From = $FromEmail;
    $mail->FromName = $FromName;
    $mail->AddAddress(trim($ToEmail), trim($ToEmail));
    $MyBccArray = explode(",", $Bcc);
    foreach ($MyBccArray as $Key => $Value) {
        if (trim($Value) != "")
            $mail->AddBCC("$Value");
    }
    if ($Format == "html")
        $mail->IsHTML(true);                               // send as HTML
    else
        $mail->IsHTML(false);                               // send as Plain

    $mail->Subject = $Subject;
    $mail->Body = $Message;
    //$mail->AltBody  =  $Message;

    if ($FileAttachment)
        $mail->AddAttachment($AttachmentFileName, basename($AttachmentFileName));
    
    if ($mail->Send()) {
        return true;
    } else{
        return false;
        echo "Message was not sent <p>";
       echo "Mailer Error: " . $mail->ErrorInfo;
        exit;
    }
}
?>