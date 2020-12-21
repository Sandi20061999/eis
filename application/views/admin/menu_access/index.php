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
                                <th>Menu</th>
                                <th>Sub Menu</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($menu as $r) { ?>
                                <tr>
                                    <td><?php echo $r['id']; ?></td>
                                    <td><?php echo $r['menu']; ?></td>
                                    <td>
                                        <?php
                                        $sub = $this->db->select('menu_access_sub_menu.id AS idku,title')->join('sub_menu', 'sub_menu.id=menu_access_sub_menu.sub_menu_id')->get_where('menu_access_sub_menu', array('menu_id' => $r['id']))->result_array();
                                        foreach ($sub as $s) {
                                            echo "<span style='color:white' class='badge badge-info mr-1 mb-1'>" . $s['title'] . " <a href='" . base_url('menu_access/subDelete/' . $s['idku']) . "' class='badge badge-danger'><span class='fa fa-trash'></span></a></span>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a id="<?php echo  $r['id']; ?>" class="btn btn-info btn-xs btnTambahMenu" style="color: white;"><span class="fa fa-pencil"></span> Tambah Menu Access</a>
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
    $("a.btnTambahMenu").on('click', function() {
        console.log($(this).attr("id"));
        $.ajax({
            url: baseUrl + "menu_access/add/" + $(this).attr("id"),
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