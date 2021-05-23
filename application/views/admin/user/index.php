<div class="row mb-4">
	<div class="col-lg">
		<div class="card border-0 shadow-sm">
			<div class="card-header bg-white">
				<h5 class="text-primary mb-0">Tambah User</h5>
			</div>
			<div class="card-body p-0">
				<div class="card-body">
					<form action="<?= base_url('user') ?>" method="POST">
						<div class="form-group row">
							<div class="col-md-6">
								<label>Nama</label>
								<input type="text" class="form-control" name="name" value="<?= set_value('name') ?>">
								<?= form_error('name', '<small class="text-danger">', '</small>'); ?>
							</div>
							<div class="col-md-6">
								<label>Username</label>
								<input type="text" class="form-control" name="username" value="<?= set_value('username') ?>">
								<?= form_error('username', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-6">
								<label>Password</label>
								<input type="password" class="form-control" name="password">
								<?= form_error('password', '<small class="text-danger">', '</small>'); ?>
							</div>
							<div class="col-md-6">
								<label>No. Telepon</label>
								<input type="text" class="form-control" name="phone" value="<?= set_value('phone') ?>">
								<?= form_error('password', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-6">
								<label>Alamat</label>
								<textarea class="form-control" name="address" rows="1"><?= set_value('address') ?></textarea>
								<?= form_error('address', '<small class="text-danger">', '</small>'); ?>
							</div>
							<div class="col-md-6">
								<label>Level</label>
								<select name="level" class="custom-select">
									<option value="">Pilih Level</option>
									<option value="Admin" <?= set_value('level') == 'Admin' ? 'selected' : '' ?>>Admin</option>
									<option value="Customer" <?= set_value('level') == 'Customer' ? 'selected' : '' ?>>Customer</option>
								</select>
								<?= form_error('level', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>

						<div class="d-flex justify-content-end">
							<button class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mb-5">
	<div class="col-lg">
		<div class="card border-0 shadow-sm">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover datatables">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama</th>
								<th>Username</th>
								<th>Level</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($users as $row) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $row->name ?></td>
									<td><?= $row->username ?></td>
									<td><?= $row->level ?></td>
									<td>
										<a href="<?= base_url('user/detail/' . $row->id) ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Detail"><i class="fas fa-info-circle"></i></a>
										<a href="<?= base_url('user/edit/' . $row->id) ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fas fa-pen"></i></a>
										<button data-target="<?= base_url('user/delete/' . $row->id) ?>" class="btn btn-danger btn-sm confirm-delete" data-toggle="tooltip" data-placement="left" title="Delete"><i class="fas fa-trash"></i></button>
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