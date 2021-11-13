<?php
session_start();
error_reporting(-1);
include('../db_connection/config.php');

if ($_SESSION['user_type'] != 2) {
	header('location: ../index.php');
}
?>

<?php
	if(isset($_POST['barangay_clearance'])){
		$loan_app_id = intval($_GET['loan_app_id']);

		$images =$_FILES['barangay_clearance']['name'];
		$tmp_dir = $_FILES['barangay_clearance']['tmp_name'];
		$imageSize=$_FILES['barangay_clearance']['size'];

		$upload_dir2='../assets/keen/requirements/';
		$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
		$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
		$barangay_clearance=rand(1000,10000000).".".$imgExt;
		move_uploaded_file($tmp_dir,$upload_dir2.$barangay_clearance);

		$sql = "SELECT * FROM loan_application WHERE loan_app_id = $loan_app_id";
		$query = $dbh->prepare($sql);
		$query->execute();
		if($query->rowCount()==0){
			$insert = "INSERT INTO loan_application(barangay_clearance)VALUES(:barangay_clearance)";
			$insert_query = $dbh->prepare($insert);
			$insert_query->bindParam(':barangay_clearance',$barangay_clearance,PDO::PARAM_STR);
			$insert_query->execute();
		}else{
			$update = "UPDATE loan_application SET barangay_clearance = :barangay_clearance WHERE loan_app_id = $loan_app_id";
			$update_query = $dbh->prepare($update);
			$update_query->bindParam(':barangay_clearance',$barangay_clearance,PDO::PARAM_STR);
			$update_query->execute();
		}
		if($update_query){
			$_SESSION['status'] = "Success";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}else{
			$_SESSION['status'] = "Error!";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}
	}
?>
<?php
	if(isset($_POST['barangay_clearance'])){
		$loan_app_id = intval($_GET['loan_app_id']);

		$images =$_FILES['barangay_clearance']['name'];
		$tmp_dir = $_FILES['barangay_clearance']['tmp_name'];
		$imageSize=$_FILES['barangay_clearance']['size'];

		$upload_dir2='../assets/keen/requirements/';
		$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
		$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
		$barangay_clearance=rand(1000,10000000).".".$imgExt;
		move_uploaded_file($tmp_dir,$upload_dir2.$barangay_clearance);

		$sql = "SELECT * FROM loan_application WHERE loan_app_id = $loan_app_id";
		$query = $dbh->prepare($sql);
		$query->execute();
		if($query->rowCount()==0){
			$insert = "INSERT INTO loan_application(barangay_clearance)VALUES(:barangay_clearance)";
			$insert_query = $dbh->prepare($insert);
			$insert_query->bindParam(':barangay_clearance',$barangay_clearance,PDO::PARAM_STR);
			$insert_query->execute();
		}else{
			$update = "UPDATE loan_application SET barangay_clearance = :barangay_clearance WHERE loan_app_id = $loan_app_id";
			$update_query = $dbh->prepare($update);
			$update_query->bindParam(':barangay_clearance',$barangay_clearance,PDO::PARAM_STR);
			$update_query->execute();
		}
		if($update_query){
			$_SESSION['status'] = "Success";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}else{
			$_SESSION['status'] = "Error!";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}
	}
?>
<?php
	if(isset($_POST['payslip'])){
		$loan_app_id = intval($_GET['loan_app_id']);

		$images =$_FILES['payslip']['name'];
		$tmp_dir = $_FILES['payslip']['tmp_name'];
		$imageSize=$_FILES['payslip']['size'];

		$upload_dir2='../assets/keen/requirements/';
		$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
		$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
		$payslip=rand(1000,10000000).".".$imgExt;
		move_uploaded_file($tmp_dir,$upload_dir2.$payslip);

		$sql = "SELECT * FROM loan_application WHERE loan_app_id = $loan_app_id";
		$query = $dbh->prepare($sql);
		$query->execute();

		if($query->rowCount()==0){
			$insert = "INSERT INTO loan_application(payslip)VALUES(:payslip)";
			$insert_query = $dbh->prepare($insert);
			$insert_query->bindParam(':payslip',$payslip,PDO::PARAM_STR);
			$insert_query->execute();
		}else{
			$update = "UPDATE loan_application SET payslip = :payslip WHERE loan_app_id = $loan_app_id";
			$update_query = $dbh->prepare($update);
			$update_query->bindParam(':payslip',$payslip,PDO::PARAM_STR);
			$update_query->execute();
		}
		if($update_query){
			$_SESSION['status'] = "Success";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}else{
			$_SESSION['status'] = "Error!";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}
	}
?>
<?php
	if(isset($_POST['cedula'])){
		$loan_app_id = intval($_GET['loan_app_id']);

		$images =$_FILES['cedula']['name'];
		$tmp_dir = $_FILES['cedula']['tmp_name'];
		$imageSize=$_FILES['cedula']['size'];

		$upload_dir2='../assets/keen/requirements/';
		$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
		$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
		$cedula=rand(1000,10000000).".".$imgExt;
		move_uploaded_file($tmp_dir,$upload_dir2.$cedula);

		$sql = "SELECT * FROM loan_application WHERE loan_app_id = $loan_app_id";
		$query = $dbh->prepare($sql);
		$query->execute();
		if($query->rowCount()==0){
			$insert = "INSERT INTO loan_application(cedula)VALUES(:cedula)";
			$insert_query = $dbh->prepare($insert);
			$insert_query->bindParam(':cedula',$cedula,PDO::PARAM_STR);
			$insert_query->execute();
		}else{
			$update = "UPDATE loan_application SET cedula = :cedula WHERE loan_app_id = $loan_app_id";
			$update_query = $dbh->prepare($update);
			$update_query->bindParam(':cedula',$cedula,PDO::PARAM_STR);
			$update_query->execute();
		}
		if($update_query){
			$_SESSION['status'] = "Success";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}else{
			$_SESSION['status'] = "Error!";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}
	}
?>
<?php
	if(isset($_POST['atm_transaction'])){
		$loan_app_id = intval($_GET['loan_app_id']);

		$images =$_FILES['atm_transaction']['name'];
		$tmp_dir = $_FILES['atm_transaction']['tmp_name'];
		$imageSize=$_FILES['atm_transaction']['size'];

		$upload_dir2='../assets/keen/requirements/';
		$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
		$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
		$atm_transaction=rand(1000,10000000).".".$imgExt;
		move_uploaded_file($tmp_dir,$upload_dir2.$atm_transaction);

		$sql = "SELECT * FROM loan_application WHERE loan_app_id = $loan_app_id";
		$query = $dbh->prepare($sql);
		$query->execute();
		if($query->rowCount()==0){
			$insert = "INSERT INTO loan_application(atm_transaction)VALUES(:atm_transaction)";
			$insert_query = $dbh->prepare($insert);
			$insert_query->bindParam(':atm_transaction',$atm_transaction,PDO::PARAM_STR);
			$insert_query->execute();
		}else{
			$update = "UPDATE loan_application SET atm_transaction = :atm_transaction WHERE loan_app_id = $loan_app_id";
			$update_query = $dbh->prepare($update);
			$update_query->bindParam(':atm_transaction',$atm_transaction,PDO::PARAM_STR);
			$update_query->execute();
		}
		if($update_query){
			$_SESSION['status'] = "Success";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}else{
			$_SESSION['status'] = "Error!";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}
	}
?>
<?php
	if(isset($_POST['coe'])){
		$loan_app_id = intval($_GET['loan_app_id']);

		$images =$_FILES['coe']['name'];
		$tmp_dir = $_FILES['coe']['tmp_name'];
		$imageSize=$_FILES['coe']['size'];

		$upload_dir2='../assets/keen/requirements/';
		$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
		$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
		$coe=rand(1000,10000000).".".$imgExt;
		move_uploaded_file($tmp_dir,$upload_dir2.$coe);

		$sql = "SELECT * FROM loan_application WHERE loan_app_id = $loan_app_id";
		$query = $dbh->prepare($sql);
		$query->execute();
		if($query->rowCount()==0){
			$insert = "INSERT INTO loan_application(coe)VALUES(:coe)";
			$insert_query = $dbh->prepare($insert);
			$insert_query->bindParam(':coe',$coe,PDO::PARAM_STR);
			$insert_query->execute();
		}else{
			$update = "UPDATE loan_application SET coe = :coe WHERE loan_app_id = $loan_app_id";
			$update_query = $dbh->prepare($update);
			$update_query->bindParam(':coe',$coe,PDO::PARAM_STR);
			$update_query->execute();
		}
		if($update_query){
			$_SESSION['status'] = "Success";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}else{
			$_SESSION['status'] = "Error!";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}
	}
