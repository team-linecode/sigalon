<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0 text-primary">Tambah Data</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('product') ?>" method="POST">
                    <div class="row">
                        <div class="col-lg-4 border-right mb-3">
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
                            <div id="data_supplier"></div>
                            <button class="btn btn-sm btn-primary float-right"><i class="fas fa-save"></i> Simpan</button>

                        </div>
                        <div class="col-lg-8">
                            <h5><i class="fas fa-info-circle"></i> Detail Supplier</h5>
                            <hr>
                            <h5 class="text-primary font-weight-bold" id="nameSupplier"></h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr id="tr-product">
                                        <th>Alamat</th>
                                        <td id="addressSupplier">-</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Kontak</th>
                                        <td id="contactSupplier">-</td>
                                    </tr>
                                    <tr>
                                        <th>No. Handphone</th>
                                        <td id="phoneSupplier">-</td>
                                    </tr>
                                    <tr>
                                        <th>Harga/Tanki</th>
                                        <td id="priceSupplier">-</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Liter/Tanki</th>
                                        <td id="literSupplier">-</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Galon yang didapat</th>
                                        <td id="stockSupplier">-</td>
                                    </tr>
                                    <tr>
                                        <th>Modal/Galon</th>
                                        <td id="unitpriceSupplier">-</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered datatables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Supplier</th>
                                <th>Stok</th>
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
                                    <td class="text-left"><?= $row->product_stock; ?></td>
                                    <td><?= $row->status; ?></td>
                                    <td>
                                        <a href="<?= base_url('product/edit/' . $row->product_id) ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fas fa-pen"></i></a>
                                        <button data-target="<?= base_url('product/delete/' . $row->product_id) ?>" class="btn btn-danger btn-sm confirm-delete" data-toggle="tooltip" data-placement="left" title="Delete"><i class="fas fa-trash"></i></button>
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