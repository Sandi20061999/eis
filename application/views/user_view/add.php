<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">User View Add</h3>
            </div>
            <?php echo form_open('user_view/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="type" class="control-label"><span class="text-danger">*</span>Type</label>
						<div class="form-group">
							<select name="type" class="form-control">
								<option value="">select</option>
								<?php 
								$type_values = array(
									'table'=>'Table',
									'chart'=>'Chart',
									'grid'=>'Grid',
								);

								foreach($type_values as $value => $display_text)
								{
									$selected = ($value == $this->input->post('type')) ? ' selected="selected"' : "";

									echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('type');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="view" class="control-label"><span class="text-danger">*</span>View</label>
						<div class="form-group">
							<input type="text" name="view" value="<?php echo $this->input->post('view'); ?>" class="form-control" id="view" />
							<span class="text-danger"><?php echo form_error('view');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="view_name" class="control-label">View Name</label>
						<div class="form-group">
							<input type="text" name="view_name" value="<?php echo $this->input->post('view_name'); ?>" class="form-control" id="view_name" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="select" class="control-label">Select</label>
						<div class="form-group">
							<input type="text" name="select" value="<?php echo $this->input->post('select'); ?>" class="form-control" id="select" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="where" class="control-label">Where</label>
						<div class="form-group">
							<input type="text" name="where" value="<?php echo $this->input->post('where'); ?>" class="form-control" id="where" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="limit" class="control-label">Limit</label>
						<div class="form-group">
							<input type="text" name="limit" value="<?php echo $this->input->post('limit'); ?>" class="form-control" id="limit" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="order_by" class="control-label">Order By</label>
						<div class="form-group">
							<input type="text" name="order_by" value="<?php echo $this->input->post('order_by'); ?>" class="form-control" id="order_by" />
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