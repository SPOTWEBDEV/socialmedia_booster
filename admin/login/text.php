<?php


include('../../server/connection.php');




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
  data-bybit-channel-name="ejDyBVopPZdH0IKXFPfCV"
  data-bybit-is-default-wallet="true">
<div
  id="in-page-channel-node-id"
  data-channel-name="in_page_channel_nT-vO_"></div>

<head>
  <!-- Meta Data -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>UDON - Bootstrap 5 Premium Admin &amp; Dashboard Template</title>
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
      class="row justify-content-center authentication authentication-basic align-items-center h-100">
      <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
        <div class="card custom-card">
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
            <p class="h5 mb-2 text-center">Lock Screens</p>
            <p class="mb-3 text-muted op-7 fw-normal text-center">
              Hello Admin!
            </p>
            <div class="d-flex align-items-center mb-3">
              <div class="lh-1">
                <span class="avatar avatar-rounded">
                  <img src="<?php echo $domain ?>assets/images/avatar.svg" alt="" />
                </span>
              </div>
              <div class="ms-3">
                <p class="mb-0 text-dark">admin@admin.com</p>
              </div>
            </div>
            <div class="row gy-3">
              <div class="col-xl-12 mb-2">
                <label
                  for="lockscreen-password"
                  class="form-label text-default">Password</label>
                <div class="position-relative">
                  <input
                    type="password"
                    class="form-control form-control-lg"
                    id="lockscreen-password"
                    placeholder="password" />
                  <a
                    href="javascript:void(0);"
                    class="show-password-button text-muted"
                    onclick="createpassword('lockscreen-password',this)"
                    id="button-addon2"><i class="ri-eye-off-line align-middle"></i></a>
                </div>
                <div class="mt-2">
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      value=""
                      id="defaultCheck1" />
                    <label
                      class="form-check-label text-muted fw-normal"
                      for="defaultCheck1">
                      Remember password ?
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-xl-12 d-grid mt-2">
                <a href="index.html" class="btn btn-lg btn-primary">Unlock</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <script src="<?php echo $domain ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="<?php echo $domain ?>assets/js/show-password.js"></script>
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