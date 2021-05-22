<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="mb-0 text-primary font-weight-bold">Pendapatan Bersih</h5>
                <hr>
                <div class="row">
                    <!-- Earnings (Annual) Card Example -->
                    <div class="col-xl-4 col-md-6">
                        <div class="card border-left-success h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pendapatan</div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total_pendapatan) ?></div>
                                            </div>
                                            <div class="col">
                                                <small class="mb-0 mr-3 text-success">&nbsp;(<?= number_format($total_pendapatan_trx) ?>)</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6">
                        <div class="card border-left-primary h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pendapatan Bulan ini</div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total_pendapatan_bulan) ?></div>
                                            </div>
                                            <div class="col">
                                                <small class="mb-0 mr-3 text-primary">&nbsp;(<?= number_format($total_pendapatan_bulan_trx) ?>)</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tasks Card Example -->
                    <div class="col-xl-4 col-md-6">
                        <div class="card border-left-info h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pendapatan Hari ini</div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Rp <?= number_format($total_pendapatan_hari) ?></div>
                                            </div>
                                            <div class="col">
                                                <small class="mb-0 mr-3 text-info">&nbsp;(<?= number_format($total_pendapatan_hari_trx) ?>)</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="mb-0 text-primary font-weight-bold">Pendapatan Kotor</h5>
                <hr>
                <div class="row">
                    <!-- Earnings (Annual) Card Example -->
                    <div class="col-xl-4 col-md-6">
                        <div class="card border-left-success h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pendapatan</div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total_pendapatan) ?></div>
                                            </div>
                                            <div class="col">
                                                <small class="mb-0 mr-3 text-success">&nbsp;(<?= number_format($total_pendapatan_trx) ?>)</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6">
                        <div class="card border-left-primary h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pendapatan Bulan ini</div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total_pendapatan_bulan) ?></div>
                                            </div>
                                            <div class="col">
                                                <small class="mb-0 mr-3 text-primary">&nbsp;(<?= number_format($total_pendapatan_bulan_trx) ?>)</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tasks Card Example -->
                    <div class="col-xl-4 col-md-6">
                        <div class="card border-left-info h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pendapatan Hari ini</div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Rp <?= number_format($total_pendapatan_hari) ?></div>
                                            </div>
                                            <div class="col">
                                                <small class="mb-0 mr-3 text-info">&nbsp;(<?= number_format($total_pendapatan_hari_trx) ?>)</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="mb-0 text-primary font-weight-bold">Transaksi Paid</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover datatables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($paid as $row) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row->user_name ?></td>
                                    <td><?= $row->product_name ?></td>
                                    <td class="text-center"><?= $row->qty ?></td>
                                    <td class="text-center"><?= $row->total ?></td>
                                    <td><?= $row->date ?></td>
                                    <td>
                                        <div class="btn btn-success btn-sm readonly"><i class="fas fa-check-circle"></i> Paid</div>
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
<div class="row">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="mb-0 text-primary font-weight-bold">Transaksi On Process</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover datatables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($process as $row) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row->user_name ?></td>
                                    <td><?= $row->product_name ?></td>
                                    <td class="text-center"><?= $row->qty ?></td>
                                    <td class="text-center"><?= $row->total ?></td>
                                    <td><?= $row->date ?></td>
                                    <td>
                                        <div class="btn btn-primary btn-sm readonly"><i class="fas fa-check-circle"></i> On Process</div>
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