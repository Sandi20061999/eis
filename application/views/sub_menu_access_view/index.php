<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-between px-4">
                    <h4 class="card-title">Data Table</h4>
                    <!-- <a href="<?php echo site_url('user_access_menu/add/' . $this->uri->segment(3)); ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add"><i class="mdi mdi-library-plus"></i></a> -->
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sub Menu</th>
                                <th>View</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sub_menu as $r) { ?>
                                <tr>
                                    <td><?php echo $r['id']; ?></td>
                                    <td><?php echo $r['menu'] . ' | ' . $r['title']; ?></td>
                                    <td>
                                        <?php foreach ($sub_menu_access_view as $m) {
                                            if ($r['id'] == $m['sub_menu_id']) {
                                                echo '<a href="' . base_url('admin/sub_menu_access_view/delete/') . $m['id'] . '" class="btn btn-danger btn-xs mb-1 mr-1"><span class="fa fa-trash" title="Hapus Sub Menu"></span></a>' . $m['type'] . '<br>';
                                            }
                                        } ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo site_url('admin/sub_menu_access_view/add/') . $r['id'] ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Tambah View</a><br>
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