<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul; ?></title>
    <style>
        body {
            font-family: 'Segoe UI', Trebuchet, Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            background-color: #fff;
            font-size: 12pt;
        }

        .header-table {
            width: 100%;
            margin-bottom: 20px;
            border-bottom: 2px solid #3498db;
        }

        .header-table td {
            padding: 10px;
        }

        .logo {
            width: 120px;
            text-align: left;
        }

        .title {
            text-align: center;
            padding: 20px 0;
        }

        .title h1 {
            font-size: 24pt;
            color: #2c3e50;
            margin: 0;
        }

        .document-info {
            text-align: right;
            font-size: 10pt;
        }

        .booking-details {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        .booking-details td {
            padding: 8px;
            border: 1px solid #dee2e6;
            font-size: 10pt;
        }

        .booking-details .label {
            background-color: #f8f9fa;
            font-weight: bold;
            width: 150px;
        }

        .customer-name {
            font-weight: bold;
            color: #3498db;
        }

        .books-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
        }

        .books-table th {
            background-color: #3498db;
            color: #fff;
            padding: 12px;
            text-align: left;
            font-size: 11pt;
        }

        .books-table td {
            padding: 10px;
            border: 1px solid #dee2e6;
            font-size: 10pt;
        }

        .books-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .footer {
            width: 100%;
            margin-top: 30px;
            border-top: 1px solid #dee2e6;
            text-align: center;
            font-size: 9pt;
            color: #6c757d;
            padding-top: 20px;
        }

        .note {
            font-size: 9pt;
            color: #666;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <table class="header-table">
        <tr>
            <td class="logo">
                <img src="<?= base_url('assets/img/'); ?>dummy-book.png" alt="Logo" width="100">
            </td>
            <td class="title">
                <h1>Bukti Booking Pustaka Booking</h1>
                <div style="font-size: 10pt; color: #6c757d;">Digital Booking Receipt</div>
            </td>
            <td class="document-info">
                <strong>No: <?= $booking['id_booking']; ?></strong><br>
                Tanggal: <?= date('d/m/Y'); ?>
            </td>
        </tr>
    </table>

    <table class="booking-details">
        <tr>
            <td class="label">ID Booking</td>
            <td colspan="3"><?= $booking['id_booking']; ?></td>
        </tr>
        <tr>
            <td class="label">Tanggal Booking</td>
            <td><?= date('d/m/Y', strtotime($booking['tgl_booking'])); ?></td>
            <td class="label">Batas Pengambilan</td>
            <td><?= date('d/m/Y', strtotime($booking['batas_ambil'])); ?></td>
        </tr>
    </table>

    <table class="customer-info">
        <tr>
            <td>
                <?php foreach ($useraktif as $u): ?>
                    <h2 style="margin: 0 0 10px 0;">Terima kasih, <span class="customer-name"><?= $u->nama; ?></span></h2>
                    <p style="margin: 0;">Berikut adalah detail buku yang telah dibooking:</p>
                <?php endforeach; ?>
            </td>
        </tr>
    </table>

    <table class="books-table">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="35%">Judul Buku</th>
                <th width="25%">Penulis</th>
                <th width="20%">Penerbit</th>
                <th width="15%">Tahun</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($items as $i): ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><strong><?= $i['judul_buku']; ?></strong></td>
                    <td><?= $i['pengarang']; ?></td>
                    <td><?= $i['penerbit']; ?></td>
                    <td><?= $i['tahun_terbit']; ?></td>
                </tr>
                <?php $no++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="note">
        <p>Dokumen ini diterbitkan secara digital dan sah sebagai bukti booking.</p>
        <p style="font-family: monospace;">Generated: <?= date('d M Y H:i:s'); ?></p>
    </div>

    <div class="footer">
        <p>Hash: <?= md5(date('d M Y H:i:s')); ?></p>
    </div>
</body>

</html>