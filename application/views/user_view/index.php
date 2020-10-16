<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">User View Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('user_view/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
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
                    <?php foreach($user_view as $u){ ?>
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
                            <a href="<?php echo site_url('user_view/edit/'.$u['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('user_view/remove/'.$u['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
