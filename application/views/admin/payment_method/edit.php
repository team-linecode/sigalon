<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0 text-primary">Ubah Data</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('payment_method/edit/'.$method->id) ?>" method="POST">
                    <div class="form-group">
                        <label for="">Nama Metode</label>
                        <input type="text" class="form-control" name="name" value="<?= $method->name ?>">
                        <?= form_error('name','<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label for="">Tipe Pembayaran</label>
                        <select name="type" id="type_edit" class="custom-select">
                            <option value="">Pilih Tipe Pembayaran</option>
                            <option value="transfer" <?= $method->type == 'transfer' ? 'selected' : '' ?>>Transfer</option>
                            <option value="cod" <?= $method->type == 'cod' ? 'selected' : '' ?>>Bayar di Tempat</option>
                        </select>
                        <?= form_error('type','<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group" id="account_number_edit">
                        <label for="">Nomor Rekening</label>
                        <input type="text" class="form-control" name="acc_number" id="acc_number" value="<?= $method->acc_number ?>">
                        <?= form_error('acc_number','<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group" id="account_name_edit">
                        <label for="">Atas Nama Rekening</label>
                        <input type="text" class="form-control" name="acc_name" id="acc_name" value="<?= $method->acc_name ?>">
                        <?= form_error('acc_name','<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" id="status" class="custom-select">
                            <option value="Active" <?= $method->status == 'Active' ? 'selected' : '' ?>>Active</option>
                            <option value="No Active" <?= $method->status == 'No Active' ? 'selected' : '' ?>>No Active</option>
                        </select>
                        <?= form_error('type','<small class="text-danger">', '</small>') ?>
                    </div>
                    <button class="btn btn-sm btn-primary float-right"><i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>