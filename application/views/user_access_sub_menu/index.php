<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">User Access Sub Menu Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('user_access_sub_menu/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>User Id</th>
						<th>Sub Menu Id</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($user_access_sub_menu as $u){ ?>
                    <tr>
						<td><?php echo $u['id']; ?></td>
						<td><?php echo $u['user_id']; ?></td>
						<td><?php echo $u['sub_menu_id']; ?></td>
						<td>
                            <a href="<?php echo site_url('user_access_sub_menu/edit/'.$u['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('user_access_sub_menu/remove/'.$u['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
