<div class="card border-0 shadow">
	<div class="card-body p-0">
		<div class="row">
			<div class="col-lg-12">
				<div class="card-header bg-white">
					<a href="<?= base_url('transaction/create') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover datatables">
							<thead>
								<tr>
									<th>#</th>
									<th>Produk</th>
									<th>Jumlah</th>
									<th>Total</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($transactions as $row) : ?>
									<tr>
										<td><?= $no++ ?></td>
										<td></td>
										<td></td>
										<td></td>
										<td>
											<a href="<?= base_url('transaction/edit/' . $row->id) ?>" class="btn btn-primary btn-sm mb-2">Ubah</a>
											<a href="<?= base_url('transaction/delete/' . $row->id) ?>" class="btn btn-danger btn-sm">Hapus</a>
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