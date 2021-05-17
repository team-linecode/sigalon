<div class="card border-0 shadow">
	<div class="card-header bg-white">
		<h5 class="text-primary mb-0">Tambah User</h5>
	</div>
	<div class="card-body p-0">
		<div class="row">
			<div class="col-lg-4 pr-lg-0 border-right">
				<div class="card-body">
					<form action="<?= base_url('user') ?>" method="POST">
						<div class="form-group">
							<label>Nama</label>
							<input type="text" class="form-control" name="name" value="<?= set_value('name') ?>">
							<?= form_error('name', '<small class="text-danger">', '</small>'); ?>
						</div>
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control" name="username" value="<?= set_value('username') ?>">
							<?= form_error('username', '<small class="text-danger">', '</small>'); ?>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password">
							<?= form_error('password', '<small class="text-danger">', '</small>'); ?>
						</div>
						<div class="form-group">
							<label>No. Telepon</label>
							<input type="text" class="form-control" name="phone" value="<?= set_value('phone') ?>">
							<?= form_error('password', '<small class="text-danger">', '</small>'); ?>
						</div>
						<div class="form-group">
							<label>Level</label>
							<select name="level" class="custom-select">
								<option value="">Pilih Level</option>
								<option value="Admin" <?= set_value('level') == 'Admin' ? 'selected' : '' ?>>Admin</option>
								<option value="Customer" <?= set_value('level') == 'Customer' ? 'selected' : '' ?>>Customer</option>
							</select>
							<?= form_error('level', '<small class="text-danger">', '</small>'); ?>
						</div>

						<div class="d-flex justify-content-end">
							<button class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-8 pl-lg-0">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover datatables">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama</th>
									<th>Username</th>
									<th>Password</th>
									<th>Level</th>
									<th>Telepon</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; foreach ($users as $row) : ?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $row->name ?></td>
										<td><?= $row->username ?></td>
										<td><?= $row->nohash ?></td>
										<td><?= $row->level ?></td>
										<td><?= $row->phone ?></td>
										<td>
											<a href="<?= base_url('user/edit/' . $row->id) ?>" class="btn btn-primary btn-sm mb-2">Ubah</a>
											<a href="<?= base_url('user/delete/' . $row->id) ?>" class="btn btn-danger btn-sm">Hapus</a>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>