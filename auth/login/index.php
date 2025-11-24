<?php

include_once '../../server/connection.php';
include_once '../../server/model.php';



if(isset($_POST['login'])) {
    $email = trim(mysqli_real_escape_string($connection, $_POST['email']));
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        showToast("Please fill all fields", "#f44336"); // red
    } else {
        // Check if user exists
        $query = mysqli_query($connection, "SELECT * FROM users WHERE email='$email' LIMIT 1");
        if (mysqli_num_rows($query) == 1) {
            $user = mysqli_fetch_assoc($query);
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Login successful
                $_SESSION['user_id'] = $user['id'];
                
                showToast("Login successful! Welcome ".$user['fullname'], "#4CAF50");

                // Redirect after 2 seconds
                echo "<script>setTimeout(()=>{window.location.href='../../user/dashboard'},2000)</script>";
            } else {
                showToast("Incorrect password", "#f44336");
            }
        } else {
            showToast("Email not registered", "#f44336");
        }
    }
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
  data-bybit-channel-name="np8AviE6GLVh2bjmsS1hK"
  data-bybit-is-default-wallet="true"
>
  <div
    id="in-page-channel-node-id"
    data-channel-name="in_page_channel_EJqX5N"
  ></div>
  <head>
    <!-- Meta Data -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo $sitename . ' - User Login ' ?></title>
    <meta
      name="Description"
      content="Bootstrap Responsive Admin Web Dashboard HTML5 Template"
    />
    <meta name="Author" content="Spruko Technologies Private Limited" />
    <meta
      name="keywords"
      content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit."
    />
    <!-- Favicon -->
    <link
      rel="icon"
      href="<?php echo $domain ?>assets/images/brand-logos/favicon.ico"
      type="image/x-icon"
    />
    <!-- Main Theme Js -->
    <script src="<?php echo $domain ?>assets/js/authentication-main.js"></script>
    <!-- Bootstrap Css -->
    <link
      id="style"
      href="<?php echo $domain ?>assets/libs/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- Style Css -->
    <link href="<?php echo $domain ?>assets/css/styles.css" rel="stylesheet" />
    <!-- Icons Css -->
    <link href="<?php echo $domain ?>assets/css/icons.css" rel="stylesheet" />

    <meta http-equiv="imagetoolbar" content="no" />
    <style type="text/css">
      <!-- input,textarea{-webkit-touch-callout:default;-webkit-user-select:auto;-khtml-user-select:auto;-moz-user-select:text;-ms-user-select:text;user-select:text} *{-webkit-touch-callout:none;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:-moz-none;-ms-user-select:none;user-select:none} -->
    </style>
    <style type="text/css" media="print">
      <!-- body{display:none} -->
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
        src: url(chrome-extension://egjidjbpglichdcondbcbdnbeeppgdph/fonts/BinancePlex-Regular.otf)
          format("opentype");
        font-weight: 400;
        font-style: normal;
      }

      @font-face {
        font-family: "Binance";
        src: url(chrome-extension://egjidjbpglichdcondbcbdnbeeppgdph/fonts/BinancePlex-Medium.otf)
          format("opentype");
        font-weight: 500;
        font-style: normal;
      }

      @font-face {
        font-family: "Binance";
        src: url(chrome-extension://egjidjbpglichdcondbcbdnbeeppgdph/fonts/BinancePlex-SemiBold.otf)
          format("opentype");
        font-weight: 600;
        font-style: normal;
      }
    </style>
  </head>
  <body class="authentication-background" cz-shortcut-listen="true">
 
    <!-- Start Switcher -->
    <div
      class="offcanvas offcanvas-end"
      tabindex="-1"
      id="switcher-canvas"
      aria-labelledby="offcanvasRightLabel"
    >
      <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title text-default" id="offcanvasRightLabel">
          Switcher
        </h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body">
        <nav class="border-bottom border-block-end-dashed">
          <div
            class="nav nav-tabs nav-justified"
            id="switcher-main-tab"
            role="tablist"
          >
            <button
              class="nav-link active"
              id="switcher-home-tab"
              data-bs-toggle="tab"
              data-bs-target="#switcher-home"
              type="button"
              role="tab"
              aria-controls="switcher-home"
              aria-selected="true"
            >
              Theme Styles
            </button>
            <button
              class="nav-link"
              id="switcher-profile-tab"
              data-bs-toggle="tab"
              data-bs-target="#switcher-profile"
              type="button"
              role="tab"
              aria-controls="switcher-profile"
              aria-selected="false"
              tabindex="-1"
            >
              Theme Colors
            </button>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div
            class="tab-pane fade show active border-0"
            id="switcher-home"
            role="tabpanel"
            aria-labelledby="switcher-home-tab"
            tabindex="0"
          >
            <div class="">
              <p class="switcher-style-head">Theme Color Mode:</p>
              <div class="row switcher-style">
                <div class="col-sm-4">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-light-theme">
                      Light
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="theme-style"
                      id="switcher-light-theme"
                      checked=""
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-dark-theme">
                      Dark
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="theme-style"
                      id="switcher-dark-theme"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="">
              <p class="switcher-style-head">Directions:</p>
              <div class="row switcher-style">
                <div class="col-sm-4">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-ltr">
                      LTR
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="direction"
                      id="switcher-ltr"
                      checked=""
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-rtl">
                      RTL
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="direction"
                      id="switcher-rtl"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="">
              <p class="switcher-style-head">Navigation Styles:</p>
              <div class="row switcher-style">
                <div class="col-sm-4">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-vertical">
                      Vertical
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="navigation-style"
                      id="switcher-vertical"
                      checked=""
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-horizontal">
                      Horizontal
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="navigation-style"
                      id="switcher-horizontal"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="navigation-menu-styles">
              <p class="switcher-style-head">Navigation Menu Style:</p>
              <div class="row switcher-style pb-2">
                <div class="col-sm-4">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-menu-click">
                      Menu Click
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="navigation-menu-styles"
                      id="switcher-menu-click"
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-menu-hover">
                      Menu Hover
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="navigation-menu-styles"
                      id="switcher-menu-hover"
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-icon-click">
                      Icon Click
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="navigation-menu-styles"
                      id="switcher-icon-click"
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-icon-hover">
                      Icon Hover
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="navigation-menu-styles"
                      id="switcher-icon-hover"
                    />
                  </div>
                </div>
              </div>
              <div class="px-4 pb-3 text-secondary fs-11">
                <span class="fw-medium fs-12 text-dark me-2 d-inline-block"
                  >Note:</span
                >Works same for both Vertical and Horizontal
              </div>
            </div>
            <div class="">
              <p class="switcher-style-head">Page Styles:</p>
              <div class="row switcher-style">
                <div class="col-sm-4">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-regular">
                      Regular
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="page-styles"
                      id="switcher-regular"
                      checked=""
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-classic">
                      Classic
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="page-styles"
                      id="switcher-classic"
                    />
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-modern">
                      Modern
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="page-styles"
                      id="switcher-modern"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="">
              <p class="switcher-style-head">Layout Width Styles:</p>
              <div class="row switcher-style">
                <div class="col-sm-4">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-full-width">
                      Full Width
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="layout-width"
                      id="switcher-full-width"
                      checked=""
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-boxed">
                      Boxed
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="layout-width"
                      id="switcher-boxed"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="">
              <p class="switcher-style-head">Menu Positions:</p>
              <div class="row switcher-style">
                <div class="col-sm-4">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-menu-fixed">
                      Fixed
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="menu-positions"
                      id="switcher-menu-fixed"
                      checked=""
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-menu-scroll">
                      Scrollable
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="menu-positions"
                      id="switcher-menu-scroll"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="">
              <p class="switcher-style-head">Header Positions:</p>
              <div class="row switcher-style">
                <div class="col-sm-4">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-header-fixed">
                      Fixed
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="header-positions"
                      id="switcher-header-fixed"
                      checked=""
                    />
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-check switch-select">
                    <label
                      class="form-check-label"
                      for="switcher-header-scroll"
                    >
                      Scrollable
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="header-positions"
                      id="switcher-header-scroll"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="sidemenu-layout-styles">
              <p class="switcher-style-head">Sidemenu Layout Syles:</p>
              <div class="row switcher-style pb-2">
                <div class="col-sm-6">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-default-menu">
                      Default Menu
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="sidemenu-layout-styles"
                      id="switcher-default-menu"
                      checked=""
                    />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-closed-menu">
                      Closed Menu
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="sidemenu-layout-styles"
                      id="switcher-closed-menu"
                    />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-check switch-select">
                    <label
                      class="form-check-label"
                      for="switcher-icontext-menu"
                    >
                      Icon Text
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="sidemenu-layout-styles"
                      id="switcher-icontext-menu"
                    />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-icon-overlay">
                      Icon Overlay
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="sidemenu-layout-styles"
                      id="switcher-icon-overlay"
                    />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-detached">
                      Detached
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="sidemenu-layout-styles"
                      id="switcher-detached"
                    />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-check switch-select">
                    <label class="form-check-label" for="switcher-double-menu">
                      Double Menu
                    </label>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="sidemenu-layout-styles"
                      id="switcher-double-menu"
                    />
                  </div>
                </div>
              </div>
              <div class="px-4 pb-3 text-secondary fs-11">
                <span class="fw-medium fs-12 text-dark me-2 d-inline-block"
                  >Note:</span
                >Navigation menu styles won't work here.
              </div>
            </div>
          </div>
          <div
            class="tab-pane fade border-0"
            id="switcher-profile"
            role="tabpanel"
            aria-labelledby="switcher-profile-tab"
            tabindex="0"
          >
            <div>
              <div class="theme-colors">
                <p class="switcher-style-head">Menu Colors:</p>
                <div class="d-flex switcher-style pb-2">
                  <div class="form-check switch-select me-3">
                    <input
                      class="form-check-input color-input color-white"
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Light Menu"
                      type="radio"
                      name="menu-colors"
                      id="switcher-menu-light"
                      checked=""
                    />
                  </div>
                  <div class="form-check switch-select me-3">
                    <input
                      class="form-check-input color-input color-dark"
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Dark Menu"
                      type="radio"
                      name="menu-colors"
                      id="switcher-menu-dark"
                    />
                  </div>
                  <div class="form-check switch-select me-3">
                    <input
                      class="form-check-input color-input color-primary"
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Color Menu"
                      type="radio"
                      name="menu-colors"
                      id="switcher-menu-primary"
                    />
                  </div>
                  <div class="form-check switch-select me-3">
                    <input
                      class="form-check-input color-input color-gradient"
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Gradient Menu"
                      type="radio"
                      name="menu-colors"
                      id="switcher-menu-gradient"
                    />
                  </div>
                  <div class="form-check switch-select me-3">
                    <input
                      class="form-check-input color-input color-transparent"
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Transparent Menu"
                      type="radio"
                      name="menu-colors"
                      id="switcher-menu-transparent"
                    />
                  </div>
                </div>
                <div class="px-4 pb-3 text-muted fs-11">
                  Note:If you want to change color Menu dynamically change from
                  below Theme Primary color picker
                </div>
              </div>
              <div class="theme-colors">
                <p class="switcher-style-head">Header Colors:</p>
                <div class="d-flex switcher-style pb-2">
                  <div class="form-check switch-select me-3">
                    <input
                      class="form-check-input color-input color-white"
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Light Header"
                      type="radio"
                      name="header-colors"
                      id="switcher-header-light"
                      checked=""
                    />
                  </div>
                  <div class="form-check switch-select me-3">
                    <input
                      class="form-check-input color-input color-dark"
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Dark Header"
                      type="radio"
                      name="header-colors"
                      id="switcher-header-dark"
                    />
                  </div>
                  <div class="form-check switch-select me-3">
                    <input
                      class="form-check-input color-input color-primary"
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Color Header"
                      type="radio"
                      name="header-colors"
                      id="switcher-header-primary"
                    />
                  </div>
                  <div class="form-check switch-select me-3">
                    <input
                      class="form-check-input color-input color-gradient"
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Gradient Header"
                      type="radio"
                      name="header-colors"
                      id="switcher-header-gradient"
                    />
                  </div>
                  <div class="form-check switch-select me-3">
                    <input
                      class="form-check-input color-input color-transparent"
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Transparent Header"
                      type="radio"
                      name="header-colors"
                      id="switcher-header-transparent"
                    />
                  </div>
                </div>
                <div class="px-4 pb-3 text-muted fs-11">
                  Note:If you want to change color Header dynamically change
                  from below Theme Primary color picker
                </div>
              </div>
              <div class="theme-colors">
                <p class="switcher-style-head">Theme Primary:</p>
                <div class="d-flex flex-wrap align-items-center switcher-style">
                  <div class="form-check switch-select me-3">
                    <input
                      class="form-check-input color-input color-primary-1"
                      type="radio"
                      name="theme-primary"
                      id="switcher-primary"
                    />
                  </div>
                  <div class="form-check switch-select me-3">
                    <input
                      class="form-check-input color-input color-primary-2"
                      type="radio"
                      name="theme-primary"
                      id="switcher-primary1"
                    />
                  </div>
                  <div class="form-check switch-select me-3">
                    <input
                      class="form-check-input color-input color-primary-3"
                      type="radio"
                      name="theme-primary"
                      id="switcher-primary2"
                    />
                  </div>
                  <div class="form-check switch-select me-3">
                    <input
                      class="form-check-input color-input color-primary-4"
                      type="radio"
                      name="theme-primary"
                      id="switcher-primary3"
                    />
                  </div>
                  <div class="form-check switch-select me-3">
                    <input
                      class="form-check-input color-input color-primary-5"
                      type="radio"
                      name="theme-primary"
                      id="switcher-primary4"
                    />
                  </div>
                  <div
                    class="form-check switch-select ps-0 mt-1 color-primary-light"
                  >
                    <div class="theme-container-primary"></div>
                    <div class="pickr-container-primary"></div>
                  </div>
                </div>
              </div>
              <div class="theme-colors">
                <p class="switcher-style-head">Theme Background:</p>
                <div class="d-flex flex-wrap align-items-center switcher-style">
                  <div class="form-check switch-select me-3">
                    <input
                      class="form-check-input color-input color-bg-1"
                      type="radio"
                      name="theme-background"
                      id="switcher-background"
                      checked=""
                    />
                  </div>
                  <div class="form-check switch-select me-3">
                    <input
                      class="form-check-input color-input color-bg-2"
                      type="radio"
                      name="theme-background"
                      id="switcher-background1"
                    />
                  </div>
                  <div class="form-check switch-select me-3">
                    <input
                      class="form-check-input color-input color-bg-3"
                      type="radio"
                      name="theme-background"
                      id="switcher-background2"
                    />
                  </div>
                  <div class="form-check switch-select me-3">
                    <input
                      class="form-check-input color-input color-bg-4"
                      type="radio"
                      name="theme-background"
                      id="switcher-background3"
                    />
                  </div>
                  <div class="form-check switch-select me-3">
                    <input
                      class="form-check-input color-input color-bg-5"
                      type="radio"
                      name="theme-background"
                      id="switcher-background4"
                    />
                  </div>
                  <div
                    class="form-check switch-select ps-0 mt-1 tooltip-static-demo color-bg-transparent"
                  >
                    <div class="theme-container-background"></div>
                    <div class="pickr-container-background"></div>
                  </div>
                </div>
              </div>
              <div class="menu-image mb-3">
                <p class="switcher-style-head">Menu With Background Image:</p>
                <div class="d-flex flex-wrap align-items-center switcher-style">
                  <div class="form-check switch-select m-2">
                    <input
                      class="form-check-input bgimage-input bg-img1"
                      type="radio"
                      name="theme-background"
                      id="switcher-bg-img"
                      checked=""
                    />
                  </div>
                  <div class="form-check switch-select m-2">
                    <input
                      class="form-check-input bgimage-input bg-img2"
                      type="radio"
                      name="theme-background"
                      id="switcher-bg-img1"
                    />
                  </div>
                  <div class="form-check switch-select m-2">
                    <input
                      class="form-check-input bgimage-input bg-img3"
                      type="radio"
                      name="theme-background"
                      id="switcher-bg-img2"
                    />
                  </div>
                  <div class="form-check switch-select m-2">
                    <input
                      class="form-check-input bgimage-input bg-img4"
                      type="radio"
                      name="theme-background"
                      id="switcher-bg-img3"
                    />
                  </div>
                  <div class="form-check switch-select m-2">
                    <input
                      class="form-check-input bgimage-input bg-img5"
                      type="radio"
                      name="theme-background"
                      id="switcher-bg-img4"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-between canvas-footer">
            <a href="javascript:void(0);" class="btn btn-primary">Buy Now</a>
            <a href="https://1.envato.market/MGEaN" class="btn btn-secondary"
              >Our Portfolio</a
            >
            <a href="javascript:void(0);" id="reset-all" class="btn btn-danger"
              >Reset</a
            >
          </div>
        </div>
      </div>
    </div>
    <!-- End Switcher -->
    <div class="container-lg">
      <div
        class="row justify-content-center align-items-center authentication authentication-basic h-100"
      >
        <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
          <div class="card custom-card my-4">
            <form method="POST" class="card-body p-5">
              <div class="mb-3 d-flex justify-content-center">
                <a href="#">
                  <img
                    src="<?php echo $domain ?>assets/images/logo.png"
                    alt="logo"
                    class="desktop-logo"
                  />
                  <img
                    src="<?php echo $domain ?>assets/images/logo.png"
                    alt="logo"
                    class="desktop-dark"
                  />
                </a>
              </div>
              <p class="h5 mb-2 text-center">Sign In</p>
              <p class="mb-4 text-muted op-7 fw-normal text-center">
                Welcome &amp; login to your account
              </p>
              <div class="row gy-3">
                
                <div class="col-xl-12">
                  <label for="signup-firstname" class="form-label text-default"
                    >Email<sup>*</sup></label
                  >
                  <input
                    type="text"
                    class="form-control form-control-lg"
                    id="signup-email"
                    name="email"
                    placeholder="Email"
                  />
                </div>
                <div class="col-xl-12">
                  <label for="signup-password" class="form-label text-default"
                    >Password<sup>*</sup></label
                  >
                  <div class="position-relative">
                    <input
                      type="password"
                      class="form-control form-control-lg"
                      id="signup-password"
                      placeholder="password"
                       name="password"
                    />
                    <a
                      href="javascript:void(0);"
                      class="show-password-button text-muted"
                      onclick="createpassword('signup-password',this)"
                      id="button-addon2"
                      ><i class="ri-eye-off-line align-middle"></i
                    ></a>
                  </div>
                </div>
                
              </div>
              
              <div class="d-grid mt-4">
                <button name="login" type="submit" class="btn btn-lg btn-primary">Login </button>
              </div>
              <div class="text-center">
                <p class="text-muted mt-3 mb-0">
                  Don't have an account?
                  <a href="../register/" class="text-primary">Sign Up</a>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap JS -->
    <noscript
      ><p>
        To display this page you need a browser that supports JavaScript.
      </p></noscript
    >
    <script src="<?php echo $domain ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <
    <!-- Show Password JS -->
    <noscript
      ><p>
        To display this page you need a browser that supports JavaScript.
      </p></noscript
    >
    <script src="<?php echo $domain ?>assets/js/show-password.js"></script>
    <div
      state="voice"
      class="placeholder-icon"
      id="tts-placeholder-icon"
      title="Click to show TTS button"
      style="
        background-image: url('chrome-extension://cpnomhnclohkhnikegipapofcjihldck/data/content_script/icons/voice.png');
      "
    >
      <canvas
        width="36"
        height="36"
        class="loading-circle"
        id="text-to-speech-loader"
        style="display: none"
      ></canvas>
    </div>
  </body>
</html>
