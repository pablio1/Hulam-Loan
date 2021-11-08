<?php
session_start();
error_reporting(0);
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
	$status = 'Pending';

    // valid_id
	$images =$_FILES['valid_id']['name'];
	$tmp_dir = $_FILES['valid_id']['tmp_name'];
	$imageSize=$_FILES['valid_id']['size'];

	$upload_dir='../../assets/keen/requirements/';
	$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
	$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
	$pic=rand(1000,10000000).".".$imgExt;
	move_uploaded_file($tmp_dir,$upload_dir.$pic);
    // barangay_clearance
    $images1 =$_FILES['barangay_clearance']['name'];
	$tmp_dir = $_FILES['barangay_clearance']['tmp_name'];
	$imageSize=$_FILES['barangay_clearance']['size'];

	$upload_dir='../../assets/keen/requirements/';
	$imgExt=strtolower(pathinfo($images1,PATHINFO_EXTENSION));
	$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
	$pic1=rand(1000,10000000).".".$imgExt;
	move_uploaded_file($tmp_dir,$upload_dir.$pic1);
    // payslip
    $images2 =$_FILES['payslip']['name'];
	$tmp_dir = $_FILES['payslip']['tmp_name'];
	$imageSize=$_FILES['payslip']['size'];

	$upload_dir='../../assets/keen/requirements/';
	$imgExt=strtolower(pathinfo($images2,PATHINFO_EXTENSION));
	$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
	$pic2=rand(1000,10000000).".".$imgExt;
	move_uploaded_file($tmp_dir,$upload_dir.$pic2);
    // cedula
    $images3 =$_FILES['cedula']['name'];
	$tmp_dir = $_FILES['cedula']['tmp_name'];
	$imageSize=$_FILES['cedula']['size'];

	$upload_dir='../../assets/keen/requirements/';
	$imgExt=strtolower(pathinfo($images3,PATHINFO_EXTENSION));
	$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
	$pic3=rand(1000,10000000).".".$imgExt;
	move_uploaded_file($tmp_dir,$upload_dir.$pic3);
    // atm_transaction
    $images4 =$_FILES['atm_transaction']['name'];
	$tmp_dir = $_FILES['atm_transaction']['tmp_name'];
	$imageSize=$_FILES['atm_transaction']['size'];

	$upload_dir='../../assets/keen/requirements/';
	$imgExt=strtolower(pathinfo($images4,PATHINFO_EXTENSION));
	$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
	$pic4=rand(1000,10000000).".".$imgExt;
	move_uploaded_file($tmp_dir,$upload_dir.$pic4); 
    // coe
    $images5 =$_FILES['coe']['name'];
	$tmp_dir = $_FILES['coe']['tmp_name'];
	$imageSize=$_FILES['coe']['size'];

	$upload_dir='../../assets/keen/requirements/';
	$imgExt=strtolower(pathinfo($images5,PATHINFO_EXTENSION));
	$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
	$pic5=rand(1000,10000000).".".$imgExt;
	move_uploaded_file($tmp_dir,$upload_dir.$pic5); 
    // bank statement
    $images6 =$_FILES['bank_statement']['name'];
	$tmp_dir = $_FILES['bank_statement']['tmp_name'];
	$imageSize=$_FILES['bank_statement']['size'];

	$upload_dir='../../assets/keen/requirements/';
	$imgExt=strtolower(pathinfo($images6,PATHINFO_EXTENSION));
	$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
	$pic6=rand(1000,10000000).".".$imgExt;
	move_uploaded_file($tmp_dir,$upload_dir.$pic6);
    // Proof Billing
    $images7 =$_FILES['proof_billing']['name'];
	$tmp_dir = $_FILES['proof_billing']['tmp_name'];
	$imageSize=$_FILES['proof_billing']['size'];

	$upload_dir='../../assets/keen/requirements/';
	$imgExt=strtolower(pathinfo($images7,PATHINFO_EXTENSION));
	$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
	$pic7=rand(1000,10000000).".".$imgExt;
	move_uploaded_file($tmp_dir,$upload_dir.$pic7);
    // co-maker id
    $images8 =$_FILES['co_maker_id']['name'];
	$tmp_dir = $_FILES['co_maker_id']['tmp_name'];
	$imageSize=$_FILES['co_maker_id']['size'];

	$upload_dir='../../assets/keen/requirements/';
	$imgExt=strtolower(pathinfo($images8,PATHINFO_EXTENSION));
	$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
	$pic8=rand(1000,10000000).".".$imgExt;
	move_uploaded_file($tmp_dir,$upload_dir.$pic8);
    // co-maker cedula
    $images9 =$_FILES['co_maker_cedula']['name'];
	$tmp_dir = $_FILES['co_maker_cedula']['tmp_name'];
	$imageSize=$_FILES['co_maker_cedula']['size'];

	$upload_dir='../../assets/keen/requirements/';
	$imgExt=strtolower(pathinfo($images9,PATHINFO_EXTENSION));
	$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
	$pic9=rand(1000,10000000).".".$imgExt;
	move_uploaded_file($tmp_dir,$upload_dir.$pic9);
    // 2x2 ID
    $images10 =$_FILES['x_id']['name'];
	$tmp_dir = $_FILES['x_id']['tmp_name'];
	$imageSize=$_FILES['x_id']['size'];

	$upload_dir='../../assets/keen/requirements/';
	$imgExt=strtolower(pathinfo($images10,PATHINFO_EXTENSION));
	$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
	$pic10=rand(1000,10000000).".".$imgExt;
	move_uploaded_file($tmp_dir,$upload_dir.$pic10);

    $sql ="INSERT INTO upload_requirements(lender_id,debtor_id,valid_id,barangay_clearance,payslip,cedula,atm_transaction,coe,bank_statement,proof_billing,co_maker_id,co_maker_cedula,x_id,date)
    VALUES(:lender_id,:debtor_id,:valid_id,:barangay_clearance,:payslip,:cedula,:atm_transaction,:coe,:bank_statement,:proof_billing,:co_maker_id,:co_maker_cedula,:x_id,:date)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':lender_id',$lender_id,PDO::PARAM_STR);
    $query->bindParam(':debtor_id',$debtor_id,PDO::PARAM_STR);
    $query->bindParam(':valid_id',$pic,PDO::PARAM_STR);
    $query->bindParam(':barangay_clearance',$pic1,PDO::PARAM_STR);
    $query->bindParam(':payslip',$pic2,PDO::PARAM_STR);
    $query->bindParam(':cedula',$pic3,PDO::PARAM_STR);
    $query->bindParam(':atm_transaction',$pic4,PDO::PARAM_STR);
    $query->bindParam(':coe',$pic5,PDO::PARAM_STR);
    $query->bindParam(':bank_statement',$pic6,PDO::PARAM_STR);
    $query->bindParam(':proof_billing',$pic7,PDO::PARAM_STR);
    $query->bindParam(':co_maker_id',$pic8,PDO::PARAM_STR);
    $query->bindParam(':co_maker_cedula',$pic9,PDO::PARAM_STR);
    $query->bindParam(':x_id',$pic10,PDO::PARAM_STR);
    $query->bindParam(':date',$date,PDO::PARAM_STR);

     $sql2 = "INSERT INTO loan_application(debtor_id,lender_id,loan_amount,loan_term,fix_rate,total_amount,monthly_payment,total_interest,late_charges,date,confirm,status)
    VALUES(:debtor_id,:lender_id,:loan_amount,:loan_term,:fix_rate,:total_amount,:monthly_payment,:total_interest,:late_charges,:date,:confirm,:status)";
	$query2 = $dbh->prepare($sql2);
	$query2->bindParam(':debtor_id', $debtor_id, PDO::PARAM_STR);
	$query2->bindParam(':lender_id', $lender_id, PDO::PARAM_STR);
	$query2->bindParam(':loan_amount', $loan_amount, PDO::PARAM_STR);
	$query2->bindParam(':loan_term', $loan_term, PDO::PARAM_STR);
	$query2->bindParam(':fix_rate', $fix_rate, PDO::PARAM_STR);
	$query2->bindParam(':total_amount', $total_amount, PDO::PARAM_STR);
	$query2->bindParam(':monthly_payment', $monthly_payment, PDO::PARAM_STR);
	$query2->bindParam(':total_interest', $total_interest, PDO::PARAM_STR);
	$query2->bindParam(':late_charges', $late_charges, PDO::PARAM_STR);
	$query2->bindParam(':date', $date, PDO::PARAM_STR);
	$query2->bindParam(':confirm', $confirm, PDO::PARAM_STR);
	$query2->bindParam(':status', $status, PDO::PARAM_STR);
    $query2->execute();


    if ($query->execute()) {
		$_SESSION['status'] = "Loan Application Submitted Successfully!";
		header("Location: ../notif.php");
		exit();
	} else {
		$_SESSION['status'] = "Error! Not added";
		header("Location: ../apply_loan.php");
		exit();
	}
} ?>
































