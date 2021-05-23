<div class="row mb-5">
	<div class="col-lg">
		<div class="card border-0 shadow-sm">
			<div class="card-header bg-white">
				<a href="<?= base_url('/user') ?>" class="btn btn-danger"><i class="fas fa-angle-left"></i> Kembali</a>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Nama</th>
								<td><?= $user->name ?></td>
							</tr>
							<tr>
								<th>Username</th>
								<td><?= $user->username ?></td>
							</tr>
							<tr>
								<th>Password</th>
								<td><?= $user->nohash ?></td>
							</tr>
							<tr>
								<th>Level</th>
								<td><?= $user->level ?></td>
							</tr>
							<tr>
								<th>No. Telepon</th>
								<td><?= $user->phone ?></td>
							</tr>
							<tr>
								<th>Alamat</th>
								<td><?= nl2br($user->address) ?></td>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>