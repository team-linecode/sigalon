<div class="row">
    <div class="col-lg-4">
        <div class="card shadow border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0 text-primary">Tambah Data</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Nama Metode</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label for="">Tipe Pembayaran</label>
                    <select name="type" id="type" class="form-control">
                        <option value="">Pilih Tipe Pembayaran</option>
                        <option value="transfer">Transfer</option>
                        <option value="cod">Bayar di Tempat</option>
                    </select>
                </div>
                <div class="form-group" id="account_number">
                    <label for="">Nomor Rekening</label>
                    <input type="text" class="form-control" name="acc_number" id="acc_number">
                </div>
                <a href="" class="btn btn-sm btn-primary float-right"><i class="fas fa-save"></i> Simpan</a>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered datatables">
                        <thead>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Tipe</th>
                            <th>Nomor Rekening</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <tr></tr>
                            <tr></tr>
                            <tr></tr>
                            <tr></tr>
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>