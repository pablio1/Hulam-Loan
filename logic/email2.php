<?php
session_start();
error_reporting(0);
include('../db_connection/config.php');
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';
require '../phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
    $mail = new PHPmailer();
    header('location: ../login.php?id=' . $usertype . '&m=Verify Login! Please check your email to verify.');

    $mail->SMTPDebug = 1;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->Username = 'hulamloan@gmail.com';
    $mail->Password = 'Capstone@42';
    $mail->Subject = 'Login Verification';
    $mail->setFrom('hulamloan@gmail.com', 'Hulam');
    $mail->isHTML(true);
    $name = $_SESSION['firstname'];
    $token = generateRandomString();
    $_SESSION['token1'] = $token;
    $body = "
            <div style='width: 750px; height: auto; background-color: #eee;'>
                <div style='width: 90%; background-color: #fff; margin: auto;'>
                    <div style='width: 90%; background-color: transparent; margin: auto;'>
                        <div style='width: 100%; background-color: #4ab4f4; margin: auto;'>
                            <br/><h1 style='text-align: center; color: #fff;'><strong>Verify your Login</strong></h1><br/>
                        </div>
                    
                        <p>Hi " . $name. ", </p>
                    
                        <p>Welcome back to Hulam!</p>
                        
                        <p style='text-align: justify;'>To verify your login account please click the link below.</p>
                        
                        <p style='text-align: justify;'><a href='http://localhost/hulam/otp-email.php?token=" . $token . "'>http://localhost/hulam/otp-email.php?token=" . $token . "</a></p>
                        
                        Regards,<br/>
                        <strong>The Hulam Team</strong>
                        
                    </div>
                    <br/>
                    <div style='width: 100%; border-top: solid 1px; border-color: #eee;'>
                        <div style='width: 90%; background-color: #fff; margin: auto;'>
                            <p style='text-align: justify;'>If you would like to speak to one of our Customer Service Executives please call or email us.</p>
                            
                            <p style='text-align: justify;'>Support: 0945-490-9530 - hulamloan@gmail.com</p>
                            <p style='text-align: justify;'>This email was sent from a notification-only address. Please do not reply.</p>
                        </div>
                    </div>
                    <br/>
                </div>
                <br/>
                <center><small>Hulam, Mactan, Lapu-Lapu City Cebu 6015</small></center>
                <br/><br/>
            </div>
            ";
  $mail->Body = $body;
  $mail->addAddress($_SESSION['email']);

    if ($mail->Send()) {
        echo 'Message sent!';
    } else {
        echo 'Error';
    }
    $mail->smtpClose();

