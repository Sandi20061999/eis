<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="row d-flex justify-content-between">
					<h4 class="card-title">Data Table</h4>
				</div>
				<?php echo form_open('admin/sub_menu/add/' . $this->uri->segment(4), array("class" => "form-horizontal")); ?>

				<div class="form-group">
					<label for="is_active" class="col-md-4 control-label">Is Active</label>
					<div class="col-md-8">
						<select name="is_active" class="form-control">
							<?php
							$is_active_values = array(
								'1' => 'Active',
								'0' => 'Inactive',
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
				<div class="form-group">
					<label for="title" class="col-md-4 control-label">Title</label>
					<div class="col-md-8">
						<input type="text" name="title" value="<?php echo $this->input->post('title'); ?>" class="form-control" id="title" />
						<span class="text-danger"><?php echo form_error('title'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<label for="icon" class="col-md-4 control-label">Icon</label>
					<div class="col-md-8">
						<input type="text" name="icon" value="<?php echo $this->input->post('icon'); ?>" class="form-control" id="icon" />
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