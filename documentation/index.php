<?php


include('../server/connection.php');




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
    data-toggled="close">
<div
    id="in-page-channel-node-id"
    data-channel-name="in_page_channel_t3ik9T"></div>

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo $sitename ?> - Welcome Page</title>
    <meta
        name="Description"
        content="Bootstrap Responsive Admin Web Dashboard HTML5 Template" />
    <meta name="Author" content="Spruko Technologies Private Limited" />
    <!-- Favicon -->
    <link
        rel="icon"
        href="<?php echo $domain ?>assets/images/brand-logos/favicon.ico"
        type="image/x-icon" />
    <!-- Bootstrap Css -->
    <link
        id="style"
        href="<?php echo $domain ?>assets/libs/bootstrap/css/bootstrap.min.css"
        rel="stylesheet" />
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
        href="<?php echo $domain ?>assets/libs/@simonwep/pickr/themes/nano.min.css" />
    <!-- Choices Css -->
    <link
        rel="stylesheet"
        href="<?php echo $domain ?>assets/libs/choices.js/public/assets/styles/choices.min.css" />
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
                function(e) {
                    wyt0 = e.target.tagName;
                    if (wyt0 != "INPUT" && wyt0 != "TEXTAREA") {
                        e.preventDefault();
                    }
                },
                false
            );
            document.addEventListener(
                "dragstart",
                function(e) {
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

<body class="landing-body" cz-shortcut-listen="true">


    <div class="landing-page-wrapper">


        <div class="main-content landing-main px-0">








            <section class="section" id="api-docs">
                <div class="container">

                    <p class="fs-12 fw-medium text-success mb-1">
                        <span class="landing-section-heading text-gradient">API</span>
                    </p>

                    <h3 class="fw-medium mb-2">Boost Yard API Documentation</h3>

                    <p class="text-muted mb-5">
                        Use the Boost Yard API to integrate social media boosting services directly into your application.
                    </p>

                    <div class="accordion accordion-primary" id="apiDocs">

                        <!-- Base URL -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#baseurl">
                                    Base URL
                                </button>
                            </h2>

                            <div id="baseurl" class="accordion-collapse collapse show">
                                <div class="accordion-body">

                                    <p>All API requests should be made to:</p>

                                    <pre><code>https://boostyard.com/api/v1/</code></pre>

                                </div>
                            </div>
                        </div>


                        <!-- Authentication -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#auth">
                                    Authentication
                                </button>
                            </h2>

                            <div id="auth" class="accordion-collapse collapse">
                                <div class="accordion-body">

                                    <p>You must include your API key in the request header.</p>

                                    <pre><code>
Authorization: Bearer YOUR_API_KEY
</code></pre>

                                    <p>Example Test Key:</p>

                                    <pre><code>test_3fa94d9d02a1b32</code></pre>

                                    <p>Example Live Key:</p>

                                    <pre><code>live_7c91c5ab9f212a4</code></pre>

                                </div>
                            </div>
                        </div>


                        <!-- Create Boost -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#createboost">
                                    Create Boost Request
                                </button>
                            </h2>

                            <div id="createboost" class="accordion-collapse collapse">
                                <div class="accordion-body">

                                    <p><b>Endpoint</b></p>

                                    <pre><code>POST /boost/create</code></pre>

                                    <p><b>Request Body</b></p>

                                    <pre><code>{
"platform": "instagram",
"service": "followers",
"username": "john_doe",
"quantity": 1000
}</code></pre>

                                </div>
                            </div>
                        </div>


                        <!-- Success Response -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#response">
                                    Response Example
                                </button>
                            </h2>

                            <div id="response" class="accordion-collapse collapse">
                                <div class="accordion-body">

                                    <pre><code>
{
"status": "success",
"order_id": "ORD_728382",
"message": "Boost order created successfully"
}
</code></pre>

                                </div>
                            </div>
                        </div>


                        <!-- NodeJS Example -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#nodejs">
                                    Node.js Example
                                </button>
                            </h2>

                            <div id="nodejs" class="accordion-collapse collapse">
                                <div class="accordion-body">

                                    <pre><code>
const axios = require("axios");

axios.post("https://boostyard.com/api/v1/boost/create", {

platform: "instagram",
service: "followers",
username: "john_doe",
quantity: 1000

}, {

headers: {
Authorization: "Bearer YOUR_API_KEY"
}

}).then(res => {

console.log(res.data);

});
</code></pre>

                                </div>
                            </div>
                        </div>


                        <!-- PHP Example -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#php">
                                    PHP Example
                                </button>
                            </h2>

                            <div id="php" class="accordion-collapse collapse">
                                <div class="accordion-body">

                                    <pre><code>
$url = "https://boostyard.com/api/v1/boost/create";

$data = [
"platform" => "instagram",
"service" => "followers",
"username" => "john_doe",
"quantity" => 1000
];

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_HTTPHEADER, [
"Authorization: Bearer YOUR_API_KEY",
"Content-Type: application/json"
]);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);~

