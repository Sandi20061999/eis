<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Api Edit</h3>
            </div>
			<?php echo form_open('api/edit/'.$api['id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="name" class="control-label"><span class="text-danger">*</span>Name</label>
						<div class="form-group">
							<input type="text" name="name" value="<?php echo ($this->input->post('name') ? $this->input->post('name') : $api['name']); ?>" class="form-control" id="name" />
							<span class="text-danger"><?php echo form_error('name');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="view_name" class="control-label"><span class="text-danger">*</span>View Name</label>
						<div class="form-group">
							<input type="text" name="view_name" value="<?php echo ($this->input->post('view_name') ? $this->input->post('view_name') : $api['view_name']); ?>" class="form-control" id="view_name" />
							<span class="text-danger"><?php echo form_error('view_name');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="select" class="control-label"><span class="text-danger">*</span>Select</label>
						<div class="form-group">
							<input type="text" name="select" value="<?php echo ($this->input->post('select') ? $this->input->post('select') : $api['select']); ?>" class="form-control" id="select" />
							<span class="text-danger"><?php echo form_error('select');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="where" class="control-label">Where</label>
						<div class="form-group">
							<input type="text" name="where" value="<?php echo ($this->input->post('where') ? $this->input->post('where') : $api['where']); ?>" class="form-control" id="where" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="limit" class="control-label"><span class="text-danger">*</span>Limit</label>
						<div class="form-group">
							<input type="text" name="limit" value="<?php echo ($this->input->post('limit') ? $this->input->post('limit') : $api['limit']); ?>" class="form-control" id="limit" />
							<span class="text-danger"><?php echo form_error('limit');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="order_by" class="control-label">Order By</label>
						<div class="form-group">
							<input type="text" name="order_by" value="<?php echo ($this->input->post('order_by') ? $this->input->post('order_by') : $api['order_by']); ?>" class="form-control" id="order_by" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="jsonConfig" class="control-label"><span class="text-danger">*</span>JsonConfig</label>
						<div class="form-group">
							<textarea name="jsonConfig" class="form-control" id="jsonConfig"><?php echo ($this->input->post('jsonConfig') ? $this->input->post('jsonConfig') : $api['jsonConfig']); ?></textarea>
							<span class="text-danger"><?php echo form_error('jsonConfig');?></span>
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