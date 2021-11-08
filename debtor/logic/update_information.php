<?php
session_start();
error_reporting(-1);
include('../../db_connection/config.php');

if ($_SESSION['user_type'] != 2) {
    header('location: ../index.php');
}?>


<?php
if(isset($_POST['submit'])){

    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $gender = $_POST['gender'];
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
    $monthly_salary = $_POST['monthly_salary'];
    $company_name = $_POST['company_name'];
    $company_mobile = $_POST['company_mobile'];
    $company_landline = $_POST['company_landline'];
    $company_email = $_POST['company_email'];
    $company_street = $_POST['company_street'];
    $company_barangay = $_POST['company_barangay'];
    $company_city = $_POST['company_city'];
    $company_province = $_POST['company_province'];
    $company_zipcode = $_POST['company_zipcode'];
    $rel_name = $_POST['rel_name'];
    $rel_mobile = $_POST['rel_mobile'];
    $rel_type = $_POST['rel_type'];
    $user_id = $_SESSION['user_id'];

    // profile_pic
	$images2 =$_FILES['profile_pic']['name'];
	$tmp_dir = $_FILES['profile_pic']['tmp_name'];
	$imageSize=$_FILES['profile_pic']['size'];

	$upload_dir2='../../assets/keen/debtors/';
	$imgExt=strtolower(pathinfo($images2,PATHINFO_EXTENSION));
	$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
	$pic2=rand(1000,10000000).".".$imgExt;
	move_uploaded_file($tmp_dir,$upload_dir2.$pic2);


    $sql = "UPDATE user SET lastname = :lname, firstname = :fname, middlename = :mname, mobile = :mobile, landline = :landline, gender = :gender, b_day = :b_day, 
    c_street = :c_street, c_barangay = :c_barangay, c_city = :c_city, c_province = :c_province, c_zipcode = :c_zipcode, p_street = :p_street, p_barangay = :p_barangay, 
    p_city = :p_city, p_province = :p_province, p_zipcode = :p_zipcode, profile_pic =:profile_pic WHERE user_id = :user_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':lname',$lname,PDO::PARAM_STR);
    $query->bindParam(':fname',$fname,PDO::PARAM_STR);
    $query->bindParam(':mname',$mname,PDO::PARAM_STR);
    $query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
    $query->bindParam(':landline',$landline,PDO::PARAM_STR);
    $query->bindParam(':gender',$gender,PDO::PARAM_STR);
    $query->bindParam(':b_day',$b_day,PDO::PARAM_STR);
    $query->bindParam(':c_street',$c_street,PDO::PARAM_STR);
    $query->bindParam(':c_barangay',$c_barangay,PDO::PARAM_STR);
    $query->bindParam(':c_city',$c_city,PDO::PARAM_STR);
    $query->bindParam(':c_province',$c_province,PDO::PARAM_STR);
    $query->bindParam(':c_zipcode',$c_zipcode,PDO::PARAM_STR);
    $query->bindParam(':p_street',$p_street,PDO::PARAM_STR);
    $query->bindParam(':p_barangay',$p_barangay,PDO::PARAM_STR);
    $query->bindParam(':p_city',$p_city,PDO::PARAM_STR);
    $query->bindParam(':p_province',$p_province,PDO::PARAM_STR);
    $query->bindParam(':p_zipcode',$p_zipcode,PDO::PARAM_STR);
    $query->bindParam(':profile_pic',$pic2,PDO::PARAM_STR);
    $query->bindParam(':user_id',$user_id,PDO::PARAM_STR);
    $query->execute();

    $sql2 = "SELECT * FROM debtors_info WHERE user_id = $user_id";
    $query2 = $dbh->prepare($sql2);
    $query2->execute();

      // valid_id
	$images =$_FILES['valid_id']['name'];
	$tmp_dir = $_FILES['valid_id']['tmp_name'];
	$imageSize=$_FILES['valid_id']['size'];

	$upload_dir='../../assets/keen/debtors/';
	$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
	$valid_extensions=array('jpeg','jpg','gif','pdf','doc','docx');
	$pic=rand(1000,10000000).".".$imgExt;
	move_uploaded_file($tmp_dir,$upload_dir.$pic);

    if($query2->rowCount()==0){
        $sql3 = "INSERT INTO `debtors_info`(`user_id`, `monthly_salary`, `company_name`, `company_mobile`, `company_landline`, `company_email`, `company_street`, `company_barangay`, `company_city`, `company_province`, `company_zipcode`, `rel_name`, `rel_mobile`, `rel_type`, `valid_id`) 
        VALUES (:user_id,:monthly_salary,:company_name,:company_mobile,:company_landline,:company_email,
        :company_street,:company_barangay,:company_city,:company_province,:company_zipcode,:rel_name,:rel_mobile,:rel_type,:valid_id)";
        $query3 = $dbh->prepare($sql3);
        $query3->bindParam(':user_id',$user_id,PDO::PARAM_STR);
        $query3->bindParam(':monthly_salary',$monthly_salary,PDO::PARAM_STR);
        $query3->bindParam(':company_name',$company_name,PDO::PARAM_STR);
        $query3->bindParam(':company_mobile',$company_mobile,PDO::PARAM_STR);
        $query3->bindParam(':company_landline',$company_landline,PDO::PARAM_STR);
        $query3->bindParam(':company_email',$company_email,PDO::PARAM_STR);
        $query3->bindParam(':company_street',$company_street,PDO::PARAM_STR);
        $query3->bindParam(':company_barangay',$company_barangay,PDO::PARAM_STR);
        $query3->bindParam(':company_city',$company_city,PDO::PARAM_STR);
        $query3->bindParam(':company_province',$company_province,PDO::PARAM_STR);
        $query3->bindParam(':company_zipcode',$company_zipcode,PDO::PARAM_STR);
        $query3->bindParam(':rel_name',$rel_name,PDO::PARAM_STR);
        $query3->bindParam(':rel_mobile',$rel_mobile,PDO::PARAM_STR);
        $query3->bindParam(':rel_type',$rel_type,PDO::PARAM_STR);
        $query3->bindParam(':valid_id',$pic,PDO::PARAM_STR);
        $query3->execute();
     }else{
         $sql4 = "UPDATE debtors_info SET monthly_salary=:monthly_salary,company_name=:company_name,company_mobile=:company_mobile,company_landline=:company_landline,
         company_email=:company_email,company_street=:company_street,company_barangay=:company_barangay,company_city=:company_city,company_province=:company_province,
         company_zipcode=:company_zipcode,rel_name=:rel_name,rel_mobile=:rel_mobile,rel_type=:rel_type,valid_id=:valid_id WHERE user_id =:user_id";
          $query4 = $dbh->prepare($sql4);
          $query4->bindParam(':user_id',$user_id,PDO::PARAM_STR);
          $query4->bindParam(':monthly_salary',$monthly_salary,PDO::PARAM_STR);
          $query4->bindParam(':company_name',$company_name,PDO::PARAM_STR);
          $query4->bindParam(':company_mobile',$company_mobile,PDO::PARAM_STR);
          $query4->bindParam(':company_landline',$company_landline,PDO::PARAM_STR);
          $query4->bindParam(':company_email',$company_email,PDO::PARAM_STR);
          $query4->bindParam(':company_street',$company_street,PDO::PARAM_STR);
          $query4->bindParam(':company_barangay',$company_barangay,PDO::PARAM_STR);
          $query4->bindParam(':company_city',$company_city,PDO::PARAM_STR);
          $query4->bindParam(':company_province',$company_province,PDO::PARAM_STR);
          $query4->bindParam(':company_zipcode',$company_zipcode,PDO::PARAM_STR);
          $query4->bindParam(':rel_name',$rel_name,PDO::PARAM_STR);
          $query4->bindParam(':rel_mobile',$rel_mobile,PDO::PARAM_STR);
          $query4->bindParam(':rel_type',$rel_type,PDO::PARAM_STR);
          $query4->bindParam(':valid_id',$pic,PDO::PARAM_STR);
          $query4->execute();
     }
     if($query->execute()){
         $_SESSION['status']= 'Updated Successfully';
         header("Location: ../update_information.php");
         exit();
    }else{
        $_SESSION[]="Error! Unable to Update!";
        header("Location: ../update_information.php");
        exit();
    }
}?>