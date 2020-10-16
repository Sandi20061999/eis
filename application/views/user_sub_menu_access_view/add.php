<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">User Sub Menu Access View Add</h3>
            </div>
            <?php echo form_open('user_sub_menu_access_view/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="sub_menu_id" class="control-label"><span class="text-danger">*</span>User Sub Menu</label>
						<div class="form-group">
							<select name="sub_menu_id" class="form-control">
								<option value="">select user_sub_menu</option>
								<?php 
								foreach($all_user_sub_menu as $user_sub_menu)
								{
									$selected = ($user_sub_menu['id'] == $this->input->post('sub_menu_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$user_sub_menu['id'].'" '.$selected.'>'.$user_sub_menu['title'].'</option>';
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('sub_menu_id');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="view_id" class="control-label"><span class="text-danger">*</span>User View</label>
						<div class="form-group">
							<select name="view_id" class="form-control">
								<option value="">select user_view</option>
								<?php 
								foreach($all_user_view as $user_view)
								{
									$selected = ($user_view['id'] == $this->input->post('view_id')) ? ' selected="selected"' : "";

									echo '<option value="'.$user_view['id'].'" '.$selected.'>'.$user_view['view'].'</option>';
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('view_id');?></span>
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