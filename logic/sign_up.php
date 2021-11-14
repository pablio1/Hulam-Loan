<?php
session_start();
error_reporting(0);
include('../db_connection/config.php');
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';
require '../phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;

//generate random string for token verification
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

//begin::SIGN UP CODES
if (isset($_POST['sign_up'])) {
    $usertype = $_POST['usertype'];
    $company_name = $_POST['company_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $token = generateRandomString();

    $sql = $dbh->prepare("SELECT * FROM user WHERE email = :email");
    $sql->execute(['email' => $email]);

    $sql2 = $dbh->prepare("SELECT * FROM user WHERE company_name = :company_name");
    $sql2->execute(['company_name' => $company_name]);


    //check if fields are empty
    if (empty($company_name) || empty($email) || empty($mobile) || empty($password)) {
        header('location: ../sign_up2.php?id=' . $usertype . '&company_name=' . $company_name . '&email=' . $email . '&mobile=' . $mobile . '&e=Please fill up all the fields!');
        exit();
    }
    //check if mobile is valid
    if (!preg_match("/^[0-9]/", $_POST["mobile"])) {
        header('location: ../sign_up2.php?id=' . $usertype . '&company_name=' . $company_name . '&email=' . $email . '&e=Please use a valid phone number!');
        exit();
    }
    //check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('location: ../sign_up2.php?id=' . $usertype . '&company_name=' . $company_name . '&mobile=' . $mobile. '&e=Please use a valid email!');
        exit();
    }
    //checl if email already taken
    if ($sql->rowCount() > 0) {
        header('location: ../sign_up2.php?id=' . $usertype . '&company_name=' . $company_name . '&mobile=' . $mobile. '&e=The email is already taken!');
        exit();
    }
    //checl if company name already taken
    if ($sql2->rowCount() > 0) {
        header('location: ../sign_up2.php?id=' . $usertype .'&email=' . $email . '&mobile=' . $mobile. '&e=The Company Name is already taken!');
        exit();
    }
    //check if password match
    if ($password != $cpassword) {
        header('location: ../sign_up2.php?id=' . $usertype . '&company_name=' . $company_name . '&email=' . $email . '&mobile=' . $mobile . '&email=' . $email . '&e=The password did not match!');
        exit();
    }
    //check password length
    if (strlen($password) < 8) {
        header('location: ../sign_up2.php?id=' . $usertype . '&company_name=' . $company_name . '&email=' . $email . '&mobile=' . $mobile . '&email=' . $email . '&e=Password must be at least 8 characters long!');
        exit();
    }
    if(!preg_match("#[0-9]+#", $_POST["password"])){
        header('location: ../sign_up2.php?id=' . $usertype . '&company_name=' . $company_name . '&email=' . $email . '&mobile=' . $mobile . '&email=' . $email . '&e=Password must have atleast 1 number');
        exit();

    }
    if(!preg_match("#[A-Z]+#", $_POST["password"])){
        header('location: ../sign_up2.php?id=' . $usertype . '&company_name=' . $company_name . '&email=' . $email . '&mobile=' . $mobile . '&email=' . $email . '&e=Password must have atleast upper case');
        exit();
    }
    if(!preg_match("#[a-z]+#", $_POST["password"])){
        header('location: ../sign_up2.php?id=' . $usertype . '&company_name=' . $company_name . '&email=' . $email . '&mobile=' . $mobile . '&email=' . $email . '&e=Password must have atleast lower case');
        exit();
    }

    //encrypt password using password_hash()
    $password = password_hash($password, PASSWORD_DEFAULT);

    //insert new user to our database
    $sql = $dbh->prepare("INSERT INTO user (user_type,company_name,email,mobile,password,status,eligible,notice_message,token) VALUES (:user_type,:company_name,:email,:mobile,:password,'unverified','no','To activate your account you need to complete updating your profile information and required to visit Hulam office for the signing of Memorandum of Agreement',:token)");

    try {
        $sql->execute(['user_type' => $usertype, 'company_name' => $company_name, 'email' => $email, 'mobile' => $mobile,'password' => $password, 'token' => $token]);
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }

    $mail = new PHPmailer();
    header('location: ../sign_up2.php?id=' . $usertype . '&m=Registration success! Please check your email for verification.');

    $mail->SMTPDebug = 1;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->Username = 'hulamloan@gmail.com';
    $mail->Password = 'Capstone@42';
    $mail->Subject = 'Account Verification';
    $mail->setFrom('hulamloan@gmail.com', 'Hulam');
    $mail->isHTML(true);
    $body = "
            <div style='width: 750px; height: auto; background-color: #eee;'>
                <div style='width: 90%; background-color: #fff; margin: auto;'>
                    <div style='width: 90%; background-color: transparent; margin: auto;'>
                        <div style='width: 100%; background-color: #4ab4f4; margin: auto;'>
                            <br/><h1 style='text-align: center; color: #fff;'><strong>Verify your account</strong></h1><br/>
                        </div>
                    
                        <p>Hi " . $firstname . ",</p>
                    
                        <p>Thank you for signing up to Hulam.</p>
                        
                        <p style='text-align: justify;'>To verify your account please click the link below.</p>
                        
                        <p style='text-align: justify;'><a href='http://localhost/hulam/verify.php?token=" . $token . "'>http://localhost/hulam/verify.php?token=" . $token . "</a></p>
                        
                        Regards,<br/>
                        <strong>The Hulam Team</strong>
                        
                    </div>
                    <br/>
                    <div style='width: 100%; border-top: solid 1px; border-color: #eee;'>
                        <div style='width: 90%; background-color: #fff; margin: auto;'>
                            <p style='text-align: justify;'>If you would like to speak to one of our Customer Service executives please call or email us.</p>
                            
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
    $mail->addAddress($email);

    if ($mail->Send()) {
        echo 'Message sent!';
    } else {
        echo 'Error';
    }
    $mail->smtpClose();
}
