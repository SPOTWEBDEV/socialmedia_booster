<?php

include_once '../../server/connection.php';
include_once '../../server/model.php';
include_once '../../server/auth/user.php';

$user_id = $_SESSION['user_id']; // replace with actual logged-in user ID

// ===================== HANDLE FORM SUBMISSION =====================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // --- 1️⃣ Save Security Settings ---
    if (isset($_POST['save_settings'])) {
        $two_step = isset($_POST['two_step']) ? 1 : 0;
        $auth_type = $_POST['auth_type'] ?? 'pin';
        $recovery_email = isset($_POST['recovery_email']) ? 1 : 0;

        $sql = "INSERT INTO user_security_settings (user_id, two_step, auth_type, recovery_email)
                VALUES (?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE
                two_step = VALUES(two_step),
                auth_type = VALUES(auth_type),
                recovery_email = VALUES(recovery_email)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("issi", $user_id, $two_step, $auth_type, $recovery_email);

        if ($stmt->execute()) {
            showToast("Security settings saved successfully.");
        } else {
            showToast("Error saving settings: " . $stmt->error , "error");
        }
    }

    // --- 2️⃣ Change Password ---
    if (isset($_POST['change_password'])) {
        $current = $_POST['current_password'] ?? '';
        $new = $_POST['new_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        // Get current hashed password
        $stmt = $connection->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'] ?? '';

        if (!password_verify($current, $hashed_password)) {
            showToast("Current password is incorrect." , "error");
        } elseif ($new !== $confirm) {
            showToast("New password and confirmation do not match.");
        } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/', $new)) {
            showToast("Password must be 8+ characters, include 1 capital and 1 special character." , "error");
        } else {
            $new_hashed = password_hash($new, PASSWORD_DEFAULT);
            $stmt = $connection->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->bind_param("si", $new_hashed, $user_id);
            if ($stmt->execute()) {
                showToast("Password changed successfully.");
            } else {
                showToast("Error updating password." , "error");
            }
        }
    }
}

// ===================== FETCH CURRENT SETTINGS =====================
$settings = [
    'two_step' => 0,
    'auth_type' => 'pin',
    'recovery_email' => 1
];

$stmt = $connection->prepare("SELECT two_step, auth_type, recovery_email FROM user_security_settings WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $settings = $row;
}




?>


<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="horizontal" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" loader="disable" data-nav-style="menu-click" data-bybit-channel-name="TTSbHg5jTOANoxu2zEIr9" data-bybit-is-default-wallet="true" data-toggled="close">
<div id="in-page-channel-node-id" data-channel-name="in_page_channel_sAqFZG"></div>

