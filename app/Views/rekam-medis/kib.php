<!-- app/Views/rekam-medis/kib.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Kartu Indeks Obat</title>
    <style>
        .card {
            border: 1px solid #000;
            padding: 10px;
            width: 350px;
            font-family: Arial, sans-serif;
        }

        .header {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .info {
            font-size: 12px;
            margin-top: 10px;
        }

        .info table {
            width: 100%;
        }

        .info td {
            padding: 5px;
        }

        .footer {
            font-size: 10px;
            text-align: center;
            margin-top: 10px;
            padding: 5px;
            background-color: greenyellow;
            border-radius: 10px;
        }

        .qr-code {
            text-align: right;
            margin-top: -50px;
        }

        .logo img {
            height: 100px;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="header">
            <div class="logo">
                <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents('logo.png')); ?>" alt="Logo Klinik">
            </div>
            <div class="content">
                <h2>KLINIK JENDRAL KEFAMENANU</h2>
                <p>"Kesembuhan Anda Adalah Kebahagian Kami"</p>
                <p>Jln. Sisingamangaraja, Depan Pasar Baru, Kelurahan Benpasi, Kec. Kota Kefamenanu, Kab. Timor Tengah Utara, Prop. NTT</p>
                <h2>KARTU INDENTITAS BEROBAT</h2>
            </div>
        </div>
        <hr>
        <div class="info">
            <table>
                <tr>
                    <td>No RM</td>
                    <td>:<?= $segment1; ?></td>
                </tr>
                <tr>
                    <td>Nama Pasien</td>
                    <td>:<?= $pasien['nama_lengkap']; ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:<?= $pasien['jenis_kelamin']; ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:<?= $pasien['alamat']; ?></td>
                </tr>
            </table>
        </div>
        <div class="footer">
            Setiap Berobat Kartu Ini Harus Di Bawa
        </div>
    </div>
</body>

</html>