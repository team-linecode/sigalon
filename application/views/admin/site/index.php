<div class="row mb-3">
    <div class="col-lg-12">
        <div class="card shadow border-0">
            <div class="card-body">
                <form action="<?= base_url('site') ?>" method="POST">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nama Perusahaan</label>
                                <input type="text" class="form-control" name="company_name" id="company_name" value="<?= $site->company_name ?>">
                                <?= form_error('company_name', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Alamat Perusahaan</label>
                                <input type="text" class="form-control" name="company_address" id="company_address" value="<?= $site->company_address ?>">
                                <?= form_error('company_address', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" id="email" value="<?= $site->email ?>">
                                <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Whatsapp</label>
                                <input type="number" class="form-control" name="whatsapp" id="whatsapp" value="<?= $site->whatsapp ?>">
                                <?= form_error('whatsapp', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="number" class="form-control" name="phone" id="phone" value="<?= $site->phone ?>">
                                <?= form_error('phone', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Facebook</label>
                                <input type="text" class="form-control" name="facebook" id="facebook" value="<?= $site->facebook ?>">
                                <?= form_error('facebook', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Instagram</label>
                                <input type="text" class="form-control" name="instagram" id="instagram" value="<?= $site->instagram ?>">
                                <?= form_error('instagram', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Line</label>
                                <input type="text" class="form-control" name="line" id="line" value="<?= $site->line ?>">
                                <?= form_error('line', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary float-right"><i class="fas fa-save"></i> Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>