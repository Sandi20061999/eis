<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">View Add</h3>
            </div>
            <?php echo form_open('view/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="jsonFile" class="control-label"><span class="text-danger">*</span>JsonFile</label>
						<div class="form-group">
							<textarea name="jsonFile" class="form-control" id="jsonFile"><?php echo $this->input->post('jsonFile'); ?></textarea>
							<span class="text-danger"><?php echo form_error('jsonFile');?></span>
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Save
            	</button>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>