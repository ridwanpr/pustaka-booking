<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>

    <div class="row">
        <div class="col-lg-12">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>

            <!-- Card without header -->
            <div class="card mb-3">
                <div class="card-body">
                    <a href="<?= base_url('laporanAnggota/cetak_laporan_anggota'); ?>" target="_blank" class="btn btn-primary mb-3">
                        <i class="fas fa-print"></i> Print
                    </a>
                    <a href="<?= base_url('laporanAnggota/laporan_anggota_pdf'); ?>" class="btn btn-warning mb-3">
                        <i class="far fa-file-pdf"></i> Download Pdf
                    </a>
                    <a href="<?= base_url('laporanAnggota/export_excel'); ?>" class="btn btn-success mb-3">
                        <i class="far fa-file-excel"></i> Export ke Excel
                    </a>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $a = 1; ?>
                            <?php foreach ($anggota as $b) { ?>
                                <tr>
                                    <th scope="row"><?= $a++; ?></th>
                                    <td><?= $b['nama']; ?></td>
                                    <td><?= $b['email']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>