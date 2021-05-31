<div class="row mb-5">
	<div class="col-lg">
		<div class="card border-0 shadow-sm">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover datatables">
						<thead>
							<tr>
								<th>#</th>
								<th colspan="2">Produk</th>
								<th>Harga</th>
								<th>Qty</th>
								<th>Total</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							$total = 0;
							foreach ($carts as $row) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td>
										<img src="<?= base_url('assets/img/product/' . $row->image) ?>" class="img-50">
									</td>
									<td><?= $row->product_name ?></td>
									<td><?= number_format($row->product_price) ?></td>
									<td width="15%">
										<form action="<?= base_url('cart/update') ?>" method="post">
											<div class="d-flex">
												<input type="hidden" name="cart_id" value="<?= $row->id_cart ?>">
												<input type="number" name="qty" class="form-control mr-1" value="<?= $row->qty ?>">
												<button type="submit" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-pen"></i></button>
											</div>
										</form>
									</td>
									<td><?= number_format($row->product_price * $row->qty) ?></td>
									<td>
										<button data-target="<?= base_url('cart/delete/' . $row->id_cart) ?>" class="btn btn-danger btn-sm confirm-delete" title="Delete"><i class="fas fa-trash"></i></button>
									</td>
								</tr>
								<?php $total += ($row->product_price * $row->qty) ?>
							<?php endforeach ?>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="6" class="text-right">Total</th>
								<td class="text-right"><?= number_format($total) ?></td>
							</tr>
						</tfoot>
					</table>
				</div>

				<form action="<?= base_url('cart/checkout') ?>" method="post">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-6">
								<label>Metode Pembayaran</label>
								<select class="custom-select" name="payment_method" id="paymentMethod">
									<option value="" hidden>Pilih Metode Pembayaran</option>
									<?php foreach ($payment_methods as $row) : ?>
										<option value="<?= $row->id ?>"><?= $row->name ?></option>
									<?php endforeach ?>
								</select>
								<?= form_error('payment_method', '<small class="text-danger">', '</small>'); ?>
							</div>
							<div class="col-lg-6">
								<label>Metode Pengiriman</label>
								<select class="custom-select" name="delivery_method" id="deliveryMethod">
									<option value="" hidden>Pilih Metode Pengiriman</option>
									<option value="Di Jemput">Di Jemput</option>
									<option value="Di Antar">Di Antar</option>
								</select>
								<?= form_error('delivery_method', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Detail Pengiriman :</label>
						<table class="w-100 mb-4">
							<tr>
								<th>Nama</th>
								<th>:</th>
								<td><?= user()->name ?></td>
							</tr>
							<tr>
								<th>No. Telp</th>
								<th>:</th>
								<td><?= user()->phone ?></td>
							</tr>
							<tr>
								<th>Alamat</th>
								<th>:</th>
								<td><?= nl2br(user()->address) ?></td>
							</tr>
						</table>
						<a href="<?= base_url('user/profile') ?>">Ubah data pengiriman</a>
					</div>
					<div class="d-flex justify-content-end">
						<button class="btn btn-success">Buat Pesanan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>