<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-between px-4">
                    <h4 class="card-title">Data Table</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>View</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($sub_menu as $s) { ?>
                                <tr>
                                    <td><?php echo $s['id']; ?></td>
                                    <td><?php echo $s['title']; ?></td>
                                    <td>
                                        <?php
                                        $view = $this->db->select('sub_menu_access_view.id,jsonFile')->join('view', 'view.id=sub_menu_access_view.view_id')->get_where('sub_menu_access_view', array('sub_menu_id' => $s['id']))->result_array();
                                        foreach ($view as $v) {
                                            $json = json_decode($v['jsonFile'], TRUE);
                                            echo "<span style='color:white' class='badge badge-info mr-1 mb-1'>" . $json['name'] . " <a href='" . base_url('sub_menu_access/subDelete/' . $v['id']) . "' class='badge badge-danger'><span class='fa fa-trash'></span></a></span>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a id="<?php echo  $s['id']; ?>" class="btn btn-xs btn-info TambahSubMenu" style="color: white;">Tambah View</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="pilihan"></div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.bootstrap-select').selectpicker();
    })
    var baseUrl = '<?= base_url() ?>';
    $("a.TambahSubMenu").on('click', function() {
        console.log($(this).attr("id"));
        $.ajax({
            url: baseUrl + "sub_menu_access/add/" + $(this).attr("id"),
            type: "POST",
            cache: false,
            success: function(data) {
                // console.log(data);
                $("#pilihan").html(data);
                $('.bootstrap-select').selectpicker();
                $("#addNewModal").modal('show');
            }
        })
    })
</script>