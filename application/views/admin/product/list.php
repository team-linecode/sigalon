<div class="row mb-5">
	<?php foreach ($products as $row) : ?>
		<div class="col-lg-4">
			<div class="card border-0 shadow-sm mb-3">
				<div class="card-body">
					<img src="<?= base_url('assets/img/product/' .  $row->image) ?>" class="img-fluid rounded mb-2" style="width: 100%;height: 200px; object-fit: cover;">
					<h5 class="text-primary mb-0"><?= $row->name ?></h5>
					<small class="text-muted d-block">
						Stok :
						<?php if ($row->stock > 0) : ?>
							<span class="text-success">Ready</span>
						<?php else : ?>
							<span class="text-danger">Kosong</span>
						<?php endif ?>
					</small>
					<small class="text-muted d-block">Harga : <?= number_format($row->price) ?></small>
					<a href="<?= base_url('cart/add/' . $row->id) ?>" class="btn btn-success mt-3"><i class="fas fa-cart-plus"></i> Pesan</a>
				</div>
			</div>
		</div>
	<?php endforeach ?>
</div>