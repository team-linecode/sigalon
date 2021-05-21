<div class="row" style="color: #000 !important">
	<div class="col mb-5">
		<div class="card border-0 shadow-sm">
			<div class="card-body">
				<div class="row justify-content-between mb-3">
					<div class="col-lg-6">
						<div class="mb-5">
							<h5 class="font-weight-bold mb-0"><?= site()->company_name ?></h5>
							<p class="text-muted mb-2"><?= site()->email ?></p>
							<p class="text-muted mb-0"><?= nl2br(site()->company_address) ?></p>
						</div>
						<?php if ($trx->trx_type == 'out') : ?>
							<h6 class="font-weight-bold">Halo, <?= $trx->user_name ?></h6>
							<p class="text-muted">Terima kasih banyak karena Anda terus membeli produk kami. Perusahaan kami berjanji untuk menyediakan produk yang berkualitas tinggi untuk Anda serta layanan pelanggan yang luar biasa untuk setiap transaksi.</p>
						<?php endif ?>
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
						<?php if ($trx->trx_type == 'in') : ?>
							<p class="text-muted mb-0">PT. Danone Indonesia</p>
							<p class="text-muted mb-0"><?= site()->email ?></p>
						<?php else : ?>
							<p class="text-muted mb-0"><?= $trx->user_name ?></p>
							<p class="text-muted mb-0"><?= $trx->user_phone ?></p>
						<?php endif ?>
					</div>
					<div class="col-lg-4">
						<h6 class="font-weight-bold">Metode Pengiriman</h6>
						<p class="text-muted mb-0"><?= $trx->delivery_method ?></p>
					</div>
					<div class="col-lg-4">
						<h6 class="font-weight-bold">Alamat</h6>
						<?php if ($trx->delivery_method == 'Di Antar') : ?>
							<?php if ($trx->trx_type == 'in') : ?>
								<p class="text-muted mb-0"><?= site()->company_address ?></p>
							<?php else : ?>
								<p class="text-muted mb-0"><?= nl2br($trx->user_address) ?></p>
							<?php endif ?>
						<?php else : ?>
							<p class="text-muted mb-0"><?= nl2br($trx->user_address) ?></p>
						<?php endif ?>
					</div>
				</div>

				<div class="row justify-content-between mb-4">
					<div class="col">
						<div class="table-responsive">
							<table class="table table-bordered">
								<tr>
									<th>Produk</th>
									<th>Harga</th>
									<th>Qty</th>
									<th>Total</th>
								</tr>
								<tr>
									<td><?= $trx->product_name ?></td>
									<?php if ($trx->trx_type == 'in') : ?>
										<td>Rp <?= number_format($trx->supplier_price, 0, '.', '.') ?></td>
									<?php else : ?>
										<td>Rp <?= number_format($trx->product_price, 0, '.', '.') ?></td>
									<?php endif ?>
									<td><?= $trx->qty ?? '1 Tanki / ' . $trx->liter . ' liter' ?></td>
									<td>Rp <?= $trx->total != 0 ? number_format($trx->total, 0, '.', '.') : number_format($trx->supplier_price, 0, '.', '.') ?></td>
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
						<h3 class="text-right font-weight-bold mb-0">Rp <?= $trx->total != 0 ? number_format($trx->total, 0, '.', '.') : number_format($trx->supplier_price, 0, '.', '.') ?></h3>
					</div>
				</div>

				<div class="d-flex justify-content-end">
					<button onclick="print(<?= $trx->no_invoice ?>)" class="btn btn-success"><i class="fas fa-print"></i> Print</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<h6 class="card-title">Timeline</h6>
				<div id="content">
					<ul class="timeline">
						<li class="event" data-date="12:30 - 1:00pm">
							<h3>Registration</h3>
							<p>Get here on time, it's first come first serve. Be late, get turned away.</p>
						</li>
						<li class="event" data-date="2:30 - 4:00pm">
							<h3>Opening Ceremony</h3>
							<p>Get ready for an exciting event, this will kick off in amazing fashion with MOP &amp; Busta Rhymes as an opening show.</p>
						</li>
						<li class="event" data-date="5:00 - 8:00pm">
							<h3>Main Event</h3>
							<p>This is where it all goes down. You will compete head to head with your friends and rivals. Get ready!</p>
						</li>
						<li class="event" data-date="8:30 - 9:30pm">
							<h3>Closing Ceremony</h3>
							<p>See how is the victor and who are the losers. The big stage is where the winners bask in their own glory.</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>