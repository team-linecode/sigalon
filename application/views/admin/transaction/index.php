<div class="card border-0 shadow-sm mb-5">
	<div class="card-body p-0">
		<div class="row">
			<div class="col-lg-12">
				<div class="card-header bg-white">
					<?php if (user()->level == 'Admin') : ?>
						<a href="<?= base_url('transaction/create') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Buat Transaksi Masuk</a>
					<?php else : ?>
						<a href="<?= base_url('product/list') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Beli Produk</a>
					<?php endif ?>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<?php
						if (user()->level != 'Customer') {
							$this->load->view('admin/transaction/table_admin');
						} else {
							$this->load->view('admin/transaction/table_customer');
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>