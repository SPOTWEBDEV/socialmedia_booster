<?php
include_once '../../server/connection.php';
include_once '../../server/model.php';
include_once '../../mailer/index.php';

$step = isset($_GET['step']) ? $_GET['step'] : 1;
$toast = "";

/*
|--------------------------------------------------------------------------
| STEP 1 — SEND OTP
|--------------------------------------------------------------------------
*/
if (isset($_POST['send_otp'])) {

    $email = trim(mysqli_real_escape_string($connection, $_POST['email']));

    if (empty($email)) {
        $toast = "Please enter your email address.";
    } else {

        $stmt = $connection->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            $otp = rand(1000, 9999);
            $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

            $update = $connection->prepare("UPDATE users SET otp=?, otp_expiry=? WHERE email=?");
            $update->bind_param("sss", $otp, $expiry, $email);
            $update->execute();

            $_SESSION['reset_email'] = $email;

            // Send Email
            $subject = "Your OTP Code";
            $message = "Your OTP is: $otp (valid for 5 minutes)";
            

            $otp_result = smtpmailer($email, $subject, $message);

           


            if($otp_result) {
                $toast = "OTP sent successfully!";
            } else {
                $toast = "Failed to send OTP. Please try again.";
            }

          
            
            echo showToast($toast);

            echo "<script>
                setTimeout(function(){
                    window.location.href='?step=2';
                }, 1000);
            </script>";

            exit();

        } else {
            $toast = "This email is not registered!";
        }
    }
}


