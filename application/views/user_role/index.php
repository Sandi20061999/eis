<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="row d-flex justify-content-between px-4">
					<h4 class="card-title">Data Table</h4>
					<a href="<?= site_url('user_role/add'); ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add"><i class="mdi mdi-library-plus"></i></a>
				</div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered zero-configuration">
						<thead>
							<tr>
								<th>#</th>
								<th>Role</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;
							foreach ($user_roles as $u) { ?>
								<tr>
									<td><?= $i++ ?></td>
									<td><?= $u['role']; ?></td>
									<td>
										<a href="<?= site_url('user_role/edit/' . $u['id']); ?>" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="mdi mdi-lead-pencil"></i></a>
										<a href="<?= site_url('user_role/remove/' . $u['id']); ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove"><i class="mdi mdi-delete"></i></a>
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