?>
<?php
	if(isset($_POST['bank_statement'])){
		$loan_app_id = intval($_GET['loan_app_id']);

		$images =$_FILES['bank_statement']['name'];
		$tmp_dir = $_FILES['bank_statement']['tmp_name'];
		$imageSize=$_FILES['bank_statement']['size'];

		$upload_dir2='../assets/keen/requirements/';
		$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
		$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
		$bank_statement=rand(1000,10000000).".".$imgExt;
		move_uploaded_file($tmp_dir,$upload_dir2.$bank_statement);

		$sql = "SELECT * FROM loan_application WHERE loan_app_id = $loan_app_id";
		$query = $dbh->prepare($sql);
		$query->execute();
		if($query->rowCount()==0){
			$insert = "INSERT INTO loan_application(bank_statement)VALUES(:bank_statement)";
			$insert_query = $dbh->prepare($insert);
			$insert_query->bindParam(':bank_statement',$bank_statement,PDO::PARAM_STR);
			$insert_query->execute();
		}else{
			$update = "UPDATE loan_application SET bank_statement = :bank_statement WHERE loan_app_id = $loan_app_id";
			$update_query = $dbh->prepare($update);
			$update_query->bindParam(':bank_statement',$bank_statement,PDO::PARAM_STR);
			$update_query->execute();
		}
		if($update_query){
			$_SESSION['status'] = "Success";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}else{
			$_SESSION['status'] = "Error!";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}
	}
?>
<?php
	if(isset($_POST['proof_billing'])){
		$loan_app_id = intval($_GET['loan_app_id']);

		$images =$_FILES['proof_billing']['name'];
		$tmp_dir = $_FILES['proof_billing']['tmp_name'];
		$imageSize=$_FILES['proof_billing']['size'];

		$upload_dir2='../assets/keen/requirements/';
		$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
		$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
		$proof_billing=rand(1000,10000000).".".$imgExt;
		move_uploaded_file($tmp_dir,$upload_dir2.$proof_billing);

		$sql = "SELECT * FROM loan_application WHERE loan_app_id = $loan_app_id";
		$query = $dbh->prepare($sql);
		$query->execute();
		if($query->rowCount()==0){
			$insert = "INSERT INTO loan_application(proof_billing)VALUES(:proof_billing)";
			$insert_query = $dbh->prepare($insert);
			$insert_query->bindParam(':proof_billing',$proof_billing,PDO::PARAM_STR);
			$insert_query->execute();
		}else{
			$update = "UPDATE loan_application SET proof_billing = :proof_billing WHERE loan_app_id = $loan_app_id";
			$update_query = $dbh->prepare($update);
			$update_query->bindParam(':proof_billing',$proof_billing,PDO::PARAM_STR);
			$update_query->execute();
		}
		if($update_query){
			$_SESSION['status'] = "Success";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}else{
			$_SESSION['status'] = "Error!";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}
	}
?>
<?php
	if(isset($_POST['co_maker_id'])){
		$loan_app_id = intval($_GET['loan_app_id']);

		$images =$_FILES['co_maker_id']['name'];
		$tmp_dir = $_FILES['co_maker_id']['tmp_name'];
		$imageSize=$_FILES['co_maker_id']['size'];

		$upload_dir2='../assets/keen/requirements/';
		$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
		$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
		$co_maker_id=rand(1000,10000000).".".$imgExt;
		move_uploaded_file($tmp_dir,$upload_dir2.$co_maker_id);

		$sql = "SELECT * FROM loan_application WHERE loan_app_id = $loan_app_id";
		$query = $dbh->prepare($sql);
		$query->execute();
		if($query->rowCount()==0){
			$insert = "INSERT INTO loan_application(co_maker_id)VALUES(:co_maker_id)";
			$insert_query = $dbh->prepare($insert);
			$insert_query->bindParam(':co_maker_id',$co_maker_id,PDO::PARAM_STR);
			$insert_query->execute();
		}else{
			$update = "UPDATE loan_application SET co_maker_id = :co_maker_id WHERE loan_app_id = $loan_app_id";
			$update_query = $dbh->prepare($update);
			$update_query->bindParam(':co_maker_id',$co_maker_id,PDO::PARAM_STR);
			$update_query->execute();
		}
		if($update_query){
			$_SESSION['status'] = "Success";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}else{
			$_SESSION['status'] = "Error!";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}
	}
?>
<?php
	if(isset($_POST['co_maker_cedula'])){
		$loan_app_id = intval($_GET['loan_app_id']);

		$images =$_FILES['co_maker_cedula']['name'];
		$tmp_dir = $_FILES['co_maker_cedula']['tmp_name'];
		$imageSize=$_FILES['co_maker_cedula']['size'];

		$upload_dir2='../assets/keen/requirements/';
		$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
		$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
		$co_maker_cedula=rand(1000,10000000).".".$imgExt;
		move_uploaded_file($tmp_dir,$upload_dir2.$co_maker_cedula);

		$sql = "SELECT * FROM loan_application WHERE loan_app_id = $loan_app_id";
		$query = $dbh->prepare($sql);
		$query->execute();
		if($query->rowCount()==0){
			$insert = "INSERT INTO loan_application(co_maker_cedula)VALUES(:co_maker_cedula)";
			$insert_query = $dbh->prepare($insert);
			$insert_query->bindParam(':co_maker_cedula',$co_maker_cedula,PDO::PARAM_STR);
			$insert_query->execute();
		}else{
			$update = "UPDATE loan_application SET co_maker_cedula = :co_maker_cedula WHERE loan_app_id = $loan_app_id";
			$update_query = $dbh->prepare($update);
			$update_query->bindParam(':co_maker_cedula',$co_maker_cedula,PDO::PARAM_STR);
			$update_query->execute();
		}
		if($update_query){
			$_SESSION['status'] = "Success";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}else{
			$_SESSION['status'] = "Error!";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}
	}
?>
<?php
	if(isset($_POST['id_pic'])){
		$loan_app_id = intval($_GET['loan_app_id']);

		$images =$_FILES['id_pic']['name'];
		$tmp_dir = $_FILES['id_pic']['tmp_name'];
		$imageSize=$_FILES['id_pic']['size'];

		$upload_dir2='../assets/keen/requirements/';
		$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
		$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
		$id_pic=rand(1000,10000000).".".$imgExt;
		move_uploaded_file($tmp_dir,$upload_dir2.$id_pic);

		$sql = "SELECT * FROM loan_application WHERE loan_app_id = $loan_app_id";
		$query = $dbh->prepare($sql);
		$query->execute();
		if($query->rowCount()==0){
			$insert = "INSERT INTO loan_application(id_pic)VALUES(:id_pic)";
			$insert_query = $dbh->prepare($insert);
			$insert_query->bindParam(':id_pic',$id_pic,PDO::PARAM_STR);
			$insert_query->execute();
		}else{
			$update = "UPDATE loan_application SET id_pic = :id_pic WHERE loan_app_id = $loan_app_id";
			$update_query = $dbh->prepare($update);
			$update_query->bindParam(':id_pic',$id_pic,PDO::PARAM_STR);
			$update_query->execute();
		}
		if($update_query){
			$_SESSION['status'] = "Success";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}else{
			$_SESSION['status'] = "Error!";
			header("location: view_application.php?loan_app_id=$loan_app_id");
			exit();
		}
	}
?>

<?php 
// if(isset($_POST['remove_valid_id'])){
// 	$loan_app_id = intval($_GET['loan_app_id']);
	
// 	$sql = "SELECT * FROM `loan_application`";
// 	$select = $dbh->prepare($sql);
// 	$select->execute();
// 	$result = $select->fetch();
// 	$valid_id = $result['valid_id'];
// 	$sql = "DELETE FROM `loan_application` WHERE valid_id = $valid_id AND loan_app_id = $loan_app_id";


?>



