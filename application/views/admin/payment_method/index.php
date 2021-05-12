<div class="row">
    <div class="col-lg-4">
        <div class="card shadow border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0 text-primary">Tambah Data</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('payment_method') ?>" method="POST">
                    <div class="form-group">
                        <label for="">Nama Metode</label>
                        <input type="text" class="form-control" name="name">
                        <?= form_error('name','<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label for="">Tipe Pembayaran</label>
                        <select name="type" id="type" class="custom-select">
                            <option value="">Pilih Tipe Pembayaran</option>
                            <option value="transfer">Transfer</option>
                            <option value="cod">Bayar di Tempat</option>
                        </select>
                        <?= form_error('type','<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group" id="account_number">
                        <label for="">Nomor Rekening</label>
                        <input type="text" class="form-control" name="acc_number" id="acc_number">
                        <?= form_error('acc_number','<small class="text-danger">', '</small>') ?>
                    </div>
                    <button class="btn btn-sm btn-primary float-right"><i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered datatables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Tipe</th>
                                <th>Nomor Rekening</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($method as $row) { ?>
                                <tr class="text-center">
                                    <td><?= $no++; ?></td>
                                    <td class="text-left"><?= $row->name; ?></td>
                                    <td><?= $row->type == 'cod' ? 'COD' : 'Transfer Bank'; ?></td>
                                    <td><?= empty($row->acc_number) ? '-' : $row->acc_number; ?></td>
                                    <td><i class="fas fa-circle text-<?= $row->status == 'Active' ? 'success' : 'danger' ?>"></i> <?= $row->status; ?></td>
                                    <td>
                                        <a href="<?= base_url('payment_method/edit/'.$row->id) ?>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fas fa-pen"></i></a>
                                        <a href="<?= base_url('payment_method/delete/'.$row->id) ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="left" title="Delete"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>