<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
	<link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">

	<!-- Custom fonts for this template-->
	<link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">

	<title>Laporan Transaksi Penjualan</title>
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

		@media print {

			.footer,
			#button-print {
				display: none !important;
			}
			
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
		</div>
		<div class="col-3 col-sm-4">
			<h5 class="font-weight-bold text-right mb-4">Laporan Transaksi Barang <?= $type == 'in' ? 'Masuk' : 'Keluar' ?></h5>
			<table width="100%">
				<tr>
					<th>Periode</th>
					<th>:</th>
					<td class="text-right"><?= date("d/m/Y", strtotime($from_date)) ?> - <?= date("d/m/Y", strtotime($till_date)) ?></td>
				</tr>
				<tr>
					<th>Laporan dibuat</th>
					<th>:</th>
					<td class="text-right"><?= date('d F Y H:i') ?></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-lg">
			<h5 class="font-weight-bold">Data Transaksi</h5>
			<table class="table table-bordered">
				<thead>
					<?php if ($type == 'in') { ?>
						<tr>
							<th>Tanggal</th>
							<th>No Pesanan</th>
							<th>Supplier</th>
							<th>Barang</th>
							<th>Liter</th>
							<th>Harga</th>
						</tr>
						<?php foreach ($report as $row) { ?>
							<tr>
								<td><?= $row->date ?></td>
								<td><?= $row->no_invoice ?></td>
								<td><?= $row->supplier_name ?></td>
								<td><?= $row->product_name ?></td>
								<td><?= $row->liter ?></td>
								<td><?= $row->total ?></td>
							</tr>
						<?php } ?>
						<tr>
							<td colspan="5" class="font-weight-bold">Total :</td>
							<td><?= $total ?></td>
						</tr>
					<?php } else { ?>
						<tr>
							<th>Tanggal</th>
							<th>No Pesanan</th>
							<th>Barang</th>
							<th>Pelanggan</th>
							<th>Harga</th>
							<th>Jumlah</th>
							<th>Total</th>
							<th>Untung</th>
						</tr>
						<?php foreach ($report as $row) { ?>
							<tr>
								<td><?= $row->date ?></td>
								<td><?= $row->no_invoice ?></td>
								<td><?= $row->product_name ?></td>
								<td><?= $row->user_name ?></td>
								<td><?= $row->price ?></td>
								<td><?= $row->qty ?></td>
								<td><?= $row->total ?></td>
								<td><?= $row->income ?></td>
							</tr>
						<?php } ?>
						<tr>
							<td colspan="5" class="font-weight-bold">Total :</td>
							<td><?= $qty ?></td>
							<td><?= $total ?></td>
							<td><?= $income ?></td>
						</tr>
					<?php } ?>
				</thead>
			</table>
		</div>
	</div>
	<div class="form-group row" id="button-print">
		<div class="col-sm-9"></div>
		<div class="col-sm-3 text-right">
			<a href="<?= base_url('report') ?>" class="btn btn-danger">Kembali <i class="fas fa-fw fa-times"></i></a>
			<a href="javascript:window.print()" class="btn btn-primary">Print <i class="fas fa-fw fa-print"></i></a>
		</div>
	</div>
</body>

</html>