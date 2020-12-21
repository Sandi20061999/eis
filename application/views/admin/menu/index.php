<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Menu Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('menu/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Menu</th>
						<th>Icon</th>
						<th>By</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($menu as $m){ ?>
                    <tr>
						<td><?php echo $m['id']; ?></td>
						<td><?php echo $m['menu']; ?></td>
						<td><?php echo $m['icon']; ?></td>
						<td><?php echo $m['by']; ?></td>
						<td>
                            <a href="<?php echo site_url('menu/edit/'.$m['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('menu/remove/'.$m['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
