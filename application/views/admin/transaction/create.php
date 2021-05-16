<div class="row">
	<div class="col-lg-6">
		<div class="card border-0 shadow">
			<div class="card-body">
				<form action="<?= base_url('user') ?>" method="POST">
					<div class="form-group">
						<label>Produk</label>
						<select class="custom-select" name="id_product">
							<option value="">Pilih Produk</option>
							<?php foreach ($products as $row) : ?>
								<option value="<?= $row->id ?>"><?= $row->name ?></option>
							<?php endforeach ?>
						</select>
						<?php echo form_error('name', '<small class="text-danger">', '</small>'); ?>
					</div>
					<div class="form-group">
						<label>Jumlah</label>
						<input type="number" class="form-control" name="qty" value="<?= set_value('qty') ?>">
						<?php echo form_error('qty', '<small class="text-danger">', '</small>'); ?>
					</div>
					<div class="form-group">
						<label>Metode Pembayaran</label>
						<select class="custom-select" name="id_product">
							<option value="">Pilih Metode Pembayaran</option>
							<?php foreach ($payment_methods as $row) : ?>
								<option value="<?= $row->id ?>"><?= $row->name ?></option>
							<?php endforeach ?>
						</select>
						<?php echo form_error('name', '<small class="text-danger">', '</small>'); ?>
					</div>

					<div class="d-flex justify-content-end">
						<button class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>