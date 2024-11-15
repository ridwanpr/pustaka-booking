<div class="card mx-4 my-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="table-datatable">
                <thead class="thead-light">
                    <tr>
                        <th>No Pinjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>ID User</th>
                        <th>ID Buku</th>
                        <th>Tanggal Kembali</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Terlambat</th>
                        <th>Denda</th>
                        <th>Status</th>
                        <th>Total Denda</th>
                        <th>Pilihan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pinjam as $p) { ?>
                        <tr>
                            <td><?= $p['no_pinjam']; ?></td>
                            <td><?= $p['tgl_pinjam']; ?></td>
                            <td><?= $p['id_user']; ?></td>
                            <td><?= $p['id_buku']; ?></td>
                            <td><?= $p['tgl_kembali']; ?></td>
                            <td>
                                <?= date('Y-m-d'); ?>
                                <input type="hidden" name="tgl_pengembalian" id="tgl_pengembalian" value="<?= date('Y-m-d'); ?>">
                            </td>
                            <td>
                                <?php
                                $tgl1 = new DateTime($p['tgl_kembali']);
                                $tgl2 = new DateTime();
                                $selisih = $tgl2->diff($tgl1)->format("%a");
                                echo $selisih;
                                ?> Hari
                            </td>
                            <td><?= $p['denda']; ?></td>
                            <td>
                                <?php $statusClass = $p['status'] == "Pinjam" ? "warning" : "secondary"; ?>
                                <span class="badge badge-<?= $statusClass; ?>"><?= $p['status']; ?></span>
                            </td>
                            <td>
                                <?php
                                $total_denda = $selisih < 0 ? 0 : $p['denda'] * $selisih;
                                echo $total_denda;
                                ?>
                                <input type="hidden" name="totaldenda" id="totaldenda" value="<?= $total_denda; ?>">
                            </td>
                            <td>
                                <?php if ($p['status'] == "Kembali") { ?>
                                    <span class="btn btn-sm btn-outline-secondary disabled"><i class="fas fa-fw fa-edit"></i> Ubah Status</span>
                                <?php } else { ?>
                                    <a class="btn btn-sm btn-outline-info" href="<?= base_url('pinjam/ubahStatus/' . $p['id_buku'] . '/' . $p['no_pinjam']); ?>"><i class="fas fa-fw fa-edit"></i> Ubah Status</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>