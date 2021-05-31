<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
	<link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">

	<title>Invoice <?= $trx->no_invoice ?></title>
	<style>
		body {
			border: 1px dashed #000;
			padding: 10px;
			margin: 10px;
			box-sizing: border-box;
			color: #000 !important;
		}

		.font-weight-bold {
			color: #000 !important;
		}

		@page {
			size: auto;
			margin: 0mm;
		}
	</style>
</head>

<body>
	<div class="row justify-content-between mb-3 text-dark">
		<div class="col-6">
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
		<div class="col-3 text-right">
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
		<div class="col-4">
			<h6 class="font-weight-bold">Ditagih kepada</h6>
			<?php if ($trx->trx_type == 'in') : ?>
				<p class="text-muted mb-0">PT. Danone Indonesia</p>
				<p class="text-muted mb-0"><?= site()->email ?></p>
			<?php else : ?>
				<p class="text-muted mb-0"><?= $trx->user_name ?></p>
				<p class="text-muted mb-0"><?= $trx->user_phone ?></p>
			<?php endif ?>
		</div>
		<div class="col-4">
			<h6 class="font-weight-bold">Metode Pengiriman</h6>
			<p class="text-muted mb-0"><?= $trx->delivery_method ?></p>
		</div>
		<div class="col-4">
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
							<td>Rp <?= number_format($product->product_price) ?></td>
							<td><?= number_format($product->qty) ?></td>
							<td>Rp <?= number_format($product->product_price * $product->qty) ?></td>
						</tr>
					<?php endforeach ?>
					<tr>
						<th colspan="4" class="text-right">Total :</th>
						<td>Rp <?= number_format($total) ?></td>
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
</body>

</html>