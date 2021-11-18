<?php
session_start();
error_reporting(-1);
include('../../db_connection/config.php');

if ($_SESSION['user_type'] != 2) {
    header('location: ../index.php');
}?>

<?php
if (isset($_POST['submit'])) {

	$debtor_id = $_POST['debtor_id'];
	$lender_id = $_POST['lender_id'];
	$loan_amount = $_POST['loan_amount'];
	$loan_term = $_POST['loan_term'];
	$fix_rate = $_POST['fix_rate'];
	$total_amount = $_POST['total_amount'];
	$monthly_payment = $_POST['monthly_payment'];
	$total_interest = $_POST['total_interest'];
	$late_charges = $_POST['late_charges'];
	$date = $_POST['date'];
	$confirm = $_POST['confirm'];

	$sql = "SELECT * FROM loan_application WHERE debtor_id= $debtor_id AND lender_id = $lender_id";
	$query = $dbh->prepare($sql);
	$query->execute();
	if($query->rowCount()==0){
		$sql = "INSERT INTO loan_application(debtor_id,lender_id,loan_amount,loan_term,fix_rate,total_amount,monthly_payment,total_interest,late_charges,date,confirm,loan_status)
		VALUES(:debtor_id,:lender_id,:loan_amount,:loan_term,:fix_rate,:total_amount,:monthly_payment,:total_interest,:late_charges,:date,:confirm,'Pending')";
		$query = $dbh->prepare($sql);
		$query->bindParam(':debtor_id', $debtor_id, PDO::PARAM_STR);
		$query->bindParam(':lender_id', $lender_id, PDO::PARAM_STR);
		$query->bindParam(':loan_amount', $loan_amount, PDO::PARAM_STR);
		$query->bindParam(':loan_term', $loan_term, PDO::PARAM_STR);
		$query->bindParam(':fix_rate', $fix_rate, PDO::PARAM_STR);
		$query->bindParam(':total_amount', $total_amount, PDO::PARAM_STR);
		$query->bindParam(':monthly_payment', $monthly_payment, PDO::PARAM_STR);
		$query->bindParam(':total_interest', $total_interest, PDO::PARAM_STR);
		$query->bindParam(':late_charges', $late_charges, PDO::PARAM_STR);
		$query->bindParam(':date', $date, PDO::PARAM_STR);
		$query->bindParam(':confirm', $confirm, PDO::PARAM_STR);
		$query->execute();
	}else{
		$update = "UPDATE loan_application SET loan_amount=:loan_amount, loan_term=:loan_term, fix_rate=:fix_rate,
		total_amount =:total_amount, monthly_payment=:monthly_payment, total_interest=:total_interest, late_charges=:late_charges, date=:date, confirm=:confirm,loan_status='Pending' 
		WHERE debtor_id = $debtor_id AND lender_id = $lender_id";
		$query = $dbh->prepare($update);
		$query->bindParam(':loan_amount', $loan_amount, PDO::PARAM_STR);
		$query->bindParam(':loan_term', $loan_term, PDO::PARAM_STR);
		$query->bindParam(':fix_rate', $fix_rate, PDO::PARAM_STR);
		$query->bindParam(':total_amount', $total_amount, PDO::PARAM_STR);
		$query->bindParam(':monthly_payment', $monthly_payment, PDO::PARAM_STR);
		$query->bindParam(':total_interest', $total_interest, PDO::PARAM_STR);
		$query->bindParam(':late_charges', $late_charges, PDO::PARAM_STR);
		$query->bindParam(':date', $date, PDO::PARAM_STR);
		$query->bindParam(':confirm', $confirm, PDO::PARAM_STR);
		$query->execute();
	}if ($query) {
		$_SESSION['status_message'] = "Loan Application Submitted Successfully!";
		header("Location: ../notif.php");
		exit();
	} else {
		$_SESSION['status_message'] = "Error! Not added";
		header("Location: ../apply_loan.php");
		exit();
	}
} ?>

