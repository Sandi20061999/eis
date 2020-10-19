<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="row d-flex justify-content-between">
					<h4 class="card-title">Data Table</h4>
				</div>
				<?php echo form_open('user_menu/add_access/' . $this->uri->segment(3) . '/' . $this->uri->segment(4)); ?>
				<div class="form-group">
					<div class="col-md-6">
						<label for="view_id" class="control-label"><span class="text-danger">*</span>User View</label>
						<div class="form-group">
							<select name="view_id" class="form-control">
								<option value="">select user_view</option>
								<?php
								foreach ($all_user_view as $user_view) {
									$selected = ($user_view['id'] == $this->input->post('view_id')) ? ' selected="selected"' : "";

									echo '<option value="' . $user_view['id'] . '" ' . $selected . '>' . $user_view['view'] . '</option>';
								}
								?>
							</select>
							<span class="text-danger"><?php echo form_error('view_id'); ?></span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<label for="is_active" class="control-label"><span class="text-danger">*</span>Is Active</label>
						<div class="form-group">
							<select name="is_active" class="form-control">
								<option value="">select</option>
								<?php
								$is_active_values = array(
									'1' => 'Active',
									'0' => 'Not Active',
								);

								foreach ($is_active_values as $value => $display_text) {
									$selected = ($value == $this->input->post('is_active')) ? ' selected="selected"' : "";

									echo '<option value="' . $value . '" ' . $selected . '>' . $display_text . '</option>';
								}
								?>
							</select>
							<span class="text-danger"><?php echo form_error('is_active'); ?></span>
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