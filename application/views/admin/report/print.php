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
		</div>
		<div class="col-3 col-sm-4">
			<h5 class="font-weight-bold text-right mb-4">Laporan Penjualan Transaksi</h5>
			<table width="100%">
				<tr>
					<th>Periode</th>
					<th>:</th>
					<td class="text-right">01/06/21 - 02/06/21</td>
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
					<tr>
						<th>Tanggal</th>
						<th>No Pesanan</th>
						<th>Pelanggan</th>
						<th>Qty</th>
						<th>Total</th>
						<th>Untung</th>
					</tr>
					<tr>
						<td>12/06/2021</td>
						<td>123456</td>
						<td>Rio Adrian</td>
						<td>2</td>
						<td>12000</td>
						<td>10000</td>
					</tr>
					<tr>
						<td>10/07/2021</td>
						<td>654321</td>
						<td>siapa Aja</td>
						<td>4</td>
						<td>24000</td>
						<td>20000</td>
					</tr>
					<tr>
						<td colspan="3" class="text-right">Total :</td>
						<td>6</td>
						<td>36000</td>
						<td>30000</td>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</body>

<script>
	window.print
</script>

</html>