<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="row d-flex justify-content-between">
					<h4 class="card-title">Data Table</h4>
				</div>
				<?php echo form_open('user_menu/edit_sub/' . $this->uri->segment(3) . '/' . $user_sub_menu['id'], array("class" => "form-horizontal")); ?>

				<div class="form-group">
					<label for="is_active" class="col-md-4 control-label">Is Active</label>
					<div class="col-md-8">
						<select name="is_active" class="form-control">
							<option value="">select</option>
							<?php
							$is_active_values = array(
								'0' => 'Inactive',
								'1' => 'Active',
							);

							foreach ($is_active_values as $value => $display_text) {
								$selected = ($value == $user_menu['is_active']) ? ' selected="selected"' : "";

								echo '<option value="' . $value . '" ' . $selected . '>' . $display_text . '</option>';
							}
							?>
						</select>
						<span class="text-danger"><?php echo form_error('is_active'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<label for="title" class="col-md-4 control-label">Title</label>
					<div class="col-md-8">
						<input type="text" name="title" value="<?php echo ($this->input->post('title') ? $this->input->post('title') : $user_sub_menu['title']); ?>" class="form-control" id="title" />
						<span class="text-danger"><?php echo form_error('title'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<label for="url" class="col-md-4 control-label">Url</label>
					<div class="col-md-8">
						<input type="text" name="url" value="<?php echo ($this->input->post('url') ? $this->input->post('url') : $user_sub_menu['url']); ?>" class="form-control" id="url" />
						<span class="text-danger"><?php echo form_error('url'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<label for="icon" class="col-md-4 control-label">Icon</label>
					<div class="col-md-8">
						<input type="text" name="icon" value="<?php echo ($this->input->post('icon') ? $this->input->post('icon') : $user_sub_menu['icon']); ?>" class="form-control" id="icon" />
						<span class="text-danger"><?php echo form_error('icon'); ?></span>
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