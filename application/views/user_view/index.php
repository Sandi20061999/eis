<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-between px-4">
                    <h4 class="card-title">Data Table</h4>
                    <a href="<?= site_url('user_view/add'); ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add"><i class="mdi mdi-library-plus"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>View</th>
                                <th>View Name</th>
                                <th>Select</th>
                                <th>Where</th>
                                <th>Limit</th>
                                <th>Order By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user_view as $u) { ?>
                                <tr>
                                    <td><?php echo $u['id']; ?></td>
                                    <td><?php echo $u['type']; ?></td>
                                    <td><?php echo $u['view']; ?></td>
                                    <td><?php echo $u['view_name']; ?></td>
                                    <td><?php echo $u['select']; ?></td>
                                    <td><?php echo $u['where']; ?></td>
                                    <td><?php echo $u['limit']; ?></td>
                                    <td><?php echo $u['order_by']; ?></td>
                                    <td>
                                        <a href="<?php echo site_url('user_view/edit/' . $u['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a>
                                        <a href="<?php echo site_url('user_view/remove/' . $u['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
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