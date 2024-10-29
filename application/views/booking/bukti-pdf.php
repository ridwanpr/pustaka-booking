<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul; ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/booking-pdf.css">
</head>

<body>
    <table class="header-table">
        <tr>
            <td class="logo">
                <img src="<?= base_url('assets/img/'); ?>dummy-book.png" alt="Logo" width="100">
            </td>
            <td class="title">
                <h1>Bukti Booking Pustaka Booking</h1>
                <div class="sub-title">Digital Booking Receipt</div>
            </td>
            <td class="document-info">
                <strong>No: <?= $booking['id_booking']; ?></strong><br>
                Tanggal: <?= date('d/m/Y'); ?>
            </td>
        </tr>
    </table>

    <table class="booking-details">
        <tr>
            <td class="label">Kode Booking</td>
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
                    <h2 class="greeting">Terima kasih, <span class="customer-name"><?= $u->nama; ?></span></h2>
                    <p class="info-text">Berikut adalah detail buku yang telah dibooking:</p>
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
        <p class="generated">Generated: <?= date('d M Y H:i:s'); ?></p>
    </div>

    <div class="footer">
        <p>Hash: <?= md5(date('d M Y H:i:s')); ?></p>
    </div>
</body>

</html>