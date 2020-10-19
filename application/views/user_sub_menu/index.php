<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="row d-flex justify-content-between px-4">
					<h4 class="card-title">Data Table</h4>
					<a href="<?= site_url('user_menu/add_sub/' . $this->uri->segment(3)); ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add"><i class="mdi mdi-library-plus"></i></a>
				</div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered zero-configuration">
						<thead>
							<tr>
								<th>#</th>
								<th>Title</th>
								<th>URL</th>
								<th>Icon</th>
								<th>Active</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;
							foreach ($user_sub_menus as $u) { ?>
								<tr>
									<td><?= $i++ ?></td>
									<td><?= $u['title']; ?></td>
									<td><?= $u['url']; ?></td>
									<td><?= $u['icon']; ?></td>
									<td><?= $u['is_active'] == 1 ? 'Active' : 'Inactive'; ?></td>
									<td>
										<a href="<?= site_url('user_menu/edit_sub/' . $this->uri->segment(3) . '/' . $u['id']); ?>" class="btn btn-info btn-xs my-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="mdi mdi-lead-pencil"></i></a>
										<a href="<?= site_url('user_menu/remove_sub/' . $this->uri->segment(3) . '/' . $u['id']); ?>" class="btn btn-danger btn-xs my-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove"><i class="mdi mdi-delete"></i></a>
										<a href="<?= site_url('user_menu/index_access/' . $this->uri->segment(3) . '/' . $u['id']); ?>" class="btn btn-primary btn-xs my-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Access View"><i class="mdi mdi-home"></i></a>
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