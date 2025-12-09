<?php

$to = 'hashkapilkalra@gmail.com';
$subject = "Ausgezeichnet - Account Verification";
$message = 'You have been registerd successfully, for Verification your account<br><a href="' . make_url('activation', array('key' => 'abc')) . '">Click Here</a>';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'FROM: Ausgezeichnet.cc <' . FROM_EMAIL .'>'."\r\n" . 'Reply-To:' . REPLY_TO_EMAIL . "\r\n" . 'X-Mailer: PHP/' . phpversion();
$move = mail($to, $subject, $message, $headers);
if ($move) {
    echo "yes";
} else{
    echo "no";
}
    exit;