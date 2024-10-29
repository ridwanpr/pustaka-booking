<div class="container">
    <center>
        <table>
            <?php foreach ($useraktif as $u): ?>
                <tr>
                    <td nowrap>Terima Kasih <b><?= htmlspecialchars($u->nama); ?></b></td>
                </tr>
                <tr>
                    <td>Buku yang ingin Anda pinjam adalah sebagai berikut:</td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="table-datatable">
                            <tr>
                                <th>No.</th>
                                <th>Buku</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Tahun</th>
                            </tr>
                            <?php $no = 1; ?>
                            <?php foreach ($items as $i): ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td>
                                        <img src="<?= base_url('assets/img/upload/' . $i['image']); ?>" class="rounded" alt="No Picture" width="10%">
                                    </td>
                                    <td nowrap><?= htmlspecialchars($i['pengarang']); ?></td>
                                    <td nowrap><?= htmlspecialchars($i['penerbit']); ?></td>
                                    <td nowrap><?= htmlspecialchars($i['tahun_terbit']); ?></td>
                                </tr>
                                <?php $no++; ?>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <hr>
                </td>
            </tr>
            <tr>
                <td>
                    <a class="btn btn-sm btn-outline-danger" onclick="information('Waktu Pengambilan Buku 1x24 jam dari Booking!!!')" href="<?= base_url('booking/exportToPdf/' . $this->session->userdata('id_user')); ?>" target="_blank">
                        <span class="far fa-lg fa-fw fa-file-pdf"></span> Pdf
                    </a>
                </td>
            </tr>
        </table>
    </center>
</div>