<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Buku</title>
    <style>
        .table-data {
            width: 100%;
            border-collapse: collapse;
        }

        .table-data th,
        .table-data td {
            border: 1px solid black;
            font-size: 11pt;
            font-family: Verdana, sans-serif;
            padding: 10px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h3 style="text-align: center;">Laporan Data Buku Perpustakaan Online</h3>

    <table class="table-data">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>ISBN</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($buku as $b) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $b['judul_buku']; ?></td>
                    <td><?= $b['pengarang']; ?></td>
                    <td><?= $b['penerbit']; ?></td>
                    <td><?= $b['tahun_terbit']; ?></td>
                    <td><?= $b['isbn']; ?></td>
                    <td><?= $b['stok']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>