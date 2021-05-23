<div class="card border-0 shadow-sm">
	<div class="card-body p-0">
		<div class="row">
			<div class="col-lg-12">
				<div class="card-header bg-white">
					<?php if ($this->session->userdata('level') == 'Admin') : ?>
						<a href="<?= base_url('transaction/create') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
					<?php else : ?>
						<a href="<?= base_url('order/create') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Buat Pesanan</a>
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