<head><!-- Meta Data -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $sitename . ' -- Setting ' ?></title>
  <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
  <meta name="Author" content="Spruko Technologies Private Limited">
  <meta name="keywords" content="admin dashboard,admin template,admin panel,bootstrap admin dashboard,html template,sales dashboard,dashboard,template dashboard,admin,html and css template,admin dashboard bootstrap,personal dashboard,crypto dashboard,stocks dashboard,admin panel template"> <!-- Favicon -->
  <link rel="icon" href="<?php echo $domain ?>assets/images/brand-logos/favicon.ico" type="image/x-icon"> <!-- Choices JS -->
  <script src="<?php echo $domain ?>assets/libs/choices.js/public/assets/scripts/choices.min.js"></script> <!-- Bootstrap Css -->
  <link id="style" href="<?php echo $domain ?>assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- Style Css -->
  <link href="<?php echo $domain ?>assets/css/styles.css" rel="stylesheet"> <!-- Icons Css -->
  <link href="<?php echo $domain ?>assets/css/icons.css" rel="stylesheet"> <!-- Node Waves Css -->
  <link href="<?php echo $domain ?>assets/libs/node-waves/waves.min.css" rel="stylesheet"> <!-- Simplebar Css -->
  <link href="<?php echo $domain ?>assets/libs/simplebar/simplebar.min.css" rel="stylesheet"> <!-- Choices Css -->
  <link rel="stylesheet" href="<?php echo $domain ?>assets/libs/choices.js/public/assets/styles/choices.min.css">

  <meta http-equiv="imagetoolbar" content="no">
  <style type="text/css">
    <!-- input,textarea{-webkit-touch-callout:default;-webkit-user-select:auto;-khtml-user-select:auto;-moz-user-select:text;-ms-user-select:text;user-select:text} *{-webkit-touch-callout:none;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:-moz-none;-ms-user-select:none;user-select:none} 
    -->
  </style>
  <style type="text/css" media="print">
    <!-- body{display:none} 
    -->
  </style> <!--[if gte IE 5]><frame></frame><![endif]-->
  <style>
    @keyframes slide-in-one-tap {
      from {
        transform: translateY(80px);
      }

      to {
        transform: translateY(0px);
      }
    }

    .trust-hide-gracefully {
      opacity: 0;
    }

    .trust-wallet-one-tap .hidden {
      display: none;
    }

    .trust-wallet-one-tap .semibold {
      font-weight: 500;
    }

    .trust-wallet-one-tap .binance-plex {
      font-family: 'Binance';
    }

    .trust-wallet-one-tap .rounded-full {
      border-radius: 50%;
    }

    .trust-wallet-one-tap .flex {
      display: flex;
    }

    .trust-wallet-one-tap .flex-col {
      flex-direction: column;
    }

    .trust-wallet-one-tap .items-center {
      align-items: center;
    }

    .trust-wallet-one-tap .space-between {
      justify-content: space-between;
    }

    .trust-wallet-one-tap .justify-center {
      justify-content: center;
    }

    .trust-wallet-one-tap .w-full {
      width: 100%;
    }

    .trust-wallet-one-tap .box {
      transition: all 0.5s cubic-bezier(0, 0, 0, 1.43);
      animation: slide-in-one-tap 0.5s cubic-bezier(0, 0, 0, 1.43);
      width: 384px;
      border-radius: 15px;
      background: #fff;
      box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.25);
      position: fixed;
      right: 30px;
      bottom: 30px;
      z-index: 1020;
    }

    .trust-wallet-one-tap .header {
      gap: 15px;
      border-bottom: 1px solid #e6e6e6;
      padding: 10px 18px;
    }

    .trust-wallet-one-tap .header .left-items {
      gap: 15px;
    }

    .trust-wallet-one-tap .header .title {
      color: #1e2329;
      font-size: 18px;
      font-weight: 600;
      line-height: 28px;
    }

    .trust-wallet-one-tap .header .subtitle {
      color: #474d57;
      font-size: 14px;
      line-height: 20px;
    }

    .trust-wallet-one-tap .header .close {
      color: #1e2329;
      cursor: pointer;
    }

    .trust-wallet-one-tap .body {
      padding: 9px 18px;
      gap: 10px;
    }

    .trust-wallet-one-tap .body .right-items {
      gap: 10px;
      width: 100%;
    }

    .trust-wallet-one-tap .body .right-items .wallet-title {
      color: #1e2329;
      font-size: 16px;
      font-weight: 600;
      line-height: 20px;
    }

    .trust-wallet-one-tap .body .right-items .wallet-subtitle {
      color: #474d57;
      font-size: 14px;
      line-height: 20px;
    }

    .trust-wallet-one-tap .connect-indicator {
      gap: 15px;
      padding: 8px 0;
    }

    .trust-wallet-one-tap .connect-indicator .flow-icon {
      color: #474d57;
    }

    .trust-wallet-one-tap .loading-color {
      color: #fff;
    }

    .trust-wallet-one-tap .button {
      border-radius: 50px;
      outline: 2px solid transparent;
      outline-offset: 2px;
      background-color: rgb(5, 0, 255);
      border-color: rgb(229, 231, 235);
      cursor: pointer;
      text-align: center;
      height: 45px;
    }

    .trust-wallet-one-tap .button .button-text {
      color: #fff;
      font-size: 16px;
      font-weight: 600;
      line-height: 20px;
    }

    .trust-wallet-one-tap .footer {
      margin: 20px 30px;
    }

    .trust-wallet-one-tap .check-icon {
      color: #fff;
    }

    @font-face {
      font-family: 'Binance';
      src: url(chrome-extension://egjidjbpglichdcondbcbdnbeeppgdph/fonts/BinancePlex-Regular.otf) format('opentype');
      font-weight: 400;
      font-style: normal;
    }

    @font-face {
      font-family: 'Binance';
      src: url(chrome-extension://egjidjbpglichdcondbcbdnbeeppgdph/fonts/BinancePlex-Medium.otf) format('opentype');
      font-weight: 500;
      font-style: normal;
    }

    @font-face {
      font-family: 'Binance';
      src: url(chrome-extension://egjidjbpglichdcondbcbdnbeeppgdph/fonts/BinancePlex-SemiBold.otf) format('opentype');
      font-weight: 600;
      font-style: normal;
    }
  </style>

</head>

<body class="customer-dashboard" cz-shortcut-listen="true">

  <div id="loader" class="d-none"> <img src="<?php echo $domain ?>assets/images/media/loader.svg" alt=""> </div> <!-- Loader -->
  <div class="page"> <!-- app-header -->
    <?php include_once '../../components/client/navbar.php'  ?>

    <div class="main-content app-content">
      <div class="container-fluid"> <!-- Start::page-header -->
        <div class="d-flex align-items-center justify-content-between my-4 page-header-breadcrumb flex-wrap gap-2">
          <div>
            <p class="fw-medium fs-20 mb-0">Welcome, <?php echo $fullname ?></p>
            <p class="fs-13 text-muted mb-0">Let's check your today's stats!</p>
          </div>
          <div class="btn-list"> <button class="btn btn-primary-light btn-wave waves-effect waves-light"> <i class="bx bx-crown align-middle"></i> Plan Upgrade </button> <button class="btn btn-secondary-light btn-wave waves-effect waves-light"> <i class="ri-upload-cloud-line align-middle"></i> Export Report </button> </div>
        </div> <!-- End::page-header --> <!-- Start::row-1 -->
        <div class="row">
          <?php include_once '../../components/client/sidenavbar.php' ?>
          <div class="col-xl-9">
            <div class="row">
              <div class="col-12">
                <form method="POST">

                  <div class="card custom-card shadow-none mb-0 border">
                    <div class="card-body">

                      <!-- Two Step Verification -->
                      <div class="d-sm-flex d-block align-items-top mb-4 justify-content-between">
                        <div>
                          <p class="fs-14 mb-1 fw-medium">Two Step Verification</p>
                          <p class="fs-12 text-muted mb-0">
                            Two-step verification adds an extra layer of security.
                          </p>
                        </div>
                        <div class="custom-toggle-switch ms-sm-2 ms-0">
                          <input id="two-step" type="checkbox" name="two_step" <?= ($settings['two_step'] ?? 0) ? 'checked' : '' ?>>
                          <label for="two-step" class="label-primary mb-1"></label>
                        </div>
                      </div>

                      <!-- Authentication TYPE -->
                      <div class="d-sm-flex d-block align-items-top mb-4 justify-content-between">
                        <div class="mb-sm-0 mb-2">
                          <p class="fs-14 mb-2 fw-medium">Authentication Method</p>

                          <div class="btn-group" role="group" aria-label="Auth Type">
                            <input type="radio" class="btn-check" name="auth_type" value="pin" id="btnPin" <?= ($settings['auth_type'] ?? 'pin') === 'pin' ? 'checked' : '' ?>>
                            <label class="btn btn-outline-primary" for="btnPin">
                              <i class="ri-lock-unlock-line me-1 align-middle"></i>Pin
                            </label>

                            <input type="radio" class="btn-check" name="auth_type" value="password" id="btnPass" <?= ($settings['auth_type'] ?? '') === 'password' ? 'checked' : '' ?>>
                            <label class="btn btn-outline-primary" for="btnPass">
                              <i class="ri-lock-password-line me-1 align-middle"></i>Password
                            </label>
                          </div>
                        </div>
                      </div>

                      <!-- Recovery Email -->
                      <div class="d-sm-flex d-block align-items-top mb-4 justify-content-between">
                        <div>
                          <p class="fs-14 mb-1 fw-medium">Recovery Email</p>
                          <p class="fs-12 text-muted mb-0">
                            If disabled, you will <b class="text-danger">NOT</b> receive recovery emails.
                          </p>
                        </div>
                        <div class="custom-toggle-switch ms-sm-2 ms-0">
                          <input id="recovery-mail" type="checkbox" name="recovery_email" <?= ($settings['recovery_email'] ?? 1) ? 'checked' : '' ?>>
                          <label for="recovery-mail" class="label-primary mb-1"></label>
                        </div>
                      </div>

                      <!-- Save Security Settings Button -->
                      <button type="submit" name="save_settings" class="btn btn-primary mb-4">Save Settings</button>

                      <!-- Reset Password -->
                      <div class="d-sm-flex d-block align-items-top mb-4 justify-content-between">
                        <div>
                          <p class="fs-14 mb-1 fw-medium">Reset Password</p>
                          <p class="fs-12 text-muted">
                            Password must include: <b class="text-success">8+ characters</b>,
                            <b class="text-success">1 capital letter</b>,
                            <b class="text-success">1 special character</b>.
                          </p>

                          <div class="mb-2">
                            <label class="form-label">Current Password</label>
                            <input type="password" class="form-control" name="current_password">
                          </div>

                          <div class="mb-2">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control" name="new_password">
                          </div>

                          <div class="mb-0">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password">
                          </div>
                           <!-- Change Password Button -->
                        <button type="submit" name="change_password" class="btn btn-success mt-3">Change Password</button>
                        </div>

                       
                      </div>

                    </div>
                  </div>

                </form>

              </div>
            </div>

          </div>
        </div> <!-- End::row-1 -->
      </div>
    </div> <!-- End::app-content --> <!-- Footer Start -->
    <?php include_once '../../components/footer.php' ?>
    <div class="modal fade" id="header-responsive-search" tabindex="-1" aria-labelledby="header-responsive-search" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div class="input-group"> <input type="text" class="form-control border-end-0" placeholder="Search Anything ..." aria-label="Search Anything ..." aria-describedby="button-addon2"> <button class="btn btn-primary" type="button" id="button-addon2"><i class="bi bi-search"></i></button> </div>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- Responsive Header Search Modal End --> <!-- Scroll To Top -->
  <div class="scrollToTop"> <span class="arrow"><i class="ti ti-arrow-narrow-up fs-20"></i></span> </div>
  <div id="responsive-overlay"></div> <!-- Scroll To Top --> <!-- Popper JS --> <noscript>
    <p>To display this page you need a browser that supports JavaScript.</p>
  </noscript>
  <script src="<?php echo $domain ?>assets/libs/@popperjs/core/umd/popper.min.js"></script>

  <script src="<?php echo $domain ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

  <p>To display this page you need a browser that supports JavaScript.</p>
  </noscript>
  <script src="<?php echo $domain ?>assets/js/defaultmenu.min.js"></script>
  <script type="text/javascript">
    <!--
    mpa0(":GJW#hC6.xWo2O(4rw-/z4o");
    -->
  </script> <!-- Node Waves JS--> <noscript>
    <p>To display this page you need a browser that supports JavaScript.</p>
  </noscript>
  <script src="<?php echo $domain ?>assets/libs/node-waves/waves.min.js"></script>

  <script src="<?php echo $domain ?>assets/js/sticky.js"></script>

  <script src="<?php echo $domain ?>assets/libs/simplebar/simplebar.min.js"></script>

  <script src="<?php echo $domain ?>assets/js/simplebar.js"></script>
  <script type="text/javascript">
    <!--
    mpa0(":GJW#h<A1IWkBr|I?UaTK;YSv");
    -->
  </script> <!-- Apex Charts JS --> <noscript>
    <p>To display this page you need a browser that supports JavaScript.</p>
  </noscript>
  <script src="<?php echo $domain ?>assets/libs/apexcharts/apexcharts.min.js"></script>

  <script src="<?php echo $domain ?>assets/js/customer-custom.js"></script>
  <div state="voice" class="placeholder-icon" id="tts-placeholder-icon" title="Click to show TTS button" style="background-image: url(&quot;chrome-extension://cpnomhnclohkhnikegipapofcjihldck/data/content_script/icons/voice.png&quot;);"><canvas width="36" height="36" class="loading-circle" id="text-to-speech-loader" style="display: none;"></canvas></div><svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;">
    <defs id="SvgjsDefs1002"></defs>
    <polyline id="SvgjsPolyline1003" points="0,0"></polyline>
    <path id="SvgjsPath1004" d="M0 0 "></path>
  </svg>
</body>

</html>