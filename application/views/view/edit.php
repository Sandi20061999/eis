<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="row d-flex justify-content-between">
					<h4 class="card-title"><?= $view; ?></h4>
				</div>
				<?php echo form_open('admin/view/add', array("class" => "form-horizontal")); ?>
				<div class="form-group">
					<div class="col-md-6">
						<label for="type" class="control-label"><span class="text-danger">*</span>Type</label>
						<div class="form-group">
							<select name="type" class="form-control" id="select_type">
								<option value="">Select</option>
								<?php
								$type_values = array(
									'table' => 'Table',
									'accordion-table' => 'Accordion and Table',
									'morris-line-chart' => 'Morris Line Chart',
									'morris-bar-chart' => 'Morris Bar Chart',
									// 'grid' => 'Grid',
									'tab' => 'Tab',
									'header' => 'Header',
									'card' => 'Card',
								);
								foreach ($type_values as $value => $display_text) {
									$selected = ($value == $view['type'] ? 'selected="selected"' : "");
									echo '<option id="' . $value . '" value="' . $value . '" ' . $selected . '>' . $display_text . '</option>';
								}
								?>
							</select>
							<span class="text-danger"><?php echo form_error('type'); ?></span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<label for="api_id" class="control-label"><span class="text-danger">*</span>API</label>
						<div class="form-group">
							<select name="api_id" class="form-control" id="api_id">
								<option value="">Select API</option>
								<?php foreach ($api as $value) {
									$selected = ($value['id'] == $this->input->post('api_id')) ? ' selected="selected"' : "";
									echo '<option id="' . $value['id'] . '" value="' . $value['id'] . '" ' . $selected . '>' . $value['name'] . '</option>';
								} ?>
							</select>
						</div>
					</div>
				</div>
				<div id="pertype">

					<!-- table -->

					<!-- Accordion Table -->

					<!-- header -->

					<!-- chart -->

					<!-- card -->

					<!-- tab -->

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