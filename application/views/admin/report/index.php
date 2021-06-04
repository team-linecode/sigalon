<div class="row mb-3">
    <div class="col-lg-12">
        <div class="card shadow border-0">
            <div class="card-header bg-white">
                <h5 class="text-primary mb-0 font-weight-bold">Laporan Transaksi Masuk</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('report/view') ?>" method="POST">
                <input type="hidden" name="type" value="in">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" id="status" class="custom-select">
                                    <option value="" hidden>Pilih Status</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Unpaid">Unpaid</option>
                                    <option value="On Process">On Process</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Canceled">Canceled</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Dari Tanggal</label>
                                <input type="date" class="form-control" name="from_date">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Sampai Tanggal</label>
                                <input type="date" class="form-control" name="till_date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-primary btn-sm">Lihat Laporan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-lg-12">
        <div class="card shadow border-0">
            <div class="card-header bg-white">
                <h5 class="text-primary mb-0 font-weight-bold">Laporan Transaksi Keluar</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('report/view') ?>" method="POST">
                <input type="hidden" name="type" value="out">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" id="status" class="custom-select">
                                    <option value="" hidden>Pilih Status</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Unpaid">Unpaid</option>
                                    <option value="On Process">On Process</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Canceled">Canceled</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Dari Tanggal</label>
                                <input type="date" class="form-control" name="from_date">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Sampai Tanggal</label>
                                <input type="date" class="form-control" name="till_date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-primary btn-sm">Lihat Laporan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>