<?php
session_start();
include('db_connection/config.php');
$email = $_SESSION['email'];
//get the user with email
$sql = $dbh->prepare('SELECT * FROM user WHERE email = :email');
$sql->execute(['email' => $email]);
$user = $sql->fetch();
$token1 = $_SESSION['token1'];
$token2 = $_GET['token'];
if ($token1 == $token2) {
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['user_type'] = $user['user_type'];
    $_SESSION['company_name'] = $user['company_name'];
    $_SESSION['firstname'] = $user['firstname'];
    $_SESSION['middlename'] = $user['middlename'];
    $_SESSION['mobile'] = $user['mobile'];
    $_SESSION['lastname'] = $user['lastname'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['mobile'] = $user['mobile'];
    $_SESSION['landline'] = $user['landline'];
    $_SESSION['gender'] = $user['gender'];
    $_SESSION['image'] = $user['image'];
    $_SESSION['b_day'] = $user['b_day'];
    $_SESSION['c_street'] = $user['c_street'];
    $_SESSION['c_barangay'] = $user['c_barangay'];
    $_SESSION['c_city'] = $user['c_city'];
    $_SESSION['c_province'] = $user['c_province'];
    $_SESSION['c_zipcode'] = $user['c_zipcode'];
    $_SESSION['p_street'] = $user['p_street'];
    $_SESSION['p_barangay'] = $user['p_barangay'];
    $_SESSION['p_city'] = $user['p_city'];
    $_SESSION['p_province'] = $user['p_province'];
    $_SESSION['p_zipcode'] = $user['p_zipcode'];
    $_SESSION['status'] = $user['status'];
    $_SESSION['eligible'] = $user['eligible'];

    if($user['user_type'] == 1) {
        header('location: admin/idex.php');
    }
    if($user['user_type'] == 2) {
        header('location: debtor/index.php');
    }
    if($user['user_type'] == 3) {
        header('location: lending_company/index.php');
    }
    if($user['user_type'] == 4) {
        header('location: individual_investor/index.php');
    }
    if($user['user_type'] == 5) {
        header('location: payment_center/index.php');
    }
}
echo '' . $token1 . '=' . $token2;
