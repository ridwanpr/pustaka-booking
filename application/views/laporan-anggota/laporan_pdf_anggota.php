<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Anggota</title>
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
    <h3 style="text-align: center;">Laporan Data Anggota Perpustakaan Online</h3>

    <table class="table-data">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($anggota as $b) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $b['nama']; ?></td>
                    <td><?= $b['email']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>