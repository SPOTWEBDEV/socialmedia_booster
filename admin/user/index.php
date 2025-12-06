<?php

include_once '../../server/connection.php';
include_once '../../server/model.php';




?>


<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="horizontal" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" loader="disable" data-nav-style="menu-click" data-bybit-channel-name="TTSbHg5jTOANoxu2zEIr9" data-bybit-is-default-wallet="true" data-toggled="close">
<div id="in-page-channel-node-id" data-channel-name="in_page_channel_sAqFZG"></div>

<head><!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $sitename . ' -- Order Page ' ?></title>
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

        <?php include_once '../../components/admin/navbar.php'  ?>

        <div class="main-content app-content">
            <div class="container-fluid"> <!-- Start::page-header -->
                <div class="d-flex align-items-center justify-content-between my-4 page-header-breadcrumb flex-wrap gap-2">
                    <div>
                        <p class="fw-medium fs-20 mb-0"></p>
                        <p class="fs-13 text-muted mb-0"></p>
                    </div>
                    <div class="btn-list"> <button class="btn btn-primary-light btn-wave waves-effect waves-light"> <i class="bx bx-crown align-middle"></i> Plan Upgrade </button> <button class="btn btn-secondary-light btn-wave waves-effect waves-light"> <i class="ri-upload-cloud-line align-middle"></i> Export Report </button> </div>
                </div> <!-- End::page-header --> <!-- Start::row-1 -->
                <div class="row">
                    <?php include_once '../../components/admin/sidenavbar.php' ?>
                    <div class="col-xl-9">
                        <div class="row">


                            <div class="col-xl-12">
                                <div class="card custom-card overflow-hidden">
                                    <div class="card-header justify-content-between">
                                        <div class="card-body d-flex align-items-center flex-wrap">

                                            <div class="flex-fill">
                                                <span class="mb-0 fs-14 text-muted">
                                                    Total number of orders placed upto now :
                                                    <span class="fw-medium text-success" id="orderCount">0</span>
                                                </span>
                                            </div>

                                            <!-- Sort -->
                                            <div class="dropdown">
                                                <button class="btn btn-light dropdown-toggle m-1" type="button"
                                                    id="sortBtn" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Sort By
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item sortOption" data-sort="id" href="#">ID</a></li>
                                                    <li><a class="dropdown-item sortOption" data-sort="name" href="#">Name</a></li>
                                                    <li><a class="dropdown-item sortOption" data-sort="date" href="#">Date</a></li>

                                                </ul>
                                            </div>

                                            <!-- Category Filter -->
                                            <select id="categoryFilter" class="form-select m-1" style="width:200px;">
                                                <option value="">All Categories</option>
                                            </select>

                                            <!-- Search -->
                                            <div class="d-flex align-items-center m-1" role="search">
                                                <input class="form-control" id="searchInput" type="search" placeholder="Search">
                                                <button class="btn btn-light ms-2" id="searchBtn">Search</button>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-body px-0 pt-2 pb-0">
                                        <div class="table-responsive">
                                            <table class="table text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">User ID</th>
                                                        <th scope="col">Full Name</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Date Registered</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <script>
                            let users = [];
                            let filteredUsers = [];

                            // =============================
                            //  FETCH USERS FROM PHP
                            // =============================
                            function loadUsers() {
                                fetch("<?php echo $domain ?>server/api/users.php")
                                    .then(res => res.json())
                                    .then(data => {
                                        if (data.success) {
                                            users = data.data;
                                            filteredUsers = users;
                                            updateUserCount();
                                            populateStatusCategories();
                                            renderTable();
                                        }
                                    })
                                    .catch(err => console.error("API ERROR:", err));
                            }

                            // =============================
                            //   UPDATE COUNT
                            // =============================
                            function updateUserCount() {
                                document.getElementById("orderCount").textContent = users.length;
                            }

                            // =============================
                            //   POPULATE DROPDOWN (active/inactive/warning)
                            // =============================
                            function populateStatusCategories() {
                                let select = document.getElementById("categoryFilter");
                                let statuses = ["active", "inactive", "warning"];

                                statuses.forEach(status => {
                                    let opt = document.createElement("option");
                                    opt.value = status;
                                    opt.textContent = status.charAt(0).toUpperCase() + status.slice(1);
                                    select.appendChild(opt);
                                });
                            }

                            // =============================
                            //   RENDER TABLE
                            // =============================
                            function renderTable() {
                                let tbody = document.querySelector("table tbody");
                                tbody.innerHTML = "";

                                filteredUsers.forEach(user => {
                                    tbody.innerHTML += `
            <tr>
                <td><a href="#" class="text-primary text-decoration-underline">#${user.id}</a></td>

                <td>
                    <div>
                        <span class="d-block mb-1">${user.fullname}</span>
                        <span class="d-block fs-12 text-muted fw-normal">${user.email}</span>
                    </div>
                </td>

                <td><span class="badge bg-${getStatusColor(user.status)}-transparent">
                    ${user.status}
                </span></td>

                <td>
                    <div>
                        <span class="d-block mb-1">${user.created_at}</span>
                        <span class="d-block fs-12 text-muted fw-normal">${user.status_message ?? ''}</span>
                    </div>
                </td>

                <td>
                    <button class="btn btn-sm btn-ghost-light text-default border btn-wave">
                        <i class="fe fe-eye text-muted align-middle me-1"></i> View
                    </button>
                </td>
            </tr>
        `;
                                });
                            }

                            // status color badge
                            function getStatusColor(status) {
                                switch (status.toLowerCase()) {
                                    case "active":
                                        return "success";
                                    case "inactive":
                                        return "danger";
                                    case "warning":
                                        return "warning";
                                    default:
                                        return "primary";
                                }
                            }

                            // =============================
                            //   SORTING
                            // =============================
                            document.querySelectorAll(".sortOption").forEach(btn => {
                                btn.addEventListener("click", function() {
                                    let field = this.getAttribute("data-sort");

                                    filteredUsers.sort((a, b) => {
                                        if (field === "id") {
                                            return Number(a.id) - Number(b.id);
                                        }
                                        if (field === "date") {
                                            return new Date(a.created_at) - new Date(b.created_at);
                                        }
                                        return a.fullname.localeCompare(b.fullname);
                                    });

                                    renderTable();
                                });
                            });

                            // =============================
                            //   SEARCH (name + email)
                            // =============================
                            document.getElementById("searchBtn").addEventListener("click", () => {
                                let search = document.getElementById("searchInput").value.toLowerCase();

                                filteredUsers = users.filter(u =>
                                    u.fullname.toLowerCase().includes(search) ||
                                    u.email.toLowerCase().includes(search)
                                );

                                renderTable();
                            });

                            // =============================
                            //   CATEGORY FILTER (status)
                            // =============================
                            document.getElementById("categoryFilter").addEventListener("change", function() {
                                if (this.value === "") {
                                    filteredUsers = users;
                                } else {
                                    filteredUsers = users.filter(u => u.status.toLowerCase() === this.value.toLowerCase());
                                }
                                renderTable();
                            });

                            // start
                            loadUsers();
                        </script>

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

    <script src="<?php echo $domain ?>assets/js/defaultmenu.min.js"></script>

    <script src="<?php echo $domain ?>assets/libs/node-waves/waves.min.js"></script>

    <script src="<?php echo $domain ?>assets/js/sticky.js"></script>

    <script src="<?php echo $domain ?>assets/libs/simplebar/simplebar.min.js"></script>

    <script src="<?php echo $domain ?>assets/js/simplebar.js"></script>

    <script src="<?php echo $domain ?>assets/libs/apexcharts/apexcharts.min.js"></script>

    <script src="<?php echo $domain ?>assets/js/customer-custom.js"></script>
    <div state="voice" class="placeholder-icon" id="tts-placeholder-icon" title="Click to show TTS button" style="background-image: url(&quot;chrome-extension://cpnomhnclohkhnikegipapofcjihldck/data/content_script/icons/voice.png&quot;);"><canvas width="36" height="36" class="loading-circle" id="text-to-speech-loader" style="display: none;"></canvas></div><svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;">
        <defs id="SvgjsDefs1002"></defs>
        <polyline id="SvgjsPolyline1003" points="0,0"></polyline>
        <path id="SvgjsPath1004" d="M0 0 "></path>
    </svg>
</body>

</html>