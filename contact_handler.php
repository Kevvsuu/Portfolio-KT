<?php
// Include PHPMailer classes FIRST
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// TEMPORARILY enable errors to see what's wrong (REMOVE after fixing)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set JSON header
header('Content-Type: application/json');

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

// Get form data
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Validate
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
    exit;
}

// Create PHPMailer instance
$mail = new PHPMailer(true);

try {
    // SMTP Configuration
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'kevintolentino1821@gmail.com';
    $mail->Password   = 'agii jllv pjyw jmrv';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    
    // Recipients
    $mail->setFrom('Kevintolentino1821@gmail.com', 'Portfolio Contact Form');
    $mail->addAddress('Kevintolentino1821@gmail.com', 'Kevin Tolentino');
    $mail->addReplyTo($email, $name);
    
    // Content
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'Portfolio Contact: ' . $subject;
    
    $mail->Body = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
            .header { background: linear-gradient(135deg, #6366f1, #818cf8); color: white; padding: 30px 20px; text-align: center; }
            .content { padding: 30px; }
            .info-card { background: #f8f9fa; border-left: 4px solid #6366f1; padding: 15px; margin: 15px 0; border-radius: 4px; }
            .label { font-weight: 600; color: #6366f1; font-size: 14px; }
            .value { color: #333; font-size: 16px; margin-top: 5px; }
            .message-box { background: #ffffff; border: 2px solid #e5e7eb; border-radius: 8px; padding: 20px; margin: 20px 0; }
            .footer { background: #f8f9fa; padding: 20px; text-align: center; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 14px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>New Contact Form Message</h1>
            </div>
            <div class='content'>
                <div class='info-card'>
                    <div class='label'>From</div>
                    <div class='value'>" . htmlspecialchars($name) . "</div>
                </div>
                <div class='info-card'>
                    <div class='label'>Email</div>
                    <div class='value'>" . htmlspecialchars($email) . "</div>
                </div>
                <div class='info-card'>
                    <div class='label'>Subject</div>
                    <div class='value'>" . htmlspecialchars($subject) . "</div>
                </div>
                <div class='info-card'>
                    <div class='label'>Message</div>
                </div>
                <div class='message-box'>" . nl2br(htmlspecialchars($message)) . "</div>
            </div>
            <div class='footer'>
                <p><strong>Sent from Portfolio Contact Form</strong></p>
                <p>Received on " . date('F j, Y \a\t g:i A') . "</p>
            </div>
        </div>
    </body>
    </html>
    ";
    
    $mail->AltBody = "From: {$name}\nEmail: {$email}\nSubject: {$subject}\n\nMessage:\n{$message}";
    
    // Send
    $mail->send();
    
    echo json_encode([
        'success' => true,
        'message' => 'Thank you for your message, ' . $name . '! I will get back to you soon.'
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Sorry, there was an error sending your message. Please try again or email me directly.'
    ]);
}
?>