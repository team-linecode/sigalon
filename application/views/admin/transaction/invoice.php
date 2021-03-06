<div class="row" style="color: #000 !important">
	<div class="col mb-5">
		<?php if ($trx->trx_status == 'Unpaid' && $trx->trx_type == 'out') : ?>
			<div class="alert alert-success">
				<h4>Pesanan Berhasil Dibuat</h4>
				Silahkan konfirmasi pembayaran melalui whatsapp dengan menekan tombol <b>"Bayar"</b> dibawah.<br>
				<b>No Faktur</b> : #<?= $trx->no_invoice ?><br>
				<b>Jumlah yang harus dibayar</b> : Rp <?= number_format($total) ?>
			</div>
		<?php endif ?>
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
								<td><?= date('M d, Y', strtotime($trx->date)) ?></td>
							</tr>
							<tr>
								<th>Status</th>
								<th>:</th>
								<td>
									<?php if ($trx->trx_status == 'Unpaid' || $trx->trx_status == 'Canceled') : ?>
										<div class="badge badge-danger rounded-pill px-3"><?= $trx->trx_status ?></div>
									<?php else : ?>
										<div class="badge badge-success rounded-pill px-3"><?= $trx->trx_status ?></div>
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
									<th>#</th>
									<th>Produk</th>
									<th>Harga</th>
									<th>Qty</th>
									<th>Total</th>
								</tr>
								<?php
								$no = 1;
								foreach ($trx_products as $product) : ?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $product->product_name ?></td>
										<td>Rp
											<?php
											if ($trx->trx_type == 'out') {
												echo number_format($product->product_price);
											} else {
												echo number_format($product->supplier_price);
											}
											?>
										<td>
											<?php
											if ($trx->trx_type == 'out') {
												echo number_format($product->qty);
											} else {
												echo '1 Tanki';
											}
											?>
										</td>
										<td>Rp
											<?php
											if ($trx->trx_type == 'out') {
												echo number_format($product->product_price * $product->qty);
											} else {
												echo number_format($product->supplier_price);
											}
											?>
										</td>
									</tr>
								<?php endforeach ?>
								<tr>
									<th colspan="4" class="text-right">Total :</th>
									<td>Rp
										<?php
										if ($trx->trx_type == 'out') {
											echo number_format($total);
										} else {
											echo number_format($product->supplier_price);
										}
										?>
								</tr>
							</table>
						</div>
					</div>
				</div>

				<div class="row justify-content-between mb-4">
					<?php if ($trx->trx_type == 'out') : ?>
						<div class="col-4">
							<h6 class="font-weight-bold">Metode Pembayaran</h6>
							<p class="text-muted mb-3"><?= $trx->method_name ?></p>
							<?php if ($trx->method_type == 'transfer') : ?>
								<span class="text-dark font-weight-bold">No. Rekening : </span><span class="text-muted mb-0"><?= $trx->acc_number ?></span><br>
								<span class="text-dark font-weight-bold">Atas nama : </span><span class="text-muted mb-0"><?= $trx->acc_name ?></span>
							<?php endif ?>
						</div>
					<?php endif ?>
					<div class="<?= $trx->trx_type == 'out' ? 'col-4' : 'col-6' ?>">
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
					<div class="<?= $trx->trx_type == 'out' ? 'col-4' : 'col-6' ?>">
						<h6 class="text-right font-weight-bold">Total Bayar</h6>
						<h3 class="text-right font-weight-bold mb-0">Rp <?= $total != 0 ? number_format($total) : number_format($trx->supplier_price) ?></h3>
					</div>
				</div>

				<div class="d-flex justify-content-end">
					<button onclick="print(<?= $trx->no_invoice ?>)" class="btn btn-info mr-2"><i class="fas fa-print"></i> Print</button>
					<?php if ($trx->trx_status == 'Unpaid') : ?>
						<a href="https://wa.me/<?= site()->whatsapp ?>" target="_blank" class="btn btn-success" title="Konfirmasi Pembayaran Melalui Whatsapp"><i class="fab fa-whatsapp"></i> Bayar</a>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mb-5">
	<div class="col-md-12">
		<div class="card border-0 shadow-sm">
			<div class="card-body">
				<h6 class="card-title">Tracking</h6>
				<div id="content">
					<ul class="timeline">
						<?php if ($trx->trx_status == 'Unpaid' || $trx->trx_status == 'Canceled' || $trx->trx_status == 'Paid' || $trx->trx_status == 'On Process' || $trx->trx_status == 'Completed') : ?>
							<li class="event" data-date="<?= date('M d, Y H:i', strtotime($trx->date)) ?>">
								<h3>Pesanan Berhasil Dibuat</h3>
								<p>Berhasil membuat pesanan, Silahkan selesaikan pembayaran agar kami segera proses pesanan anda.</p>
							</li>
						<?php endif ?>
						<?php if ($trx->trx_status == 'Canceled') : ?>
							<li class="event" data-date="<?= date('M d, Y H:i', strtotime($trx->canceled_at)) ?>">
								<h3>Pesanan Dibatalkan</h3>
								<p>Transaksi anda telah di batalkan, Jika ada masalah terkait orderan silahkan hubungi kami.</p>
							</li>
						<?php endif ?>
						<?php if ($trx->trx_status == 'Paid' || $trx->trx_status == 'On Process' || $trx->trx_status == 'Completed') : ?>
							<li class="event" data-date="<?= date('M d, Y H:i', strtotime($trx->paid_at)) ?>">
								<h3>Pesanan Dibayar</h3>
								<p>Terimakasih telah melakukan pembayaran, Sedang menunggu konfirmasi dari seller.</p>
							</li>
						<?php endif ?>
						<?php if ($trx->trx_status == 'On Process' || $trx->trx_status == 'Completed') : ?>
							<?php if ($trx->delivery_method == 'Di Jemput') : ?>
								<li class="event" data-date="<?= date('M d, Y H:i', strtotime($trx->process_at)) ?>">
									<h3>Pesanan Siap Diambil</h3>
									<p>Pesananan anda sudah siap, Silahkan melakukan pengambilan ke toko kami.</p>
								</li>
							<?php else : ?>
								<li class="event" data-date="<?= date('M d, Y H:i', strtotime($trx->process_at)) ?>">
									<h3>Pesanan Diproses</h3>
									<p>Pesanan sedang diproses, selanjutnya pesanan akan langsung diantar ke alamat pengiriman.</p>
								</li>
							<?php endif ?>
						<?php endif ?>
						<?php if ($trx->trx_status == 'Completed') : ?>
							<li class="event" data-date="<?= date('M d, Y H:i', strtotime($trx->completed_at)) ?>">
								<h3>Pesanan Selesai</h3>
								<p>Pesanan telah diterima, Terimakasih atas pesanannya dan selamat berbelanja kembali:)</p>
							</li>
						<?php endif ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>