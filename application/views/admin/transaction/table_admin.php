<table class="table table-bordered table-hover datatables">
	<thead>
		<tr>
			<th>#</th>
			<th>No. Faktur</th>
			<th>User</th>
			<th>Produk</th>
			<th>Tanggal</th>
			<th>Tipe</th>
			<th>Opsi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1;
		foreach ($transactions as $row) : ?>
			<tr>
				<td><?= $no++ ?></td>
				<td>#<?= $row->no_invoice ?></td>
				<td>
					<?= $row->user_name ?? $row->contact ?><br>
					<small class="text-primary"><?= $row->phone ?? $row->supplier_phone ?></small>
				</td>
				<td>
					<?= $row->product_name ?><br>
					<small class="text-primary"><?= $row->supplier_name ?></small>
				</td>
				<td><?= date('d/m/Y H:i', strtotime($row->date)) ?></td>
				<td class="<?= $row->trx_type == 'in' ? 'text-success' : 'text-danger' ?>"><?= strtoupper($row->trx_type) ?></td>
				<td>
					<a href="<?= base_url('transaction/invoice/' . $row->no_invoice) ?>" class="btn btn-primary btn-sm" title="Lihat Invoice"><i class="fas fa-file-alt"></i></a>
					<?php if ($row->trx_status == 'Unpaid') : ?>
						<div class="dropdown d-inline" title="Ubah Status">
							<button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?= $row->trx_status ?>
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item" href="<?= base_url('transaction/change_status/' . $row->trx_id . '/Paid') ?>">Paid</a>
								<a class="dropdown-item" href="<?= base_url('transaction/change_status/' . $row->trx_id . '/Canceled') ?>">Canceled</a>
							</div>
						</div>
					<?php elseif ($row->trx_status == 'Paid') : ?>
						<div class="dropdown d-inline" title="Ubah Status">
							<button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Paid
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item" href="<?= base_url('transaction/change_status/' . $row->trx_id . '/On_Process') ?>">On Process</a>
								<a class="dropdown-item" href="<?= base_url('transaction/change_status/' . $row->trx_id . '/Completed') ?>">Completed</a>
							</div>
						</div>
					<?php elseif ($row->trx_status == 'On Process') : ?>
						<div class="dropdown d-inline" title="Ubah Status">
							<button class="btn btn-warning btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								On Proccess
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item" href="<?= base_url('transaction/change_status/' . $row->trx_id . '/Completed') ?>">Completed</a>
							</div>
						</div>
					<?php elseif ($row->trx_status == 'Completed') : ?>
						<div class="btn btn-success btn-sm disabled"><i class="fas fa-check-circle"></i> Completed</div>
					<?php else : ?>
						<div class="btn btn-danger btn-sm disabled"><i class="fas fa-times-circle"></i> Canceled</div>
					<?php endif ?>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>