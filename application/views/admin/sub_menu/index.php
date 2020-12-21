<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Sub Menu Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('sub_menu/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Is Active</th>
						<th>Title</th>
						<th>Url</th>
						<th>Icon</th>
						<th>By</th>
						<th>Pict</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($sub_menu as $s){ ?>
                    <tr>
						<td><?php echo $s['id']; ?></td>
						<td><?php echo $s['is_active']; ?></td>
						<td><?php echo $s['title']; ?></td>
						<td><?php echo $s['url']; ?></td>
						<td><?php echo $s['icon']; ?></td>
						<td><?php echo $s['by']; ?></td>
						<td><?php echo $s['pict']; ?></td>
						<td>
                            <a href="<?php echo site_url('sub_menu/edit/'.$s['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('sub_menu/remove/'.$s['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
