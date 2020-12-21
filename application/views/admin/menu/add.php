<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Menu Add</h3>
            </div>
            <?php echo form_open('menu/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="menu" class="control-label"><span class="text-danger">*</span>Menu</label>
						<div class="form-group">
							<input type="text" name="menu" value="<?php echo $this->input->post('menu'); ?>" class="form-control" id="menu" />
							<span class="text-danger"><?php echo form_error('menu');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="icon" class="control-label"><span class="text-danger">*</span>Icon</label>
						<div class="form-group">
							<input type="text" name="icon" value="<?php echo $this->input->post('icon'); ?>" class="form-control" id="icon" />
							<span class="text-danger"><?php echo form_error('icon');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="by" class="control-label"><span class="text-danger">*</span>By</label>
						<div class="form-group">
							<input type="text" name="by" value="<?php echo $this->input->post('by'); ?>" class="form-control" id="by" />
							<span class="text-danger"><?php echo form_error('by');?></span>
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