<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
	<base href="../">
	<meta charset="utf-8" />
	<title>Apply Now</title>
	<meta name="description" content="Updates and statistics" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Page Vendors Styles(used by this page)-->
	<link href="assets/keen/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Page Vendors Styles-->
	<!--begin::Global Theme Styles(used by all pages)-->
	<link href="assets/keen/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/keen/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/keen/css/style.bundle.css" rel="stylesheet" type="text/css" />

	<!--end::Global Theme Styles-->
	<!--begin::Layout Themes(used by all pages)-->
	<!--end::Layout Themes-->
	<link rel="shortcut icon" href="assets/keen/media/logos/Hulam_Logo.png" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading" style="background-image: url('assets/keen/media/logos/banner.png')">
	<!--begin::Main-->
	<!--begin::Header Mobile-->
	<div id="kt_header_mobile" class="header-mobile header-mobile-fixed">
		<!--begin::Logo-->
		<a href="debtor/index.php">
			<img alt="Logo" src="assets/keen/media/logos/h_logo2.png" class="max-h-30px" />
		</a>
		<!--end::Logo-->

		<!-- TOOL BAR -->

	</div>
	<!--end::Header Mobile-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Subheader-->
		<div class="subheader bg-white h-100px" id="kt_subheader">
			<div class="container flex-wrap flex-sm-nowrap">
				<!--begin::Logo-->
				<div class="d-none d-lg-flex align-items-center flex-wrap w-250px">
					<!--begin::Logo-->
					<a href="debtor/index.php">
						<img alt="Logo" src="assets/keen/media/logos/h_logo2.png" class="max-h-50px" />
					</a>
					<!--end::Logo-->
				</div>
				<!--end::Logo-->
				<!--begin::Nav-->
				<div class="subheader-nav nav flex-grow-1">
					<!--begin::Item-->
					<a href="debtor/index.php" class="nav-item">
						<span class="nav-label px-10">
							<span class="nav-title text-dark-75 font-weight-bold font-size-h4">&nbsp;&nbsp;&nbsp;&nbsp&nbsp;HOME</span>
							<!-- <span class="nav-desc text-muted">Profile &amp; Account</span> -->
						</span>
					</a>
					<!--end::Item-->
					<!--begin::Item-->
					<a href="debtor/apply_now.php" class="nav-item active">
						<span class="nav-label px-10">
							<span class="nav-title text-dark-75 font-weight-bold font-size-h4">APPLY NOW</span>
							<!-- <span class="nav-desc text-muted">My Order List</span> -->
						</span>
					</a>
					<!--end::Item-->
					<!--begin::Item-->
					<a href="debtor/update_information.php" class="nav-item">
						<span class="nav-label px-10">
							<span class="nav-title text-dark-75 font-weight-bold font-size-h4">UPDATE INFORMATION</span>
							<!-- <span class="nav-desc text-muted">My Order List</span> -->
						</span>
					</a>
					<!--end::Item-->
					<!--begin::Item-->
					<a href="debtor/loan_information.php" class="nav-item">
						<span class="nav-label px-10">
							<span class="nav-title text-dark-75 font-weight-bold font-size-h4">LOAN INFORMATION</span>
							<!-- <span class="nav-desc text-muted">Dashboard &amp; Reports</span> -->
						</span>
					</a>
					<!--end::Item-->
				</div>
				<!--end::Nav-->
			</div>

			<!--begin::Topbar-->
			<div class="topbar">
				<!--begin::Chat-->
				<div class="topbar-item mr-1">
                    <div class="btn btn-icon btn-hover-transparent-black btn-clean btn-lg" data-toggle="modal" id="kt_quick_panel_toggle">
                        <span class="svg-icon svg-icon-xl svg-icon-primary">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Chat6.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M14.4862 18L12.7975 21.0566C12.5304 21.54 11.922 21.7153 11.4386 21.4483C11.2977 21.3704 11.1777 21.2597 11.0887 21.1255L9.01653 18H5C3.34315 18 2 16.6569 2 15V6C2 4.34315 3.34315 3 5 3H19C20.6569 3 22 4.34315 22 6V15C22 16.6569 20.6569 18 19 18H14.4862Z" fill="black" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6 7H15C15.5523 7 16 7.44772 16 8C16 8.55228 15.5523 9 15 9H6C5.44772 9 5 8.55228 5 8C5 7.44772 5.44772 7 6 7ZM6 11H11C11.5523 11 12 11.4477 12 12C12 12.5523 11.5523 13 11 13H6C5.44772 13 5 12.5523 5 12C5 11.4477 5.44772 11 6 11Z" fill="black" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </div>
                </div>
				<!--end::Quick panel-->
				<!--begin::User-->
				<div class="topbar-item mr-3">
					<div class="btn btn-icon btn-hover-transparent-black w-auto d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
						<span class="svg-icon svg-icon-xl svg-icon-primary">
							<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48px" height="48px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<polygon points="0 0 24 0 24 24 0 24" />
									<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
									<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
								</g>
							</svg>
							<!--end::Svg Icon-->
						</span>
					</div>
				</div>
				<!--end::User-->
			</div>
			<!--begin::Dropdown-->
			<!--end::Topbar-->
		</div>
		<!--end::Subheader-->


		<!--begin::Content-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
			<!--begin::Entry-->
			<div class="d-flex flex-column-fluid">
				<!--begin::Container-->
				<div class="container">

					<div class="d-flex flex-column-fluid">
						<div class="container">
							<!-- begin::Card-->
							<div class="card card-custom overflow-hidden">
								<div class="card-body p-0">
									<div class="card card-custom gutter-b">
										<div class="card-body">
											<!-- <form action="debtor/logic/update_loan_application.php" method="post" enctype="multipart/form-data"> -->
												<?php
												$loan_app_id = intval($_GET['loan_app_id']);

												$sql = "SELECT * FROM loan_application WHERE loan_app_id = $loan_app_id";
												$query = $dbh->prepare($sql);
												$query->execute();
												$result = $query->fetch();

												$lender_id = $result['lender_id'];

												$sql2 = "SELECT * FROM loan_features INNER JOIN user ON loan_features.lender_id = user.user_id WHERE loan_features.lender_id = $lender_id";
												$query2 = $dbh->prepare($sql2);
												$query2->execute();
												$lender = $query2->fetch();


												?>
												<div class="d-flex">
													<div class="flex-shrink-0 mr-7">
														<div class="symbol symbol-50 symbol-lg-120 symbol-circle">
															<img alt="Pic" src="/hulam/assets/keen/company_logo/<?= $lender['company_logo'] ?>" />
														</div>
													</div>
													<div class="flex-grow-1">
														<div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
															<div class="mr-3">
																<a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3"><?= $lender['company_name'] ?></a>
															</div>
															<div class="my-lg-0 my-1">
																<a href="debtor/index.php" class="btn btn-sm btn-light-primary font-weight-bolder mr-2">
																	<< Back</a>
															</div>
														</div>
														<div class="d-flex align-items-center flex-wrap justify-content-between">
															<div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">
																<?= $lender['description'] ?>

															</div>
														</div>
													</div>
												</div>
												<div class="separator separator-solid my-7"></div>
												<div class="card-body pt-2">
													<div class="card card-custom">
														<div class="card-body">
															<h5>Loan Information</h5>
															<table class="table table-bordered">
																<?php
																		$loan_app_id = intval($_GET['loan_app_id']);

																		$sql = "SELECT * FROM loan_application WHERE loan_app_id = $loan_app_id";
																		$query = $dbh->prepare($sql);
																		$query->execute();
																		$results = $query->fetchAll(PDO::FETCH_OBJ);
																		if ($query->rowCount() > 0) {
																			foreach ($results as $res) {
																		?>
																<thead>
																	<tr>
																		<th>Loan Status</th>
																		<th><?= htmlentities($res->loan_status);?></th>

																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>Application Date</td>
																		<td><?php echo $year = date('F d, Y - h:i:sa',strtotime($res->date));?></td>
																	</tr>
                                                                    <tr>
																		<td>Approval Date</td>
																		<td><?php echo $year = date('F d, Y',strtotime($res->approval_date));?></td>
																	</tr>
                                                                    <tr>
																		<td>Releasing Schedule</td>
																		<td><?= date('F d, Y',strtotime($res->release_schedule)); ?></td>
																	</tr>
																	<tr>
																		<td>Loan Amount</td>
																		<td><?= number_format(htmlentities($res->loan_amount), 2); ?></td>
																	</tr>
																	<tr>
																		<td>Loan Term</td>
																		<td><?= htmlentities($res->loan_term); ?></td>
																	</tr>
																	<tr>
																		<td>Fix Rate</td>
																		<td><?= htmlentities($res->fix_rate); ?>%</td>
																	</tr>
																	<tr>
																		<td>Total Interest</td>
																		<td><?= number_format(htmlentities($res->total_interest), 2); ?></td>
																	</tr>
																	<tr>
																		<td>Late Charge</td>
																		<td><?= htmlentities($res->late_charges); ?>%</td>
																	</tr>
																	<tr>
																		<td>Total Loan Amount</td>
																		<td><?= number_format(htmlentities($res->total_amount), 2); ?></td>
																	</tr>

																</tbody>
														<?php }
																	} ?>
															</table></br>
															<h5>Uploaded Requirements</h5>
															<?php
																if(isset($_SESSION['status'])){
																	?>
																	<div class="alert alert-success alert-dismissable" id="flash-msg">
																	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
																	<h4>Success!</h4>
																	</div>
																	<?php
																	unset($_SESSION['status']);
																}?>
															<table class="table table-bordered">
																<thead>
																	<tr>
																		<th>Type of Documents</th>
																		<th>Uploaded Documents</th>
																		<th>Action</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																	$loan_app_id = intval($_GET['loan_app_id']);

																	$sql = "SELECT * FROM loan_application WHERE loan_app_id = $loan_app_id";
																	$query = $dbh->prepare($sql);
																	$query->execute();
																	$results = $query->fetchAll(PDO::FETCH_OBJ);
																	if ($query->rowCount() > 0) {
																		foreach ($results as $res) {
																	?>
																			<tr>
																				<td>Valid ID</td>
																				<td><a href="/hulam/assets/keen/requirements/<?= htmlentities($res->barangay_clearance) ?>" target="_blank"><?= htmlentities($res->barangay_clearance); ?></a></td>
																				<td><a href="" class="btn btn-sm btn-light-primary font-weight-bolder mr-2" data-toggle="modal" data-target="#view">Update</a></td>
																					<!-- <button type="submit" class="btn btn-sm btn-light-danger font-weight-bolder mr-2" data-toggle="modal" data-target="#view2">Remove</button></td> -->
																			</tr>
																			<tr>
																				<td>Barangay Clearanace</td>
																				<td><a href="/hulam/assets/keen/requirements/<?= htmlentities($res->barangay_clearance) ?>" target="_blank"><?= htmlentities($res->barangay_clearance); ?></a></td>
																				<td><a href="" class="btn btn-sm btn-light-primary font-weight-bolder mr-2" data-toggle="modal" data-target="#barangay_clearance">Update</a></td>
																			</tr>
																			<tr>
																				<td>Payslip</td>
																				<td><a href="/hulam/assets/keen/requirements/<?= htmlentities($res->payslip) ?>" target="_blank"><?= htmlentities($res->payslip); ?></a></td>
																				<td><a href="" class="btn btn-sm btn-light-primary font-weight-bolder mr-2" data-toggle="modal" data-target="#payslip">Update</a></td>
																			</tr>
																			<tr>
																				<td>Cedula</td>
																				<td><a href="/hulam/assets/keen/requirements/<?= htmlentities($res->cedula) ?>" target="_blank"><?= htmlentities($res->cedula); ?></a></td>
																				<td><a href="" class="btn btn-sm btn-light-primary font-weight-bolder mr-2" data-toggle="modal" data-target="#cedula">Update</a></td>
																			</tr>
																			<tr>
																				<td>ATM Latest Transaction Receipt</td>
																				<td><a href="/hulam/assets/keen/requirements/<?= htmlentities($res->atm_transaction) ?>" target="_blank"><?= htmlentities($res->atm_transaction); ?></a></td>
																				<td><a href="" class="btn btn-sm btn-light-primary font-weight-bolder mr-2" data-toggle="modal" data-target="#atm_transaction">Update</a></td>
																			</tr>
																			<tr>
																				<td>Certificate of Employment</td>
																				<td><a href="/hulam/assets/keen/requirements/<?= htmlentities($res->coe) ?>" target="_blank"><?= htmlentities($res->coe); ?></a></td>
																				<td><a href="" class="btn btn-sm btn-light-primary font-weight-bolder mr-2" data-toggle="modal" data-target="#coe">Update</a></td>
																			</tr>
																			<tr>
																				<td>Bank Statement</td>
																				<td><a href="/hulam/assets/keen/requirements/<?= htmlentities($res->bank_statement) ?>" target="_blank"><?= htmlentities($res->bank_statement); ?></a></td>
																				<td><a href="" class="btn btn-sm btn-light-primary font-weight-bolder mr-2" data-toggle="modal" data-target="#bank_statement">Update</a></td>
																			</tr>
																			<tr>
																				<td>Proof of Billing</td>
																				<td><a href="/hulam/assets/keen/requirements/<?= htmlentities($res->proof_billing) ?>" target="_blank"><?= htmlentities($res->proof_billing); ?></a></td>
																				<td><a href="" class="btn btn-sm btn-light-primary font-weight-bolder mr-2" data-toggle="modal" data-target="#proof_billing">Update</a></td>
																			</tr>
																			<tr>
																				<td>Co-Maker ID</td>
																				<td><a href="/hulam/assets/keen/requirements/<?= htmlentities($res->co_maker_id) ?>" target="_blank"><?= htmlentities($res->co_maker_id); ?></a></td>
																				<td><a href="" class="btn btn-sm btn-light-primary font-weight-bolder mr-2" data-toggle="modal" data-target="#co_maker_id">Update</a></td>
																			</tr>
																			<tr>
																				<td>Co-Maker Cedula</td>
																				<td><a href="/hulam/assets/keen/requirements/<?= htmlentities($res->co_maker_cedula) ?>" target="_blank"><?= htmlentities($res->co_maker_cedula); ?></a></td>
																				<td><a href="" class="btn btn-sm btn-light-primary font-weight-bolder mr-2" data-toggle="modal" data-target="#co_maker_cedula">Update</a></td>
																			</tr>
																			<tr>
																				<td>2x2 ID</td>
																				<td><a href="/hulam/assets/keen/requirements/<?= htmlentities($res->id_pic) ?>" target="_blank"><?= htmlentities($res->id_pic); ?></a></td>
																				<td><a href="" class="btn btn-sm btn-light-primary font-weight-bolder mr-2" data-toggle="modal" data-target="#id_pic">Update</a></td>
																			</tr>
																</tbody>
														<?php }
																	} ?>
															</table>
															<!-- Start Modal -->
															<form action="" method="post" enctype="multipart/form-data">
															<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
																<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title" id="exampleModalLabel">Valid ID</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<i aria-hidden="true" class="ki ki-close"></i>
																			</button>
																		</div>
																		<!-- <div class="modal-body">
																			<div class="ExternalFiles">
																				<img src="/hulam/assets/keen/requirements/<?= htmlentities($res->barangay_clearance) ?>" style="width: 500px; height:auto">
																			</div>
																			<div class="ExternalFiles">		
																				<iframe src="/hulam/assets/keen/requirements/<?= htmlentities($res->barangay_clearance) ?>" width="1000" height="1000"></iframe>
																			</div>
																		</div> -->
																			<div class="col-xl-4">
																				<label class="font-weight-bolder font-size-lg" for="input-username">Edit Valid ID</label>
																				<div class="form-group">
																					<input type="file" name="valid_id" class="dropzone-select btn btn-light-primary font-weight-bold btn-sm mt-3" />
																				</div>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
																				<button type="submit" name="valid_id" class="btn btn-primary font-weight-bold">Save changes</button>
																			</div>
																		</div>
																	</div>
																</div>
															</form>
															<!-- End Modal -->
															<!-- Start Modal -->
															<form action="" method="post" enctype="multipart/form-data">
															<div class="modal fade" id="barangay_clearance" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
																<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title" id="exampleModalLabel">Barangay Clearance</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<i aria-hidden="true" class="ki ki-close"></i>
																			</button>
																		</div>
																			<div class="col-xl-4">
																				<label class="font-weight-bolder font-size-lg" for="input-username">Edit Barangay Clearance</label>
																				<div class="form-group">
																					<input type="file" name="barangay_clearance" class="dropzone-select btn btn-light-primary font-weight-bold btn-sm mt-3" />
																				</div>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
																				<button type="barangay_clearance" name="barangay_clearance" class="btn btn-primary font-weight-bold">Save changes</button>
																			</div>
																		</div>
																	</div>
																</div>
															</form>
															<!-- End Modal -->
															<!-- Start Modal -->
															<form action="" method="post" enctype="multipart/form-data">
															<div class="modal fade" id="payslip" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
																<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title" id="exampleModalLabel">Payslip</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<i aria-hidden="true" class="ki ki-close"></i>
																			</button>
																		</div>
																			<div class="col-xl-4">
																				<label class="font-weight-bolder font-size-lg" for="input-username">Edit Payslip</label>
																				<div class="form-group">
																					<input type="file" name="payslip" class="dropzone-select btn btn-light-primary font-weight-bold btn-sm mt-3" />
																				</div>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
																				<button type="submit" name="payslip" class="btn btn-primary font-weight-bold">Save changes</button>
																			</div>
																		</div>
																	</div>
																</div>
															</form>
															<!-- End Modal -->
															<!-- Start Modal -->
															<form action="" method="post" enctype="multipart/form-data">
															<div class="modal fade" id="cedula" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
																<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title" id="exampleModalLabel">Cedula</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<i aria-hidden="true" class="ki ki-close"></i>
																			</button>
																		</div>
																			<div class="col-xl-4">
																				<label class="font-weight-bolder font-size-lg" for="input-username">Edit Cedula</label>
																				<div class="form-group">
																					<input type="file" name="cedula" class="dropzone-select btn btn-light-primary font-weight-bold btn-sm mt-3" />
																				</div>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
																				<button type="submit" name="cedula" class="btn btn-primary font-weight-bold">Save changes</button>
																			</div>
																		</div>
																	</div>
																</div>
															</form>
															<!-- End Modal -->
															<!-- Start Modal -->
															<form action="" method="post" enctype="multipart/form-data">
															<div class="modal fade" id="atm_transaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
																<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title" id="exampleModalLabel">ATM Latest Transaction Receipt</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<i aria-hidden="true" class="ki ki-close"></i>
																			</button>
																		</div>
																			<div class="col-xl-4">
																				<label class="font-weight-bolder font-size-lg" for="input-username">Edit Latest Transaction Receipt</label>
																				<div class="form-group">
																					<input type="file" name="atm_transaction" class="dropzone-select btn btn-light-primary font-weight-bold btn-sm mt-3" />
																				</div>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
																				<button type="submit" name="atm_transaction" class="btn btn-primary font-weight-bold">Save changes</button>
																			</div>
																		</div>
																	</div>
																</div>
															</form>
															<!-- End Modal -->
															<!-- Start Modal -->
															<form action="" method="post" enctype="multipart/form-data">
															<div class="modal fade" id="coe" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
																<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title" id="exampleModalLabel">Certificate of Employment</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<i aria-hidden="true" class="ki ki-close"></i>
																			</button>
																		</div>
																			<div class="col-xl-4">
																				<label class="font-weight-bolder font-size-lg" for="input-username">Edit Certificate of Employment</label>
																				<div class="form-group">
																					<input type="file" name="coe" class="dropzone-select btn btn-light-primary font-weight-bold btn-sm mt-3" />
																				</div>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
																				<button type="submit" name="coe" class="btn btn-primary font-weight-bold">Save changes</button>
																			</div>
																		</div>
																	</div>
																</div>
															</form>
															<!-- End Modal -->
															<!-- Start Modal -->
															<form action="" method="post" enctype="multipart/form-data">
															<div class="modal fade" id="bank_statement" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
																<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title" id="exampleModalLabel">Bank Statement</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<i aria-hidden="true" class="ki ki-close"></i>
																			</button>
																		</div>
																			<div class="col-xl-4">
																				<label class="font-weight-bolder font-size-lg" for="input-username">Edit Bank Statement</label>
																				<div class="form-group">
																					<input type="file" name="bank_statement" class="dropzone-select btn btn-light-primary font-weight-bold btn-sm mt-3" />
																				</div>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
																				<button type="submit" name="bank_statement" class="btn btn-primary font-weight-bold">Save changes</button>
																			</div>
																		</div>
																	</div>
																</div>
															</form>
															<!-- End Modal -->
															<!-- Start Modal -->
															<form action="" method="post" enctype="multipart/form-data">
															<div class="modal fade" id="proof_billing" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
																<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title" id="exampleModalLabel">Proof of Billing</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<i aria-hidden="true" class="ki ki-close"></i>
																			</button>
																		</div>
																			<div class="col-xl-4">
																				<label class="font-weight-bolder font-size-lg" for="input-username">Edit Proof of Billing</label>
																				<div class="form-group">
																					<input type="file" name="proof_billing" class="dropzone-select btn btn-light-primary font-weight-bold btn-sm mt-3" />
																				</div>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
																				<button type="submit" name="proof_billing" class="btn btn-primary font-weight-bold">Save changes</button>
																			</div>
																		</div>
																	</div>
																</div>
															</form>
															<!-- End Modal -->
															<!-- Start Modal -->
															<form action="" method="post" enctype="multipart/form-data">
															<div class="modal fade" id="co_maker_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
																<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title" id="exampleModalLabel">Co-Maker ID</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<i aria-hidden="true" class="ki ki-close"></i>
																			</button>
																		</div>
																			<div class="col-xl-4">
																				<label class="font-weight-bolder font-size-lg" for="input-username">Edit Co-Maker ID</label>
																				<div class="form-group">
																					<input type="file" name="co_maker_id" class="dropzone-select btn btn-light-primary font-weight-bold btn-sm mt-3" />
																				</div>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
																				<button type="submit" name="co_maker_id" class="btn btn-primary font-weight-bold">Save changes</button>
																			</div>
																		</div>
																	</div>
																</div>
															</form>
															<!-- End Modal -->

															<!-- Start Modal -->
															<form action="" method="post" enctype="multipart/form-data">
															<div class="modal fade" id="co_maker_cedula" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
																<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title" id="exampleModalLabel">Co-Maker Cedula</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<i aria-hidden="true" class="ki ki-close"></i>
																			</button>
																		</div>
																			<div class="col-xl-4">
																				<label class="font-weight-bolder font-size-lg" for="input-username">Edit Co-Maker Cedula</label>
																				<div class="form-group">
																					<input type="file" name="co_maker_cedula" class="dropzone-select btn btn-light-primary font-weight-bold btn-sm mt-3" />
																				</div>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
																				<button type="submit" name="co_maker_cedula" class="btn btn-primary font-weight-bold">Save changes</button>
																			</div>
																		</div>
																	</div>
																</div>
															</form>
															<!-- End Modal -->
															<!-- Start Modal -->
															<form action="" method="post" enctype="multipart/form-data">
															<div class="modal fade" id="id_pic" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
																<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title" id="exampleModalLabel">2X2 ID Picture</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<i aria-hidden="true" class="ki ki-close"></i>
																			</button>
																		</div>
																			<div class="col-xl-4">
																				<label class="font-weight-bolder font-size-lg" for="input-username">Edit 2X2 ID Picture</label>
																				<div class="form-group">
																					<input type="file" name="id_pic" class="dropzone-select btn btn-light-primary font-weight-bold btn-sm mt-3" />
																				</div>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
																				<button type="submit" name="id_pic" class="btn btn-primary font-weight-bold">Save changes</button>
																			</div>
																		</div>
																	</div>
																</div>
															</form>
															<!-- End Modal -->
															<!-- MODAL REMOVE -->
															<!-- Start Modal -->
															<form action="" method="post" enctype="multipart/form-data">
															<div class="modal fade" id="view2" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
																<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title" id="exampleModalLabel">Valid ID</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<i aria-hidden="true" class="ki ki-close"></i>
																			</button>
																		</div>
																		<div class="modal-body">
																			Are you Sure you want to Remove?
																		</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">No</button>
																				<button type="submit" name="remove_valid_id" class="btn btn-primary font-weight-bold">Yes</button>
																			</div>
																		</div>
																	</div>
																</div>
															</form>
															<!-- End Modal -->

														</div>
													</div>
												</div>


												<!-- UPLOAD REQUIREMENTS -->
												<div class="separator separator-solid my-7"></div>
												<div class="form-group row">
													<h4>Reminders:</h4>
													<div class="col-lg-12 col-xl-12">
														<p class="font-weight-bolder font-size-lg py-4">
															<!-- ▸ Loan application is subject for approval.</br> -->
															▸ Please comply all the requirements provided below to complete the loan application.</br>
															▸ Requirements uploaded will be validated by the <?= $lender['company_name'] ?>.
														</p>Please read <a href="#" class="font-weight-boldk" data-toggle="modal" data-target="#view_terms">Terms and Conditions |&nbsp;&nbsp;</a><a href="#" class="font-weight-bold" data-toggle="modal" data-target="#view_privacy">Privacy Statement</a>
													</div>
												</div>

												<div class="separator separator-solid my-7"></div>
												
												
											<!-- Start Modal -->
											<div class="modal fade" id="view_terms" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel">Hulam Data Privacy</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<i aria-hidden="true" class="ki ki-close"></i>
															</button>
														</div>
														<div class="modal-body">
															<div class="ExternalFiles">
																<iframe src="/hulam/assets/admin/terms_privacy/Hulam-Data-Privacy.pdf" width="1000" height="1000"></iframe>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
															<button type="button" class="btn btn-primary font-weight-bold">Save changes</button>
														</div>
													</div>
												</div>
											</div>
											<!-- End Modal -->
											<!-- Start Modal -->
											<div class="modal fade" id="view_privacy" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel">Terms and Conditions</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<i aria-hidden="true" class="ki ki-close"></i>
															</button>
														</div>
														<div class="modal-body">
															<div class="ExternalFiles">
																<iframe src="/hulam/assets/admin/terms_privacy/TERMS-AND-CONDITIONS.pdf" width="1000" height="1000"></iframe>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
															<button type="button" class="btn btn-primary font-weight-bold">Save changes</button>
														</div>
													</div>
												</div>
											</div>
											<!-- End Modal -->

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

	<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
		<div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
			<div class="text-dark order-2 order-md-1">
				<span class="text-muted font-weight-bold mr-2">2021©</span>
				<a href="http://keenthemes.com/keen" target="_blank" class="text-dark-75 text-hover-primary">Hulam</a>
			</div>
			<div class="nav nav-dark order-1 order-md-2">
				<a href="http://keenthemes.com/keen" target="_blank" class="nav-link pr-3 pl-0">About</a>
				<a href="http://keenthemes.com/keen" target="_blank" class="nav-link px-3">Team</a>
				<a href="http://keenthemes.com/keen" target="_blank" class="nav-link pl-3 pr-0">Contact</a>
			</div>
		</div>
	</div>
	</div>
	</div>
	</div>

	<!-- begin::User Panel-->
	<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
		<!--begin::Header-->
		<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
			<h3 class="font-weight-bold m-0">User Profile
				<!-- <small class="text-muted font-size-sm ml-2">15 messages</small></h3> -->
				<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
					<i class="ki ki-close icon-xs text-muted"></i>
				</a>
		</div>
		<!--end::Header-->
		<!--begin::Content-->
		<div class="offcanvas-content pr-5 mr-n5">
			<!--begin::Header-->
			<div class="d-flex align-items-center mt-5">
				<div class="symbol symbol-100 mr-5">
					<div class="symbol-label" style="background-image:url('assets/keen/media/logos/icon-debtors.png')"></div>
					<i class="symbol-badge bg-success"></i>
				</div>
				<div class="d-flex flex-column">
					<a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?= $_SESSION['firstname']; ?> <?= $_SESSION['lastname']; ?></a>
					<div class="text-muted mt-1">Debtor</div>
					<div class="navi mt-1">
						<a href="#" class="navi-item">
							<span class="navi-link p-0 pb-2">
								<span class="navi-icon mr-1">
									<span class="svg-icon svg-icon-lg svg-icon-primary">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
												<circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
								</span>
								<span class="navi-text text-muted text-hover-primary">gregamit31@gmail.com</span>
							</span>
						</a>
					</div>
				</div>
			</div>
			<!--end::Header-->
			<!--begin::Separator-->
			<div class="separator separator-dashed mt-8 mb-5"></div>
			<!--end::Separator-->
			<!--begin::Nav-->
			<div class="navi navi-spacer-x-0 p-0">
				<!--begin::Item-->
				<a href="custom/apps/user/profile-1/personal-information.html" class="navi-item">
					<div class="navi-link">
						<div class="symbol symbol-40 bg-light mr-3">
							<div class="symbol-label">
								<span class="svg-icon svg-icon-md svg-icon-danger">
									<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Adress-book2.svg-->
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<path d="M18,2 L20,2 C21.6568542,2 23,3.34314575 23,5 L23,19 C23,20.6568542 21.6568542,22 20,22 L18,22 L18,2 Z" fill="#000000" opacity="0.3" />
											<path d="M5,2 L17,2 C18.6568542,2 20,3.34314575 20,5 L20,19 C20,20.6568542 18.6568542,22 17,22 L5,22 C4.44771525,22 4,21.5522847 4,21 L4,3 C4,2.44771525 4.44771525,2 5,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000" />
										</g>
									</svg>
									<!--end::Svg Icon-->
								</span>
							</div>
						</div>
						<div class="navi-text">
							<div class="font-weight-bold">My Account</div>
							<div class="text-muted">Profile info
								<span class="label label-light-danger label-inline font-weight-bold">update</span>
							</div>
						</div>
					</div>
				</a>
				<!--end:Item-->
				<!--begin::Item-->
				<a href="custom/apps/user/profile-3.html" class="navi-item">
					<div class="navi-link">
						<div class="symbol symbol-40 bg-light mr-3">
							<div class="symbol-label">
								<span class="svg-icon svg-icon-md svg-icon-success">
									<!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000" />
											<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3" />
										</g>
									</svg>
									<!--end::Svg Icon-->
								</span>
							</div>
						</div>
						<div class="navi-text">
							<div class="font-weight-bold">My Tasks</div>
							<div class="text-muted">Todo and tasks</div>
						</div>
					</div>
				</a>
				<!--end:Item-->
				<!--begin::Item-->
				<a href="custom/apps/user/profile-2.html" class="navi-item">
					<div class="navi-link">
						<div class="symbol symbol-40 bg-light mr-3">
							<div class="symbol-label">
								<span class="svg-icon svg-icon-md svg-icon-primary">
									<!--begin::Svg Icon | path:assets/media/svg/icons/General/Half-star.svg-->
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24" />
											<path d="M12,4.25932872 C12.1488635,4.25921584 12.3000368,4.29247316 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 L12,4.25932872 Z" fill="#000000" opacity="0.3" />
											<path d="M12,4.25932872 L12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.277344,4.464261 11.6315987,4.25960807 12,4.25932872 Z" fill="#000000" />
										</g>
									</svg>
									<!--end::Svg Icon-->
								</span>
							</div>
						</div>
						<div class="navi-text">
							<div class="font-weight-bold">My Events</div>
							<div class="text-muted">Logs and notifications</div>
						</div>
					</div>
				</a>
				<!--end:Item-->
				<!--begin::Item-->
				<a href="custom/apps/userprofile-1/overview.html" class="navi-item">
					<div class="navi-link">
						<div class="symbol symbol-40 bg-light mr-3">
							<div class="symbol-label">
								<span class="svg-icon svg-icon-md svg-icon-info">
									<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg-->
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" fill="#000000" opacity="0.3" />
											<path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000" />
										</g>
									</svg>
									<!--end::Svg Icon-->
								</span>
							</div>
						</div>
						<div class="navi-text">
							<div class="font-weight-bold">My Statements</div>
							<div class="text-muted">latest tasks and projects</div>
						</div>
					</div>
				</a>
				<!--end:Item-->
				<!--begin::Item-->
				<span class="navi-item mt-2">
					<span class="navi-link">
						<a href="logout.php" class="btn btn-sm btn-light-primary font-weight-bolder py-3 px-6">Sign Out</a>
					</span>
				</span>
				<!--end:Item-->
			</div>
			<!--end::Nav-->
			<!--begin::Separator-->
			<div class="separator separator-dashed my-7"></div>
			<!--end::Separator-->
		</div>
		<!--end::Content-->
	</div>
	<!-- end::User Panel-->

	

    <!--begin::Quick Panel-->
    <div id="kt_quick_panel" class="offcanvas offcanvas-right pt-5 pb-10">
        <!--begin::Header-->
        <div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5">
            <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#kt_chat_modal">Messages</a>
                </li>
            </ul>
            <div class="offcanvas-close mt-n1 pr-5">
                <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_panel_close">
                    <i class="ki ki-close icon-xs text-muted"></i>
                </a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Content-->
        <div class="offcanvas-content px-10">
            <div class="tab-content">
                <div class="navi navi-icon-circle navi-spacer-x-0">
                    <?php
                    $user_id = $_SESSION['user_id'];

                    $sql = "SELECT * FROM message INNER JOIN user ON message.sender_id = user.user_id WHERE message.receiver_id = $user_id";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    foreach ($results as $res) :

                    ?> <a href="debtor/messages.php?sender_id=<?= htmlentities($res->sender_id) ?>">
                            <div class="navi-link rounded">
                                <div class="symbol symbol-50 mr-3">
                                </div>
                                <div class="navi-text">
                                    <div class="font-weight-bold font-size-lg">
                                        <?php
                                        $red = htmlentities($res->user_type);

                                        if ($red == 1) : ?>
                                            <?= htmlentities($res->firstname) . '' . htmlentities($res->middlename) . ' ' . htmlentities($res->lastname); ?>
                                        <?php elseif ($red == 2) : ?>
                                            <?= htmlentities($res->firstname) . '' . htmlentities($res->middlename) . ' ' . htmlentities($res->lastname); ?>
                                        <?php elseif ($red == 3) : ?>
                                            <?= htmlentities($res->company_name); ?>
                                        <?php elseif ($red == 4) : ?>
                                            <?= htmlentities($res->firstname) . '' . htmlentities($res->middlename) . ' ' . htmlentities($res->lastname); ?>
                                        <?php else : ?>
                                            <?= htmlentities($res->company_name); ?>
                                        <?php endif; ?>
                                    </div><span class="font-size-sm"><?= htmlentities($res->date_message); ?></span>
                                    <div class="text-muted"><?= htmlentities($res->message) ?></div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!--end::Content-->
    </div>
    <!--end::Quick Panel-->	<!--begin::Chat Panel-->
	<div class="modal modal-sticky modal-sticky-bottom-right" id="kt_chat_modal" role="dialog" data-backdrop="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<!--begin::Card-->
				<div class="card card-custom">
					<!--begin::Header-->
					<div class="card-header align-items-center px-4 py-3">
						<div class="text-left flex-grow-1">
							<!--begin::Dropdown Menu-->
							<div class="dropdown dropdown-inline">
								<button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="svg-icon svg-icon-lg">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24" />
												<path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
												<path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
								</button>
								<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-md">
									<!--begin::Navigation-->
									<ul class="navi navi-hover py-5">
										<li class="navi-item">
											<a href="#" class="navi-link">
												<span class="navi-icon">
													<span class="svg-icon svg-icon-md svg-icon-primary">
														<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																<path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</span>
												<span class="navi-text">Member</span>
											</a>
										</li>
										<li class="navi-item">
											<a href="#" class="navi-link">
												<span class="navi-icon">
													<span class="svg-icon svg-icon-md svg-icon-primary">
														<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Clipboard-check.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect x="0" y="0" width="24" height="24" />
																<path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3" />
																<path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" fill="#000000" />
																<path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</span>
												<span class="navi-text">Contact</span>
											</a>
										</li>
										<li class="navi-item">
											<a href="#" class="navi-link">
												<span class="navi-icon">
													<span class="svg-icon svg-icon-md svg-icon-primary">
														<!--begin::Svg Icon | path:assets/media/svg/icons/Code/Time-schedule.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect x="0" y="0" width="24" height="24" />
																<path d="M10.9630156,7.5 L11.0475062,7.5 C11.3043819,7.5 11.5194647,7.69464724 11.5450248,7.95024814 L12,12.5 L15.2480695,14.3560397 C15.403857,14.4450611 15.5,14.6107328 15.5,14.7901613 L15.5,15 C15.5,15.2109164 15.3290185,15.3818979 15.1181021,15.3818979 C15.0841582,15.3818979 15.0503659,15.3773725 15.0176181,15.3684413 L10.3986612,14.1087258 C10.1672824,14.0456225 10.0132986,13.8271186 10.0316926,13.5879956 L10.4644883,7.96165175 C10.4845267,7.70115317 10.7017474,7.5 10.9630156,7.5 Z" fill="#000000" />
																<path d="M7.38979581,2.8349582 C8.65216735,2.29743306 10.0413491,2 11.5,2 C17.2989899,2 22,6.70101013 22,12.5 C22,18.2989899 17.2989899,23 11.5,23 C5.70101013,23 1,18.2989899 1,12.5 C1,11.5151324 1.13559454,10.5619345 1.38913364,9.65805651 L3.31481075,10.1982117 C3.10672013,10.940064 3,11.7119264 3,12.5 C3,17.1944204 6.80557963,21 11.5,21 C16.1944204,21 20,17.1944204 20,12.5 C20,7.80557963 16.1944204,4 11.5,4 C10.54876,4 9.62236069,4.15592757 8.74872191,4.45446326 L9.93948308,5.87355717 C10.0088058,5.95617272 10.0495583,6.05898805 10.05566,6.16666224 C10.0712834,6.4423623 9.86044965,6.67852665 9.5847496,6.69415008 L4.71777931,6.96995273 C4.66931162,6.97269931 4.62070229,6.96837279 4.57348157,6.95710938 C4.30487471,6.89303938 4.13906482,6.62335149 4.20313482,6.35474463 L5.33163823,1.62361064 C5.35654118,1.51920756 5.41437908,1.4255891 5.49660017,1.35659741 C5.7081375,1.17909652 6.0235153,1.2066885 6.2010162,1.41822583 L7.38979581,2.8349582 Z" fill="#000000" opacity="0.3" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</span>
												<span class="navi-text">Event</span>
												<span class="navi-link-badge">
													<span class="label label-light-primary label-inline font-weight-bold">new</span>
												</span>
											</a>
										</li>
										<li class="navi-item">
											<a href="#" class="navi-link">
												<span class="navi-icon">
													<span class="svg-icon svg-icon-md svg-icon-primary">
														<!--begin::Svg Icon | path:assets/media/svg/icons/Code/Git3.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect x="0" y="0" width="24" height="24" />
																<path d="M7,11 L15,11 C16.1045695,11 17,10.1045695 17,9 L17,8 L19,8 L19,9 C19,11.209139 17.209139,13 15,13 L7,13 L7,15 C7,15.5522847 6.55228475,16 6,16 C5.44771525,16 5,15.5522847 5,15 L5,9 C5,8.44771525 5.44771525,8 6,8 C6.55228475,8 7,8.44771525 7,9 L7,11 Z" fill="#000000" opacity="0.3" />
																<path d="M6,21 C7.1045695,21 8,20.1045695 8,19 C8,17.8954305 7.1045695,17 6,17 C4.8954305,17 4,17.8954305 4,19 C4,20.1045695 4.8954305,21 6,21 Z M6,23 C3.790861,23 2,21.209139 2,19 C2,16.790861 3.790861,15 6,15 C8.209139,15 10,16.790861 10,19 C10,21.209139 8.209139,23 6,23 Z" fill="#000000" fill-rule="nonzero" />
																<path d="M18,7 C19.1045695,7 20,6.1045695 20,5 C20,3.8954305 19.1045695,3 18,3 C16.8954305,3 16,3.8954305 16,5 C16,6.1045695 16.8954305,7 18,7 Z M18,9 C15.790861,9 14,7.209139 14,5 C14,2.790861 15.790861,1 18,1 C20.209139,1 22,2.790861 22,5 C22,7.209139 20.209139,9 18,9 Z" fill="#000000" fill-rule="nonzero" />
																<path d="M6,7 C7.1045695,7 8,6.1045695 8,5 C8,3.8954305 7.1045695,3 6,3 C4.8954305,3 4,3.8954305 4,5 C4,6.1045695 4.8954305,7 6,7 Z M6,9 C3.790861,9 2,7.209139 2,5 C2,2.790861 3.790861,1 6,1 C8.209139,1 10,2.790861 10,5 C10,7.209139 8.209139,9 6,9 Z" fill="#000000" fill-rule="nonzero" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</span>
												<span class="navi-text">Task</span>
											</a>
										</li>
										<li class="navi-item">
											<a href="#" class="navi-link">
												<span class="navi-icon">
													<span class="svg-icon svg-icon-md svg-icon-primary">
														<!--begin::Svg Icon | path:assets/media/svg/icons/Code/Settings4.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect x="0" y="0" width="24" height="24" />
																<path d="M18.6225,9.75 L18.75,9.75 C19.9926407,9.75 21,10.7573593 21,12 C21,13.2426407 19.9926407,14.25 18.75,14.25 L18.6854912,14.249994 C18.4911876,14.250769 18.3158978,14.366855 18.2393549,14.5454486 C18.1556809,14.7351461 18.1942911,14.948087 18.3278301,15.0846699 L18.372535,15.129375 C18.7950334,15.5514036 19.03243,16.1240792 19.03243,16.72125 C19.03243,17.3184208 18.7950334,17.8910964 18.373125,18.312535 C17.9510964,18.7350334 17.3784208,18.97243 16.78125,18.97243 C16.1840792,18.97243 15.6114036,18.7350334 15.1896699,18.3128301 L15.1505513,18.2736469 C15.008087,18.1342911 14.7951461,18.0956809 14.6054486,18.1793549 C14.426855,18.2558978 14.310769,18.4311876 14.31,18.6225 L14.31,18.75 C14.31,19.9926407 13.3026407,21 12.06,21 C10.8173593,21 9.81,19.9926407 9.81,18.75 C9.80552409,18.4999185 9.67898539,18.3229986 9.44717599,18.2361469 C9.26485393,18.1556809 9.05191298,18.1942911 8.91533009,18.3278301 L8.870625,18.372535 C8.44859642,18.7950334 7.87592081,19.03243 7.27875,19.03243 C6.68157919,19.03243 6.10890358,18.7950334 5.68746499,18.373125 C5.26496665,17.9510964 5.02757002,17.3784208 5.02757002,16.78125 C5.02757002,16.1840792 5.26496665,15.6114036 5.68716991,15.1896699 L5.72635306,15.1505513 C5.86570889,15.008087 5.90431906,14.7951461 5.82064513,14.6054486 C5.74410223,14.426855 5.56881236,14.310769 5.3775,14.31 L5.25,14.31 C4.00735931,14.31 3,13.3026407 3,12.06 C3,10.8173593 4.00735931,9.81 5.25,9.81 C5.50008154,9.80552409 5.67700139,9.67898539 5.76385306,9.44717599 C5.84431906,9.26485393 5.80570889,9.05191298 5.67216991,8.91533009 L5.62746499,8.870625 C5.20496665,8.44859642 4.96757002,7.87592081 4.96757002,7.27875 C4.96757002,6.68157919 5.20496665,6.10890358 5.626875,5.68746499 C6.04890358,5.26496665 6.62157919,5.02757002 7.21875,5.02757002 C7.81592081,5.02757002 8.38859642,5.26496665 8.81033009,5.68716991 L8.84944872,5.72635306 C8.99191298,5.86570889 9.20485393,5.90431906 9.38717599,5.82385306 L9.49484664,5.80114977 C9.65041313,5.71688974 9.7492905,5.55401473 9.75,5.3775 L9.75,5.25 C9.75,4.00735931 10.7573593,3 12,3 C13.2426407,3 14.25,4.00735931 14.25,5.25 L14.249994,5.31450877 C14.250769,5.50881236 14.366855,5.68410223 14.552824,5.76385306 C14.7351461,5.84431906 14.948087,5.80570889 15.0846699,5.67216991 L15.129375,5.62746499 C15.5514036,5.20496665 16.1240792,4.96757002 16.72125,4.96757002 C17.3184208,4.96757002 17.8910964,5.20496665 18.312535,5.626875 C18.7350334,6.04890358 18.97243,6.62157919 18.97243,7.21875 C18.97243,7.81592081 18.7350334,8.38859642 18.3128301,8.81033009 L18.2736469,8.84944872 C18.1342911,8.99191298 18.0956809,9.20485393 18.1761469,9.38717599 L18.1988502,9.49484664 C18.2831103,9.65041313 18.4459853,9.7492905 18.6225,9.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																<path d="M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</span>
												<span class="navi-text">Settings</span>
											</a>
										</li>
										<li class="navi-separator my-3"></li>
										<li class="navi-item">
											<a href="#" class="navi-link">
												<span class="navi-icon">
													<span class="svg-icon svg-icon-md svg-icon-primary">
														<!--begin::Svg Icon | path:assets/media/svg/icons/Code/Info-circle.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect x="0" y="0" width="24" height="24" />
																<circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
																<rect fill="#000000" x="11" y="10" width="2" height="7" rx="1" />
																<rect fill="#000000" x="11" y="7" width="2" height="2" rx="1" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</span>
												<span class="navi-text">Help</span>
											</a>
										</li>
										<li class="navi-item">
											<a href="#" class="navi-link">
												<span class="navi-icon">
													<span class="svg-icon svg-icon-md svg-icon-primary">
														<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Safe-chat.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect x="0" y="0" width="24" height="24" />
																<path d="M8,17 C8.55228475,17 9,17.4477153 9,18 L9,21 C9,21.5522847 8.55228475,22 8,22 L3,22 C2.44771525,22 2,21.5522847 2,21 L2,18 C2,17.4477153 2.44771525,17 3,17 L3,16.5 C3,15.1192881 4.11928813,14 5.5,14 C6.88071187,14 8,15.1192881 8,16.5 L8,17 Z M5.5,15 C4.67157288,15 4,15.6715729 4,16.5 L4,17 L7,17 L7,16.5 C7,15.6715729 6.32842712,15 5.5,15 Z" fill="#000000" opacity="0.3" />
																<path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" fill="#000000" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</span>
												<span class="navi-text">Privacy</span>
												<span class="navi-link-badge">
													<span class="label label-light-danger label-rounded font-weight-bold">5</span>
												</span>
											</a>
										</li>
									</ul>
									<!--end::Navigation-->
								</div>
							</div>
							<!--end::Dropdown Menu-->
						</div>
						<div class="text-center flex-grow-1">
							<div class="text-dark-75 font-weight-bold font-size-h5">Matt Pears</div>
							<div>
								<span class="label label-dot label-success"></span>
								<span class="font-weight-bold text-muted font-size-sm">Active</span>
							</div>
						</div>
						<div class="text-right flex-grow-1">
							<button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-dismiss="modal">
								<i class="ki ki-close icon-1x"></i>
							</button>
						</div>
					</div>
					<!--end::Header-->
					<!--begin::Body-->
					<div class="card-body">
						<!--begin::Scroll-->
						<div class="scroll scroll-pull" data-height="375" data-mobile-height="300">
							<!--begin::Messages-->
							<div class="messages">
								<!--begin::Message In-->
								<div class="d-flex flex-column mb-5 align-items-start">
									<div class="d-flex align-items-center">
										<div class="symbol symbol-circle symbol-40 mr-3">
											<img alt="Pic" src="assets/media/users/150-11.jpg" />
										</div>
										<div>
											<a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">Matt Pears</a>
											<span class="text-muted font-size-sm">2 Hours</span>
										</div>
									</div>
									<div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">How likely are you to recommend our company to your friends and family?</div>
								</div>
								<!--end::Message In-->
								<!--begin::Message Out-->
								<div class="d-flex flex-column mb-5 align-items-end">
									<div class="d-flex align-items-center">
										<div>
											<span class="text-muted font-size-sm">3 minutes</span>
											<a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">You</a>
										</div>
										<div class="symbol symbol-circle symbol-40 ml-3">
											<img alt="Pic" src="assets/media/users/150-9.jpg" />
										</div>
									</div>
									<div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">Hey there, we’re just writing to let you know that you’ve been subscribed to a repository on GitHub.</div>
								</div>
								<!--end::Message Out-->
								<!--begin::Message In-->
								<div class="d-flex flex-column mb-5 align-items-start">
									<div class="d-flex align-items-center">
										<div class="symbol symbol-circle symbol-40 mr-3">
											<img alt="Pic" src="assets/media/users/150-11.jpg" />
										</div>
										<div>
											<a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">Matt Pears</a>
											<span class="text-muted font-size-sm">40 seconds</span>
										</div>
									</div>
									<div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">Ok, Understood!</div>
								</div>
								<!--end::Message In-->
								<!--begin::Message Out-->
								<div class="d-flex flex-column mb-5 align-items-end">
									<div class="d-flex align-items-center">
										<div>
											<span class="text-muted font-size-sm">Just now</span>
											<a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">You</a>
										</div>
										<div class="symbol symbol-circle symbol-40 ml-3">
											<img alt="Pic" src="assets/media/users/150-9.jpg" />
										</div>
									</div>
									<div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">You’ll receive notifications for all issues, pull requests!</div>
								</div>
								<!--end::Message Out-->
								<!--begin::Message In-->
								<div class="d-flex flex-column mb-5 align-items-start">
									<div class="d-flex align-items-center">
										<div class="symbol symbol-circle symbol-40 mr-3">
											<img alt="Pic" src="assets/media/users/150-2.jpg" />
										</div>
										<div>
											<a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">Matt Pears</a>
											<span class="text-muted font-size-sm">40 seconds</span>
										</div>
									</div>
									<div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">You can unwatch this repository immediately by clicking here:
										<a href="#">https://github.com</a>
									</div>
								</div>
								<!--end::Message In-->
								<!--begin::Message Out-->
								<div class="d-flex flex-column mb-5 align-items-end">
									<div class="d-flex align-items-center">
										<div>
											<span class="text-muted font-size-sm">Just now</span>
											<a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">You</a>
										</div>
										<div class="symbol symbol-circle symbol-40 ml-3">
											<img alt="Pic" src="assets/media/users/150-9.jpg" />
										</div>
									</div>
									<div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">Discover what students who viewed Learn Figma - UI/UX Design. Essential Training also viewed</div>
								</div>
								<!--end::Message Out-->
								<!--begin::Message In-->
								<div class="d-flex flex-column mb-5 align-items-start">
									<div class="d-flex align-items-center">
										<div class="symbol symbol-circle symbol-40 mr-3">
											<img alt="Pic" src="assets/media/users/150-2.jpg" />
										</div>
										<div>
											<a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">Matt Pears</a>
											<span class="text-muted font-size-sm">40 seconds</span>
										</div>
									</div>
									<div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">Most purchased Business courses during this sale!</div>
								</div>
								<!--end::Message In-->
								<!--begin::Message Out-->
								<div class="d-flex flex-column mb-5 align-items-end">
									<div class="d-flex align-items-center">
										<div>
											<span class="text-muted font-size-sm">Just now</span>
											<a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">You</a>
										</div>
										<div class="symbol symbol-circle symbol-40 ml-3">
											<img alt="Pic" src="assets/media/users/150-9.jpg" />
										</div>
									</div>
									<div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">Company BBQ to celebrate the last quater achievements and goals. Food and drinks provided</div>
								</div>
								<!--end::Message Out-->
							</div>
							<!--end::Messages-->
						</div>
						<!--end::Scroll-->
					</div>
					<!--end::Body-->
					<!--begin::Footer-->
					<div class="card-footer align-items-center">
						<!--begin::Compose-->
						<textarea class="form-control border-0 p-0" rows="2" placeholder="Type a message"></textarea>
						<div class="d-flex align-items-center justify-content-between mt-5">
							<div class="mr-3">
								<a href="#" class="btn btn-clean btn-icon btn-md mr-1">
									<i class="flaticon2-photograph icon-lg"></i>
								</a>
								<a href="#" class="btn btn-clean btn-icon btn-md">
									<i class="flaticon2-photo-camera icon-lg"></i>
								</a>
							</div>
							<div>
								<button type="button" class="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6">Send</button>
							</div>
						</div>
						<!--begin::Compose-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Card-->
			</div>
		</div>
	</div>
	<!--end::Chat Panel-->
	<!--begin::Scrolltop-->
	<div id="kt_scrolltop" class="scrolltop">
		<span class="svg-icon">
			<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<polygon points="0 0 24 0 24 24 0 24" />
					<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
					<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
				</g>
			</svg>
			<!--end::Svg Icon-->
		</span>
	</div>
	<!--end::Scrolltop-->
	<!--end::Sticky Toolbar-->

	<script>
		var HOST_URL = "https://preview.keenthemes.com/keen/theme/tools/preview";
	</script>
	<!--begin::Global Config(global config for global JS scripts)-->
	<script>
		var KTAppSettings = {
			"breakpoints": {
				"sm": 576,
				"md": 768,
				"lg": 992,
				"xl": 1200,
				"xxl": 1200
			},
			"colors": {
				"theme": {
					"base": {
						"white": "#ffffff",
						"primary": "#0BB783",
						"secondary": "#E5EAEE",
						"success": "#1BC5BD",
						"info": "#8950FC",
						"warning": "#FFA800",
						"danger": "#F64E60",
						"light": "#F3F6F9",
						"dark": "#212121"
					},
					"light": {
						"white": "#ffffff",
						"primary": "#D7F9EF",
						"secondary": "#ECF0F3",
						"success": "#C9F7F5",
						"info": "#EEE5FF",
						"warning": "#FFF4DE",
						"danger": "#FFE2E5",
						"light": "#F3F6F9",
						"dark": "#D6D6E0"
					},
					"inverse": {
						"white": "#ffffff",
						"primary": "#ffffff",
						"secondary": "#212121",
						"success": "#ffffff",
						"info": "#ffffff",
						"warning": "#ffffff",
						"danger": "#ffffff",
						"light": "#464E5F",
						"dark": "#ffffff"
					}
				},
				"gray": {
					"gray-100": "#F3F6F9",
					"gray-200": "#ECF0F3",
					"gray-300": "#E5EAEE",
					"gray-400": "#D6D6E0",
					"gray-500": "#B5B5C3",
					"gray-600": "#80808F",
					"gray-700": "#464E5F",
					"gray-800": "#1B283F",
					"gray-900": "#212121"
				}
			},
			"font-family": "Poppins"
		};
	</script>
	<!--end::Global Config-->
	<!--begin::Global Theme Bundle(used by all pages)-->
	<script src="assets/keen/plugins/global/plugins.bundle.js"></script>
	<script src="assets/keen/plugins/custom/prismjs/prismjs.bundle.js"></script>
	<script src="assets/keen/js/scripts.bundle.js"></script>
	<!--end::Global Theme Bundle-->
	<!--begin::Page Vendors(used by this page)-->
	<script src="assets/keen/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
	<!--end::Page Vendors-->
	<!--begin::Page Scripts(used by this page)-->
	<script src="assets/keen/js/pages/widgets.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="assets/keen/js/pages/features/file-upload/dropzonejs.js"></script>
	<script src="assets/keen/js/pages/features/file-upload/image-input.js"></script>
	<script src="assets/keen/js/pages/features/file-upload/dropzonejs.js"></script>
	<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
	<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
	<script>
	(document).ready(function () {
    $("#flash-msg").delay(3000).fadeOut("slow");
	});
	</script>

	<!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>