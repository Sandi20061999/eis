<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>DJ</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>/assets/images/Logo-darmajaya.png">
    <link href="<?= base_url() ?>/assets/css/style.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="<?= base_url() ?>/assets/daricdn/npmchartjs.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/common/common.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/gleek.js"></script>
    <script src="<?= base_url() ?>/assets/js/styleSwitcher.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/highlightjs/highlight.pack.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
    
    <script src="<?= base_url() ?>/assets/plugins/chart.js/Chart.bundle.min.js"></script>

    <script src="<?= base_url() ?>/assets/daricdn/chartjslabel.js"></script>
    <style type="text/css">
        /* Chart.js */
        @keyframes chartjs-render-animation {
            from {
                opacity: .99
            }

            to {
                opacity: 1
            }
        }

        .chartjs-render-monitor {
            animation: chartjs-render-animation 1ms
        }

        .chartjs-size-monitor,
        .chartjs-size-monitor-expand,
        .chartjs-size-monitor-shrink {
            position: absolute;
            direction: ltr;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            overflow: hidden;
            pointer-events: none;
            visibility: hidden;
            z-index: -1
        }

        .chartjs-size-monitor-expand>div {
            position: absolute;
            width: 1000000px;
            height: 1000000px;
            left: 0;
            top: 0
        }

        .chartjs-size-monitor-shrink>div {
            position: absolute;
            width: 200%;
            height: 200%;
            left: 0;
            top: 0
        }
    </style>

    <style>
        .link:hover {
            color: white;
        }
    </style>
</head>

<body>

    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>


    <div id="main-wrapper">

        <div class="nav-header">
            <div class="brand-logo mt-2">
                <span class="d-flex justify-content-center">
                    <img src="<?= base_url() ?>/assets/images/Logo-Darmajaya.png" alt="" width="60" height="60">
                </span>
                </a>
            </div>
        </div>

        <div class="header bg-primary">
            <div class="header-content clearfix">

                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu color-white"></i></span>
                    </div>
                </div>
                <div class="header-left">
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            <div class="position-relative mr-2">
                                <h5 style="color: white;"><?php echo $this->session->userdata('role'); ?></h5>
                            </div>
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="<?= base_url() ?>/assets/images/user/1.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile   dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href=""><i class="icon-user"></i> <span>Profile</span></a>
                                        </li>
                                        <hr class="my-2">
                                        <li><a href="<?= base_url('auth/logout') ?>"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>