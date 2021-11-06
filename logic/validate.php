<?php
session_start();
$otp1 = $_SESSION['otp1'];
$otp2 = $_POST['otp'];
if ($otp1 == $otp2) {
    echo 'Login successfully';
} else {
    echo 'error otp';
}
