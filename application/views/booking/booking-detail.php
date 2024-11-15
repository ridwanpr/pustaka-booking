<div class="container">
    <div class="card">
        <div class="card-body d-flex justify-content-center">
            <table>
                <?php foreach ($agt_booking as $ab) { ?>
                    <tr>
                        <td>Data Anggota</td>
                        <td>:</td>
                        <th><?= $ab['nama']; ?></th>
                    </tr>
                    <tr>
                        <td>ID Booking</td>
                        <td>:</td>
                        <th><?= $ab['id_booking']; ?></th>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="table-datatable">
                                <tr>
                                    <th>No.</th>
                                    <th>ID Buku</th>
                                    <th>Judul Buku</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Tahun</th>
                                </tr>
                                <?php $no = 1;
                                foreach ($detail as $d) { ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $d['id_buku']; ?></td>
                                        <td><?= $d['judul_buku']; ?></td>
                                        <td><?= $d['pengarang']; ?></td>
                                        <td><?= $d['penerbit']; ?></td>
                                        <td><?= $d['tahun_terbit']; ?></td>
                                    </tr>
                                <?php $no++;
                                } ?>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="text-center">
                        <a href="#" onclick="window.history.go(-1)" class="btn btn-outline-dark mt-3">
                            <i class="fas fa-fw fa-reply"></i> Kembali
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>