<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-between px-4">
                    <h4 class="card-title">Data Table</h4>
                    <a href="<?= site_url('user/add'); ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add"><i class="mdi mdi-library-plus"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Image</th>
                                <th>Role</th>
                                <th>Is Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $u) { ?>
                                <tr>
                                    <td><?php echo $u['id']; ?></td>
                                    <td><?php echo $u['name']; ?></td>
                                    <td><?php echo $u['email']; ?></td>
                                    <td><?php echo $u['image']; ?></td>
                                    <td><?php echo $u['role']; ?></td>
                                    <td><?php echo ($u['is_active'] == 1)?'Active':'Non Active'; ?></td>
                                    <td>
                                        <a href="<?php echo site_url('user/edit/' . $u['id']); ?>" class="btn btn-info btn-xs my-1"><span class="fa fa-pencil"></span> Edit</a>
                                        <a href="<?php echo site_url('user/remove/' . $u['id']); ?>" class="btn btn-danger btn-xs my-1"><span class="fa fa-trash"></span> Delete</a>
                                        <a href="<?php echo site_url('user_access_menu/index/' . $u['id']); ?>" class="btn btn-primary btn-xs my-1"><span class="fa fa-home"></span> Access Menu</a>
                                        <a href="<?php echo site_url('user_access_sub_menu/index/' . $u['id']); ?>" class="btn btn-primary btn-xs my-1"><span class="fa fa-home"></span> Access Sub Menu</a>
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