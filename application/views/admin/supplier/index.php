<div class="row mb-3">
    <div class="col-lg-12">
        <div class="card shadow border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0 text-primary">Tambah Data</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('supplier') ?>" method="POST">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                                <?= form_error('name', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" class="form-control" name="address" id="address">
                                <?= form_error('address', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Kontak Person</label>
                                <input type="text" class="form-control" name="contact" id="contact">
                                <?= form_error('contact', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Nomor Hanphone</label>
                                <input type="number" class="form-control" name="phone" id="phone">
                                <?= form_error('phone', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Price/Tanki</label>
                                <input type="number" class="form-control" name="price" id="price">
                                <?= form_error('price', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Liter/Tanki</label>
                                <input type="number" class="form-control" name="liter" id="liter">
                                <?= form_error('liter', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary float-right"><i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered datatables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Nama Kontak</th>
                                <th>No. Telepon</th>
                                <th>Harga/Tanki</th>
                                <th>Liter</th>
                                <th>Jumlah Galon</th>
                                <th>Harga/Galon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($suppliers as $row) { ?>
                                <tr class="text-center">
                                    <td>1</td>
                                    <td class="text-left"><?= $row->name; ?></td>
                                    <td class="text-left"><?= $row->address; ?></td>
                                    <td><?= $row->contact; ?></td>
                                    <td><?= $row->phone; ?></td>
                                    <td>Rp <?= number_format($row->price); ?></td>
                                    <td><?= $row->liter; ?></td>
                                    <td><?= $row->stok; ?></td>
                                    <td>Rp <?= number_format($row->unit_price); ?></td>
                                    <td>
                                        <a href="<?= base_url('supplier/edit/' . $row->id) ?>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fas fa-pen"></i></a>
                                        <a href="<?= base_url('supplier/delete/' . $row->id) ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="left" title="Delete"><i class="fas fa-trash"></i></a>
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