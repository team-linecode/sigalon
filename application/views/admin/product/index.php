<div class="row mb-3">
    <div class="col-lg-12">
        <div class="card shadow border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0 text-primary">Tambah Data</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('product') ?>" method="POST">
                    <div class="row">
                        <div class="col-lg-4 border-right">
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" class="form-control" name="name" id="name">
                                <?= form_error('name', '<small class="text-danger">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" class="form-control" name="price" id="price">
                                <?= form_error('price', '<small class="text-danger">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label>Suplier</label>
                                <select name="id_supplier" id="id_supplier" class="custom-select">
                                    <option value="" hidden>Pilih Supplier</option>
                                    <?php foreach ($suppliers as $row) { ?>
                                        <option value="<?= $row->id ?>"><?= $row->name ?></option>
                                    <?php } ?>
                                </select>
                                <?= form_error('id_supplier', '<small class="text-danger">', '</small>') ?>
                            </div>
                            <button class="btn btn-sm btn-primary float-right"><i class="fas fa-save"></i> Simpan</button>

                        </div>
                        <div class="col-lg-8">
                            <h5><i class="fas fa-info-circle"></i> Detail Supplier</h5>
                            <hr>
                            <h5 class="text-primary font-weight-bold">Nama Supplier</h5>
                            <table class="table table-bordered">
                                <tr id="tr-product">
                                    <th>Alamat</th>
                                    <td id="productDetail">Jl Daan Mogot Km.11 No.12, Cipanas, Bogor</td>
                                </tr>
                                <tr>
                                    <th>Nama Kontak</th>
                                    <td id="showQty">Supardi</td>
                                </tr>
                                <tr>
                                    <th>No. Handphone</th>
                                    <td id="total">0</td>
                                </tr>
                                <tr>
                                    <th>Harga/Tanki</th>
                                    <td id="total">0</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Liter/Tanki</th>
                                    <td id="total">0</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Galon yang didapat</th>
                                    <td id="total">0</td>
                                </tr>
                                <tr>
                                    <th>Modal/Galon</th>
                                    <td id="total">0</td>
                                </tr>
                            </table>
                        </div>
                    </div>
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
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($products as $row) { ?>
                                <tr class="text-center">
                                    <td>1</td>
                                    <td class="text-left"><?= $row->product_name; ?></td>
                                    <td>Rp <?= number_format($row->product_price); ?></td>
                                    <td class="text-left"><?= $row->supplier_name; ?></td>
                                    <td class="text-left"><?= $row->stock; ?></td>
                                    <td><?= $row->status; ?></td>
                                    <td>
                                        <a href="<?= base_url('product/edit/' . $row->product_id) ?>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fas fa-pen"></i></a>
                                        <a href="<?= base_url('product/delete/' . $row->product_id) ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="left" title="Delete"><i class="fas fa-trash"></i></a>
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