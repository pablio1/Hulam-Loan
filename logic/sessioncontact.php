<?php
session_start();
$otp = $_POST['otp'];
$_SESSION['otp1'] = $otp;
echo "otp1 = " . $otp;
