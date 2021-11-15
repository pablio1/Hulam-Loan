<?php
session_start();
error_reporting(-1);
include('../db_connection/config.php');

if ($_SESSION['user_type'] != 2) {
    header('location: ../index.php');
}

?>

<?php
if (isset($_POST['send_message'])) {

    $from = $_POST['sender_id'];
    $to = $_POST['receiver_id'];
    $date_message = $_POST['date_message'];
    $message = $_POST['message'];

    $insert = "INSERT INTO message(sender_id,receiver_id,message,date_message)VALUES(:sender_id,:receiver_id,:message,:date_message)";
    $query = $dbh->prepare($insert);
    $query->bindParam(':sender_id', $from, PDO::PARAM_STR);
    $query->bindParam(':receiver_id', $to, PDO::PARAM_STR);
    $query->bindParam(':message', $message, PDO::PARAM_STR);
    $query->bindParam(':date_message', $date_message, PDO::PARAM_STR);
    if ($query->execute()) {
        $_SESSION['status_message'] = "Message Sent";
        header("Location: messages.php?sender_id=$to");
        exit();
    } else {
        $_SESSION['status_message'] = "Message Not Sent";
        header('Location: messages.php?sender_id=$to');
        exit();
    }
}
?>


<!DOCTYPE html>
<!--
Template Name: Keen - The Ultimate Bootstrap 4 HTML Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://themes.getbootstrap.com/product/keen-the-ultimate-bootstrap-admin-theme/
Support: https://keenthemes.com/theme-support
License: You must have a valid license purchased only from themes.getbootstrap.com(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../">
    <meta charset="utf-8" />
    <title>Loan Information</title>
    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="assets/keen/css/pages/wizard/wizard-2.css" rel="stylesheet" type="text/css" />
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

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">
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
        <!--begin::Page-->

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
                    <a href="debtor/apply_now.php" class="nav-item">
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
                    <a href="debtor/loan_information.php" class="nav-item active">
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
            <!--end::Topbar-->
        </div>
        <!--end::Subheader-->

        <!--begin::Content-->
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="background-image:url('assets/keen/media/logos/banner.png')">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="card card-custom gutter-b card-stretch">
                        <div class="card-header border-0 pt-6">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder font-size-h4 text-dark-75">Messages</span>
                            </h3>
                            <div class="col-xl-4">
                                <?php
                                if (isset($_SESSION['status_message'])) {
                                ?>
                                    <div class="alert alert-custom alert-notice alert-light-success fade show" role="alert">
                                        <div class="alert-text">
                                            <h4><?php echo $_SESSION['status_message']; ?></h4>
                                        </div>
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    </div>
                                <?php unset($_SESSION['status_message']);
                                } ?>
                            </div>
                        </div>

                        <!--begin::Card-->
                        <div class="card card-custom">
                            <!--begin::Header-->
                            <div class="card-header align-items-center px-4 py-3">
                                <div class="text-center flex-grow-1">
                                    <div class="text-dark-75 font-weight-bold font-size-h5">
                                        <?php
                                        $user_id = $_SESSION['user_id'];
                                        $sender_id = intval($_GET['sender_id']);

                                        $sql = "SELECT * FROM message INNER JOIN user ON message.sender_id = user.user_id WHERE message.receiver_id = $user_id AND message.sender_id = $sender_id ORDER BY date_message desc";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $res = $query->fetch();
                                        $red = $res['user_type'];
                                        ?>
                                        <?php
                                        if ($red == 1 || $red == 2 || $red == 4) : ?>
                                            <?= $res['firstname'] . '' . $res['middlename'] . ' ' . $res['lastname'] ?>
                                        <?php else : ?>
                                            <?= $res['company_name']; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="scroll scroll-pull" data-height="375" data-mobile-height="300">
                                    <div class="messages">

                                        <div class="d-flex flex-column mb-5 align-items-start">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-circle symbol-40 mr-3">
                                                    <!-- <img alt="Pic" src="/hulam/assets/keen/company_logo/<?= htmlentities($res->company_logo) ?>" /> -->
                                                </div>
                                                <div>
                                                    <span class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">
                                                        <?php
                                                        $user_id = $_SESSION['user_id'];
                                                        $sender_id = intval($_GET['sender_id']);

                                                        $sql = "SELECT * FROM message INNER JOIN user ON message.sender_id = user.user_id WHERE message.receiver_id = $user_id AND message.sender_id = $sender_id ORDER BY date_message desc";
                                                        $query = $dbh->prepare($sql);
                                                        $query->execute();
                                                        $res = $query->fetch();

                                                        $rem = $res['user_type'];
                                                        ?>
                                                        <?php
                                                        if ($rem == 1 || $rem == 2 || $rem == 4) : ?>
                                                            <?= $res['firstname'] . '' . $res['middlename'] . ' ' . $res['lastname'] ?>

                                                        <?php else : ?>
                                                            <?= $res['company_name']; ?>
                                                        <?php endif; ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <?php
                                            $user_id = $_SESSION['user_id'];
                                            $sender_id = intval($_GET['sender_id']);

                                            $sql = "SELECT * FROM message INNER JOIN user ON message.sender_id = user.user_id WHERE message.receiver_id = $user_id AND message.sender_id = $sender_id ORDER BY date_message asc";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $r = $query->fetchAll();
                                            foreach ($r as $red) :
                                            ?>
                                                <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px"><?= $red['message'] ?></div>
                                                <span class="text-muted font-size-sm"><?= date('F-d Y h:i:sa', strtotime($red['date_message'])) ?></span>
                                            <?php endforeach; ?>
                                        </div>

                                        <div class="d-flex flex-column mb-5 align-items-end">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6"><?= $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] ?></a>
                                                </div>
                                                <div class="symbol symbol-circle symbol-40 ml-3">
                                                </div>
                                            </div>
                                            <?php
                                            $user_id = $_SESSION['user_id'];
                                            $sender_id = intval($_GET['sender_id']);

                                            $sql = "SELECT * FROM message INNER JOIN user ON message.receiver_id = user.user_id WHERE message.sender_id = $user_id AND message.receiver_id = $sender_id ORDER BY date_message asc";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $r = $query->fetchAll();
                                            foreach ($r as $my_message) :
                                            ?>
                                                <div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px"><?= $my_message['message'] ?></div>
                                                <span class="text-muted font-size-sm"><?= date('F-d Y h:i:sa', strtotime($red['date_message'])) ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="" method="post">
                            <div class="card-footer align-items-center">
                                <textarea name="message" class="form-control border-0 p-0" rows="2" placeholder="Type a message"></textarea>
                                <div class="d-flex align-items-center justify-content-between mt-5">
                                    <div class="mr-3">
                                    </div>
                                    <div>
                                    <?php
                                        date_default_timezone_set('Asia/Manila');
                                        $todays_date = date("y-m-d h:i:sa");
                                        $today = strtotime($todays_date);
                                        $det = date("Y-m-d h:i:sa", $today);

                                        ?>
                                        <input type="hidden" name="date_message" value="<?= $det; ?>">
                                        <input type="hidden" name="sender_id" value="<?= $_SESSION['user_id']?>">
                                        <input type="hidden" name="receiver_id" value="<?= intval($_GET['sender_id'])?>">
                                        <button type="submit" name="send_message" class="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6">Send</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--end::Content-->
    <!--begin::Footer-->
    <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">

    </div>
    </div>
    <!--end::Entry-->
    </div>
    <!--end::Content-->
    <!--begin::Footer-->
    <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
        <!--begin::Container-->
        <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
            <!--begin::Copyright-->
            <div class="text-dark order-2 order-md-1">
                <span class="text-muted font-weight-bold mr-2">2021©</span>
                <a href="http://keenthemes.com/keen" target="_blank" class="text-dark-75 text-hover-primary">The Hulam Team</a>
            </div>
            <div class="nav nav-dark order-1 order-md-2">
                <a href="http://keenthemes.com/keen" target="_blank" class="nav-link pr-3 pl-0">About</a>
                <a href="http://keenthemes.com/keen" target="_blank" class="nav-link px-3">Team</a>
                <a href="http://keenthemes.com/keen" target="_blank" class="nav-link pl-3 pr-0">Contact</a>
            </div>
        </div>
    </div>
    <!--end::Footer-->
    </div>
    <!--end::Wrapper-->
    </div>
    <!--end::Page-->
    </div>
    <!--end::Main-->
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
								<span class="navi-text text-muted text-hover-primary"><?= $_SESSION['email']?>/span>
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
				<a href="debtor/update_information.php" class="navi-item">
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
    <!--begin::Chat Panel-->
    <div class="modal modal-body modal-sticky modal-sticky-bottom-right" id="chat_modal" role="dialog" data-backdrop="false">
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
                                    </span>
                                </button>
                            </div>
                        </div>

                        <div class="text-center flex-grow-1">
                            <div class="text-dark-75 font-weight-bold font-size-h5">
                                <?php


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
                                    <!-- COmpany -->
                                <!--begin::Message In-->
                                <div class="d-flex flex-column mb-5 align-items-start">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-40 mr-3">
                                            <!-- <img alt="Pic" src="/hulam/assets/keen/company_logo/<?= htmlentities($res->company_logo) ?>" /> -->
                                        </div>
                                        <div>
                                            <span class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">
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
                                            </span>
                                            <!-- <span class="text-muted font-size-sm">2 Hours</span> -->
                                        </div>
                                    </div>
                                    <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px"><?= htmlentities($res->message) ?></div>
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
                                            <img alt="Pic" src="assets/keen/media/users/150-9.jpg" />
                                        </div>
                                    </div>
                                    <div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">Hey there, we’re just writing to let you know that you’ve been subscribed to a repository on GitHub.</div>
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
    <!--begin::Demo Panel-->
    <div id="kt_demo_panel" class="offcanvas offcanvas-right p-10">

    </div>
    <!--end::Demo Panel-->
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
    <!--begin::Page Scripts(used by this page)-->
    <script src="assets/keen/js/pages/custom/wizard/wizard-2.js"></script>
    <!--begin::Page Scripts(used by this page)-->
    <script src="assets/keen/js/pages/features/file-upload/image-input.js"></script>
    <script src="assets/keen/js/pages/features/file-upload/dropzonejs.js"></script>
    <!--begin::Page Scripts(used by this page)-->
    <script src="assets/keen/js/pages/features/ktdatatable/base/data-local.js"></script>
    <!--end::Page Scripts-->
    <script type="text/javascript">
        $("#submit").click(function() {
            var sender_id = $("#sender_id").val();
            var debtor_id = $("#debtor_id").val();
            var message_id = "You Have Entered " +
                "Name: " + sender_id +
                " and Marks: " + message_id;
            $("#modal_body").html(str);
        });
    </script>

</body>
<!--end::Body-->

</html>