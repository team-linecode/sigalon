<div class="row">
    <div class="col-lg-12">
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered datatables">
                        <thead>
                            <tr>
                                <th>Nama Perusahaan</th>
                                <th>Alamat Perusahaan</th>
                                <th>Email</th>
                                <th>Whatsapp</th>
                                <th>Phone</th>
                                <th>Facebook</th>
                                <th>Instagram</th>
                                <th>Line</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($site as $row) { ?>
                                <tr class="text-center">
                                    <td class="text-left"><?= empty($row->company_name) ? ' - ' : $row->company_name; ?></td>
                                    <td class="text-left"><?= empty($row->company_address) ? ' - ' : $row->company_address; ?></td>
                                    <td><?= empty($row->email) ? ' - ' : $row->email; ?></td>
                                    <td><?= empty($row->whatsapp) ? ' - ' : $row->whatsapp; ?></td>
                                    <td><?= empty($row->phone) ? ' - ' : $row->phone; ?></td>
                                    <td><?= empty($row->facebook) ? ' - ' : $row->facebook; ?></td>
                                    <td><?= empty($row->instagram) ? ' - ' : $row->instagram; ?></td>
                                    <td><?= empty($row->line) ? ' - ' : $row->line; ?></td>
                                    <td>
                                        <a href="<?= base_url('site/edit/' . $row->id) ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fas fa-pen"></i></a>
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