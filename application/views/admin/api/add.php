<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="row d-flex justify-content-between">
					<h4 class="card-title">Form Api</h4>
				</div>
				<form id="apiForm">
					<div class="form-group row">
						<div class="col-md-8">
							<label for="name" class="control-label"><span class="text-danger">*</span>Name</label>
							<input type="text" name="name" value="<?php echo $this->input->post('name'); ?>" class="form-control" id="name" />
							<span class="text-danger"><?php echo form_error('name'); ?></span>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="select" class="control-label"><span class="text-danger">*</span>Select</label>
							<input type="text" name="select" value="<?php echo $this->input->post('select'); ?>" class="form-control" id="select" />
							<span class="text-danger"><?php echo form_error('select'); ?></span>
						</div>
						<div class="col-md-6">
							<label for="view_name" class="control-label"><span class="text-danger">*</span>View Name</label>
							<input type="text" name="view_name" value="<?php echo $this->input->post('view_name'); ?>" class="form-control" id="view_name" />
							<span class="text-danger"><?php echo form_error('view_name'); ?></span>
						</div>
						<div class="col-md-4">
							<label for="where" class="control-label">Where</label>
							<input type="text" name="where" value="<?php echo $this->input->post('where'); ?>" class="form-control" id="where" />
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-4">
							<label for="limit" class="control-label"><span class="text-danger">*</span>Limit</label>
							<input type="text" name="limit" value="<?php echo $this->input->post('limit'); ?>" class="form-control" id="limit" />
							<span class="text-danger"><?php echo form_error('limit'); ?></span>
						</div>
						<div class="col-md-4">
							<label for="order_by" class="control-label">Order By</label>
							<input type="text" name="order_by" value="<?php echo $this->input->post('order_by'); ?>" class="form-control" id="order_by" />
						</div>
						<div class="col-md-4">
							<label for="order_by" class="control-label">Get for config table</label>
							<br>
							<button type="button" class="btn btn-success getApi form-control" style="color: white;">Get</button>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-8">
							<label class="control-label"><span class="text-danger">*</span>Tombol Save</label><br>
							<button type="button" id="saveConfig" class="btn btn-success saveConfig form-control" style="color: white;">Save</button>
						</div>
					</div>
					<div id="config"></div>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="preloader">
	<div class="loader">
		<svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
		</svg>
	</div>
</div>
<script>
	$('#preloader').fadeOut(100);
	var baseUrl = '<?= base_url() ?>';
	$(".getApi").on('click', function() {
		$('#preloader').fadeIn(300);
		var select = document.getElementById("select").value;
		var view_name = document.getElementById("view_name").value;
		var where = document.getElementById("where").value;
		var order_by = document.getElementById("order_by").value;
		var limit = document.getElementById("limit").value;
		$.ajax({
			url: baseUrl + "api/getAPI/",
			type: "POST",
			data: {
				select: select,
				view_name: view_name,
				where: where,
				order_by: order_by,
				limit: limit
			},
			cache: false,
			success: function(msg) {
				$('msg').ready(function() {
					$('#config').html(msg);
					$('#preloader').fadeOut(100);
				});
			}
		})
	});
	$("#saveConfig").on('click', function() {
		$('#preloader').fadeIn(300);
		var data = $("#apiForm").serialize();
		$.ajax({
			url: baseUrl + "api/addData",
			type: "POST",
            dataType: "json",
			data: data,
			cache: false,
			success: function(msg) {
				$('#preloader').fadeOut(100);
				if (msg !== 'sukses') {
					Swal.fire({
						icon: 'error',
						title: 'Gagal...',
						text: 'Gagal tambah api..',
					}).then((result) => {
						if (result.isConfirmed) {
							top.location.href = baseUrl + "api";
						}
					})
				} else {
					Swal.fire({
						icon: 'success',
						title: 'Berhasil...',
						text: 'Berhasil tambah api..',
					}).then((result) => {
						if (result.isConfirmed) {
							top.location.href = baseUrl + "api";
						}
					})
				}
			}
		})
	})
</script>