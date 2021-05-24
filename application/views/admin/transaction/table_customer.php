<table class="table table-bordered table-hover datatables">
	<thead>
		<tr>
			<th>#</th>
			<th>No. Faktur</th>
			<th>Foto</th>
			<th>Produk</th>
			<th>Harga</th>
			<th>Qty</th>
			<th>Total</th>
			<th>Tanggal</th>
			<th>Status</th>
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
					<img src="<?= base_url('assets/img/product/' . $row->image) ?>" class="img-50">
				</td>
				<td>
					<?= $row->product_name ?>
				</td>
				<td>Rp <?= number_format($row->total / $row->qty) ?></td>
				<td><?= $row->qty ?></td>
				<td>Rp <?= number_format($row->total) ?></td>
				<td><?= date('F d, Y', strtotime($row->date)) ?></td>
				<td class="<?= $row->trx_status != 'Canceled' && $row->trx_status != 'Unpaid' ? 'text-success' : 'text-danger' ?>"><?= $row->trx_status ?></td>
				<td>
					<a href="<?= base_url('transaction/invoice/' . $row->no_invoice) ?>" class="btn btn-primary btn-sm" title="Lihat Invoice"><i class="fas fa-file-alt"></i></a>
					<?php if ($row->trx_status == 'Unpaid') : ?>
						<button data-target="<?= base_url('order/change_status/' . $row->trx_id . '/Canceled') ?>" class="confirm-status btn btn-danger btn-sm" title="Batalkan pesanan"><i class="fas fa-times-circle"></i></button>
						<a href="https://wa.me/<?= site()->whatsapp ?>" target="_blank" class="btn btn-success btn-sm" title="Bayar melalui konfirmasi whatsapp"><i class="fab fa-whatsapp"></i> Bayar</a>
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
					<?php endif ?>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>