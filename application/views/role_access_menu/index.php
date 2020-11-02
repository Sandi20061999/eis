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
                                <th>Role</th>
                                <th>Menu</th>
                                <th>Sub Menu</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($role as $r) { ?>
                                <tr>
                                    <td><?php echo $r['id']; ?></td>
                                    <td><?php echo $r['role']; ?></td>
                                    <td>
                                        <?php foreach ($role_access_menu as $m) {
                                            if ($r['id'] == $m['role_id']) {
                                                echo '<a href="' . base_url('admin/role_access_menu/delete/') . $m['id'] . '" class="btn btn-danger btn-xs mb-1 mr-1"><span class="fa fa-trash" title="Hapus Sub Menu"></span></a>' . $m['menu'] . '<br>';
                                            }
                                        } ?></td>
                                    <td><?php foreach ($role_access_sub_menu as $sm) {
                                            if ($r['id'] == $sm['role_id']) {
                                                echo '<a href="' . base_url('admin/role_access_sub_menu/delete/') . $sm['id'] . '" class="btn btn-danger btn-xs mb-1 mr-1"><span class="fa fa-trash" title="Hapus Sub Menu"></span></a>' . $sm['title'] . '<br>';
                                            }
                                        } ?></td>
                                    <td>
                                        <a href="<?php echo site_url('admin/role_access_menu/add/') . $r['id'] ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Tambah Menu</a><br>
                                        <a href="<?php echo site_url('admin/role_access_sub_menu/add/' . $r['id']) ?>" class="btn btn-success btn-xs text-white"><span class="fa fa-pencil"></span> Tambah Sub Menu</a><br>
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