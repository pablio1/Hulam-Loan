<?php
session_start();
error_reporting(-1);
include('../db_connection/config.php');
?>


<?php 
    if ($_GET['Action'] == "pay") {
        $loan_app_id =  $_POST['loan_app_id'];//ntval($_GET['loan_app_id']);
        $lender_id = $_POST['lender_id'];
        $debtor_id = $_POST['debtor_id'];
        // $debtor_id = $_POST['debtor_id'];
        $remaining_balance = $_POST['remaining_balance'];
        $payment = $_POST['payment'];
        $payId = $_POST['payId'];
        $paymentType = $_POST['paymentType'];
        $monthlyPaymentLoan = $_POST['monthlyPaymentLoan'];
        //echo $loan_app_id;
        
        //echo "<script>alert('$idsDueDt')</script>";
    
        $remain = $remaining_balance- $payment;
        $monthly_pay = $_POST['monthly_pay'];
        $date_paid = date("Y-m-d h:i:s",strtotime($_POST['date_paid']));
        $date_message = $_POST['date_message'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $message = 'Your payment for loan account number'.' '. $loan_app_id.' '. 'is now posted. Thank You!';
        $noPasDue =  $_POST['no_pas_due'];
        $pasDueIds = $_POST['pasDueIds'];
        $amount = $_POST['amount'];
        $lateCharges = $_POST['lateCharges'];
    
        $query = $dbh->prepare('SELECT * FROM running_balance WHERE  loan_app_id = :loadId');
        $query->bindParam(':loadId',$loan_app_id);
        $query->execute();
        $loanAppDetailsInfo = $query->fetch();

        //$query->execute();
    
        $sql = $dbh->prepare('SELECT * FROM loan_application WHERE  loan_app_id = :lappId');
        $sql->execute(['lappId' => $loan_app_id]);
        $loanAppDetails = $sql->fetch();	
    
        $sql = $dbh->prepare('SELECT * FROM loan_payment_detail WHERE  lp_Id = :lappId');
        $sql->execute(['lappId' => $payId]);
        $loanPayDetails = $sql->fetch();
    
        
        $lateCharge = 0;

        $passDueId =  explode("-",$pasDueIds); 

        $NewAmount = $loanAppDetailsInfo['remaining_balance'];
        
        if ($noPasDue ==0)
        {
            if ($paymentType == 'semi')
            {
                if ($loanPayDetails['status'] == 0)
                {
                    $NewAmount =  $NewAmount - $amount;

                    $sql = "UPDATE loan_payment_detail SET payment='$amount', semi_payment1 ='$amount',  paid_date='$date_paid', late_charge=0 , `status`=-1  WHERE lp_Id = $payId";
                    $query = $dbh->prepare($sql);
                    $query->execute();

                    //echo $NewAmount;
                }
                if ($loanPayDetails['status'] == -1)
                {
                    if ($monthlyPaymentLoan == ($amount * 2))
                    {
                        $NewAmount =  $NewAmount - $amount;

                        $nAmount = $amount * 2;
                        $sql = "UPDATE loan_payment_detail SET payment='$nAmount',semi_payment1 ='$amount', semi_payment2 ='$amount',  paid_date='$date_paid', late_charge=0 , `status`=1  WHERE lp_Id = $payId";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                    }
                    else
                    {
                        

                        $late_charge = $amount - ($monthlyPaymentLoan / 2);
                        $amountPaid = $monthlyPaymentLoan / 2;
                        $sql = "UPDATE loan_payment_detail SET payment='$monthlyPaymentLoan',semi_payment2 ='$amountPaid',  paid_date='$date_paid', late_charge='$late_charge' , `status`=1  WHERE lp_Id = $payId";
                        $query = $dbh->prepare($sql);
                        $query->execute();

                        $NewAmount =  $NewAmount - $amountPaid;
                    }
                }
                //echo $NewAmount;
            }
            else
            {
                if ($monthlyPaymentLoan == $amount)
                {
                    $sql = "UPDATE loan_payment_detail SET payment='$monthlyPaymentLoan', paid_date='$date_paid', late_charge=0 , `status`=1  WHERE lp_Id = $payId";
                    $query = $dbh->prepare($sql);
                    $query->execute();

                    $NewAmount =  $NewAmount - $amount;
                }
                else
                {
                    $late_charge = $amount - $monthlyPaymentLoan;
                    $sql = "UPDATE loan_payment_detail SET payment='$monthlyPaymentLoan', paid_date='$date_paid', late_charge=$late_charge , `status`=1  WHERE lp_Id = $payId";
                    $query = $dbh->prepare($sql);
                    $query->execute();

                    $NewAmount =  $NewAmount - $amount;
                }
                //echo $NewAmount;
            }

            //$sql = "UPDATE  running_balance SET remaining_balance='$NewAmount' WHERE loan_app_id = $loan_app_id";
            //$query = $dbh->prepare($sql);
            //$query->execute();
        }
        else
        {
            $lateChargePercent = $loanAppDetails['late_charges'];
            $lateCharge = ($lateChargePercent / 100) * $monthlyPaymentLoan;

            foreach ($passDueId as $idsDueDt)
            {
                if ($idsDueDt != "")
                {
                    $sql = "SELECT * from  loan_payment_detail WHERE lp_Id = $idsDueDt";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $loanDtl = $query->fetch();
                    //echo "status ".$loanDtl['status'];
                    if ($loanDtl['status'] == -1)
                    {
                       // echo "status ".$loanDtl['status'];
                        
                        $halfAmt = $monthlyPaymentLoan / 2;
                        $sql = "UPDATE loan_payment_detail SET payment='$monthlyPaymentLoan', paid_date='$date_paid',semi_payment2 ='$halfAmt', late_charge=$lateCharge, `status`=1  WHERE lp_Id = $idsDueDt";
                        $query = $dbh->prepare($sql);
                        $query->execute();

                        $amount = $amount - $lateCharge;
                        $amount = $amount - $halfAmt;

                        $NewAmount =  $NewAmount - $halfAmt;

                        //echo $NewAmount;
                    }
                    else
                    {
                        $sql = "UPDATE loan_payment_detail SET payment='$monthlyPaymentLoan', paid_date='$date_paid', late_charge=$lateCharge, `status`=1  WHERE lp_Id = $idsDueDt";
                        $query = $dbh->prepare($sql);
                        $query->execute();

                        $amount = $amount - $lateCharge;
                        $amount = $amount - $monthlyPaymentLoan;

                        $NewAmount = $NewAmount - $monthlyPaymentLoan;

                        //echo $NewAmount;
                    }
                }

            }

            $sql = "UPDATE loan_payment_detail SET payment='$monthlyPaymentLoan', paid_date='$date_paid', late_charge=0, `status`=1  WHERE lp_Id = $payId";
            $query = $dbh->prepare($sql);
            $query->execute();

            //$amount = $amount - $lateCharge;
            //$amount = $amount - $monthlyPaymentLoan;

            //$NewAmount =  $loanAppDetailsInfo['remaining_balance'] - $monthlyPaymentLoan;



        }
        //$remBalance =  $loanAppDetailsInfo['remaining_balance'] - $amount;
        
        $sql = "UPDATE  running_balance SET remaining_balance='$NewAmount' WHERE loan_app_id = $loan_app_id";
        $query = $dbh->prepare($sql);
        $query->execute();
    
        echo '1';
    
        // $sql = "INSERT INTO payment(loan_app_id,debtor_id,lender_id,amount_paid,date_paid)
        // VALUES(:loan_app_id,:debtor_id,:lender_id,:amount_paid,:date_paid)";
        // $query = $dbh->prepare($sql);
        // $query->bindParam(':loan_app_id', $loan_app_id, PDO::PARAM_STR);
        // $query->bindParam(':debtor_id', $debtor_id, PDO::PARAM_STR);
        // $query->bindParam(':lender_id', $lender_id, PDO::PARAM_STR);
        // $query->bindParam(':amount_paid', $amount_paid, PDO::PARAM_STR);
        // $query->bindParam(':date_paid', $date_paid, PDO::PARAM_STR);
    
        /*
        $sql ="INSERT INTO message(sender_id,receiver_id,message,date_message)VALUES('$lender_id','$debtor_id','$message','$date_message')";
        $query = $dbh->prepare($sql);
        $query->execute();
    
        

        /*
        if ($query->execute()) {
            $_SESSION['status_payment'] = "Submitted Successfully!";
            header("Location: record_payment.php?loan_app_id=$loan_app_id");
            exit();
        } else {
            $_SESSION['status_payment'] = "Error!";
            header('Location: record_payment.php?loan_app_id=$loan_app_id');
            exit();
        }
        */
    }

    if ($_GET['Action'] == "GetDueDateById") {
        $id = $_GET['Id'];

        $query = $dbh->prepare("SELECT * FROM loan_payment_detail WHERE lp_Id = $id");
        $query->execute();
        $loanPaymentSelected = $query->fetch();
    
        $currentPaymentMonth = $loanPaymentSelected['due_date'];

        echo $currentPaymentMonth;
    }
    

?>