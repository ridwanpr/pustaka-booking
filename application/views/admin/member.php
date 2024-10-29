<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>
            <?= $this->session->flashdata('message'); ?>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="table-datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Anggota</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Profil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $a = 1;
                                foreach ($member as $k) { ?>
                                    <tr>
                                        <th scope="row"><?= $a++; ?></th>
                                        <td><?= $k['nama'] ?></td>
                                        <td><?= $k['email'] ?></td>
                                        <td>
                                            <img src="<?= base_url('assets/img/upload/') . $k['image']; ?>" class="img-fluid img-thumbnail" alt="profile user" onerror="this.onerror=null;this.src='<?= base_url('assets/img/default.svg'); ?>'" width="50">
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
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->