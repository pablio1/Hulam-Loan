<?php
session_start();
error_reporting(0);
include('../db_connection/config.php');

if (isset($_POST['change'])) {

    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $token = $_POST['token'];

    // $sql = $dbh->prepare('SELECT * FROM user WHERE email = :email');
    // $sql->execute(['email' => $email]);
    // $user = $sql->fetch();

    if (empty($password) || empty($cpassword)) {
        header('location: ../changepassword.php?token=' . $token . '&e=Please fill up all the fields!');
        exit();
    }
    if ($password != $cpassword) {
        header('location: ../changepassword.php?token=' . $token . '&e=Password did not match!');
        exit();
    }
    if (strlen($password) < 8) {
        header('location: ../changepassword.php?token=' . $token . '&e=Password must be at least 8 characters long!');
        exit();
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = $dbh->prepare("UPDATE user SET password = :password, token = '' WHERE token = :token");
    $sql->execute(['password' => $password, 'token' => $token]);

    header('location: ../login.php?m=Password has been change. You may now login your account.');
}
