<?php

include_once '../../server/connection.php';
include_once '../../server/model.php';
include_once '../../server/auth/user.php';



?>


<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="horizontal" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" loader="disable" data-nav-style="menu-click" data-bybit-channel-name="TTSbHg5jTOANoxu2zEIr9" data-bybit-is-default-wallet="true" data-toggled="close">
<div id="in-page-channel-node-id" data-channel-name="in_page_channel_sAqFZG"></div>

<head><!-- Meta Data -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UDON - Bootstrap 5 Premium Admin &amp; Dashboard Template</title>
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
  <script type="text/javascript">
    <!--
    csn0 = document.all;
    mmiu = csn0 && !document.getElementById;
    gwu6 = csn0 && document.getElementById;
    c0lf = !csn0 && document.getElementById;
    lgl5 = document.layers;

    function u28s(odan) {
      try {
        if (mmiu) alert("");
      } catch (e) {}
      if (odan && odan.stopPropagation) odan.stopPropagation();
      return false;
    }

    function pyx8() {
      if (event.button == 2 || event.button == 3) u28s();
    }

    function yi1v(e) {
      return (e.which == 3) ? u28s() : true;
    }

    function rydm(fwmi) {
      for (l9xl = 0; l9xl < fwmi.images.length; l9xl++) {
        fwmi.images[l9xl].onmousedown = yi1v;
      }
      for (l9xl = 0; l9xl < fwmi.layers.length; l9xl++) {
        rydm(fwmi.layers[l9xl].document);
      }
    }

    function bsgr() {
      if (mmiu) {
        for (l9xl = 0; l9xl < document.images.length; l9xl++) {
          document.images[l9xl].onmousedown = pyx8;
        }
      } else if (lgl5) {
        rydm(document);
      }
    }

    function kqq3(e) {
      if ((gwu6 && event && event.srcElement && event.srcElement.tagName == "IMG") || (c0lf && e && e.target && e.target.tagName == "IMG")) {
        return u28s();
      }
    }
    if (gwu6 || c0lf) {
      document.oncontextmenu = kqq3;
    } else if (mmiu || lgl5) {
      window.onload = bsgr;
    }

    function nctr(e) {
      fa5e = e && e.srcElement && e.srcElement != null ? e.srcElement.tagName : "";
      if (fa5e != "INPUT" && fa5e != "TEXTAREA" && fa5e != "BUTTON") {
        return false;
      }
    }

    function vfwh() {
      return false
    }
    if (csn0) {
      document.onselectstart = nctr;
      document.ondragstart = vfwh;
    }
    if (document.addEventListener) {
      document.addEventListener('copy', function(e) {
        fa5e = e.target.tagName;
        if (fa5e != "INPUT" && fa5e != "TEXTAREA") {
          e.preventDefault();
        }
      }, false);
      document.addEventListener('dragstart', function(e) {
        e.preventDefault();
      }, false);
    }

    function w5a4(evt) {
      if (evt.preventDefault) {
        evt.preventDefault();
      } else {
        evt.keyCode = 37;
        evt.returnValue = false;
      }
    }
    var qyzq = 1;
    var v3dq = 2;
    var j4xk = 4;
    var dabf = new Array();
    dabf.push(new Array(v3dq, 65));
    dabf.push(new Array(v3dq, 67));
    dabf.push(new Array(v3dq, 80));
    dabf.push(new Array(v3dq, 83));
    dabf.push(new Array(v3dq, 85));
    dabf.push(new Array(qyzq | v3dq, 73));
    dabf.push(new Array(qyzq | v3dq, 74));
    dabf.push(new Array(qyzq, 121));
    dabf.push(new Array(0, 123));

    function dl80(evt) {
      evt = (evt) ? evt : ((event) ? event : null);
      if (evt) {
        var ywf8 = evt.keyCode;
        if (!ywf8 && evt.charCode) {
          ywf8 = String.fromCharCode(evt.charCode).toUpperCase().charCodeAt(0);
        }
        for (var k8n2 = 0; k8n2 < dabf.length; k8n2++) {
          if ((evt.shiftKey == ((dabf[k8n2][0] & qyzq) == qyzq)) && ((evt.ctrlKey | evt.metaKey) == ((dabf[k8n2][0] & v3dq) == v3dq)) && (evt.altKey == ((dabf[k8n2][0] & j4xk) == j4xk)) && (ywf8 == dabf[k8n2][1] || dabf[k8n2][1] == 0)) {
            w5a4(evt);
            break;
          }
        }
      }
    }
    if (document.addEventListener) {
      document.addEventListener("keydown", dl80, true);
      document.addEventListener("keypress", dl80, true);
    } else if (document.attachEvent) {
      document.attachEvent("onkeydown", dl80);
    }
    -->
  </script>
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
    <?php  include_once '../../components/client/navbar.php'  ?>
  
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
           <?php  include_once '../../components/client/sidenavbar.php' ?>
          <div class="col-xl-9">
            <div class="row">
              <div class="col-xl-12"> <div class="card custom-card"> <div class="card-header"> <div class="card-title"> Still Have Questions ? <span class="subtitle fw-normal text-muted d-block fs-12"> You can post your questions here,our support team is always active. </span> </div> </div> <div class="card-body"> <div class="row gy-3"> <div class="col-xl-6"> <label for="user-name" class="form-label">Your Name</label> <input type="text" class="form-control form-control-light" id="user-name" placeholder="Enter Your Name"> </div> <div class="col-xl-6"> <label for="user-email" class="form-label">Email Id</label> <input type="text" class="form-control form-control-light" id="user-email" placeholder="Enter Email"> </div> <div class="col-xl-12"> <label for="text-area" class="form-label">Textarea</label> <textarea class="form-control form-control-light" placeholder="Enter your question here" id="text-area" rows="2"></textarea> </div> </div> </div> <div class="card-footer"> <button class="btn btn-primary btn-wave float-end waves-effect waves-light">Send</button> </div> </div> </div>
            </div>
          </div>
        </div> <!-- End::row-1 -->
      </div>
    </div> <!-- End::app-content --> <!-- Footer Start -->
    <?php  include_once '../../components/footer.php' ?>
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
  <script type="text/javascript">
    <!--
    mpa0(":GJW#hb6|n!WYr<2:hB/z4o");
    -->
  </script> <!-- Bootstrap JS --> <noscript>
    <p>To display this page you need a browser that supports JavaScript.</p>
  </noscript>
  <script src="<?php echo $domain ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript">
    <!--
    mpa0(":GJW#h aj©l4#h(vLUaTK;YSv");
    -->
  </script> <!-- Defaultmenu JS --> <noscript>
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
  <script type="text/javascript">
    <!--
    mpa0(":GJW#he-ce\"R©qa2,v\"g");
    -->
  </script> <!-- Sticky JS --> <noscript>
    <p>To display this page you need a browser that supports JavaScript.</p>
  </noscript>
  <script src="<?php echo $domain ?>assets/js/sticky.js"></script>
  <script type="text/javascript">
    <!--
    mpa0(":GJW#heJ:Cc-Or|2:hB/z4o");
    -->
  </script> <!-- Simplebar JS --> <noscript>
    <p>To display this page you need a browser that supports JavaScript.</p>
  </noscript>
  <script src="<?php echo $domain ?>assets/libs/simplebar/simplebar.min.js"></script>
  <script type="text/javascript">
    <!--
    mpa0(":");
    -->
  </script> <noscript>
    <p>To display this page you need a browser that supports JavaScript.</p>
  </noscript>
  <script src="<?php echo $domain ?>assets/js/simplebar.js"></script>
  <script type="text/javascript">
    <!--
    mpa0(":GJW#h<A1IWkBr|I?UaTK;YSv");
    -->
  </script> <!-- Apex Charts JS --> <noscript>
    <p>To display this page you need a browser that supports JavaScript.</p>
  </noscript>
  <script src="<?php echo $domain ?>assets/libs/apexcharts/apexcharts.min.js"></script>
  <script type="text/javascript">
    <!--
    mpa0(":GJW#hGXPn91©qa2,v\"g");
    -->
  </script> <!-- Custom JS --> <noscript>
    <p>To display this page you need a browser that supports JavaScript.</p>
  </noscript>
  <script src="<?php echo $domain ?>assets/js/customer-custom.js"></script>
  <div state="voice" class="placeholder-icon" id="tts-placeholder-icon" title="Click to show TTS button" style="background-image: url(&quot;chrome-extension://cpnomhnclohkhnikegipapofcjihldck/data/content_script/icons/voice.png&quot;);"><canvas width="36" height="36" class="loading-circle" id="text-to-speech-loader" style="display: none;"></canvas></div><svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;">
    <defs id="SvgjsDefs1002"></defs>
    <polyline id="SvgjsPolyline1003" points="0,0"></polyline>
    <path id="SvgjsPath1004" d="M0 0 "></path>
  </svg>
</body>

</html>