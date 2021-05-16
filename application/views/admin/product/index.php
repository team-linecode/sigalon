<div class="row mb-3">
    <div class="col-lg-12">
        <div class="card shadow border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0 text-primary">Tambah Data</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('product') ?>" method="POST">
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
                                <label for="">Price</label>
                                <input type="number" class="form-control" name="price" id="price">
                                <?= form_error('price', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Supplier</label>
                                <select name="id_supplier" id="id_supplier" class="custom-select">
                                    <option value="" hidden>Pilih Supplier</option>
                                    <?php foreach ($suppliers as $row) { ?>
                                        <option value="<?= $row->id ?>"><?= $row->name ?></option>
                                    <?php } ?>
                                </select>
                                <?= form_error('id_supplier', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Nomor Hanphone</label>
                                <input type="number" class="form-control" name="phone" id="phone">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Price/Tanki</label>
                                <input type="number" class="form-control" name="pricea" id="pricae">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Liter/Tanki</label>
                                <input type="number" class="form-control" name="liter" id="liter">
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
                                <th>Harga</th>
                                <th>Supplier</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($products as $row) { ?>
                                <tr class="text-center">
                                    <td>1</td>
                                    <td class="text-left"><?= $row->name; ?></td>
                                    <td>Rp <?= number_format($row->price); ?></td>
                                    <td class="text-left"><?= $row->name; ?></td>
                                    <td><?= $row->status; ?></td>
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