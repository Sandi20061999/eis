<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="row d-flex justify-content-between">
					<h4 class="card-title">Data Table</h4>
				</div>
				<?php echo form_open('admin/role/edit/' . $user_role['id'], array("class" => "form-horizontal")); ?>

				<div class="form-group">
					<label for="role" class="col-md-4 control-label">Role</label>
					<div class="col-md-8">
						<input type="text" name="role" value="<?php echo ($this->input->post('role') ? $this->input->post('role') : $user_role['role']); ?>" class="form-control" id="role" />
						<span class="text-danger"><?php echo form_error('role'); ?></span>
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