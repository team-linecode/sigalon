<div class="row mb-3">
    <div class="col-lg-12">
        <div class="card shadow border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0 text-primary">Tambah Data</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('supplier/edit/'.$suppliers->id) ?>" method="POST">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="<?= $suppliers->name ?>">
                                <?= form_error('name', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" class="form-control" name="address" id="address" value="<?= $suppliers->address ?>">
                                <?= form_error('address', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Kontak Person</label>
                                <input type="text" class="form-control" name="contact" id="contact" value="<?= $suppliers->contact ?>">
                                <?= form_error('contact', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Nomor Hanphone</label>
                                <input type="number" class="form-control" name="phone" id="phone" value="<?= $suppliers->phone ?>">
                                <?= form_error('phone', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Price/Tanki</label>
                                <input type="number" class="form-control" name="price" id="price" value="<?= $suppliers->price ?>">
                                <?= form_error('price', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Liter/Tanki</label>
                                <input type="number" class="form-control" name="liter" id="liter" value="<?= $suppliers->liter ?>">
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