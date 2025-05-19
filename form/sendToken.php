<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require __DIR__ . '/vendor/autoload.php';
require_once 'db.php';
require_once 'form.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

global $emailSender;
$emailSender = getenv('EMAIL');
global $password;
$emailPass  = getenv('EMAIL_PASS');
$email = $_POST['email'];
$type = $_POST['type'];

if (isset($_POST['action']) && $_POST['action'] === 'sendToken') {
    send($email,$type);
}

function getToken () {
    return  bin2hex(random_bytes(32));
}


function send($email,$type) {

    global $emailSender,$emailPass;  
    
    $token = getToken();
    $id = getIdFromEmail($email);

    $response = [
      'message' => '',
      'icon'  => 'bx bxs-message-error error'
  ];
  
    $baseUrl = 'http://localhost/E-COMMERCE/form/verifyToken.php';
    $link    = $baseUrl . '?token=' . urlencode($token) .'&type=' .urlencode($type) . '&id='.urlencode($id);

    $subject = match($type) {
      'verify'   => 'Please confirm your email address',
      'email' => 'Change Your Email',
      'password' => 'Reset your password',
      'delete' => 'Delete your account',
      default    => 'Here is your link',
    };

    $message = "
      <html>
      <body>
        <p>Hi there,</p>
        <p>Please click the link below to {$subject}:</p>
        <p><a href=\"{$link}\">{$link}</a></p>
        <p>This link will expire in 15 minutes.</p>
      </body>
      </html>
    ";

    
$mail = new PHPMailer(true);
try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $emailSender;
    $mail->Password   = $emailPass;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    
    // Connection timeout and options to help with stability
    $mail->Timeout = 20; // seconds
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    // Recipients
    $mail->setFrom($emailSender, 'E_COMMERCE_2025');
    $mail->addAddress($email);
    
    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $message;

    $mail->send();
    $response['message'] = "Successfully sent {$type} email to {$email}. Please check your inbox.";
    $response['icon']   = "bx bxs-message-check not-error";
} catch (Exception $e) {
    $response['message'] = "Failed to send {$type} email to {$email}. Error: " ;
    $response['icon']     = "bx bxs-message-error error";
}
    if($response['message'] === ''){
    insertToken($token,$id,$type);
    }
    echo json_encode($response);
    exit;


}

?>