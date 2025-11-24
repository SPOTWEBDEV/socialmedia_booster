<?php


include('server/connection.php');




?>

<!DOCTYPE html>
<html
  lang="en"
  dir="ltr"
  data-nav-layout="horizontal"
  data-nav-style="menu-click"
  data-menu-position="fixed"
  data-theme-mode="light"
  data-bybit-channel-name="FmjLh2WC44iN5Tf-uCFoL"
  data-bybit-is-default-wallet="true"
  data-toggled="close"
>
  <div
    id="in-page-channel-node-id"
    data-channel-name="in_page_channel_t3ik9T"
  ></div>
  <head>
    <!-- Meta Data -->
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=0"
    />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php  echo $sitename ?> - Welcome Page</title>
    <meta
      name="Description"
      content="Bootstrap Responsive Admin Web Dashboard HTML5 Template"
    />
    <meta name="Author" content="Spruko Technologies Private Limited" />
    <!-- Favicon -->
    <link
      rel="icon"
      href="<?php echo $domain ?>assets/images/brand-logos/favicon.ico"
      type="image/x-icon"
    />
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
    <!-- Node Waves Css -->
    <link href="<?php echo $domain ?>assets/libs/node-waves/waves.min.css" rel="stylesheet" />
    <!-- SwiperJS Css -->
    <link rel="stylesheet" href="<?php echo $domain ?>assets/libs/swiper/swiper-bundle.min.css" />
    <!-- Color Picker Css -->
    <link rel="stylesheet" href="<?php echo $domain ?>assets/libs/flatpickr/flatpickr.min.css" />
    <link
      rel="stylesheet"
      href="<?php echo $domain ?>assets/libs/@simonwep/pickr/themes/nano.min.css"
    />
    <!-- Choices Css -->
    <link
      rel="stylesheet"
      href="<?php echo $domain ?>assets/libs/choices.js/public/assets/styles/choices.min.css"
    />
    <script>
      if (localStorage.udonlandingdarktheme) {
        document.querySelector("html").setAttribute("data-theme-mode", "dark");
      }
      if (localStorage.udonlandingrtl) {
        document.querySelector("html").setAttribute("dir", "rtl");
        document
          .querySelector("#style")
          ?.setAttribute(
            "href",
            "<?php echo $domain ?>assets/libs/bootstrap/css/bootstrap.rtl.min.css"
          );
      }
    </script>
    <script type="text/javascript">
      <!--
      k14h = document.all;
      wruf = k14h && !document.getElementById;
      uc9y = k14h && document.getElementById;
      n8ve = !k14h && document.getElementById;
      o489 = document.layers;
      function axpg(eajh) {
        try {
          if (wruf) alert("");
        } catch (e) {}
        if (eajh && eajh.stopPropagation) eajh.stopPropagation();
        return false;
      }
      function spp2() {
        if (event.button == 2 || event.button == 3) axpg();
      }
      function x8gp(e) {
        return e.which == 3 ? axpg() : true;
      }
      function y01g(y4cc) {
        for (bpr0 = 0; bpr0 < y4cc.images.length; bpr0++) {
          y4cc.images[bpr0].onmousedown = x8gp;
        }
        for (bpr0 = 0; bpr0 < y4cc.layers.length; bpr0++) {
          y01g(y4cc.layers[bpr0].document);
        }
      }
      function ybzy() {
        if (wruf) {
          for (bpr0 = 0; bpr0 < document.images.length; bpr0++) {
            document.images[bpr0].onmousedown = spp2;
          }
        } else if (o489) {
          y01g(document);
        }
      }
      function rtkh(e) {
        if (
          (uc9y &&
            event &&
            event.srcElement &&
            event.srcElement.tagName == "IMG") ||
          (n8ve && e && e.target && e.target.tagName == "IMG")
        ) {
          return axpg();
        }
      }
      if (uc9y || n8ve) {
        document.oncontextmenu = rtkh;
      } else if (wruf || o489) {
        window.onload = ybzy;
      }
      function gbxe(e) {
        wyt0 =
          e && e.srcElement && e.srcElement != null ? e.srcElement.tagName : "";
        if (wyt0 != "INPUT" && wyt0 != "TEXTAREA" && wyt0 != "BUTTON") {
          return false;
        }
      }
      function vs75() {
        return false;
      }
      if (k14h) {
        document.onselectstart = gbxe;
        document.ondragstart = vs75;
      }
      if (document.addEventListener) {
        document.addEventListener(
          "copy",
          function (e) {
            wyt0 = e.target.tagName;
            if (wyt0 != "INPUT" && wyt0 != "TEXTAREA") {
              e.preventDefault();
            }
          },
          false
        );
        document.addEventListener(
          "dragstart",
          function (e) {
            e.preventDefault();
          },
          false
        );
      }
      function nohu(evt) {
        if (evt.preventDefault) {
          evt.preventDefault();
        } else {
          evt.keyCode = 37;
          evt.returnValue = false;
        }
      }
      var i4i4 = 1;
      var sib5 = 2;
      var j56p = 4;
      var b1va = new Array();
      b1va.push(new Array(sib5, 65));
      b1va.push(new Array(sib5, 67));
      b1va.push(new Array(sib5, 80));
      b1va.push(new Array(sib5, 83));
      b1va.push(new Array(sib5, 85));
      b1va.push(new Array(i4i4 | sib5, 73));
      b1va.push(new Array(i4i4 | sib5, 74));
      b1va.push(new Array(i4i4, 121));
      b1va.push(new Array(0, 123));
      function o8lw(evt) {
        evt = evt ? evt : event ? event : null;
        if (evt) {
          var jfu3 = evt.keyCode;
          if (!jfu3 && evt.charCode) {
            jfu3 = String.fromCharCode(evt.charCode)
              .toUpperCase()
              .charCodeAt(0);
          }
          for (var xq2e = 0; xq2e < b1va.length; xq2e++) {
            if (
              evt.shiftKey == ((b1va[xq2e][0] & i4i4) == i4i4) &&
              (evt.ctrlKey | evt.metaKey) == ((b1va[xq2e][0] & sib5) == sib5) &&
              evt.altKey == ((b1va[xq2e][0] & j56p) == j56p) &&
              (jfu3 == b1va[xq2e][1] || b1va[xq2e][1] == 0)
            ) {
              nohu(evt);
              break;
            }
          }
        }
      }
      if (document.addEventListener) {
        document.addEventListener("keydown", o8lw, true);
        document.addEventListener("keypress", o8lw, true);
      } else if (document.attachEvent) {
        document.attachEvent("onkeydown", o8lw);
      }
      -->
    </script>
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
  <body class="landing-body" cz-shortcut-listen="true">
    <!-- Start Switcher -->
    <div
      class="offcanvas offcanvas-end"
      tabindex="-1"
      id="switcher-canvas"
      aria-labelledby="offcanvasRightLabel"
    >
      <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Switcher</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body">
        <div class="">
          <p class="switcher-style-head">Theme Color Mode:</p>
          <div class="row switcher-style">
            <div class="col-4">
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
            <div class="col-4">
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
            <div class="col-4">
              <div class="form-check switch-select">
                <label class="form-check-label" for="switcher-ltr"> LTR </label>
                <input
                  class="form-check-input"
                  type="radio"
                  name="direction"
                  id="switcher-ltr"
                  checked=""
                />
              </div>
            </div>
            <div class="col-4">
              <div class="form-check switch-select">
                <label class="form-check-label" for="switcher-rtl"> RTL </label>
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
        <div class="theme-colors">
          <p class="switcher-style-head">Theme Primary:</p>
          <div class="d-flex align-items-center switcher-style">
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
              class="form-check switch-select me-3 ps-0 mt-1 color-primary-light"
            >
              <div class="theme-container-primary">
                <button class="active">nano</button>
              </div>
              <div class="pickr-container-primary">
                <div class="pickr">
                  <button
                    type="button"
                    class="pcr-button"
                    role="button"
                    aria-label="toggle color picker dialog"
                    style="--pcr-color: rgba(185, 78, 237, 1)"
                  ></button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div>
          <p class="switcher-style-head">reset:</p>
          <div class="text-center">
            <button id="reset-all" class="btn btn-danger mt-3">Reset</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End Switcher -->
    <div class="landing-page-wrapper">
      <!-- app-header -->
      <header class="app-header">
        <!-- Start::main-header-container -->
        <div class="main-header-container container-fluid">
          <!-- Start::header-content-left -->
          <div class="header-content-left">
            <!-- Start::header-element -->
            <div class="header-element">
              <div class="horizontal-logo">
                <a href="index.html" class="header-logo">
                  <img
                    src="<?php echo $domain ?>assets/images/logo.png"
                    alt="logo"
                    class="toggle-logo"
                  />
                  <img
                    src="<?php echo $domain ?>assets/images/logo.png"
                    alt="logo"
                    class="toggle-dark"
                  />
                </a>
              </div>
            </div>
            <!-- End::header-element -->
            <!-- Start::header-element -->
            <div class="header-element">
              <!-- Start::header-link -->
              <a
                href="javascript:void(0);"
                class="sidemenu-toggle header-link"
                data-bs-toggle="sidebar"
              >
                <span class="open-toggle">
                  <i class="ri-menu-3-line fs-20"></i>
                </span>
              </a>
              <!-- End::header-link -->
            </div>
            <!-- End::header-element -->
          </div>
          <!-- End::header-content-left -->
          <!-- Start::header-content-right -->
          <div class="header-content-right">
            <!-- Start::header-element -->
            <div class="header-element align-items-center">
              <!-- Start::header-link|switcher-icon -->
              <div class="btn-list d-lg-none d-block">
                <a href="<?php echo $domain . 'auth/register/' ?>" class="btn btn-primary-light">
                  Sign Up
                </a>
                <button
                  class="btn btn-icon btn-success switcher-icon"
                  data-bs-toggle="offcanvas"
                  data-bs-target="#switcher-canvas"
                >
                  <i class="ri-settings-3-line"></i>
                </button>
              </div>
              <!-- End::header-link|switcher-icon -->
            </div>
            <!-- End::header-element -->
          </div>
          <!-- End::header-content-right -->
        </div>
        <!-- End::main-header-container -->
      </header>
      <!-- /app-header -->
      <!-- Start::app-sidebar -->
      <aside class="app-sidebar sticky sticky-pin" id="sidebar">
        <div class="container-xl">
          <!-- Start::main-sidebar -->
          <div class="main-sidebar">
            <!-- Start::nav -->
            <nav class="main-menu-container nav nav-pills sub-open">
              <div class="landing-logo-container">
                <div class="horizontal-logo">
                  <a href="index.html" class="header-logo">
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
              </div>
              <div class="slide-left d-none" id="slide-left">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="#7b8191"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"
                  ></path>
                </svg>
              </div>
              <ul class="main-menu" style="margin-left: 0px; margin-right: 0px">
                <!-- Start::slide -->
                <li class="slide">
                  <a class="side-menu__item" href="#home">
                    <span class="side-menu__label">Home</span>
                  </a>
                </li>
                <!-- End::slide -->
                <!-- Start::slide -->
                <li class="slide">
                  <a href="#about" class="side-menu__item active">
                    <span class="side-menu__label">About</span>
                  </a>
                </li>
                <!-- End::slide -->
                <!-- Start::slide -->
                
                <!-- End::slide -->
                <!-- Start::slide -->
               
                <!-- End::slide -->
                <!-- Start::slide -->
                <li class="slide">
                  <a href="#team" class="side-menu__item">
                    <span class="side-menu__label">Team</span>
                  </a>
                </li>
                <!-- End::slide -->
                <!-- Start::slide -->
                <li class="slide">
                  <a href="#faqs" class="side-menu__item">
                    <span class="side-menu__label">FAQ's</span>
                  </a>
                </li>
                <!-- End::slide -->
                <!-- Start::slide -->
                
                <!-- End::slide -->
                <!-- Start::slide -->
                <li class="slide">
                  <a href="#contact" class="side-menu__item">
                    <span class="side-menu__label">Contact Us</span>
                  </a>
                </li>
                <!-- End::slide -->
              </ul>
              <div class="slide-right d-none" id="slide-right">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="#7b8191"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"
                  ></path>
                </svg>
              </div>
              <div class="d-lg-flex d-none">
                <div class="btn-list d-lg-flex d-none mt-lg-2 mt-xl-0 mt-0">
                  <a href="<?php echo $domain . 'auth/register/' ?>" class="btn btn-wave btn-primary">
                    Sign Up
                  </a>
                  <button
                    class="btn btn-wave btn-icon btn-light switcher-icon"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#switcher-canvas"
                  >
                    <i class="ri-settings-3-line"></i>
                  </button>
                </div>
              </div>
            </nav>
            <!-- End::nav -->
          </div>
          <!-- End::main-sidebar -->
        </div>
      </aside>
      <!-- End::app-sidebar -->
      <!-- Start::app-content -->
      <div class="main-content landing-main px-0">
        <!-- Start:: Section-1 -->
        <div class="landing-banner" id="home">
          <section class="section">
            <div class="container main-banner-container pb-lg-0">
              <div class="row">
                <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-8">
                  <div class="py-lg-5">
                    <div class="mb-3">
                      <h6 class="fw-medium text-fixed-white op-9">
                        BOOST YOUR SOCIAL PRESENCE
                      </h6>
                    </div>
                    <p class="landing-banner-heading mb-3">
                      Grow your influence effortlessly with
                      <span class="text-gradient">BOOST YARD!</span>
                    </p>
                    <div class="fs-16 mb-5 text-fixed-white op-7">
                      Boost Yard helps you increase followers, views,
                      engagement, and overall visibility across all major social
                      media platforms — fast, reliable, and secure.
                    </div>
                    <a href="index.html" class="m-1 btn btn-lg btn-secondary">
                      Explore Services
                      <i class="ri-eye-line ms-2 align-middle"></i>
                    </a>
                  </div>
                </div>
                <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-4 my-auto">
                  <div class="text-end landing-main-image landing-heading-img">
                    <img
                      src="<?php echo $domain ?>assets/images/media/landing/1.png"
                      alt="Boost Yard Social Media Growth"
                      class="img-fluid"
                    />
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
        <!-- End:: Section-1 -->
        <!-- Start:: Section-2 -->
        <section class="section" id="about">
          <div class="container position-relative">
            <div class="text-center">
              <p class="fs-12 fw-medium text-success mb-1">
                <span class="landing-section-heading text-gradient">ABOUT</span>
              </p>
              <h3 class="fw-medium mb-2">
                Powerful Tools to Grow Your Social Influence
              </h3>
              <div class="row justify-content-center">
                <div class="col-xl-7">
                  <p class="text-muted fs-15 mb-5 fw-normal">
                    Boost Yard helps you build real momentum across all your
                    social platforms.
                  </p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-4">
                <div class="card custom-card landing-card border shadow-none">
                  <div class="card-body">
                    <div class="mb-4">
                      <span
                        class="avatar avatar-rounded avatar-xl bg-outline-primary"
                      >
                        <i class="bi bi-lightbulb fs-3"></i>
                      </span>
                    </div>
                    <h4 class="fw-medium">Smart Growth Services</h4>
                    <p class="fs-15 text-muted">
                      Boost your followers, views, and engagement with fast and
                      reliable growth tools.
                    </p>
                    <a href="javascript:void(0);" class="fw-medium text-primary"
                      >Read More<i
                        class="ti ti-arrow-narrow-right ms-2 fs-5 align-middle"
                      ></i
                    ></a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4">
                <div class="card custom-card landing-card border shadow-none">
                  <div class="card-body">
                    <div class="mb-4">
                      <span
                        class="avatar avatar-rounded avatar-xl bg-outline-info"
                      >
                        <i class="bi bi-chat-dots fs-3"></i>
                      </span>
                    </div>
                    <h4 class="fw-medium">24/7 Customer Support</h4>
                    <p class="fs-15 text-muted">
                      Our support team is always available to help you with
                      orders, issues, or questions.
                    </p>
                    <a href="javascript:void(0);" class="fw-medium text-info"
                      >Read More<i
                        class="ti ti-arrow-narrow-right ms-2 fs-5 al align-middle"
                      ></i
                    ></a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4">
                <div class="card custom-card landing-card border shadow-none">
                  <div class="card-body">
                    <div class="mb-4">
                      <span
                        class="avatar avatar-rounded avatar-xl bg-outline-warning"
                      >
                        <i class="bi bi-people fs-3"></i>
                      </span>
                    </div>
                    <h4 class="fw-medium">Professional Team</h4>
                    <p class="fs-15 text-muted">
                      Our experienced staff ensures fast delivery and consistent
                      quality for all services.
                    </p>
                    <a href="javascript:void(0);" class="fw-medium text-warning"
                      >Read More<i
                        class="ti ti-arrow-narrow-right ms-2 fs-5 align-middle"
                      ></i
                    ></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- End:: Section-2 -->
        <!-- Start:: Section-3 -->
        <section class="section section-bg" id="services">
          <div class="container">
            <div class="text-center">
              <p class="fs-12 fw-medium text-success mb-1">
                <span class="landing-section-heading text-gradient"
                  >SERVICES</span
                >
              </p>
              <h3 class="fw-medium mb-2">Boosting Services We Provide</h3>
              <div class="row justify-content-center">
                <div class="col-xl-7">
                  <p class="text-muted fs-15 mb-5 fw-normal">
                    Powerful tools to boost your followers, views, engagement,
                    and overall social reach.
                  </p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-3">
                <div class="card custom-card landing-card">
                  <div class="card-body text-center">
                    <div class="mb-4">
                      <span
                        class="avatar avatar-xl bg-primary-transparent border border-primary border-opacity-10"
                      >
                        <i class="bx bx-globe fs-3"></i>
                      </span>
                    </div>
                    <h4 class="fw-medium">Instagram Growth</h4>
                    <p class="fs-15 text-muted mb-0">
                      Boost your Instagram followers, likes, comments, and reach
                      with fast and reliable delivery.
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-xl-3">
                <div class="card custom-card landing-card">
                  <div class="card-body text-center">
                    <div class="mb-4">
                      <span
                        class="avatar avatar-xl bg-warning-transparent border border-warning border-opacity-10"
                      >
                        <i class="bx bx-dollar fs-3"></i>
                      </span>
                    </div>
                    <h4 class="fw-medium">TikTok Boosting</h4>
                    <p class="fs-15 text-muted mb-0">
                      Increase your TikTok views, likes, and followers to expand
                      your visibility instantly.
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-xl-3">
                <div class="card custom-card landing-card">
                  <div class="card-body text-center">
                    <div class="mb-4">
                      <span
                        class="avatar avatar-xl bg-info-transparent border border-info border-opacity-10"
                      >
                        <i class="bx bx-box fs-3"></i>
                      </span>
                    </div>
                    <h4 class="fw-medium">YouTube Engagement</h4>
                    <p class="fs-15 text-muted mb-0">
                      Get more views, subscribers, and watch time to accelerate
                      your YouTube channel growth.
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-xl-3">
                <div class="card custom-card landing-card">
                  <div class="card-body text-center">
                    <div class="mb-4">
                      <span
                        class="avatar avatar-xl bg-success-transparent border border-success border-opacity-10"
                      >
                        <i class="bx bx-basket fs-3"></i>
                      </span>
                    </div>
                    <h4 class="fw-medium">Facebook Promotion</h4>
                    <p class="fs-15 text-muted mb-0">
                      Boost your Facebook page likes, post engagement, and
                      overall social credibility.
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-xl-3">
                <div class="card custom-card landing-card">
                  <div class="card-body text-center">
                    <div class="mb-4">
                      <span
                        class="avatar avatar-xl bg-danger-transparent border border-danger border-opacity-10"
                      >
                        <i class="bx bx-wallet fs-3"></i>
                      </span>
                    </div>
                    <h4 class="fw-medium">Twitter/X Influence</h4>
                    <p class="fs-15 text-muted mb-0">
                      Get more followers, retweets, and impressions to grow your
                      presence on Twitter/X.
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-xl-3">
                <div class="card custom-card landing-card">
                  <div class="card-body text-center">
                    <div class="mb-4">
                      <span
                        class="avatar avatar-xl bg-secondary-transparent border border-secondary border-opacity-10"
                      >
                        <i class="bx bx-envelope fs-3"></i>
                      </span>
                    </div>
                    <h4 class="fw-medium">Email Promotion</h4>
                    <p class="fs-15 text-muted mb-0">
                      Promote your brand or social media pages through targeted
                      email outreach services.
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-xl-3">
                <div class="card custom-card landing-card">
                  <div class="card-body text-center">
                    <div class="mb-4">
                      <span
                        class="avatar avatar-xl bg-teal-transparent border border-teal border-opacity-10"
                      >
                        <i class="bx bx-user-check fs-3"></i>
                      </span>
                    </div>
                    <h4 class="fw-medium">Personal Branding</h4>
                    <p class="fs-15 text-muted mb-0">
                      Build your online identity with consistent engagement and
                      broad platform coverage.
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-xl-3">
                <div class="card custom-card landing-card">
                  <div class="card-body text-center">
                    <div class="mb-4">
                      <span
                        class="avatar avatar-xl bg-pink-transparent border border-pink border-opacity-10"
                      >
                        <i class="bx bx-calendar-check fs-3"></i>
                      </span>
                    </div>
                    <h4 class="fw-medium">Campaign Planning</h4>
                    <p class="fs-15 text-muted mb-0">
                      Plan and execute powerful multi-platform campaigns to
                      boost your social performance.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- End:: Section-3 -->
        <!-- Start:: Section-4 -->
        <section class="section" id="expectations">
          <div class="container">
            <div class="row gx-5 mx-0">
              <div class="col-xl-5">
                <div class="home-proving-image">
                  <img
                    src="<?php echo $domain ?>assets/images/media/landing/2.png"
                    alt=""
                    class="img-fluid rounded"
                  />
                </div>
                <div class="proving-pattern-1"></div>
              </div>
              <div class="col-xl-7 my-auto">
                <div class="heading-section text-start mb-4">
                  <div class="heading-subtitle fw-medium">
                    <span class="landing-section-heading text-gradient"
                      >BOOST WITH CONFIDENCE!</span
                    >
                  </div>
                  <h2 class="heading-title">Exceed Your Social Media Goals</h2>
                  <div class="heading-description fs-16">
                    Welcome to Boost Yard — the platform designed to help you
                    grow faster, reach more people, and strengthen your social
                    influence. Experience premium, reliable, and tailored
                    boosting solutions built to deliver real results.
                  </div>
                </div>
                <div class="row gy-3 mb-0">
                  <div class="col-xl-12">
                    <div class="d-flex align-items-top">
                      <div class="me-2 home-prove-svg">
                        <i
                          class="ri-checkbox-circle-line align-middle fs-16 text-primary d-inline-block"
                        ></i>
                      </div>
                      <div>
                        <span class="fs-15">
                          Trusted expertise in social media growth and digital
                          influence.
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-12">
                    <div class="d-flex align-items-top">
                      <div class="me-2 home-prove-svg">
                        <i
                          class="ri-checkbox-circle-line align-middle fs-16 text-primary d-inline-block"
                        ></i>
                      </div>
                      <div>
                        <span class="fs-15">
                          A dedicated team focused on delivering fast and
                          effective boost services.
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-12">
                    <div class="d-flex align-items-top">
                      <div class="me-2 home-prove-svg">
                        <i
                          class="ri-checkbox-circle-line align-middle fs-16 text-primary d-inline-block"
                        ></i>
                      </div>
                      <div>
                        <span class="fs-15">
                          Personalized boosting options tailored to each user’s
                          social needs.
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-12">
                    <div class="d-flex align-items-top">
                      <div class="me-2 home-prove-svg">
                        <i
                          class="ri-checkbox-circle-line align-middle fs-16 text-primary d-inline-block"
                        ></i>
                      </div>
                      <div>
                        <span class="fs-15">
                          Smooth and stress-free order process — quick, simple,
                          and convenient.
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-12">
                    <div class="d-flex align-items-top">
                      <div class="me-2 home-prove-svg">
                        <i
                          class="ri-checkbox-circle-line align-middle fs-16 text-primary d-inline-block"
                        ></i>
                      </div>
                      <div>
                        <span class="fs-15">
                          24/7 customer support ready to assist you any day,
                          anytime.
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- End:: Section-4 -->
        <!-- Start:: Section-5 -->

        <!-- End:: Section-5 -->
        <!-- Start:: Section-6 -->
        <section class="section section-bg" id="workflow">
          <div class="container">
            <div class="text-center">
              <p class="fs-12 fw-medium text-success mb-1">
                <span class="landing-section-heading text-gradient"
                  >BOOST YARD PROCESS</span
                >
              </p>
              <h3 class="fw-medium mb-2">
                How We Boost Your Social Media Influence
              </h3>
              <div class="row justify-content-center">
                <div class="col-xl-7">
                  <p class="text-muted fs-15 mb-5 fw-normal">
                    Our process begins as soon as you schedule a boost with us,
                    ensuring every step enhances your social media presence.
                  </p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-4">
                <div class="px-3">
                  <div class="card custom-card landing-card mb-5">
                    <div class="card-body">
                      <div class="mb-4">
                        <span class="svg-gradient mx-auto svg-container">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 32 32"
                            id="Finance"
                          >
                            <path
                              fill="#b94eed"
                              style="
                                line-height: normal;
                                text-indent: 0;
                                text-align: start;
                                text-decoration-line: none;
                                text-decoration-style: solid;
                                text-decoration-color: #000;
                                text-transform: none;
                                white-space: normal;
                                isolation: auto;
                                mix-blend-mode: normal;
                              "
                              d="M-432.873 1359.588a.5.5 0 0 0-.227.059l-8.212 4.355.468.885 7.772-4.123 2.746 5.18.883-.469-2.98-5.621a.5.5 0 0 0-.45-.266z"
                              color="#000"
                              transform="translate(456.5 -1353.371)"
                              class="color2b79c2 svgShape"
                            ></path>
                            <path
                              fill="#b94eed"
                              style="
                                line-height: normal;
                                text-indent: 0;
                                text-align: start;
                                text-decoration-line: none;
                                text-decoration-style: solid;
                                text-decoration-color: #000;
                                text-transform: none;
                                white-space: normal;
                                isolation: auto;
                                mix-blend-mode: normal;
                              "
                              d="M-436.693 1357.387a.5.5 0 0 0-.346.144l-4.941 4.94.707.709 4.587-4.586 2.403 2.402.707-.707-2.756-2.756a.5.5 0 0 0-.361-.146z"
                              color="#000"
                              transform="translate(456.5 -1353.371)"
                              class="color2b79c2 svgShape"
                            ></path>
                            <path
                              style="
                                line-height: normal;
                                text-indent: 0;
                                text-align: start;
                                text-decoration-line: none;
                                text-decoration-style: solid;
                                text-decoration-color: #000;
                                text-transform: none;
                                white-space: normal;
                                isolation: auto;
                                mix-blend-mode: normal;
                              "
                              d="M-440.936 1365.371v1h11.436c.563 0 1 .437 1 1v13c0 .563-.437 1-1 1h-19c-.563 0-1-.437-1-1v-10.76h-1v10.76c0 1.1.9 2 2 2h19c1.1 0 2-.9 2-2v-13c0-1.1-.9-2-2-2h-11.436z"
                              color="#000"
                              transform="translate(456.5 -1353.371)"
                              fill="#6a4eed"
                              class="color000000 svgShape"
                            ></path>
                            <path
                              style="isolation: auto; mix-blend-mode: normal"
                              d="M-440.5 1367.37h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm0 2h1v1h-1zm0 8h1v1h-1zm0 2h1v1h-1zm-2 0h1v1h-1zm-16-8h1v1h-1zm0 2h1v1h-1zm0 2h1v1h-1zm0 2h1v1h-1zm0 2h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1z"
                              color="#000"
                              transform="translate(456.5 -1353.371)"
                              fill="#6a4eed"
                              class="color000000 svgShape"
                            ></path>
                            <path
                              style="
                                line-height: normal;
                                text-indent: 0;
                                text-align: start;
                                text-decoration-line: none;
                                text-decoration-style: solid;
                                text-decoration-color: #000;
                                text-transform: none;
                                white-space: normal;
                                isolation: auto;
                                mix-blend-mode: normal;
                              "
                              d="M-434 1371.371a2.506 2.506 0 0 0-2.5 2.5c0 1.376 1.124 2.5 2.5 2.5h6a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-.5-.5h-6zm0 1h5.5v3h-5.5c-.84 0-1.5-.66-1.5-1.5s.66-1.5 1.5-1.5z"
                              color="#000"
                              transform="translate(456.5 -1353.371)"
                              fill="#6a4eed"
                              class="color000000 svgShape"
                            ></path>
                            <path
                              style="isolation: auto; mix-blend-mode: normal"
                              d="M-434.5 1373.37h1v1h-1z"
                              color="#000"
                              transform="translate(456.5 -1353.371)"
                              fill="#6a4eed"
                              class="color000000 svgShape"
                            ></path>
                            <path
                              fill="#b94eed"
                              style="
                                line-height: normal;
                                text-indent: 0;
                                text-align: start;
                                text-decoration-line: none;
                                text-decoration-style: solid;
                                text-decoration-color: #000;
                                text-transform: none;
                                white-space: normal;
                                isolation: auto;
                                mix-blend-mode: normal;
                              "
                              d="M-446.5 1359.37c-3.308 0-6 2.691-6 6 0 3.307 2.692 6 6 6s6-2.693 6-6c0-3.309-2.692-6-6-6zm0 1c2.767 0 5 2.232 5 5 0 2.766-2.233 5-5 5s-5-2.234-5-5c0-2.768 2.233-5 5-5z"
                              color="#000"
                              transform="translate(456.5 -1353.371)"
                              class="color2b79c2 svgShape"
                            ></path>
                            <path
                              fill="#b94eed"
                              d="M11.21 13.538q0-.19-.066-.35-.066-.16-.216-.299-.144-.139-.383-.256-.233-.118-.566-.228-.443-.122-.799-.282-.349-.164-.599-.383-.244-.219-.377-.505-.127-.287-.127-.661 0-.346.11-.632.117-.286.328-.497.216-.21.521-.345.305-.135.683-.181v-.926h.782v.93q.776.105 1.198.602.427.493.427 1.348h-.97q0-.283-.073-.518-.066-.236-.2-.409-.133-.172-.332-.27-.2-.096-.455-.096-.266 0-.46.071-.195.072-.328.203-.127.126-.194.307-.061.18-.061.4 0 .202.061.366.067.16.216.295.15.135.389.257.244.118.599.231.455.13.804.295.35.16.588.375.239.215.36.497.123.282.123.652 0 .362-.128.653-.128.286-.36.497-.233.21-.566.337-.333.126-.75.168v.808h-.77v-.808q-.35-.037-.677-.156-.327-.118-.582-.34-.25-.224-.4-.56-.15-.342-.15-.818h.977q0 .358.105.594t.277.375q.172.139.383.193.211.055.422.055.294 0 .521-.067.233-.071.388-.198.161-.13.245-.311.083-.185.083-.413z"
                              class="color2b79c2 svgShape"
                            ></path>
                          </svg>
                        </span>
                      </div>
                      <h4 class="fw-medium">Maximize Efficiency</h4>
                      <div class="mb-0">
                        <span class="fs-15 text-muted">
                          Our workflow is designed to get your social media
                          tasks done quickly, boosting your online visibility
                          efficiently.
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                    <span
                      class="avatar avatar-md avatar-rounded bg-primary-transparent text-primary fw-medium border-0 workflow-bottom-design"
                      >01</span
                    >
                  </div>
                </div>
              </div>
              <div class="col-xl-4">
                <div class="px-3">
                  <div class="text-center mb-5">
                    <span
                      class="avatar avatar-md avatar-rounded bg-primary-transparent text-primary fw-medium border-0 workflow-top-design"
                      >02</span
                    >
                  </div>
                  <div class="card custom-card landing-card">
                    <div class="card-body">
                      <div class="mb-4">
                        <span class="svg-gradient mx-auto svg-container">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 32 32"
                            id="Finance"
                          >
                            <path
                              fill="#b94eed"
                              style="
                                line-height: normal;
                                text-indent: 0;
                                text-align: start;
                                text-decoration-line: none;
                                text-decoration-style: solid;
                                text-decoration-color: #000;
                                text-transform: none;
                                white-space: normal;
                                isolation: auto;
                                mix-blend-mode: normal;
                              "
                              d="M-432.873 1359.588a.5.5 0 0 0-.227.059l-8.212 4.355.468.885 7.772-4.123 2.746 5.18.883-.469-2.98-5.621a.5.5 0 0 0-.45-.266z"
                              color="#000"
                              transform="translate(456.5 -1353.371)"
                              class="color2b79c2 svgShape"
                            ></path>
                            <path
                              fill="#b94eed"
                              style="
                                line-height: normal;
                                text-indent: 0;
                                text-align: start;
                                text-decoration-line: none;
                                text-decoration-style: solid;
                                text-decoration-color: #000;
                                text-transform: none;
                                white-space: normal;
                                isolation: auto;
                                mix-blend-mode: normal;
                              "
                              d="M-436.693 1357.387a.5.5 0 0 0-.346.144l-4.941 4.94.707.709 4.587-4.586 2.403 2.402.707-.707-2.756-2.756a.5.5 0 0 0-.361-.146z"
                              color="#000"
                              transform="translate(456.5 -1353.371)"
                              class="color2b79c2 svgShape"
                            ></path>
                            <path
                              style="
                                line-height: normal;
                                text-indent: 0;
                                text-align: start;
                                text-decoration-line: none;
                                text-decoration-style: solid;
                                text-decoration-color: #000;
                                text-transform: none;
                                white-space: normal;
                                isolation: auto;
                                mix-blend-mode: normal;
                              "
                              d="M-440.936 1365.371v1h11.436c.563 0 1 .437 1 1v13c0 .563-.437 1-1 1h-19c-.563 0-1-.437-1-1v-10.76h-1v10.76c0 1.1.9 2 2 2h19c1.1 0 2-.9 2-2v-13c0-1.1-.9-2-2-2h-11.436z"
                              color="#000"
                              transform="translate(456.5 -1353.371)"
                              fill="#6a4eed"
                              class="color000000 svgShape"
                            ></path>
                            <path
                              style="isolation: auto; mix-blend-mode: normal"
                              d="M-440.5 1367.37h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm0 2h1v1h-1zm0 8h1v1h-1zm0 2h1v1h-1zm-2 0h1v1h-1zm-16-8h1v1h-1zm0 2h1v1h-1zm0 2h1v1h-1zm0 2h1v1h-1zm0 2h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1z"
                              color="#000"
                              transform="translate(456.5 -1353.371)"
                              fill="#6a4eed"
                              class="color000000 svgShape"
                            ></path>
                            <path
                              style="
                                line-height: normal;
                                text-indent: 0;
                                text-align: start;
                                text-decoration-line: none;
                                text-decoration-style: solid;
                                text-decoration-color: #000;
                                text-transform: none;
                                white-space: normal;
                                isolation: auto;
                                mix-blend-mode: normal;
                              "
                              d="M-434 1371.371a2.506 2.506 0 0 0-2.5 2.5c0 1.376 1.124 2.5 2.5 2.5h6a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-.5-.5h-6zm0 1h5.5v3h-5.5c-.84 0-1.5-.66-1.5-1.5s.66-1.5 1.5-1.5z"
                              color="#000"
                              transform="translate(456.5 -1353.371)"
                              fill="#6a4eed"
                              class="color000000 svgShape"
                            ></path>
                            <path
                              style="isolation: auto; mix-blend-mode: normal"
                              d="M-434.5 1373.37h1v1h-1z"
                              color="#000"
                              transform="translate(456.5 -1353.371)"
                              fill="#6a4eed"
                              class="color000000 svgShape"
                            ></path>
                            <path
                              fill="#b94eed"
                              style="
                                line-height: normal;
                                text-indent: 0;
                                text-align: start;
                                text-decoration-line: none;
                                text-decoration-style: solid;
                                text-decoration-color: #000;
                                text-transform: none;
                                white-space: normal;
                                isolation: auto;
                                mix-blend-mode: normal;
                              "
                              d="M-446.5 1359.37c-3.308 0-6 2.691-6 6 0 3.307 2.692 6 6 6s6-2.693 6-6c0-3.309-2.692-6-6-6zm0 1c2.767 0 5 2.232 5 5 0 2.766-2.233 5-5 5s-5-2.234-5-5c0-2.768 2.233-5 5-5z"
                              color="#000"
                              transform="translate(456.5 -1353.371)"
                              class="color2b79c2 svgShape"
                            ></path>
                            <path
                              fill="#b94eed"
                              d="M11.21 13.538q0-.19-.066-.35-.066-.16-.216-.299-.144-.139-.383-.256-.233-.118-.566-.228-.443-.122-.799-.282-.349-.164-.599-.383-.244-.219-.377-.505-.127-.287-.127-.661 0-.346.11-.632.117-.286.328-.497.216-.21.521-.345.305-.135.683-.181v-.926h.782v.93q.776.105 1.198.602.427.493.427 1.348h-.97q0-.283-.073-.518-.066-.236-.2-.409-.133-.172-.332-.27-.2-.096-.455-.096-.266 0-.46.071-.195.072-.328.203-.127.126-.194.307-.061.18-.061.4 0 .202.061.366.067.16.216.295.15.135.389.257.244.118.599.231.455.13.804.295.35.16.588.375.239.215.36.497.123.282.123.652 0 .362-.128.653-.128.286-.36.497-.233.21-.566.337-.333.126-.75.168v.808h-.77v-.808q-.35-.037-.677-.156-.327-.118-.582-.34-.25-.224-.4-.56-.15-.342-.15-.818h.977q0 .358.105.594t.277.375q.172.139.383.193.211.055.422.055.294 0 .521-.067.233-.071.388-.198.161-.13.245-.311.083-.185.083-.413z"
                              class="color2b79c2 svgShape"
                            ></path>
                          </svg>
                        </span>
                      </div>
                      <h4 class="fw-medium">Flexible Boosting</h4>
                      <div class="mb-0">
                        <span class="fs-15 text-muted">
                          Our approach adapts to your social media needs,
                          responding to trends and opportunities for maximum
                          influence.
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4">
                <div class="px-3">
                  <div class="card custom-card landing-card mb-5">
                    <div class="card-body">
                      <div class="mb-4">
                        <span class="svg-gradient mx-auto svg-container">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 32 32"
                            id="Finance"
                          >
                            <path
                              fill="#b94eed"
                              style="
                                line-height: normal;
                                text-indent: 0;
                                text-align: start;
                                text-decoration-line: none;
                                text-decoration-style: solid;
                                text-decoration-color: #000;
                                text-transform: none;
                                white-space: normal;
                                isolation: auto;
                                mix-blend-mode: normal;
                              "
                              d="M-432.873 1359.588a.5.5 0 0 0-.227.059l-8.212 4.355.468.885 7.772-4.123 2.746 5.18.883-.469-2.98-5.621a.5.5 0 0 0-.45-.266z"
                              color="#000"
                              transform="translate(456.5 -1353.371)"
                              class="color2b79c2 svgShape"
                            ></path>
                            <path
                              fill="#b94eed"
                              style="
                                line-height: normal;
                                text-indent: 0;
                                text-align: start;
                                text-decoration-line: none;
                                text-decoration-style: solid;
                                text-decoration-color: #000;
                                text-transform: none;
                                white-space: normal;
                                isolation: auto;
                                mix-blend-mode: normal;
                              "
                              d="M-436.693 1357.387a.5.5 0 0 0-.346.144l-4.941 4.94.707.709 4.587-4.586 2.403 2.402.707-.707-2.756-2.756a.5.5 0 0 0-.361-.146z"
                              color="#000"
                              transform="translate(456.5 -1353.371)"
                              class="color2b79c2 svgShape"
                            ></path>
                            <path
                              style="
                                line-height: normal;
                                text-indent: 0;
                                text-align: start;
                                text-decoration-line: none;
                                text-decoration-style: solid;
                                text-decoration-color: #000;
                                text-transform: none;
                                white-space: normal;
                                isolation: auto;
                                mix-blend-mode: normal;
                              "
                              d="M-440.936 1365.371v1h11.436c.563 0 1 .437 1 1v13c0 .563-.437 1-1 1h-19c-.563 0-1-.437-1-1v-10.76h-1v10.76c0 1.1.9 2 2 2h19c1.1 0 2-.9 2-2v-13c0-1.1-.9-2-2-2h-11.436z"
                              color="#000"
                              transform="translate(456.5 -1353.371)"
                              fill="#6a4eed"
                              class="color000000 svgShape"
                            ></path>
                            <path
                              style="isolation: auto; mix-blend-mode: normal"
                              d="M-440.5 1367.37h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm0 2h1v1h-1zm0 8h1v1h-1zm0 2h1v1h-1zm-2 0h1v1h-1zm-16-8h1v1h-1zm0 2h1v1h-1zm0 2h1v1h-1zm0 2h1v1h-1zm0 2h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1zm2 0h1v1h-1z"
                              color="#000"
                              transform="translate(456.5 -1353.371)"
                              fill="#6a4eed"
                              class="color000000 svgShape"
                            ></path>
                            <path
                              style="
                                line-height: normal;
                                text-indent: 0;
                                text-align: start;
                                text-decoration-line: none;
                                text-decoration-style: solid;
                                text-decoration-color: #000;
                                text-transform: none;
                                white-space: normal;
                                isolation: auto;
                                mix-blend-mode: normal;
                              "
                              d="M-434 1371.371a2.506 2.506 0 0 0-2.5 2.5c0 1.376 1.124 2.5 2.5 2.5h6a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-.5-.5h-6zm0 1h5.5v3h-5.5c-.84 0-1.5-.66-1.5-1.5s.66-1.5 1.5-1.5z"
                              color="#000"
                              transform="translate(456.5 -1353.371)"
                              fill="#6a4eed"
                              class="color000000 svgShape"
                            ></path>
                            <path
                              style="isolation: auto; mix-blend-mode: normal"
                              d="M-434.5 1373.37h1v1h-1z"
                              color="#000"
                              transform="translate(456.5 -1353.371)"
                              fill="#6a4eed"
                              class="color000000 svgShape"
                            ></path>
                            <path
                              fill="#b94eed"
                              style="
                                line-height: normal;
                                text-indent: 0;
                                text-align: start;
                                text-decoration-line: none;
                                text-decoration-style: solid;
                                text-decoration-color: #000;
                                text-transform: none;
                                white-space: normal;
                                isolation: auto;
                                mix-blend-mode: normal;
                              "
                              d="M-446.5 1359.37c-3.308 0-6 2.691-6 6 0 3.307 2.692 6 6 6s6-2.693 6-6c0-3.309-2.692-6-6-6zm0 1c2.767 0 5 2.232 5 5 0 2.766-2.233 5-5 5s-5-2.234-5-5c0-2.768 2.233-5 5-5z"
                              color="#000"
                              transform="translate(456.5 -1353.371)"
                              class="color2b79c2 svgShape"
                            ></path>
                            <path
                              fill="#b94eed"
                              d="M11.21 13.538q0-.19-.066-.35-.066-.16-.216-.299-.144-.139-.383-.256-.233-.118-.566-.228-.443-.122-.799-.282-.349-.164-.599-.383-.244-.219-.377-.505-.127-.287-.127-.661 0-.346.11-.632.117-.286.328-.497.216-.21.521-.345.305-.135.683-.181v-.926h.782v.93q.776.105 1.198.602.427.493.427 1.348h-.97q0-.283-.073-.518-.066-.236-.2-.409-.133-.172-.332-.27-.2-.096-.455-.096-.266 0-.46.071-.195.072-.328.203-.127.126-.194.307-.061.18-.061.4 0 .202.061.366.067.16.216.295.15.135.389.257.244.118.599.231.455.13.804.295.35.16.588.375.239.215.36.497.123.282.123.652 0 .362-.128.653-.128.286-.36.497-.233.21-.566.337-.333.126-.75.168v.808h-.77v-.808q-.35-.037-.677-.156-.327-.118-.582-.34-.25-.224-.4-.56-.15-.342-.15-.818h.977q0 .358.105.594t.277.375q.172.139.383.193.211.055.422.055.294 0 .521-.067.233-.071.388-.198.161-.13.245-.311.083-.185.083-.413z"
                              class="color2b79c2 svgShape"
                            ></path>
                          </svg>
                        </span>
                      </div>
                      <h4 class="fw-medium">Quality Engagement</h4>
                      <div class="mb-0">
                        <span class="fs-15 text-muted">
                          We ensure every boost delivers authentic engagement
                          and high-quality interactions to grow your influence.
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                    <span
                      class="avatar avatar-md avatar-rounded bg-primary-transparent text-primary fw-medium border-0 workflow-bottom-design"
                      >03</span
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- End:: Section-6 -->
        <!-- Start:: Section-7 -->

        <!-- End:: Section-7 -->
        <!-- Start:: Section-8 -->
        <section class="section section-bg" id="team">
          <div class="container">
            <div class="text-center">
              <p class="fs-12 fw-medium text-success mb-1">
                <span class="landing-section-heading text-gradient">TEAM</span>
              </p>
              <h3 class="fw-medium mb-2">
                The people who make our organization Successful
              </h3>
              <div class="row justify-content-center">
                <div class="col-xl-7">
                  <p class="text-muted fs-15 mb-5 fw-normal">
                    Our team is made up of real people who are passionate about
                    what they do.
                  </p>
                </div>
              </div>
            </div>
            <div class="row">
              <div
                class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 mb-lg-0 mb-4"
              >
                <div class="card custom-card overlay-card team-card reveal">
                  <img
                    src="<?php echo $domain ?>assets/images/media/landing/team/1.png"
                    class="card-img"
                    alt="..."
                  />
                  <div
                    class="card-img-overlay d-flex flex-column p-0 over-content-bottom"
                  >
                    <div class="card-body"></div>
                  </div>
                </div>
                <div class="text-center">
                  <h5 class="mb-0">Joseph Aniston</h5>
                  <p class="mb-0 fs-15">Director</p>
                  <div class="d-flex justify-content-center mt-3">
                    <a
                      aria-label="anchor"
                      href="javascript:void(0);"
                      class="btn btn-icon btn-pil btn-primary-light"
                      ><i class="bx bxl-twitter"></i
                    ></a>
                    <a
                      aria-label="anchor"
                      href="javascript:void(0);"
                      class="btn btn-icon btn-pil btn-primary-light ms-2"
                      ><i class="bx bxl-facebook"></i
                    ></a>
                    <a
                      aria-label="anchor"
                      href="javascript:void(0);"
                      class="btn btn-icon btn-pil btn-primary-light ms-2"
                      ><i class="bx bxl-instagram"></i
                    ></a>
                    <a
                      aria-label="anchor"
                      href="javascript:void(0);"
                      class="btn btn-icon btn-pil btn-primary-light ms-2"
                      ><i class="bx bxl-linkedin"></i
                    ></a>
                  </div>
                </div>
              </div>
              <div
                class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 mb-lg-0 mb-4"
              >
                <div class="card custom-card overlay-card team-card reveal">
                  <img
                    src="<?php echo $domain ?>assets/images/media/landing/team/2.png"
                    class="card-img"
                    alt="..."
                  />
                  <div
                    class="card-img-overlay d-flex flex-column p-0 over-content-bottom"
                  >
                    <div class="card-body"></div>
                  </div>
                </div>
                <div class="text-center">
                  <h5 class="mb-0">Luke Harper</h5>
                  <p class="mb-0 fs-15">Manager</p>
                  <div class="d-flex justify-content-center mt-3">
                    <a
                      aria-label="anchor"
                      href="javascript:void(0);"
                      class="btn btn-icon btn-pil btn-primary-light"
                      ><i class="bx bxl-twitter"></i
                    ></a>
                    <a
                      aria-label="anchor"
                      href="javascript:void(0);"
                      class="btn btn-icon btn-pil btn-primary-light ms-2"
                      ><i class="bx bxl-facebook"></i
                    ></a>
                    <a
                      aria-label="anchor"
                      href="javascript:void(0);"
                      class="btn btn-icon btn-pil btn-primary-light ms-2"
                      ><i class="bx bxl-instagram"></i
                    ></a>
                    <a
                      aria-label="anchor"
                      href="javascript:void(0);"
                      class="btn btn-icon btn-pil btn-primary-light ms-2"
                      ><i class="bx bxl-linkedin"></i
                    ></a>
                  </div>
                </div>
              </div>
              <div
                class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 mb-lg-0 mb-4"
              >
                <div class="card custom-card overlay-card team-card reveal">
                  <img
                    src="<?php echo $domain ?>assets/images/media/landing/team/3.png"
                    class="card-img"
                    alt="..."
                  />
                  <div
                    class="card-img-overlay d-flex flex-column p-0 over-content-bottom"
                  >
                    <div class="card-body"></div>
                  </div>
                </div>
                <div class="text-center">
                  <h5 class="mb-0">Melissa Queen</h5>
                  <p class="mb-0 fs-15">Creative Director</p>
                  <div class="d-flex justify-content-center mt-3">
                    <a
                      aria-label="anchor"
                      href="javascript:void(0);"
                      class="btn btn-icon btn-pil btn-primary-light"
                      ><i class="bx bxl-twitter"></i
                    ></a>
                    <a
                      aria-label="anchor"
                      href="javascript:void(0);"
                      class="btn btn-icon btn-pil btn-primary-light ms-2"
                      ><i class="bx bxl-facebook"></i
                    ></a>
                    <a
                      aria-label="anchor"
                      href="javascript:void(0);"
                      class="btn btn-icon btn-pil btn-primary-light ms-2"
                      ><i class="bx bxl-instagram"></i
                    ></a>
                    <a
                      aria-label="anchor"
                      href="javascript:void(0);"
                      class="btn btn-icon btn-pil btn-primary-light ms-2"
                      ><i class="bx bxl-linkedin"></i
                    ></a>
                  </div>
                </div>
              </div>
              <div
                class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 mb-lg-0 mb-4"
              >
                <div class="card custom-card overlay-card team-card reveal">
                  <img
                    src="<?php echo $domain ?>assets/images/media/landing/team/4.png"
                    class="card-img"
                    alt="..."
                  />
                  <div
                    class="card-img-overlay d-flex flex-column p-0 over-content-bottom"
                  >
                    <div class="card-body"></div>
                  </div>
                </div>
                <div class="text-center">
                  <h5 class="mb-0">Teressa Smith</h5>
                  <p class="mb-0 fs-15">Board Director</p>
                  <div class="d-flex justify-content-center mt-3">
                    <a
                      aria-label="anchor"
                      href="javascript:void(0);"
                      class="btn btn-icon btn-pil btn-primary-light"
                      ><i class="bx bxl-twitter"></i
                    ></a>
                    <a
                      aria-label="anchor"
                      href="javascript:void(0);"
                      class="btn btn-icon btn-pil btn-primary-light ms-2"
                      ><i class="bx bxl-facebook"></i
                    ></a>
                    <a
                      aria-label="anchor"
                      href="javascript:void(0);"
                      class="btn btn-icon btn-pil btn-primary-light ms-2"
                      ><i class="bx bxl-instagram"></i
                    ></a>
                    <a
                      aria-label="anchor"
                      href="javascript:void(0);"
                      class="btn btn-icon btn-pil btn-primary-light ms-2"
                      ><i class="bx bxl-linkedin"></i
                    ></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End:: Section-8 -->
        <!-- Start:: Section-9 -->
        <section class="section" id="faqs">
          <div class="container text-center">
            <p class="fs-12 fw-medium text-success mb-1">
              <span class="landing-section-heading text-gradient">F.A.Q</span>
            </p>
            <h3 class="fw-medium mb-2">Frequently Asked Questions</h3>
            <div class="row justify-content-center">
              <div class="col-xl-7">
                <p class="text-muted fs-15 mb-5 fw-normal">
                  Here are some of the most common questions about Boost Yard
                  and how to boost your social media accounts effectively.
                </p>
              </div>
            </div>
            <div class="row text-start">
              <div class="col-xl-12">
                <div class="row gy-2">
                  <div class="col-xl-6">
                    <div
                      class="accordion accordion-customicon1 accordion-primary accordions-items-seperate"
                      id="accordionFAQ1"
                    >
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingcustomicon1One">
                          <button
                            class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapsecustomicon1One"
                            aria-expanded="true"
                            aria-controls="collapsecustomicon1One"
                          >
                            How do I boost my Instagram account with Boost Yard?
                          </button>
                        </h2>
                        <div
                          id="collapsecustomicon1One"
                          class="accordion-collapse collapse show"
                          aria-labelledby="headingcustomicon1One"
                          data-bs-parent="#accordionFAQ1"
                        >
                          <div class="accordion-body">
                            With Boost Yard, you can increase your Instagram
                            engagement by selecting your desired boost package
                            and following the simple steps. Your growth is
                            organic and safe.
                          </div>
                        </div>
                      </div>

                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingcustomicon1Two">
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapsecustomicon1Two"
                            aria-expanded="false"
                            aria-controls="collapsecustomicon1Two"
                          >
                            Can I boost multiple social media accounts at the
                            same time?
                          </button>
                        </h2>
                        <div
                          id="collapsecustomicon1Two"
                          class="accordion-collapse collapse"
                          aria-labelledby="headingcustomicon1Two"
                          data-bs-parent="#accordionFAQ1"
                        >
                          <div class="accordion-body">
                            Yes! Boost Yard allows you to manage and boost
                            multiple accounts across Instagram, TikTok, and
                            Facebook simultaneously, all from a single
                            dashboard.
                          </div>
                        </div>
                      </div>

                      <div class="accordion-item">
                        <h2
                          class="accordion-header"
                          id="headingcustomicon1Three"
                        >
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapsecustomicon1Three"
                            aria-expanded="false"
                            aria-controls="collapsecustomicon1Three"
                          >
                            Is Boost Yard safe to use?
                          </button>
                        </h2>
                        <div
                          id="collapsecustomicon1Three"
                          class="accordion-collapse collapse"
                          aria-labelledby="headingcustomicon1Three"
                          data-bs-parent="#accordionFAQ1"
                        >
                          <div class="accordion-body">
                            Absolutely! Boost Yard uses safe and secure methods
                            to boost your social media, ensuring your accounts
                            remain compliant with platform guidelines.
                          </div>
                        </div>
                      </div>

                      <div class="accordion-item">
                        <h2
                          class="accordion-header"
                          id="headingcustomicon1Four"
                        >
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapsecustomicon1Four"
                            aria-expanded="false"
                            aria-controls="collapsecustomicon1Four"
                          >
                            How quickly will I see results?
                          </button>
                        </h2>
                        <div
                          id="collapsecustomicon1Four"
                          class="accordion-collapse collapse"
                          aria-labelledby="headingcustomicon1Four"
                          data-bs-parent="#accordionFAQ1"
                        >
                          <div class="accordion-body">
                            Most Boost Yard packages start showing results
                            within 24-48 hours, but full effects depend on the
                            package and your account activity.
                          </div>
                        </div>
                      </div>

                      <div class="accordion-item">
                        <h2
                          class="accordion-header"
                          id="headingcustomicon1Five"
                        >
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapsecustomicon1Five"
                            aria-expanded="false"
                            aria-controls="collapsecustomicon1Five"
                          >
                            Can I cancel a boost or get a refund?
                          </button>
                        </h2>
                        <div
                          id="collapsecustomicon1Five"
                          class="accordion-collapse collapse"
                          aria-labelledby="headingcustomicon1Five"
                          data-bs-parent="#accordionFAQ1"
                        >
                          <div class="accordion-body">
                            Boost Yard offers refunds in certain cases according
                            to our refund policy. Please check the terms before
                            purchasing a package.
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-6">
                    <div
                      class="accordion accordion-customicon1 accordion-primary accordions-items-seperate"
                      id="accordionFAQ2"
                    >
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingcustomicon2One">
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapsecustomicon2One"
                            aria-expanded="true"
                            aria-controls="collapsecustomicon2One"
                          >
                            What social media platforms does Boost Yard support?
                          </button>
                        </h2>
                        <div
                          id="collapsecustomicon2One"
                          class="accordion-collapse collapse"
                          aria-labelledby="headingcustomicon2One"
                          data-bs-parent="#accordionFAQ2"
                        >
                          <div class="accordion-body">
                            Boost Yard supports Instagram, TikTok, Facebook, and
                            Twitter. We are continuously adding more platforms.
                          </div>
                        </div>
                      </div>

                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingcustomicon2Two">
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapsecustomicon2Two"
                            aria-expanded="false"
                            aria-controls="collapsecustomicon2Two"
                          >
                            Do I need an account to use Boost Yard?
                          </button>
                        </h2>
                        <div
                          id="collapsecustomicon2Two"
                          class="accordion-collapse collapse"
                          aria-labelledby="headingcustomicon2Two"
                          data-bs-parent="#accordionFAQ2"
                        >
                          <div class="accordion-body">
                            Yes, you need to create an account to manage boosts
                            and track your progress. Registration is quick and
                            free.
                          </div>
                        </div>
                      </div>

                      <div class="accordion-item">
                        <h2
                          class="accordion-header"
                          id="headingcustomicon2Three"
                        >
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapsecustomicon2Three"
                            aria-expanded="false"
                            aria-controls="collapsecustomicon2Three"
                          >
                            How can I pay for a boost?
                          </button>
                        </h2>
                        <div
                          id="collapsecustomicon2Three"
                          class="accordion-collapse collapse"
                          aria-labelledby="headingcustomicon2Three"
                          data-bs-parent="#accordionFAQ2"
                        >
                          <div class="accordion-body">
                            Boost Yard accepts payments via credit/debit card,
                            PayPal, and crypto. Your payment is secure and
                            instant.
                          </div>
                        </div>
                      </div>

                      <div class="accordion-item">
                        <h2
                          class="accordion-header"
                          id="headingcustomicon2Four"
                        >
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapsecustomicon2Four"
                            aria-expanded="false"
                            aria-controls="collapsecustomicon2Four"
                          >
                            Can I track the progress of my boosts?
                          </button>
                        </h2>
                        <div
                          id="collapsecustomicon2Four"
                          class="accordion-collapse collapse"
                          aria-labelledby="headingcustomicon2Four"
                          data-bs-parent="#accordionFAQ2"
                        >
                          <div class="accordion-body">
                            Yes! Boost Yard provides real-time analytics so you
                            can monitor likes, followers, and engagement on your
                            boosted posts.
                          </div>
                        </div>
                      </div>

                      <div class="accordion-item">
                        <h2
                          class="accordion-header"
                          id="headingcustomicon2Five"
                        >
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapsecustomicon2Five"
                            aria-expanded="false"
                            aria-controls="collapsecustomicon2Five"
                          >
                            Is customer support available?
                          </button>
                        </h2>
                        <div
                          id="collapsecustomicon2Five"
                          class="accordion-collapse collapse"
                          aria-labelledby="headingcustomicon2Five"
                          data-bs-parent="#accordionFAQ2"
                        >
                          <div class="accordion-body">
                            Yes! Boost Yard offers 24/7 support through live
                            chat, email, and helpdesk to ensure you have
                            assistance whenever needed.
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- End:: Section-9 -->
        <!-- Start:: Section-10 -->

        <!-- End:: Section-10 -->
        <!-- Start:: Section-11 -->
        <section class="section" id="contact">
          <div class="container text-center">
            <p class="fs-12 fw-medium text-success mb-1">
              <span class="landing-section-heading">CONTACT US</span>
            </p>
            <h3 class="fw-medium mb-2">
              Have any questions about Boost Yard? We would love to help you
              grow your social media accounts.
            </h3>
            <div class="row justify-content-center">
              <div class="col-xl-9">
                <p class="text-muted fs-15 mb-5 fw-normal">
                  Reach out to us anytime for questions about Boost Yard
                  packages, account setup, or social media boosting tips. We're
                  here to ensure your experience is smooth and successful.
                </p>
              </div>
            </div>
            <div class="row text-start">
              <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div
                  class="card custom-card border shadow-none overflow-hidden"
                >
                  <div class="card-body p-0">
                    <iframe
                      src="https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d30444.274596168965!2d78.54114692513858!3d17.48198883339408!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e6!4m3!3m2!1d17.4886524!2d78.5495041!4m5!1s0x3bcb9c7ec139a15d%3A0x326d1c90786b2ab6!2sspruko%20technologies!3m2!1d17.474805099999998!2d78.570258!5e0!3m2!1sen!2sin!4v1670225507254!5m2!1sen!2sin"
                      height="380"
                      style="border: 0; width: 100%"
                      allowfullscreen=""
                      loading="lazy"
                      referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                  </div>
                </div>
              </div>
              <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div
                  class="card custom-card overflow-hidden section-bg border shadow-none"
                >
                  <div class="card-body">
                    <div class="row gy-3 mt-2 px-3">
                      <div class="col-xl-6">
                        <div class="row gy-3">
                          <div class="col-xl-12">
                            <label for="contact-address-name" class="form-label"
                              >Full Name :</label
                            >
                            <input
                              type="text"
                              class="form-control"
                              id="contact-address-name"
                              placeholder="Enter Your Name"
                            />
                          </div>
                          <div class="col-xl-12">
                            <label
                              for="contact-address-phone"
                              class="form-label"
                              >Phone No :</label
                            >
                            <input
                              type="text"
                              class="form-control"
                              id="contact-address-phone"
                              placeholder="Enter Phone Number"
                            />
                          </div>
                          <div class="col-xl-12">
                            <label
                              for="contact-address-address"
                              class="form-label"
                              >Boost Yard Account Link :</label
                            >
                            <textarea
                              class="form-control"
                              id="contact-address-address"
                              rows="1"
                              placeholder="Paste your social media profile link"
                            ></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-6">
                        <label for="contact-address-message" class="form-label"
                          >Message :</label
                        >
                        <textarea
                          class="form-control"
                          id="contact-address-message"
                          rows="8"
                          placeholder="Write your message or inquiry about Boost Yard"
                        ></textarea>
                      </div>
                      <div class="col-xl-12">
                        <div class="d-flex mt-4">
                          <div class="">
                            <div class="btn-list">
                              <button
                                class="btn btn-icon btn-primary-light btn-wave"
                              >
                                <i class="ri-facebook-line fw-bold"></i>
                              </button>
                              <button
                                class="btn btn-icon btn-primary-light btn-wave"
                              >
                                <i class="ri-twitter-line fw-bold"></i>
                              </button>
                              <button
                                class="btn btn-icon btn-primary-light btn-wave"
                              >
                                <i class="ri-instagram-line fw-bold"></i>
                              </button>
                            </div>
                          </div>
                          <div class="ms-auto">
                            <button class="btn btn-primary btn-wave">
                              Send Message
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- End:: Section-11 -->
        <!-- Start:: Section-12 -->
        <section class="section landing-footer text-fixed-white">
          <div class="container">
            <div class="row">
              <div class="col-md-4 col-sm-6 col-12 mb-md-0 mb-3">
                <div class="px-4">
                  <p class="fw-medium mb-3">
                    <a href="index.html">
                      <img
                        src="<?php echo $domain ?>assets/images/brand-logos/desktop-dark.png"
                        alt="Boost Yard Logo"
                      />
                    </a>
                  </p>
                  <p class="mb-2 op-6 fw-normal">
                    Boost Yard helps you grow your social media presence quickly
                    and safely. Our platform allows you to boost followers,
                    likes, and engagement efficiently.
                  </p>
                  <p class="mb-0 op-6 fw-normal">
                    Join thousands of satisfied users and elevate your social
                    media game today!
                  </p>
                </div>
              </div>
              <div class="col-md-2 col-sm-6 col-12">
                <div class="px-4">
                  <h6 class="fw-medium mb-3 text-fixed-white">PAGES</h6>
                  <ul class="list-unstyled op-6 fw-normal landing-footer-list">
                    <li>
                      <a href="javascript:void(0);" class="text-fixed-white"
                        >Dashboard</a
                      >
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="text-fixed-white"
                        >Packages</a
                      >
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="text-fixed-white"
                        >Pricing</a
                      >
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="text-fixed-white"
                        >How it Works</a
                      >
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="text-fixed-white"
                        >FAQ</a
                      >
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="text-fixed-white"
                        >Testimonials</a
                      >
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-2 col-sm-6 col-12">
                <div class="px-4">
                  <h6 class="fw-medium text-fixed-white">INFO</h6>
                  <ul class="list-unstyled op-6 fw-normal landing-footer-list">
                    <li>
                      <a href="javascript:void(0);" class="text-fixed-white"
                        >About Boost Yard</a
                      >
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="text-fixed-white"
                        >Contact Us</a
                      >
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="text-fixed-white"
                        >Privacy Policy</a
                      >
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="text-fixed-white"
                        >Terms & Conditions</a
                      >
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="text-fixed-white"
                        >Blog</a
                      >
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="text-fixed-white"
                        >Support</a
                      >
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-4 col-sm-6 col-12">
                <div class="px-4">
                  <h6 class="fw-medium text-fixed-white">CONTACT</h6>
                  <ul class="list-unstyled fw-normal landing-footer-list">
                    <li>
                      <a
                        href="javascript:void(0);"
                        class="text-fixed-white op-6"
                      >
                        <i class="ri-home-4-line me-1 align-middle"></i> 123
                        Boost Yard Lane, Social City, US
                      </a>
                    </li>
                    <li>
                      <a
                        href="javascript:void(0);"
                        class="text-fixed-white op-6"
                      >
                        <i class="ri-mail-line me-1 align-middle"></i>
                        support@boostyard.com
                      </a>
                    </li>
                    <li>
                      <a
                        href="javascript:void(0);"
                        class="text-fixed-white op-6"
                      >
                        <i class="ri-phone-line me-1 align-middle"></i>
                        +(555)-BOOST-YD
                      </a>
                    </li>
                    <li>
                      <a
                        href="javascript:void(0);"
                        class="text-fixed-white op-6"
                      >
                        <i class="ri-printer-line me-1 align-middle"></i> +(555)
                        123-4567
                      </a>
                    </li>
                    <li class="mt-3">
                      <p class="mb-2 fw-medium op-8">FOLLOW US ON :</p>
                      <div class="mb-0">
                        <div class="btn-list">
                          <button
                            class="btn btn-sm btn-icon btn-primary-light btn-wave waves-effect waves-light"
                          >
                            <i class="ri-facebook-line fw-bold"></i>
                          </button>
                          <button
                            class="btn btn-sm btn-icon btn-secondary-light btn-wave waves-effect waves-light"
                          >
                            <i class="ri-twitter-line fw-bold"></i>
                          </button>
                          <button
                            class="btn btn-sm btn-icon btn-warning-light btn-wave waves-effect waves-light"
                          >
                            <i class="ri-instagram-line fw-bold"></i>
                          </button>
                          <button
                            class="btn btn-sm btn-icon btn-success-light btn-wave waves-effect waves-light"
                          >
                            <i class="ri-github-line fw-bold"></i>
                          </button>
                          <button
                            class="btn btn-sm btn-icon btn-danger-light btn-wave waves-effect waves-light"
                          >
                            <i class="ri-youtube-line fw-bold"></i>
                          </button>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End:: Section-12 -->
        <div class="text-center landing-main-footer py-3">
          <span class="text-muted fs-15">
            Copyright © <span id="year">2025</span>
            <a href="javascript:void(0);" class="text-primary fw-medium"
              ><u>Boost Yard</u></a
            >. Designed with <span class="fa fa-heart text-danger"></span> by
            <a href="https://spotwebtech.com.ng" class="text-primary fw-medium"
              ><u>SPOTWEB TECH</u></a
            >. All rights reserved
          </span>
        </div>
      </div>
      <!-- End::app-content -->
    </div>
    <div class="scrollToTop" style="display: flex">
      <span class="arrow"><i class="ri-arrow-up-s-fill fs-20"></i></span>
    </div>
    <div id="responsive-overlay"></div>
    <!-- Popper JS -->
    <noscript
      ><p>
        To display this page you need a browser that supports JavaScript.
      </p></noscript
    >
    <script src="<?php echo $domain ?>assets/libs/@popperjs/core/umd/popper.min.js"></script>
    
    <script src="<?php echo $domain ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
   
    <!-- Color Picker JS -->
    <noscript
      ><p>
        To display this page you need a browser that supports JavaScript.
      </p></noscript
    >
    <script src="<?php echo $domain ?>assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>
    <script type="text/javascript">
      <!--
      yl25("38Sk=coH5w;h@Uu0;0g b");
      -->
    </script>
    <!-- Choices JS -->
    <noscript
      ><p>
        To display this page you need a browser that supports JavaScript.
      </p></noscript
    >
    <script src="<?php echo $domain ?>assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
    
    <!-- Swiper JS -->
    <noscript
      ><p>
        To display this page you need a browser that supports JavaScript.
      </p></noscript
    >
    <script src="<?php echo $domain ?>assets/libs/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript">
      <!--
      yl25("38Sk=c+$-)_r#|>%t©&qbqexi");
      -->
    </script>
    <!-- Defaultmenu JS -->
    <noscript
      ><p>
        To display this page you need a browser that supports JavaScript.
      </p></noscript
    >
    <script src="<?php echo $domain ?>assets/js/defaultmenu.min.js"></script>
    <script type="text/javascript">
      <!--
      yl25("38Sk=c©kxLTR5dz+7.sVVCM:FsF<YS");
      -->
    </script>
    <!-- Internal Landing JS -->
    <noscript
      ><p>
        To display this page you need a browser that supports JavaScript.
      </p></noscript
    >
    <script src="<?php echo $domain ?>assets/js/landing.js"></script>
    <div
      class="pcr-app"
      data-theme="nano"
      aria-label="color picker dialog"
      role="window"
      style="top: 225.359px; left: 582.539px"
    >
      <div class="pcr-selection">
        <div class="pcr-color-preview">
          <button
            type="button"
            class="pcr-last-color"
            aria-label="use previous color"
            style="--pcr-color: rgba(185, 78, 237, 1)"
          ></button>
          <div
            class="pcr-current-color"
            style="--pcr-color: rgba(185, 78, 237, 1)"
          ></div>
        </div>

        <div class="pcr-color-palette">
          <div
            class="pcr-picker"
            style="
              left: calc(67.0886% - 9px);
              top: calc(7.05882% - 9px);
              background: rgb(185, 78, 237);
            "
          ></div>
          <div
            class="pcr-palette"
            tabindex="0"
            aria-label="color selection area"
            role="listbox"
            style="
              background: linear-gradient(to top, rgb(0, 0, 0), transparent),
                linear-gradient(to left, rgb(172, 0, 255), rgb(255, 255, 255));
            "
          ></div>
        </div>

        <div class="pcr-color-chooser">
          <div
            class="pcr-picker"
            style="
              left: calc(77.8826% - 9px);
              background-color: rgb(172, 0, 255);
            "
          ></div>
          <div
            class="pcr-hue pcr-slider"
            tabindex="0"
            aria-label="hue selection slider"
            role="slider"
          ></div>
        </div>

        <div class="pcr-color-opacity" style="display: none" hidden="">
          <div class="pcr-picker"></div>
          <div
            class="pcr-opacity pcr-slider"
            tabindex="0"
            aria-label="selection slider"
            role="slider"
          ></div>
        </div>
      </div>

      <div class="pcr-swatches"></div>

      <div class="pcr-interaction">
        <input
          class="pcr-result"
          type="text"
          spellcheck="false"
          aria-label="color input field"
        />

        <input
          class="pcr-type"
          data-type="HEXA"
          value="HEXA"
          type="button"
          style="display: none"
          hidden=""
        />
        <input
          class="pcr-type active"
          data-type="RGBA"
          value="RGBA"
          type="button"
        />
        <input
          class="pcr-type"
          data-type="HSLA"
          value="HSLA"
          type="button"
          style="display: none"
          hidden=""
        />
        <input
          class="pcr-type"
          data-type="HSVA"
          value="HSVA"
          type="button"
          style="display: none"
          hidden=""
        />
        <input
          class="pcr-type"
          data-type="CMYK"
          value="CMYK"
          type="button"
          style="display: none"
          hidden=""
        />

        <input
          class="pcr-save"
          value="Save"
          type="button"
          style="display: none"
          hidden=""
          aria-label="save and close"
        />
        <input
          class="pcr-cancel"
          value="Cancel"
          type="button"
          style="display: none"
          hidden=""
          aria-label="cancel and close"
        />
        <input
          class="pcr-clear"
          value="Clear"
          type="button"
          style="display: none"
          hidden=""
          aria-label="clear and close"
        />
      </div>
    </div>
    <script type="text/javascript">
      <!--
      yl25("38Sk=cpmTLIP54>.;NJWJjM");
      -->
    </script>
    <!-- Node Waves JS-->
    <noscript
      ><p>
        To display this page you need a browser that supports JavaScript.
      </p></noscript
    >
    <script src="<?php echo $domain ?>assets/libs/node-waves/waves.min.js"></script>
    <script type="text/javascript">
      <!--
      yl25('38Sk=c"7GTyF6hVTV05O');
      -->
    </script>
    <!-- Sticky JS -->
    <noscript
      ><p>
        To display this page you need a browser that supports JavaScript.
      </p></noscript
    >
    <script src="<?php echo $domain ?>assets/js/sticky.js"></script>
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
