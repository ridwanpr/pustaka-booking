<table border="1">
    <?php foreach ($useraktif as $u): ?>
        <tr>
            <th>Nama Anggota: <?= htmlspecialchars($u->nama); ?></th>
        </tr>
        <tr>
            <th>Buku Yang dibooking:</th>
        </tr>
    <?php endforeach; ?>

    <tr>
        <td>
            <div class="table-responsive">
                <table border="1">
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
                            <td><?= htmlspecialchars($i['judul_buku']); ?></td>
                            <td><?= htmlspecialchars($i['pengarang']); ?></td>
                            <td><?= htmlspecialchars($i['penerbit']); ?></td>
                            <td><?= htmlspecialchars($i['tahun_terbit']); ?></td>
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
        <td align="center">
            <?= md5(date('d M Y H:i:s')); ?>
        </td>
    </tr>
</table>