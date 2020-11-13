<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="row d-flex justify-content-between">
					<h4 class="card-title">View</h4>
				</div>
				<?php echo form_open('admin/view/add', array("class" => "form-horizontal")); ?>
				<div class="form-group">
					<div class="col-md-6">
						<label for="level" class="control-label"><span class="text-danger">*</span>Level</label>
						<div class="form-group">
							<select class="form-control" name="level" id="level" data-container=" body" data-live-search="true" data-hide-disabled="true" title="Level">
							</select>
							<span class="text-danger"><?php echo form_error('level'); ?></span>
						</div>
					</div>
				</div>
				<div <div id="infolevel">
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<label for="type" class="control-label"><span class="text-danger">*</span>Type</label>
						<div class="form-group">
							<select class="form-control" name="type" id="type" data-container=" body" data-live-search="true" data-hide-disabled="true" title="type">
							</select>
							<span class="text-danger"><?php echo form_error('type'); ?></span>
						</div>
					</div>
				</div>
				
				<h4>Data</h4>
				<div id="pertype">
				</div>
				<div id="disiniapi">
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