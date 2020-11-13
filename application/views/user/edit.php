<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="row d-flex justify-content-between">
					<h4 class="card-title">Data Table</h4>
				</div>
				<?php echo form_open('user/edit/' . $user['id'], array("class" => "form-horizontal")); ?>
				<div class="form-group">
					<label for="role_id" class="col-md-4 control-label">User Role</label>
					<div class="col-md-8">
						<select name="role_id" class="form-control">
							<option value="">Select Role</option>
							<?php
							foreach ($all_user_roles as $user_role) {
								$selected = ($user_role['id'] == $user['role_id']) ? ' selected="selected"' : "";

								echo '<option value="' . $user_role['id'] . '" ' . $selected . '>' . $user_role['role'] . '</option>';
							}
							?>
						</select>
						<span class="text-danger"><?php echo form_error('role_id'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="col-md-4 control-label">Password</label>
					<div class="col-md-8">
						<input type="text" name="password" value="<?php echo $this->input->post('password'); ?>" class="form-control" id="password" />
						<span class="text-danger"><?php echo form_error('password'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-md-4 control-label">Name</label>
					<div class="col-md-8">
						<input type="text" name="name" value="<?php echo ($this->input->post('name') ? $this->input->post('name') : $user['name']); ?>" class="form-control" id="name" />
						<span class="text-danger"><?php echo form_error('name'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="col-md-4 control-label">Email</label>
					<div class="col-md-8">
						<input type="text" name="email" value="<?php echo ($this->input->post('email') ? $this->input->post('email') : $user['email']); ?>" class="form-control" id="email" />
						<span class="text-danger"><?php echo form_error('email'); ?></span>
					</div>
				</div>

				<div class="form-group">
					<label for="is_active" class="col-md-4 control-label">Is Active</label>
					<div class="col-md-8">
						<select name="is_active" class="form-control">
							<option value="">Is Active</option>
							<?php
							$active = [0 => 'Inactive', 1 => 'Active'];
							foreach ($active as $i => $v) {
								$selected = ($i == $user['is_active']) ? ' selected="selected"' : "";

								echo '<option value="' . $i . '" ' . $selected . '>' . $v . '</option>';
							}
							?>
						</select>
						<span class="text-danger"><?php echo form_error('is_active'); ?></span>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-success">Save</button>
					</div>
				</div>

				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>