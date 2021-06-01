<div class="row mb-5" id="transaction">
	<div class="col-lg-12">
		<div class="card border-0 shadow-sm">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-4 border-right">
						<form action="<?= base_url('transaction/create') ?>" method="POST">
							<div class="form-group">
								<label>Supplier</label>
								<select class="custom-select" name="supplier" id="supplier">
									<option value="" hidden>Pilih Supplier</option>
									<?php foreach ($suppliers as $supplier) : ?>
										<option value="<?= $supplier->id ?>"><?= $supplier->name ?></option>
									<?php endforeach ?>
								</select>
								<?= form_error('name', '<small class="text-danger">', '</small>'); ?>
							</div>
							<div class="form-group">
								<label>Produk</label>
								<select class="custom-select" name="product" id="product" disabled>
									<option value="" hidden>Pilih Produk</option>
								</select>
								<?= form_error('name', '<small class="text-danger">', '</small>'); ?>
							</div>
							<div class="form-group" id="paymentMethodWrapper">
								<label>Metode Pembayaran</label>
								<select class="custom-select" name="payment_method" id="paymentMethod">
									<option value="" hidden>Pilih Metode Pembayaran</option>
									<?php foreach ($payment_methods as $row) : ?>
										<option value="<?= $row->id ?>"><?= $row->name ?></option>
									<?php endforeach ?>
								</select>
								<?= form_error('payment_method', '<small class="text-danger">', '</small>'); ?>
							</div>
							<div class="form-group">
								<label>Metode Pengiriman</label>
								<select class="custom-select" name="delivery_method" id="deliveryMethod">
									<option value="" hidden>Pilih Metode Pengiriman</option>
									<option value="Di Antar">Di Antar</option>
								</select>
								<?= form_error('delivery_method', '<small class="text-danger">', '</small>'); ?>
							</div>

							<div class="d-flex justify-content-end">
								<button class="btn btn-primary">Buat Transaksi</button>
							</div>
						</form>
					</div>
					<div class="col-lg-8">
						<h5><i class="fas fa-info-circle"></i> Detail Transaksi</h5>
						<hr>
						<h5 class="text-primary font-weight-bold">Produk</h5>
						<table class="table table-bordered">
							<tr id="tr-product">
								<th>Produk</th>
								<td id="productDetail">-</td>
							</tr>
							<tr>
								<th>Jumlah Beli</th>
								<td id="showQty">0</td>
							</tr>
							<tr>
								<th>Total Bayar</th>
								<td id="total">0</td>
							</tr>
						</table>
						<div id="showPaymentMethodWrapper">
							<h5 class="text-primary font-weight-bold">Pembayaran</h5>
							<table class="table table-bordered">
								<tr>
									<th>Metode Pembayaran</th>
									<td id="showPaymentMethod">-</td>
								</tr>
							</table>
						</div>
						<h5 class="text-primary font-weight-bold">Pengiriman</h5>
						<table class="table table-bordered">
							<tr>
								<th>Metode Pengiriman</th>
								<td id="showDeliveryMethod">-</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>