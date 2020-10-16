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
<script src="<?= base_url() ?>/assets//plugins/raphael/raphael.min.js"></script>
<script src="<?= base_url() ?>/assets//plugins/morris/morris.min.js"></script>
<script src="<?= base_url() ?>/assets//plugins/flot/js/jquery.flot.min.js"></script>
<script src="<?= base_url() ?>/assets//plugins/flot/js/jquery.flot.pie.js"></script>
<script src="<?= base_url() ?>/assets//plugins/flot/js/jquery.flot.resize.js"></script>
<script src="<?= base_url() ?>/assets//plugins/flot/js/jquery.flot.spline.js"></script>
<script src="<?= base_url() ?>/assets//plugins/flot/js/jquery.flot.init.js"></script>

<script>
    $(function() {
        "use strict";
        <?php
        if (isset($key) && isset($data) && isset($type)) {
            echo morris_chart($key, $data, $type);
        } else {
            echo "";
        }
        ?>
    });
</script>
</body>

</html>