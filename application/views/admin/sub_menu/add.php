<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Sub Menu Add</h3>
            </div>
            <?php echo form_open('sub_menu/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="is_active" class="control-label"><span class="text-danger">*</span>Is Active</label>
						<div class="form-group">
							<select name="is_active" class="form-control">
								<option value="">select</option>
								<?php 
								$is_active_values = array(
									'1'=>'Aktif',
									'2'=>'Non Aktif',
								);

								foreach($is_active_values as $value => $display_text)
								{
									$selected = ($value == $this->input->post('is_active')) ? ' selected="selected"' : "";

									echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('is_active');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="title" class="control-label"><span class="text-danger">*</span>Title</label>
						<div class="form-group">
							<input type="text" name="title" value="<?php echo $this->input->post('title'); ?>" class="form-control" id="title" />
							<span class="text-danger"><?php echo form_error('title');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="url" class="control-label">Url</label>
						<div class="form-group">
							<input type="text" name="url" value="<?php echo $this->input->post('url'); ?>" class="form-control" id="url" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="icon" class="control-label">Icon</label>
						<div class="form-group">
							<input type="text" name="icon" value="<?php echo $this->input->post('icon'); ?>" class="form-control" id="icon" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="by" class="control-label"><span class="text-danger">*</span>By</label>
						<div class="form-group">
							<input type="text" name="by" value="<?php echo $this->input->post('by'); ?>" class="form-control" id="by" />
							<span class="text-danger"><?php echo form_error('by');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="pict" class="control-label"><span class="text-danger">*</span>Pict</label>
						<div class="form-group">
							<input type="text" name="pict" value="<?php echo $this->input->post('pict'); ?>" class="form-control" id="pict" />
							<span class="text-danger"><?php echo form_error('pict');?></span>
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