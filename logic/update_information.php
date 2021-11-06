<?php
session_start();
error_reporting(0);
include('../db_connection/config.php');

if(isset($_POST['submit'])) {
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $b_day = $_POST['b_day'];
    $mobile = $_POST['mobile'];
    $landline = $_POST['landline'];
    $c_street = $_POST['c_street'];
    $c_barangay = $_POST['c_barangay'];
    $c_city = $_POST['c_city'];
    $c_province = $_POST['c_province'];
    $c_zipcode = $_POST['c_zipcode'];
    $p_street = $_POST['p_street'];
    $p_barangay = $_POST['p_barangay'];
    $p_city = $_POST['p_city'];
    $p_province = $_POST['p_province'];
    $p_zipcode = $_POST['p_zipcode'];
    $company_name = $_POST['company_name'];
    $monthly_salary = $_POST['monthly_salary'];
    $company_mobile = $_POST['company_mobile'];
    $company_landline = $_POST['company_landline'];
    $company_email = $_POST['lname'];
    $company_street = $_POST['company_street'];
    $company_barangay = $_POST['company_barangay'];
    $company_city = $_POST['company_city'];
    $company_province = $_POST['company_province'];
    $company_zipcode = $_POST['company_zipcode'];
    $lname = $_POST['lname'];
    $lname = $_POST['lname'];
    $lname = $_POST['lname'];
    $lname = $_POST['lname'];
    $lname = $_POST['lname'];
    $lname = $_POST['lname'];
    $lname = $_POST['lname'];
    $lname = $_POST['lname'];
    $lname = $_POST['lname'];
} else {
    header('location: index.php');
}