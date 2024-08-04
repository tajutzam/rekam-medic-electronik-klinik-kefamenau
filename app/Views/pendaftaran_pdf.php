<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kunjungan Pasien</title>
    <style>
        body {
            font-family: Arial, 'Times New Roman', Times, serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding: 20px;
        }

        .logo {
            margin-right: 20px;
            align-items: center;
        }

        .logo img {
            max-width: 100px;
            height: auto;
        }

        .content {
            text-align: center;
        }

        .content h1 {
            margin: 0;
        }

        .content p {
            margin: 0;
        }

        hr {
            border: 1px solid black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
            padding-right: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents('logo.png')); ?>" alt="Logo Klinik">
        </div>
        <div class="content">
            <h2>KLINIK JENDRAL KEFAMENANU</h2>
            <p>"Kesembuhan Anda Adalah Kebahagian Kami"</p>
            <p>Jln. Sisingamangaraja, Depan Pasar Baru, Kelurahan Benpasi, Kec. Kota Kefamenanu, Kab. Timor Tengah Utara, Prop. NTT</p>
        </div>
    </div>
    <hr>
    <h4 style="text-align: center;">LAPORAN KUNJUNGAN PASIEN</h4>
    <p style="text-align: center;">Periode: Tanggal <?= $start_date ?>- <?= $end_date; ?></p>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>No RM</th>
                <th>Tanggal Pendaftaran</th>
                <th>Nama Pasien</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>Usia</th>
                <th>Cara Bayar</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($pendaftaranBulanan as $pendaftaran) : ?>
                <?php if (is_array($pendaftaran)) : ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $pendaftaran['nomor_rm']; ?></td>
                        <td><?= $pendaftaran['tanggal_pendaftaran']; ?></td>
                        <td><?= $pendaftaran['nama_lengkap']; ?></td>
                        <td><?= $pendaftaran['jenis_kelamin']; ?></td>
                        <td><?= $pendaftaran['alamat']; ?></td>
                        <td><?= $pendaftaran['usia']; ?></td>
                        <td><?= $pendaftaran['cara_bayar']; ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="footer">
        <p>Mengathui Kepala Klinik.</p>
        <br><br>
        <p>drg. Benhur Malelak</p>
    </div>
</body>

</html>