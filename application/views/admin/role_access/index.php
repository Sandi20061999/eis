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
                                <th>Role</th>
                                <th>Menu | Sub Menu</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($role as $r) { ?>
                                <tr>
                                    <td><?php echo $r['id']; ?></td>
                                    <td><?php echo $r['role']; ?></td>
                                    <td><?php
                                        $menu = $this->db->select('DISTINCT(menu),menu_id')->join('menu_access_sub_menu', 'menu_access_sub_menu.id=role_access_menu_sub_menu.menu_access_sub_menu_id')->join('menu', 'menu.id=menu_access_sub_menu.menu_id')->order_by('menu.by', 'ASC')->get_where('role_access_menu_sub_menu', array('role_id' => $r['id']))->result_array();
                                        $html = '';
                                        foreach ($menu as $m) {
                                            $html .= "<span style='color:white' class='badge badge-info mr-1 mb-1'>" . $m['menu'] . " => ";
                                            $sub = $this->db->select('menu_access_sub_menu.id,title')->join('menu_access_sub_menu', 'menu_access_sub_menu.id=role_access_menu_sub_menu.menu_access_sub_menu_id')->join('sub_menu', 'sub_menu.id=menu_access_sub_menu.sub_menu_id')->order_by('sub_menu.by', 'ASC')->get_where('role_access_menu_sub_menu', array('menu_id' => $m['menu_id'], 'role_id' => $r['id']))->result_array();
                                            foreach ($sub as $s) {
                                                $html .= " | " . $s['title'] . " <a href='" . base_url('role_access/subDelete/' . $r['id'] . '/' . $s['id']) . "' class='badge badge-danger'><span class='fa fa-trash'></span></a>";
                                            }
                                            $html .= "</span>";
                                        }
                                        echo $html;
                                        ?></td>
                                    <td>
                                        <a id="<?php echo  $r['id']; ?>" class="btn btn-xs btn-info TambahMenu" style="color: white;">Tambah Menu</a>
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
    $("a.TambahMenu").on('click', function() {
        console.log($(this).attr("id"));
        $.ajax({
            url: baseUrl + "role_access/add/" + $(this).attr("id"),
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