<!-- // if (isset($_POST['submit'])) {
//     $debtor_id = $_POST['debtor_id'];
//     $lender_id = $_POST['lender_id'];
//     $loan_amount = $_POST['loan_amount'];
//     $loan_term = $_POST['loan_term'];
//     $fix_rate = $_POST['fix_rate'];
//     $total_amount = $_POST['total_amount'];
//     $monthly_payment = $_POST['monthly_payment'];
//     $total_interest = $_POST['total_interest'];
//     $late_charges = $_POST['late_charges'];
//     $date = $_POST['date'];
//     $status = 'Pending';

//     $sql = "INSERT INTO loan_application(debtor_id,lender_id,loan_amount,loan_term,fix_rate,total_amount,monthly_payment,total_interest,late_charges,date,status)
//     VALUES($debtor_id,$lender_id,$loan_amount,$loan_term,$fix_rate,$total_amount,$monthly_payment,$total_interest,$late_charges,$date,$status)";
//     $query = $dbh->prepare($sql);
//     if($query->execute()){
//         $_SESSION['status'] = "Added Successfully";
//         header("Location: apply_loan.php");
//         exit();
//     }else{
//         $_SESSION['status'] = "Error! Not added";
//         header("Location: apply_loan.php");
//         exit();
//     }
// } -->


<!-- 
    $sql = $dbh->prepare("INSERT INTO loan_application (debtor_id, lender_id, total_amount, remaining_balance, months, monthly_payable, date, status) 
    VALUES (:debtor_id, :lender_id, :total_amount, :remaining_balance, :months, :monthly_payable, :date, :status)");
    $sql->execute([
        'debtor_id' => $debtor_id, 'lender_id' => $lender_id, 'total_amount' => $total_amount, 'remaining_balance' => $remaining_balance, 'months' => $months,
        'monthly_payable' => $monthly_payable, 'date' => date('Y-m-d H:i:s'), 'status' => $status
    ]);

    header('location: ../index.php?loan'); -->

