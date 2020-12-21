<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-between px-4">
                    <h4 class="card-title">Data Table</h4>
                </div>
                <div class="table-responsive">
                    <a href="<?php echo site_url('api/add'); ?>" class="btn btn-success btn-sm ml-2" style="color: white;">Add</a>
                    <table class="table table-sm table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>View Name</th>
                                <th>Select</th>
                                <th>Where</th>
                                <th>Limit</th>
                                <th>Order By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($api as $a) { ?>
                                <tr>
                                    <td><?php echo $a['id']; ?></td>
                                    <td><?php echo $a['name']; ?></td>
                                    <td><?php echo $a['view_name']; ?></td>
                                    <td><?php echo $a['select']; ?></td>
                                    <td><?php echo $a['where']; ?></td>
                                    <td><?php echo $a['limit']; ?></td>
                                    <td><?php echo $a['order_by']; ?></td>
                                    <td>
                                        <a href="<?php echo site_url('api/edit/' . $a['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a>
                                        <a href="<?php echo site_url('api/remove/' . $a['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
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