<div class="row">
	<div class="col-lg-6">
		<div class="card border-0 shadow">
			<div class="card-body">
				<form action="<?= base_url('user/edit/' .  $user->id) ?>" method="POST">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" class="form-control" name="name" value="<?= $user->name ?>">
						<?php echo form_error('name', '<small class="text-danger">', '</small>'); ?>
					</div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" class="form-control" name="username" value="<?= $user->username ?>">
						<?php echo form_error('username', '<small class="text-danger">', '</small>'); ?>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" name="password" value="<?= $user->nohash ?>">
						<?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
					</div>
					<div class="form-group">
						<label>No. Telepon</label>
						<input type="text" class="form-control" name="phone" value="<?= $user->phone ?>">
						<?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<textarea class="form-control" name="address" rows="4"><?= $user->address ?></textarea>
						<?php echo form_error('address', '<small class="text-danger">', '</small>'); ?>
					</div>
					<div class="form-group">
						<label>Level</label>
						<select name="level" class="custom-select">
							<option value="">Pilih Level</option>
							<option value="Admin" <?= $user->level == 'Admin' ? 'selected' : '' ?>>Admin</option>
							<option value="Customer" <?= $user->level == 'Customer' ? 'selected' : '' ?>>Customer</option>
						</select>
						<?php echo form_error('level', '<small class="text-danger">', '</small>'); ?>
					</div>

					<div class="d-flex justify-content-end">
						<button class="btn btn-primary"><i class="fas fa-save"></i> Simpan perubahan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>