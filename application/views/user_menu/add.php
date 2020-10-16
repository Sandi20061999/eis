<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">User Menu Add</h3>
            </div>
            <?php echo form_open('user_menu/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="menu" class="control-label"><span class="text-danger">*</span>Menu</label>
						<div class="form-group">
							<input type="text" name="menu" value="<?php echo $this->input->post('menu'); ?>" class="form-control" id="menu" />
							<span class="text-danger"><?php echo form_error('menu');?></span>
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Save
            	</button>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>