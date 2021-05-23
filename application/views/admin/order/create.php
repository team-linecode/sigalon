<div class="row mb-5" id="transaction">
	<div class="col-lg-6">
		<div class="card border-0 shadow-sm">
			<div class="card-body">
				<form action="<?= base_url('order/create') ?>" method="POST">
					<div class="form-group">
						<label>Produk</label>
						<select class="custom-select" name="product" id="product">
							<option value="" hidden>Pilih Produk</option>
							<?php foreach ($products as $product) : ?>
								<option value="<?= $product->id ?>" <?= set_value('product') == $product->id ? 'selected' : '' ?>><?= $product->name ?> - Rp <?= number_format($product->price) ?></option>
							<?php endforeach ?>
						</select>
						<?= form_error('product', '<small class="text-danger">', '</small>'); ?>
					</div>
					<div class="form-group">
						<label>Jumlah</label>
						<input type="number" class="form-control" name="qty" id="qty" value="<?= set_value('qty') ?>" max="<?= $product->stock ?>">
						<?= form_error('qty', '<small class="text-danger">', '</small>'); ?>
					</div>
					<div class="form-group">
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
							<option value="Di Jemput">Di Jemput</option>
							<option value="Di Antar">Di Antar</option>
						</select>
						<?= form_error('delivery_method', '<small class="text-danger">', '</small>'); ?>
					</div>

					<div class="d-flex justify-content-end">
						<button class="btn btn-primary">Buat Pesanan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>