<?php
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
    insertToken($token,$id,$type);

    $response = [
      'message' => '',
      'icon'  => 'bx bxs-message-error error'
  ];
  
    $baseUrl = 'http://localhost/E-COMMERCE/verifyToken.php';
    $link    = $baseUrl . '?token=' . urlencode($token);

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
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $emailSender;
        $mail->Password   = $emailPass;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom($emailSender, 'E_COMMERCE_2025');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        $response['message'] = "Successfully sent {$type} email to {$email}. Please check your inbox.";
        $response['icon']   = "bx bxs-message-check not-error";
    } catch (Exception $e) {
        $response['message'] = "Failed to send {$type} email to {$email}. Please try again later.";
        $response['icon']     = "bx bxs-message-error error";
    }

    echo json_encode($response);
    exit;


}

?>