<div class="row mb-3">
    <div class="col-lg-12">
        <div class="card shadow border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0 text-primary  font-weight-bold">Edit Data</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('product/edit/' . $products->product_id) ?>" method="POST">
                    <div class="row">
                        <div class="col-lg-4 border-right mb-3">
                            <div class="form-group">
                                <label for="">Nama Barang</label>
                                <input type="text" class="form-control" name="name" id="name" value="<?= $products->product_name ?>">
                                <?= form_error('name', '<small class="text-danger">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Harga</label>
                                <input type="text" class="form-control" name="price" id="price" value="<?= $products->product_price ?>">
                                <?= form_error('price', '<small class="text-danger">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" id="status" class="custom-select">
                                    <option value="Active" <?= $products->status == 'Active' ? 'selected' : '' ?>>Active</option>
                                    <option value="No Active" <?= $products->status == 'No Active' ? 'selected' : '' ?>>No Active</option>
                                </select>
                                <?= form_error('status', '<small class="text-danger">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Supplier</label>
                                <select name="id_supplier" id="id_supplier" class="custom-select">
                                    <?php foreach ($suppliers as $row) { ?>
                                        <option value="<?= $row->id ?>" <?= $products->id_supplier == $row->id ? 'selected' : '' ?>><?= $row->name ?></option>
                                    <?php } ?>
                                </select>
                                <?= form_error('id_supplier', '<small class="text-danger">', '</small>') ?>
                            </div>
                            <div class="button-group">
                                <a href="<?= base_url('product') ?>" class="btn btn-danger btn-sm float-right ml-1"><i class="fas fa-times"></i> Batal</a>
                                <button class="btn btn-sm btn-primary float-right"><i class="fas fa-save"></i> Simpan Perubahan</button>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <h5><i class="fas fa-info-circle"></i> Detail Supplier</h5>
                            <hr>
                            <h5 class="text-primary font-weight-bold" id="nameSupplier"><?= $products->name ?></h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr id="tr-product">
                                        <th>Alamat</th>
                                        <td id="addressSupplier"><?= $products->address ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Kontak</th>
                                        <td id="contactSupplier"><?= $products->contact ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. Handphone</th>
                                        <td id="phoneSupplier"><?= $products->phone ?></td>
                                    </tr>
                                    <tr>
                                        <th>Harga/Tanki</th>
                                        <td id="priceSupplier">Rp <?= number_format($products->price) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Liter/Tanki</th>
                                        <td id="literSupplier"><?= number_format($products->liter) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Galon yang didapat</th>
                                        <td id="stockSupplier"><?= number_format($products->stock) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Modal/Galon</th>
                                        <td id="unitpriceSupplier">Rp <?= number_format($products->unit_price) ?></td>
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