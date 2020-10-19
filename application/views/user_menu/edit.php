<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="row d-flex justify-content-between">
					<h4 class="card-title">Data Table</h4>
				</div>
				<?php echo form_open('user_menu/edit/' . $user_menu['id'], array("class" => "form-horizontal")); ?>

				
				<div class="form-group">
					<label for="title" class="col-md-4 control-label">Menu</label>
					<div class="col-md-8">
						<input type="text" name="menu" value="<?php echo ($this->input->post('menu') ? $this->input->post('menu') : $user_menu['menu']); ?>" class="form-control" id="menu" />
						<span class="text-danger"><?php echo form_error('menu'); ?></span>
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