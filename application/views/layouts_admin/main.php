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
    <link href="<?= base_url() ?>assets/icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">


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

        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li>
                        <a href="<?= base_url('admin/dashboard') ?>" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-label">Menu</li>
                    <li>
                        <a href="<?= base_url('admin/user') ?>" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">User</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/view') ?>" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">view</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="<?= base_url('admin/api') ?>" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">API</span>
                        </a>
                    </li> -->
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Role</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?= base_url('admin/role') ?>">Role</a></li>
                            <li><a href="<?= base_url('admin/role_access_menu') ?>">Role Access Menu</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Menu</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?= base_url('admin/menu') ?>">Menu</a></li>
                            <li><a href="<?= base_url('admin/sub_menu') ?>">Sub Menu</a></li>
                            <li><a href="<?= base_url('admin/sub_menu_access_view') ?>">SM Access View</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="content-body">
            <div class="container-fluid pt-5">
                <?php if (isset($_view) && $_view)
                    $this->load->view($_view);
                ?>
            </div>
        </div>


        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; 2020</p>
            </div>
        </div>
    </div>

    <script src="<?= base_url() ?>/assets/plugins/common/common.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/custom.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/settings.js"></script>
    <script src="<?= base_url() ?>/assets/js/gleek.js"></script>
    <script src="<?= base_url() ?>/assets/js/styleSwitcher.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/highlightjs/highlight.pack.min.js"></script>

    <script src="<?= base_url() ?>/assets//plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/assets//plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/assets//plugins/tables/js/datatable-init/datatable-basic.min.js"></script>

    <script>
        hljs.initHighlightingOnLoad();
    </script>

    <script>
        (function($) {
            "use strict"
            new quixSettings({
                version: "light", //2 options "light" and "dark"
                layout: "vertical", //2 options, "vertical" and "horizontal"
                navheaderBg: "color_1", //have 10 options, "color_1" to "color_10"
                headerBg: "color_1", //have 10 options, "color_1" to "color_10"
                sidebarStyle: "full", //defines how sidebar should look like, options are: "full", "compact", "mini" and "overlay". If layout is "horizontal", sidebarStyle won't take "overlay" argument anymore, this will turn into "full" automatically!
                sidebarBg: "color_1", //have 10 options, "color_1" to "color_10"
                sidebarPosition: "fixed", //have two options, "static" and "fixed"
                headerPosition: "fixed", //have two options, "static" and "fixed"
                containerLayout: "wide", //"boxed" and  "wide". If layout "vertical" and containerLayout "boxed", sidebarStyle will automatically turn into "overlay".
                direction: "ltr" //"ltr" = Left to Right; "rtl" = Right to Left
            });
        })(jQuery);
    </script>
    <script>
        $("#level").change(function() {
            var id = $(this).children(":selected").attr("id");
            switch (id) {
                case 'kaprodi':
                    isi = '<div class="form-group"> <div class="col-md-6"> <label for="id_jurusan" class="control-label"><span class="text-danger">*</span>Jurusan Value</label> <div class="form-group"> <select class="form-control" name="id_jurusan" id="id_jurusan" data-container=" body" data-live-search="true" data-hide-disabled="true" title="id_jurusan"> </select> <span class="text-danger"><?php echo form_error('id_jurusan'); ?></span> </div> </div> </div>';
                    break;
                default:
                    isi = '';
            }
            $('#infolevel').html(isi)
        });

        $("#type").change(function() {
            var id = $(this).children(":selected").attr("id");
            switch (id) {
                case 'chart':
                    isi = '<div class="form-group"> <div class="col-md-6"> <label for="chartTitle" class="control-label">chart Title</label> <div class="form-group"> <input type="text" name="chartTitle" value="<?php echo $this->input->post('chartTitle'); ?>" class="form-control" id="chartTitle" /> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="chartWidth" class="control-label">chart Width</label> <div class="form-group"> <input type="number" max="12" name="chartWidth" value="<?php echo $this->input->post('chartWidth'); ?>" class="form-control" id="chartWidth" /> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="chartType" class="control-label"><span class="text-danger">*</span>chartType</label> <div class="form-group"> <select class="form-control" name="chartType" id="chartType" data-container=" body" data-live-search="true" data-hide-disabled="true" title="chartType"> <option value="">Pilih Type Chart</option> <option value="bar">Bar</option> <option value="line">Line</option> </select> <span class="text-danger"><?php echo form_error('chartType'); ?></span> </div> </div> </div><div class="form-group"> <div class="col-md-6"> <label for="by" class="control-label"><span class="text-danger">*</span>by</label> <div class="form-group"> <select class="form-control" name="by" id="by" data-container=" body" data-live-search="true" data-hide-disabled="true" title="by"><option value="">Jumlah</option> <option value="total">Total</option>  </select> <span class="text-danger"><?php echo form_error('by'); ?></span> </div> </div> </div><div class="form-group"> <div class="col-md-6"> <label for="filter" class="control-label"><span class="text-danger">*</span>Filter</label> <div class="form-group"> <select class="form-control" name="filter" id="filter" data-container=" body" data-live-search="true" data-hide-disabled="true" title="filter"> </select> <span class="text-danger"><?php echo form_error('filter'); ?></span> </div> </div> </div><div class="form-group"> <div class="col-md-6"> <button class="btn btn-info btn-small btn-add-api-data" id="addapi" type="button">Tambah Data</button> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="api_id" class="control-label"><span class="text-danger">*</span>Api</label> <div class="form-group"> <select class="form-control" name="api_id[]" id="api_id00" data-container=" body" data-live-search="true" data-hide-disabled="true" title="api_id"> <?php foreach ($api as $a) {?> <?php $selected = ($a['name'] == $this->input->post('api')) ? ' selected="selected"' : "";?> <option id="<?= $a['id'] ?>" value="<?= $a['id'] ?>" <?= $selected ?>><?= $a['name']?> </option>; <?php } ?></select> <span class="text-danger"><?php echo form_error('api_id'); ?></span> </div> </div> </div>';
                    break;
                case 'card':
                    isi = '<div class="form-group"> <div class="col-md-6"> <label for="api_id" class="control-label"><span class="text-danger">*</span>api_id</label> <div class="form-group"> <select class="form-control" class="input_api" name="api_id" id="api_id" data-container=" body" data-live-search="true" data-hide-disabled="true" title="api_id"> <?php foreach ($api as $a) {?> <?php $selected = ($a['name'] == $this->input->post('api')) ? ' selected="selected"' : "";?> <option id="<?= $a['id'] ?>" value="<?= $a['id'] ?>" <?= $selected ?>><?= $a['name']?> </option>; <?php } ?> </select> <span class="text-danger"><?php echo form_error('api_id'); ?></span> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="by" class="control-label"><span class="text-danger">*</span>by</label> <div class="form-group"> <select class="form-control" name="by" id="by" data-container=" body" data-live-search="true" data-hide-disabled="true" title="by"><option value="">Jumlah</option> <option value="total">Total</option>  </select> <span class="text-danger"><?php echo form_error('by'); ?></span> </div> </div> </div><div class="form-group"> <div class="col-md-6"> <label for="filter" class="control-label"><span class="text-danger">*</span>Filter</label> <div class="form-group"> <select class="form-control" name="filter" id="filter" data-container=" body" data-live-search="true" data-hide-disabled="true" title="filter"> </select> <span class="text-danger"><?php echo form_error('filter'); ?></span> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="fvalue" class="control-label"><span class="text-danger">*</span>Filter Value</label> <div class="form-group"> <select class="form-control" name="fvalue" id="fvalue" data-container=" body" data-live-search="true" data-hide-disabled="true" title="fvalue"> </select> <span class="text-danger"><?php echo form_error('fvalue'); ?></span> </div> </div> </div><div class="form-group"> <div class="col-md-6"> <label for="cardTitle" class="control-label">Card Title</label> <div class="form-group"> <input type="text" name="cardTitle" value="<?php echo $this->input->post('cardTitle'); ?>" class="form-control" id="cardTitle" /> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="cardWidth" class="control-label">Card Width</label> <div class="form-group"> <input type="number" max="12" name="cardWidth" value="<?php echo $this->input->post('cardWidth'); ?>" class="form-control" id="cardWidth" /> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="cardDetail" class="control-label">Card Detail</label> <div class="form-group"> <input type="text" name="cardDetail" value="<?php echo $this->input->post('cardDetail'); ?>" class="form-control" id="cardDetail" /> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="cardIcon" class="control-label"><span class="text-danger">*</span>cardIcon</label> <div class="form-group"> <select class="form-control" name="cardIcon" id="cardIcon" data-container=" body" data-live-search="true" data-hide-disabled="true" title="cardIcon"> </select> <span class="text-danger"><?php echo form_error('cardIcon'); ?></span> </div> </div> </div><div class="form-group"> <div class="col-md-6"> <label for="cardColor" class="control-label">Card Color</label> <div class="form-group"> <input type="color" name="cardColor" value="<?php echo $this->input->post('cardColor'); ?>" class="form-control" id="cardColor" /> </div> </div> </div>';
                    break;
                case 'accordionTable':
                    isi = '<div class="form-group"> <div class="col-md-6"> <label for="api_id" class="control-label"><span class="text-danger">*</span>api_id</label> <div class="form-group"> <select class="form-control" class="input_api" name="api_id" id="api_id" data-container=" body" data-live-search="true" data-hide-disabled="true" title="api_id"> <?php foreach ($api as $a) {?> <?php $selected = ($a['name'] == $this->input->post('api')) ? ' selected="selected"' : "";?> <option id="<?= $a['id'] ?>" value="<?= $a['id'] ?>" <?= $selected ?>><?= $a['name']?> </option>; <?php } ?> </select> <span class="text-danger"><?php echo form_error('api_id'); ?></span> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="filter" class="control-label"><span class="text-danger">*</span>Filter</label> <div class="form-group"> <select class="form-control" name="filter" id="filter" data-container=" body" data-live-search="true" data-hide-disabled="true" title="filter"> </select> <span class="text-danger"><?php echo form_error('filter'); ?></span> </div> </div> </div> <div class="col-md-6"> <label for="accordionTitle" class="control-label">Accordion Title</label> <div class="form-group"> <input type="text" name="accordionTitle" value="<?php echo $this->input->post('accordionTitle'); ?>" class="form-control" id="accordionTitle" /> </div> </div> </div>';
                    break;
                case 'table':
                    isi = '<div class="form-group"> <div class="col-md-6"> <label for="api_id" class="control-label"><span class="text-danger">*</span>api_id</label> <div class="form-group"> <select class="form-control" class="input_api" name="api_id" id="api_id" data-container=" body" data-live-search="true" data-hide-disabled="true" title="api_id"> <?php foreach ($api as $a) {?> <?php $selected = ($a['name'] == $this->input->post('api')) ? ' selected="selected"' : "";?> <option id="<?= $a['id'] ?>" value="<?= $a['id'] ?>" <?= $selected ?>><?= $a['name']?> </option>; <?php } ?> </select> <span class="text-danger"><?php echo form_error('api_id'); ?></span> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="filter" class="control-label"><span class="text-danger">*</span>Filter</label> <div class="form-group"> <select class="form-control" name="filter" id="filter" data-container=" body" data-live-search="true" data-hide-disabled="true" title="filter"> </select> <span class="text-danger"><?php echo form_error('filter'); ?></span> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="fvalue" class="control-label"><span class="text-danger">*</span>Filter Value</label> <div class="form-group"> <select class="form-control" name="fvalue" id="fvalue" data-container=" body" data-live-search="true" data-hide-disabled="true" title="fvalue"> </select> <span class="text-danger"><?php echo form_error('fvalue'); ?></span> </div> </div> </div><div class="col-md-6"> <label for="tableTitle" class="control-label">Table Title</label> <div class="form-group"> <input type="text" name="tableTitle" value="<?php echo $this->input->post('tableTitle'); ?>" class="form-control" id="tableTitle" /> </div> </div> </div>';
                    break;
                default:
                    isi = '';
            }
            $('#pertype').html(isi)
        });
    </script>
    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'POST',
                url: "<?= base_url() ?>/mmk/getlevel",
                cache: false,
                success: function(msg) {
                    $("#level").html(msg);
                }
            });
            $(document).on('change', 'select[name="filter"]', function() {
            $.ajax({
                type: 'POST',
                url: "<?= base_url() ?>/mmk/geticon",
                cache: false,
                success: function(msg) {
                    $("#cardIcon").html(msg);
                }
            });
        })
            $("#level").on('change', function() {
                var level = $("#level").val()
                $.ajax({
                    type: 'POST',
                    url: "<?= base_url() ?>/mmk/gettype/",
                    data: {
                        level: level
                    },
                    cache: false,
                    success: function(msg) {
                        $("#type").html(msg);
                    }
                });
            }).trigger('change')
            //api
            // $(document).on('click', 'select[name="api_id"]', function() {
            //     var id = '#' + $(this).attr('id')
            //     $.ajax({
            //         type: 'POST',
            //         url: "<?= base_url() ?>/mmk/getapi/",
            //         cache: false,
            //         success: function(msg) {
            //             $(id).html(msg);
            //         }
            //     });
            // }).trigger('change')
            $("#type").on('change', function() {
                var level = $("#level").val()
                var type = $("#type").val()
                $.ajax({
                    type: 'POST',
                    url: "<?= base_url() ?>/mmk/getfilter/",
                    data: {
                        type: type,
                        level: level
                    },
                    cache: false,
                    success: function(msg) {
                        $("#filter").html(msg);
                    }
                });
            }).trigger('change')
            $(document).on('change', 'select[name="filter"]', function() {
                var api_id = $("#api_id").val()
                var filter = $("#filter").val()
                $.ajax({
                    type: 'POST',
                    url: "<?= base_url() ?>/mmk/getfiltervalue/",
                    data: {
                        api_id: api_id,
                        filter: filter
                    },
                    cache: false,
                    success: function(msg) {
                        $("#fvalue").html(msg);
                    }
                });
            }).trigger('change')
            $("#level").on('change', function() {
                $.ajax({
                    type: 'POST',
                    url: "<?= base_url() ?>/mmk/getjurusan/",
                    cache: false,
                    success: function(msg) {
                        $("#id_jurusan").html(msg);
                    }
                });
            }).trigger('change')

            let i = 1;
            $(document).on('click', '.btn-add-api-data', function() {
                i++
                $('#disiniapi').append('<div id=apiid' + i + '><div class="form-group"> <div class="col-md-6"> <label for="api_id" class="control-label"><span class="text-danger">*</span>api_id</label> <div class="row"> <div class="form-group col-md-9"> <select class="form-control" name="api_id[]" id="api_id' + i + '" data-container=" body" data-live-search="true" data-hide-disabled="true" title="api_id"><?php foreach ($api as $a) { ?> <?php $selected = ($a['name'] == $this->input->post('api')) ? ' selected="selected"' : ""; ?> <option id="<?= $a['id'] ?>" value="<?= $a['id'] ?>" <?= $selected ?>><?= $a['name'] ?> </option>; <?php } ?> </select> <span class="text-danger"><?php echo form_error('api_id'); ?></span> </div> <div class="col-md-3"> <button class="btn btn-danger btn-small btn-remove " id="' + i + '" type="button">Hapus Api</button> </div> </div> </div> </div></div>')
            })
            $(document).on('click', '.btn-remove', function() {
                var idbtn = $(this).attr('id')
                $('#apiid' + idbtn + '').remove()
            })
        })
    </script>

</body>

</html>