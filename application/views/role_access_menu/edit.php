<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="row d-flex justify-content-between">
					<h4 class="card-title">Data Table</h4>
				</div>
				<?php echo form_open('user_access_menu/edit/' . $this->uri->segment(3) . '/' . $user_access_menu['id']); ?>
				<div class="form-group">
					<div class="col-md-6">
						<label for="menu_id" class="control-label"><span class="text-danger">*</span>User Menu</label>
						<div class="form-group">
							<select name="menu_id" class="form-control">
								<option value="">select user_menu</option>
								<?php
								foreach ($all_user_menu as $user_menu) {
									$selected = ($user_menu['id'] == $user_access_menu['menu_id']) ? ' selected="selected"' : "";

									echo '<option value="' . $user_menu['id'] . '" ' . $selected . '>' . $user_menu['menu'] . '</option>';
								}
								?>
							</select>
							<span class="text-danger"><?php echo form_error('menu_id'); ?></span>
						</div>
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