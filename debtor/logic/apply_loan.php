<?php
session_start();
error_reporting(0);
include('../../db_connection/config.php');

if ($_SESSION['user_type'] != 2) {
    header('location: ../index.php');
}

if (isset($_POST['submit'])) {
    $debtor_id = $_POST['debtor_id'];
    $lender_id = $_POST['lender_id'];
    $total_amount = $_POST['total_amount'];
    $remaining_balance = $_POST['remaining_balance'];
    $months = $_POST['months'];
    $monthly_payable = $_POST['monthly_payable'];
    $status = 'pending';

    $sql = $dbh->prepare("INSERT INTO loan_application (debtor_id, lender_id, total_amount, remaining_balance, months, monthly_payable, date, status) 
    VALUES (:debtor_id, :lender_id, :total_amount, :remaining_balance, :months, :monthly_payable, :date, :status)");
    $sql->execute([
        'debtor_id' => $debtor_id, 'lender_id' => $lender_id, 'total_amount' => $total_amount, 'remaining_balance' => $remaining_balance, 'months' => $months,
        'monthly_payable' => $monthly_payable, 'date' => date('Y-m-d H:i:s'), 'status' => $status
    ]);

    header('location: ../index.php?loan');
}
