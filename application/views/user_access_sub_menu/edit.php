<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="row d-flex justify-content-between">
					<h4 class="card-title">Data Table</h4>
				</div>
				<?php echo form_open('user_access_sub_menu/add/' . $this->uri->segment(3) . '/' . $user_access_sub_menu['id']); ?>

				<div class="form-group">
					<div class="col-md-6">
						<label for="sub_menu_id" class="control-label"><span class="text-danger">*</span>User Sub Menu</label>
						<div class="form-group">
							<select name="sub_menu_id" class="form-control">
								<option value="">select user_sub_menu</option>
								<?php
								foreach ($all_user_sub_menu as $user_sub_menu) {
									$selected = ($user_sub_menu['id'] == $user_access_sub_menu['sub_menu_id']) ? ' selected="selected"' : "";

									echo '<option value="' . $user_sub_menu['id'] . '" ' . $selected . '>' . $user_sub_menu['title'] . '</option>';
								}
								?>
							</select>
							<span class="text-danger"><?php echo form_error('sub_menu_id'); ?></span>
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