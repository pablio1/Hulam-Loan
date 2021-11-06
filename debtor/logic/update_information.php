<?php
session_start();
error_reporting(0);
include('../../db_connection/config.php');

if ($_SESSION['user_type'] != 2) {
    header('location: ../index.php');
}

// $sql = $dbh->prepare("SELECT * FROM user INNER JOIN debtors_info ON user.user_id = debtors_info.user_id WHERE user.user_id = :user_id");
// $sql->execute(['user_id' => $_SESSION['user_id']]);
// $user = $sql->fetch();

if (isset($_POST['submit'])) {
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
    $company_name = $_POST['company_name'];
    $monthly_salary = $_POST['monthly_salary'];
    $company_mobile = $_POST['company_mobile'];
    $company_landline = $_POST['company_landline'];
    $company_email = $_POST['company_email'];
    $company_street = $_POST['company_street'];
    $company_barangay = $_POST['company_barangay'];
    $company_city = $_POST['company_city'];
    $company_province = $_POST['company_province'];
    $company_zipcode = $_POST['company_zipcode'];
    $type_id = $_POST['type_id'];
    $rel_type = $_POST['rel_type'];
    $rel_name = $_POST['rel_name'];
    $rel_mobile = $_POST['rel_mobile'];
    $fileName = $_FILES['proof_id']['name'];
    $image = $_FILES['proof_id']['tmp_name'];

    $fileExt = explode('.', $fileName);
    $ext = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (empty($type_id) || empty($rel_type) || empty($rel_name) || empty($rel_mobile)) {
        header('location: ../update_identity.php?type_id=' . $type_id . '&rel_name=' . $rel_name . '&rel_type=' . $rel_type . '&rel_mobile=' . $rel_mobile . '&company_name=' . $company_name . '&monthly_salary=' . $monthly_salary . '&company_mobile=' . $company_mobile . '&company_email=' . $company_email . '&company_mobile=' . $company_mobile . '&company_landline=' . $company_landline . '&company_street=' . $company_street . '&company_barangay=' . $company_barangay . '&company_city=' . $company_city . '&company_province=' . $company_province . '&company_zipcode=' . $company_zipcode . '&c_street=' . $c_street . '&c_barangay=' . $c_barangay . '&c_city=' . $c_city . '&c_province=' . $c_province . '&c_zipcode=' . $c_zipcode . '&p_street=' . $p_street . '&p_barangay=' . $p_barangay . '&p_city=' . $p_city . '&p_province=' . $p_province . '&p_zipcode=' . $p_zipcode . '&lname=' . $lname . '&fname=' . $fname . '&mname=' . $mname . '&gender=' . $gender . '&b_day=' . $b_day . '&mobile=' . $mobile . '&landline=' . $landline . '&e=Please fill up all the required fields!');
        exit();
    }
    if (!in_array($ext, $allowed)) {
        header('location: ../update_identity.php?type_id=' . $type_id . '&rel_name=' . $rel_name . '&rel_type=' . $rel_type . '&rel_mobile=' . $rel_mobile . '&company_name=' . $company_name . '&monthly_salary=' . $monthly_salary . '&company_mobile=' . $company_mobile . '&company_email=' . $company_email . '&company_mobile=' . $company_mobile . '&company_landline=' . $company_landline . '&company_street=' . $company_street . '&company_barangay=' . $company_barangay . '&company_city=' . $company_city . '&company_province=' . $company_province . '&company_zipcode=' . $company_zipcode . '&c_street=' . $c_street . '&c_barangay=' . $c_barangay . '&c_city=' . $c_city . '&c_province=' . $c_province . '&c_zipcode=' . $c_zipcode . '&p_street=' . $p_street . '&p_barangay=' . $p_barangay . '&p_city=' . $p_city . '&p_province=' . $p_province . '&p_zipcode=' . $p_zipcode . '&lname=' . $lname . '&fname=' . $fname . '&mname=' . $mname . '&gender=' . $gender . '&b_day=' . $b_day . '&mobile=' . $mobile . '&landline=' . $landline . '&e=Please upload a valid image file extension!');
        exit();
    }

    $newFileName = uniqid('', true) . '.' . $ext;

    $dir = '../../assets/img/' . $newFileName;

    move_uploaded_file($image, $dir);

    $sql = $dbh->prepare("UPDATE user SET lastname = :lname, firstname = :fname, middlename = :mname, mobile = :mobile, landline = :landline, gender = :gender, b_day = :b_day, 
    c_street = :c_street, c_barangay = :c_barangay, c_city = :c_city, c_province = :c_province, c_zipcode = :c_zipcode, p_street = :p_street, p_barangay = :p_barangay, 
    p_city = :p_city, p_province = :p_province, p_zipcode = :p_zipcode, relative_type = :rel_type, eligible = 'yes' WHERE user_id = :user_id;");
    $sql->execute([
        'lname' => $lname, 'fname' => $fname, 'mname' => $mname, 'mobile' => $mobile, 'landline' => $landline, 'gender' => $gender, 'b_day' => $b_day,
        'c_street' => $c_street, 'c_barangay' => $c_barangay, 'c_city' => $c_city, 'c_province' => $c_province, 'c_zipcode' => $c_zipcode, 'p_street' => $p_street,
        'p_barangay' => $p_barangay, 'p_city' => $p_city, 'p_province' => $p_province, 'p_zipcode' => $p_zipcode, 'rel_type' => $rel_type, 'user_id' => $_SESSION['user_id']
    ]);

    $user = $dbh->prepare("SELECT * FROM debtors_info WHERE user_id = :user_id");
    $user->execute(['user_id' => $_SESSION['user_id']]);

    if ($user->rowCount() == 0) {
        $insert = $dbh->prepare("INSERT INTO `debtors_info`(`user_id`, `monthly_salary`, `id_type`, `id_image`, `company_name`, `company_mobile`, `company_landline`, `company_email`, 
        `company_street`, `company_barangay`, `company_city`, `company_province`, `company_zipcode`, `relative_name`, `relative_mobile`, `relative_type`) VALUES (:user_id, 
        :monthly_salary, :type_id, :newFileName, :company_name, :company_mobile, :company_landline, :company_email, :company_street, :company_barangay, :company_city, 
        :company_province, :company_zipcode, :relative_name, :relative_mobile, :relative_type)");
        $insert->execute([
            'user_id' => $_SESSION['user_id'], 'monthly_salary' => $monthly_salary, 'type_id' => $type_id, 'newFileName' => $newFileName, 'company_name' => $company_name,
            'company_mobile' => $company_mobile, 'company_landline' => $company_landline, 'company_email' => $company_email, 'company_street' => $company_street,
            'company_barangay' => $company_barangay, 'company_city' => $company_city, 'company_province' => $company_province, 'company_zipcode' => $company_zipcode,
            'relative_name' => $rel_name, 'relative_mobile' => $rel_mobile, 'relative_type' => $rel_type
        ]);
    } else {
        $update = $dbh->prepare("UPDATE debtors_info SET monthly_salary = :monthly_salary, id_type = :type_id, id_image = :newFileName, company_name = :company_name, company_landline = :company_landline, 
        company_email = :company_email, company_street = :company_street, company_barangay = :company_barangay, company_city = :company_city, company_province = :company_province, 
        company_zipcode = :company_zipcode, relative_name = :relative_name, relative_mobile = :relative_mobile, relative_type = :relative_type WHERE user_id = :user_id");
        $update->execute([
            'monthly_salary' => $monthly_salary, 'type_id' => $type_id, 'newFileName' => $newFileName, 'company_name' => $company_name, 'company_landline' => $company_landline, 'company_email' => $company_email,
            'company_street' => $company_street, 'company_barangay' => $company_barangay, 'company_city' => $company_city, 'company_province' => $company_province, 'company_zipcode' => $company_zipcode,
            'relative_name' => $rel_name, 'relative_mobile' => $rel_mobile, 'relative_type' => $rel_type, 'user_id' => $_SESSION['user_id']
        ]);
    }

    $_SESSION['lname'] = $lname;
    $_SESSION['fname'] = $fname;
    $_SESSION['mname'] = $mname;
    $_SESSION['gender'] = $gender;
    $_SESSION['b_day'] = $b_day;
    $_SESSION['mobile'] = $mobile;
    $_SESSION['landline'] = $landline;
    $_SESSION['c_street'] = $c_street;
    $_SESSION['c_barangay'] = $c_barangay;
    $_SESSION['c_city'] = $c_city;
    $_SESSION['c_province'] = $c_province;
    $_SESSION['c_zipcode'] = $c_zipcode;
    $_SESSION['p_street'] = $p_street;
    $_SESSION['p_barangay'] = $p_barangay;
    $_SESSION['p_city'] = $p_city;
    $_SESSION['p_province'] = $p_province;
    $_SESSION['p_zipcode'] = $p_zipcode;
    $_SESSION['company_name'] = $company_name;
    $_SESSION['monthly_salary'] = $monthly_salary;
    $_SESSION['company_mobile'] = $company_mobile;
    $_SESSION['company_landline'] = $company_landline;
    $_SESSION['company_email'] = $company_email;
    $_SESSION['company_street'] = $company_street;
    $_SESSION['company_barangay'] = $company_barangay;
    $_SESSION['company_city'] = $company_city;
    $_SESSION['company_province'] = $company_province;
    $_SESSION['company_zipcode'] = $company_zipcode;
    $_SESSON['eligible'] = 'yes';

    header('location: ../apply_loan.php');
}
