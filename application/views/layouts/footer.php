</div>
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

<script src="<?= base_url() ?>/assets/plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/chart.js/Chart.bundle.min.js"></script>

<script>
    hljs.initHighlightingOnLoad();
</script>

<script>
    var config = {
        type: 'bar',
        data: {
            labels: ["20201", "20202", "20191", "20192", ],
            datasets: [{
                fill: false,
                label: "Label 1",
                backgroundColor: "#f0ff0f",
                borderColor: "#f0ff0f",
                borderWidth: 1,
                data: [0, 3, 2, 4, ]
            }, {
                fill: false,
                label: "Label 2",
                backgroundColor: "#f00fa0",
                borderColor: "#f00fa0",
                borderWidth: 1,
                data: [9, 7, 2, 5, ]
            }, ]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: "Chart.js Line Chart"
            },
            tooltips: {
                mode: "index",
                intersect: false,
            },
            hover: {
                mode: "nearest",
                intersect: true,
            },
            "animation": {
                "duration": 0,
                "onComplete": function() {
                    var chartInstance = this.chart,
                        ctx = chartInstance.ctx;

                    ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'bottom';


                }
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: "kdta"
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: "jumlah"
                    }
                }]
            }
        }
    }
    window.onload = function() {
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myLine = new Chart(ctx, config);
    };
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
    <?php
    // $i = 0;
    foreach ($javascript as $j) {
        echo $j;
        // $i++;
    } ?>
</script>
<script>
    $.ajax({
        type: 'POST',
        url: "<?= site_url('user_view/getApi/'); ?>",
        cache: false,
        success: function(msg) {
            $("#api").html(msg);
        }
    });
    $("#select_type").change(function() {
        var id = $(this).children(":selected").attr("id");
        switch (id) {
            case 'table':
                isi = '<div class="form-group"> <div class="col-md-6"> <label for="tableHeader" class="control-label">Table Header</label> <div class="form-group"> <input type="text" name="tableHeader" value="<?php echo $this->input->post('tableHeader'); ?>" class="form-control" id="tableHeader" /> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="tableTitle" class="control-label">Table Title</label> <div class="form-group"> <input type="text" name="tableTitle" value="<?php echo $this->input->post('tableTitle'); ?>" class="form-control" id="tableTitle" /> </div> </div> </div>';
                break;
            case 'accordion-table':
                isi = '<div class="form-group"> <div class="col-md-6"> <label for="accordionTableTitle" class="control-label">Accordion Table Title</label> <div class="form-group"> <input type="text" name="accordionTableTitle" value="<?php echo $this->input->post('accordionTableTitle'); ?>" class="form-control" id="accordionTableTitle" /> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="accordionTablePer" class="control-label">Accordion Table Per</label> <div class="form-group"> <input type="text" name="accordionTablePer" value="<?php echo $this->input->post('accordionTablePer'); ?>" class="form-control" id="accordionTablePer" /> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="accordionTableUnik" class="control-label">Accrodion Table Unik</label> <div class="form-group"> <input type="text" name="accordionTableUnik" value="<?php echo $this->input->post('accordionTableUnik'); ?>" class="form-control" id="accordionTableUnik" /> </div> </div> </div>';
                break;
            case 'morris-line-chart':
                isi = '<div class="form-group"> <div class="col-md-6"> <label for="chartTitle" class="control-label">Chart Title</label> <div class="form-group"> <input type="text" name="chartTitle" value="<?php echo $this->input->post('chartTitle'); ?>" class="form-control" id="chartTitle" /> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="chartXkey" class="control-label">Chart X key</label> <div class="form-group"> <input type="text" name="chartXkey" value="<?php echo $this->input->post('chartXkey'); ?>" class="form-control" id="chartXkey" /> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="chartYkey" class="control-label">Chart Y Key</label> <div class="form-group"> <input type="text" name="chartYkey" value="<?php echo $this->input->post('chartYkey'); ?>" class="form-control" id="chartYkey" /> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="chartColor" class="control-label">Chart Color</label> <div class="form-group"> <input type="text" name="chartColor" value="<?php echo $this->input->post('chartColor'); ?>" class="form-control" id="chartColor" /> </div> </div> </div>';
                break;
            case 'morris-bar-chart':
                isi = '<div class="form-group"> <div class="col-md-6"> <label for="chartTitle" class="control-label">Chart Title</label> <div class="form-group"> <input type="text" name="chartTitle" value="<?php echo $this->input->post('chartTitle'); ?>" class="form-control" id="chartTitle" /> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="chartXkey" class="control-label">Chart X key</label> <div class="form-group"> <input type="text" name="chartXkey" value="<?php echo $this->input->post('chartXkey'); ?>" class="form-control" id="chartXkey" /> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="chartYkey" class="control-label">Chart Y Key</label> <div class="form-group"> <input type="text" name="chartYkey" value="<?php echo $this->input->post('chartYkey'); ?>" class="form-control" id="chartYkey" /> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="chartColor" class="control-label">Chart Color</label> <div class="form-group"> <input type="text" name="chartColor" value="<?php echo $this->input->post('chartColor'); ?>" class="form-control" id="chartColor" /> </div> </div> </div>';
                break;
            case 'tab':
                isi = '<div class="form-group"> <div class="col-md-6"> <label for="tabData" class="control-label">Tab Data</label> <div class="form-group"> <input type="text" name="tabData" value="<?php echo $this->input->post('tabData'); ?>" class="form-control" id="tabData" /> </div> </div> </div>';
                break;
            case 'card':
                isi = '<div class="form-group"> <div class="col-md-6"> <label for="cardTitle" class="control-label">Card Title</label> <div class="form-group"> <input type="text" name="cardTitle" value="<?php echo $this->input->post('cardTitle'); ?>" class="form-control" id="cardTitle" /> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="cardWidth" class="control-label">Card Width</label> <div class="form-group"> <input type="text" name="cardWidth" value="<?php echo $this->input->post('cardWidth'); ?>" class="form-control" id="cardWidth" /> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="cardValue" class="control-label">Card Value</label> <div class="form-group"> <input type="text" name="cardValue" value="<?php echo $this->input->post('cardValue'); ?>" class="form-control" id="cardValue" /> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="cardDetail" class="control-label">Card Detail</label> <div class="form-group"> <input type="text" name="cardDetail" value="<?php echo $this->input->post('cardDetail'); ?>" class="form-control" id="cardDetail" /> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="cardIcon" class="control-label">Card Icon</label> <div class="form-group"> <input type="text" name="cardIcon" value="<?php echo $this->input->post('cardIcon'); ?>" class="form-control" id="cardIcon" /> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="cardColor" class="control-label">Card Color</label> <div class="form-group"> <input type="text" name="cardColor" value="<?php echo $this->input->post('cardColor'); ?>" class="form-control" id="cardColor" /> </div> </div> </div>';
                break;
            case 'header':
                isi = '<div class="form-group"> <div class="col-md-6"> <label for="headerTitle" class="control-label">Header Title</label> <div class="form-group"> <input type="text" name="headerTitle" value="<?php echo $this->input->post('headerTitle'); ?>" class="form-control" id="headerTitle" /> </div> </div> </div> <div class="form-group"> <div class="col-md-6"> <label for="sizeText" class="control-label">Size</label> <div class="form-group"> <input type="text" name="sizeText" value="<?php echo $this->input->post('sizeText'); ?>" class="form-control" id="sizeText" /> </div> </div> </div>';
                break;
            default:
                isi = '';
        }
        $('#pertype').html(isi)
    });
</script>
</body>

</html>