<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="row d-flex justify-content-between px-4">
					<h4 class="card-title">Data Table</h4>
					<a href="<?= site_url('admin/menu/add'); ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add"><i class="mdi mdi-library-plus"></i></a>
				</div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered zero-configuration">
						<thead>
							<tr>
								<th>#</th>
								<th>Menu</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;
							foreach ($menu as $u) { ?>
								<tr>
									<td><?= $i++ ?></td>
									<td><?= $u['menu']; ?></td>
									<td>
										<a href="<?= site_url('user_menu/edit/' . $u['id']); ?>" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="mdi mdi-lead-pencil"></i></a>
										<a href="<?= site_url('user_menu/remove/' . $u['id']); ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove"><i class="mdi mdi-delete"></i></a>
										<a href="<?= site_url('admin/sub_menu/add/' . $u['id']); ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sub Menu"><i class="mdi mdi-home"></i></a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>