/*
|--------------------------------------------------------------------------
| STEP 2 — VERIFY OTP
|--------------------------------------------------------------------------
*/
if (isset($_POST['verify_otp'])) {

    

    $otp1 = trim($_POST['otp1']);
    $otp2 = trim($_POST['otp2']);
    $otp3 = trim($_POST['otp3']);
    $otp4 = trim($_POST['otp4']);

    $entered_otp = $otp1 . $otp2 . $otp3 . $otp4;



    if (empty($entered_otp)) {
        $toast = "Please enter the OTP.";
    } else {

        if (!isset($_SESSION['reset_email'])) {
            $toast = "Session expired. Try again.";
        } else {

            $email = $_SESSION['reset_email'];

            $stmt = $connection->prepare("SELECT otp, otp_expiry FROM users WHERE email=?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();

            if ($result) {

                if ($entered_otp == $result['otp']) {

                    if (strtotime($result['otp_expiry']) > time()) {

                        $toast = "OTP verified successfully!";
                        echo showToast($toast);

                        echo "<script>
                            setTimeout(function(){
                                window.location.href='?step=3';
                            }, 1000);
                        </script>";

                        exit();

                    } else {
                        $toast = "OTP has expired!";
                    }

                } else {
                    $toast = "Invalid OTP!";
                }

            } else {
                $toast = "Something went wrong!";
            }
        }
    }
}


/*
|--------------------------------------------------------------------------
| STEP 3 — CHANGE PASSWORD
|--------------------------------------------------------------------------
*/
if (isset($_POST['change_password'])) {

    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm_password']);

    if (empty($password) || empty($confirm)) {
        $toast = "Please fill all fields.";
    } 
    else if ($password !== $confirm) {
        $toast = "Passwords do not match!";
    } 
    else {

        if (!isset($_SESSION['reset_email'])) {
            $toast = "Session expired. Try again.";
        } else {

            $email = $_SESSION['reset_email'];

            $hashed = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $connection->prepare("UPDATE users SET password=?, otp=NULL, otp_expiry=NULL WHERE email=?");
            $stmt->bind_param("ss", $hashed, $email);
            $stmt->execute();

            session_destroy();

            $toast = "Password updated successfully!";

            echo showToast($toast);

            echo "<script>
                setTimeout(function(){
                    window.location.href='../login/';
                }, 1000);
            </script>";

            exit();
        }
    }
}


/*
|--------------------------------------------------------------------------
| SHOW TOAST (LIKE REGISTER PAGE)
|--------------------------------------------------------------------------
*/
if (!empty($toast)) {
    echo showToast($toast);
}
?>




<!DOCTYPE html>
<html
  lang="en"
  dir="ltr"
  data-nav-layout="vertical"
  data-vertical-style="overlay"
  data-theme-mode="light"
  data-header-styles="light"
  data-menu-styles="light"
  data-toggled="close"
  data-bybit-channel-name="7QcnNNU78yOot465zy9oD"
  data-bybit-is-default-wallet="true">

<head>
  <!-- Meta Data -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title><?php echo $sitename ?></title>
  <meta
    name="Description"
    content="Bootstrap Responsive Admin Web Dashboard HTML5 Template" />
  <meta name="Author" content="Spruko Technologies Private Limited" />
  <meta
    name="keywords"
    content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit." />
  <!-- Favicon -->
  <link
    rel="icon"
    href="<?php echo $domain ?>assets/images/brand-logos/favicon.ico"
    type="image/x-icon" />
  <!-- Main Theme Js -->
  <script src="<?php echo $domain ?>assets/js/authentication-main.js"></script>
  <!-- Bootstrap Css -->
  <link
    id="style"
    href="<?php echo $domain ?>assets/libs/bootstrap/css/bootstrap.min.css"
    rel="stylesheet" />
  <!-- Style Css -->
  <link href="<?php echo $domain ?>assets/css/styles.css" rel="stylesheet" />
  <!-- Icons Css -->
  <link href="<?php echo $domain ?>assets/css/icons.css" rel="stylesheet" />

  <meta http-equiv="imagetoolbar" content="no" />
  <style type="text/css">
    <!-- input,textarea{-webkit-touch-callout:default;-webkit-user-select:auto;-khtml-user-select:auto;-moz-user-select:text;-ms-user-select:text;user-select:text} *{-webkit-touch-callout:none;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:-moz-none;-ms-user-select:none;user-select:none} 
    -->
  </style>
  <style type="text/css" media="print">
    <!-- body{display:none} 
    -->
  </style>
  <!--[if gte IE 5]><frame></frame><![endif]-->
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
      font-family: "Binance";
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
      font-family: "Binance";
      src: url(chrome-extension://egjidjbpglichdcondbcbdnbeeppgdph/fonts/BinancePlex-Regular.otf) format("opentype");
      font-weight: 400;
      font-style: normal;
    }

    @font-face {
      font-family: "Binance";
      src: url(chrome-extension://egjidjbpglichdcondbcbdnbeeppgdph/fonts/BinancePlex-Medium.otf) format("opentype");
      font-weight: 500;
      font-style: normal;
    }

    @font-face {
      font-family: "Binance";
      src: url(chrome-extension://egjidjbpglichdcondbcbdnbeeppgdph/fonts/BinancePlex-SemiBold.otf) format("opentype");
      font-weight: 600;
      font-style: normal;
    }
  </style>
</head>

<body class="authentication-background" cz-shortcut-listen="true">

  <div class="container-lg">
    <div
      class="row justify-content-center align-items-center authentication authentication-basic h-100">
      <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
        <div class="card custom-card my-4">
          <?php

          ?>
          <div class="card-body p-5">
            <div class="mb-3 d-flex justify-content-center">
              <a href="index.html">
                <img
                  src="<?php echo $domain ?>assets/images/logo.png"
                  alt="logo"
                  class="desktop-logo" />
                <img
                  src="<?php echo $domain ?>assets/images/logo.png"
                  alt="logo"
                  class="desktop-dark" />
              </a>
            </div>
            <?php if ($step == 1): ?>
              <div class="otp">
                <p class="h5 mb-2 text-center">Forgot Password</p>

                <form method="POST" >
                  <input type="text" name="email" class="form-control" placeholder="Email" required>

                  <div class="col-xl-12 d-grid mt-2">
                    <button name="send_otp" type="submit" class="btn btn-lg btn-primary">Send OTP</button>
                  </div>
                </form>
              </div>
            <?php endif; ?>
            <?php if ($step == 2): ?>
              <div class="otp mt-5">
                <p class="h5 mb-2 text-center">Verify Your Account</p>

                <form method="POST">
                  <div class="row">
                    <div class="col-3"><input type="text" name="otp1" maxlength="1" class="form-control text-center"></div>
                    <div class="col-3"><input type="text" name="otp2" maxlength="1" class="form-control text-center"></div>
                    <div class="col-3"><input type="text" name="otp3" maxlength="1" class="form-control text-center"></div>
                    <div class="col-3"><input type="text" name="otp4" maxlength="1" class="form-control text-center"></div>
                  </div>

                  <div class="col-xl-12 d-grid mt-2">
                    <button name="verify_otp" type="submit" class="btn btn-lg btn-primary">Verify</button>
                  </div>
                </form>
              </div>
            <?php endif; ?>
            <?php if ($step == 3): ?>
              <div class="otp mt-5">
                <p class="h5 mb-2 text-center">Change Password</p>

                <form method="POST" >
                  <input type="password" name="password" class="form-control mb-2" placeholder="New Password" required>
                  <input type="password" name="confirm_password" class="form-control mb-2" placeholder="Confirm Password" required>

                  <div class="col-xl-12 d-grid mt-2">
                    <button name="change_password" type="submit" class="btn btn-lg btn-primary">Update Password</button>
                  </div>
                </form>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->

  <script src="<?php echo $domain ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Internal Two Step Verification JS -->

  <script src="<?php echo $domain ?>assets/js/two-step-verification.js"></script>
  <div
    state="voice"
    class="placeholder-icon"
    id="tts-placeholder-icon"
    title="Click to show TTS button"
    style="
        background-image: url('chrome-extension://cpnomhnclohkhnikegipapofcjihldck/data/content_script/icons/voice.png');
      ">
    <canvas
      width="36"
      height="36"
      class="loading-circle"
      id="text-to-speech-loader"
      style="display: none"></canvas>
  </div>
</body>

</html>