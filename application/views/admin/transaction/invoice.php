<div class="row">
	<div class="col mb-5">
		<div class="card border-0 shadow-sm">
			<div class="card-body text-dark">
				<div class="row justify-content-between mb-3">
					<div class="col-lg-6">
						<div class="mb-4">
							<h5 class="font-weight-bold mb-0">PT. Danone Indonesia</h5>
							<p class="text-muted mb-2">cs@danone.corp</p>
							<p class="text-muted mb-0 small">Jl. H. R. Rasuna Said No.13, RT.7/RW.2,<br>Kuningan, Jakarta Selatan 12950</p>
						</div>
						<h6 class="font-weight-bold">Halo, <?= $trx->user_name ?></h6>
						<p class="text-muted">Terima kasih banyak karena Anda terus membeli produk kami. Perusahaan kami berjanji untuk menyediakan produk yang berkualitas tinggi untuk Anda serta layanan pelanggan yang luar biasa untuk setiap transaksi.</p>
					</div>
					<div class="col-lg-3 text-right">
						<h5 class="font-weight-bold text-right mb-4">Invoice</h5>
						<table width="100%">
							<tr>
								<th>Tanggal</th>
								<th>:</th>
								<td><?= date('F d, Y', strtotime($trx->date)) ?></td>
							</tr>
							<tr>
								<th>Status</th>
								<th>:</th>
								<td>
									<?php if ($trx->trx_status == 'Paid') : ?>
										<div class="badge badge-success rounded-pill px-3"><?= $trx->trx_status ?></div>
									<?php elseif ($trx->trx_status == 'Unpaid' || $trx->trx_status == 'Canceled') : ?>
										<div class="badge badge-danger rounded-pill px-3"><?= $trx->trx_status ?></div>
									<?php endif ?>
								</td>
							</tr>
							<tr>
								<th>No. Faktur</th>
								<th>:</th>
								<td>#<?= $trx->no_invoice ?></td>
							</tr>
						</table>
					</div>
				</div>

				<div class="row justify-content-between mb-4">
					<div class="col-lg-4">
						<h6 class="font-weight-bold">Ditagih kepada</h6>
						<p class="text-muted mb-0"><?= $trx->user_name ?></p>
						<p class="text-muted mb-0"><?= $trx->user_phone ?></p>
					</div>
					<div class="col-lg-4">
						<h6 class="font-weight-bold">Metode Pengiriman</h6>
						<p class="text-muted mb-0"><?= $trx->delivery_method ?></p>
					</div>
					<div class="col-lg-4">
						<h6 class="font-weight-bold">Alamat</h6>
						<?php if ($trx->delivery_method == 'Di Antar') : ?>
							<p class="text-muted mb-0"><?= nl2br($trx->user_address) ?></p>
						<?php endif ?>
					</div>
				</div>

				<div class="row justify-content-between mb-4">
					<div class="col">
						<div class="table-responsive">
							<table class="table">
								<tr>
									<th>Produk</th>
									<th>Harga</th>
									<th>Qty</th>
									<th>Total</th>
								</tr>
								<tr>
									<td><?= $trx->product_name ?></td>
									<td>Rp <?= number_format($trx->product_price, 0, '.', '.') ?></td>
									<td><?= $trx->qty ?></td>
									<td>Rp <?= number_format($trx->total, 0, '.', '.') ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>

				<div class="row justify-content-between mb-4">
					<div class="col-lg-4">
						<h6 class="font-weight-bold">Metode Pembayaran</h6>
						<p class="text-muted mb-3"><?= $trx->method_name ?></p>
						<?php if ($trx->method_type == 'transfer') : ?>
							<span class="text-dark font-weight-bold">No. Rekening : </span><span class="text-muted mb-0"><?= $trx->acc_number ?></span><br>
							<span class="text-dark font-weight-bold">Atas nama : </span><span class="text-muted mb-0"><?= $trx->acc_name ?></span>
						<?php endif ?>
					</div>
					<div class="col-lg-4">
						<h6 class="font-weight-bold">Status Pembayaran</h6>
						<p class="text-muted mb-0">
							<?= $trx->trx_status ?>
							<?php if ($trx->trx_status == 'Paid') : ?>
								- <?= date('d/m/Y H:i:s', strtotime($trx->paid_at)) ?>
							<?php elseif ($trx->trx_status == 'Canceled') : ?>
								- <?= date('d/m/Y H:i:s', strtotime($trx->canceled_at)) ?>
							<?php endif ?>
						</p>
					</div>
					<div class="col-lg-4">
						<h6 class="text-right font-weight-bold">Total Bayar</h6>
						<h3 class="text-right font-weight-bold mb-0">Rp <?= number_format($trx->total, 0, '.', '.') ?></h3>
					</div>
				</div>

				<div class="d-flex justify-content-end">
					<a href="<?= base_url('transaction/pdf/' . $trx->no_invoice) ?>" class="btn btn-warning mr-2"><i class="fas fa-eye"></i> Lihat</a>
					<a href="" class="btn btn-success"><i class="fas fa-download"></i> Download</a>
				</div>
			</div>
		</div>
	</div>
</div>