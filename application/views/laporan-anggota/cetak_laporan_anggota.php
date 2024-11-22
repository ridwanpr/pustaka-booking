<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        h3 {
            font-family: Verdana, sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>

    <h3>Laporan Data Anggota Perpustakaan Online</h3>

    <table class="table-data">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($anggota as $b): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $b['nama']; ?></td>
                    <td><?= $b['email']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>