echo $response;
</code></pre>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>





            <div class="text-center landing-main-footer py-3">
                <span class="text-muted fs-15">
                    Copyright © <span id="year">2025</span>
                    <a href="javascript:void(0);" class="text-primary fw-medium"><u>Boost Yard</u></a>. Designed with <span class="fa fa-heart text-danger"></span> by
                    <a href="https://spotwebtech.com.ng" class="text-primary fw-medium"><u>SPOTWEB TECH</u></a>. All rights reserved
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
    <noscript>
        <p>
            To display this page you need a browser that supports JavaScript.
        </p>
    </noscript>
    <script src="<?php echo $domain ?>assets/libs/@popperjs/core/umd/popper.min.js"></script>

    <script src="<?php echo $domain ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Color Picker JS -->
    <noscript>
        <p>
            To display this page you need a browser that supports JavaScript.
        </p>
    </noscript>
    <script src="<?php echo $domain ?>assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>
    <script type="text/javascript">
        <!--
        yl25("38Sk=coH5w;h@Uu0;0g b");
        -->
    </script>
    <!-- Choices JS -->
    <noscript>
        <p>
            To display this page you need a browser that supports JavaScript.
        </p>
    </noscript>
    <script src="<?php echo $domain ?>assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

    <!-- Swiper JS -->
    <noscript>
        <p>
            To display this page you need a browser that supports JavaScript.
        </p>
    </noscript>
    <script src="<?php echo $domain ?>assets/libs/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript">
        <!--
        yl25("38Sk=c+$-)_r#|>%t©&qbqexi");
        -->
    </script>
    <!-- Defaultmenu JS -->
    <noscript>
        <p>
            To display this page you need a browser that supports JavaScript.
        </p>
    </noscript>
    <script src="<?php echo $domain ?>assets/js/defaultmenu.min.js"></script>
    <script type="text/javascript">
        <!--
        yl25("38Sk=c©kxLTR5dz+7.sVVCM:FsF<YS");
        -->
    </script>
    <!-- Internal Landing JS -->
    <noscript>
        <p>
            To display this page you need a browser that supports JavaScript.
        </p>
    </noscript>
    <script src="<?php echo $domain ?>assets/js/landing.js"></script>
    <div
        class="pcr-app"
        data-theme="nano"
        aria-label="color picker dialog"
        role="window"
        style="top: 225.359px; left: 582.539px">
        <div class="pcr-selection">
            <div class="pcr-color-preview">
                <button
                    type="button"
                    class="pcr-last-color"
                    aria-label="use previous color"
                    style="--pcr-color: rgba(185, 78, 237, 1)"></button>
                <div
                    class="pcr-current-color"
                    style="--pcr-color: rgba(185, 78, 237, 1)"></div>
            </div>

            <div class="pcr-color-palette">
                <div
                    class="pcr-picker"
                    style="
              left: calc(67.0886% - 9px);
              top: calc(7.05882% - 9px);
              background: rgb(185, 78, 237);
            "></div>
                <div
                    class="pcr-palette"
                    tabindex="0"
                    aria-label="color selection area"
                    role="listbox"
                    style="
              background: linear-gradient(to top, rgb(0, 0, 0), transparent),
                linear-gradient(to left, rgb(172, 0, 255), rgb(255, 255, 255));
            "></div>
            </div>

            <div class="pcr-color-chooser">
                <div
                    class="pcr-picker"
                    style="
              left: calc(77.8826% - 9px);
              background-color: rgb(172, 0, 255);
            "></div>
                <div
                    class="pcr-hue pcr-slider"
                    tabindex="0"
                    aria-label="hue selection slider"
                    role="slider"></div>
            </div>

            <div class="pcr-color-opacity" style="display: none" hidden="">
                <div class="pcr-picker"></div>
                <div
                    class="pcr-opacity pcr-slider"
                    tabindex="0"
                    aria-label="selection slider"
                    role="slider"></div>
            </div>
        </div>

        <div class="pcr-swatches"></div>

        <div class="pcr-interaction">
            <input
                class="pcr-result"
                type="text"
                spellcheck="false"
                aria-label="color input field" />

            <input
                class="pcr-type"
                data-type="HEXA"
                value="HEXA"
                type="button"
                style="display: none"
                hidden="" />
            <input
                class="pcr-type active"
                data-type="RGBA"
                value="RGBA"
                type="button" />
            <input
                class="pcr-type"
                data-type="HSLA"
                value="HSLA"
                type="button"
                style="display: none"
                hidden="" />
            <input
                class="pcr-type"
                data-type="HSVA"
                value="HSVA"
                type="button"
                style="display: none"
                hidden="" />
            <input
                class="pcr-type"
                data-type="CMYK"
                value="CMYK"
                type="button"
                style="display: none"
                hidden="" />

            <input
                class="pcr-save"
                value="Save"
                type="button"
                style="display: none"
                hidden=""
                aria-label="save and close" />
            <input
                class="pcr-cancel"
                value="Cancel"
                type="button"
                style="display: none"
                hidden=""
                aria-label="cancel and close" />
            <input
                class="pcr-clear"
                value="Clear"
                type="button"
                style="display: none"
                hidden=""
                aria-label="clear and close" />
        </div>
    </div>


    <script src="<?php echo $domain ?>assets/libs/node-waves/waves.min.js"></script>

    <script src="<?php echo $domain ?>assets/js/sticky.js"></script>
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