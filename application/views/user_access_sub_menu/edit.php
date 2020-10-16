<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">User Access Sub Menu Edit</h3>
            </div>
			<?php echo form_open('user_access_sub_menu/edit/'.$user_access_sub_menu['id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="user_id" class="control-label"><span class="text-danger">*</span>User</label>
						<div class="form-group">
							<select name="user_id" class="form-control">
								<option value="">select user</option>
								<?php 
								foreach($all_user as $user)
								{
									$selected = ($user['id'] == $user_access_sub_menu['user_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$user['id'].'" '.$selected.'>'.$user['name'].'</option>';
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('user_id');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="sub_menu_id" class="control-label"><span class="text-danger">*</span>User Sub Menu</label>
						<div class="form-group">
							<select name="sub_menu_id" class="form-control">
								<option value="">select user_sub_menu</option>
								<?php 
								foreach($all_user_sub_menu as $user_sub_menu)
								{
									$selected = ($user_sub_menu['id'] == $user_access_sub_menu['sub_menu_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$user_sub_menu['id'].'" '.$selected.'>'.$user_sub_menu['title'].'</option>';
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('sub_menu_id');?></span>
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