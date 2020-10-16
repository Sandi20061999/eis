<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">User Sub Menu Add</h3>
            </div>
            <?php echo form_open('user_sub_menu/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="menu_id" class="control-label">User Menu</label>
						<div class="form-group">
							<select name="menu_id" class="form-control">
								<option value="">select user_menu</option>
								<?php 
								foreach($all_user_menu as $user_menu)
								{
									$selected = ($user_menu['id'] == $this->input->post('menu_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$user_menu['id'].'" '.$selected.'>'.$user_menu['menu'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="is_active" class="control-label"><span class="text-danger">*</span>Is Active</label>
						<div class="form-group">
							<select name="is_active" class="form-control">
								<option value="">select</option>
								<?php 
								$is_active_values = array(
									'1'=>'Active',
									'0'=>'Not Active',
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
						<label for="url" class="control-label"><span class="text-danger">*</span>Url</label>
						<div class="form-group">
							<input type="text" name="url" value="<?php echo $this->input->post('url'); ?>" class="form-control" id="url" />
							<span class="text-danger"><?php echo form_error('url');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="icon" class="control-label"><span class="text-danger">*</span>Icon</label>
						<div class="form-group">
							<input type="text" name="icon" value="<?php echo $this->input->post('icon'); ?>" class="form-control" id="icon" />
							<span class="text-danger"><?php echo form_error('icon');?></span>
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