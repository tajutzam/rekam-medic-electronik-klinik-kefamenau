<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Resume Medis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            width: 100%;
        }

        .content td {
            padding: 5px;
        }

        .content .td {
            width: 200px;
        }

        .content ol {
            margin: 0;
            padding-left: 20px;
        }

        .logo img {
            height: 100px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents('logo.png')); ?>" alt="Logo Klinik">
        </div>
        <h3>KLINIK JENDRAL KEFAMENANU</h3>
        <p>"Kesembuhan Anda Adalah Kebahagian Kami"</p>

        <p>Jln. Sisingamangaraja, Depan Pasar Baru, Kelurahan Benpasi, Kec. Kota Kefamenanu, Kab. Timor Tengah Utara, Prop. NTT</p>

    </div>
    <hr>
    <h2 style="text-align: center;">Resume Medis</h2>
    <table class="content">
        <tr>
            <td class="td">No KTP</td>
            <td>: <?= $nomor_ktp; ?></td>
        </tr>
        <tr>
            <td class="td">No RM</td>
            <td>: <?= $nomor_rm; ?></td>
        </tr>
        <tr>
            <td class="td">Nama Pasien</td>
            <td>: <?= $nama_lengkap; ?></td>
        </tr>
        <tr>
            <td class="td">Tanggal Lahir</td>
            <td>: <?= $tanggal_lahir; ?></td>
        </tr>
        <tr>
            <td class="td">Tanggal Pemeriksaan</td>
            <td>: <?= $tgl_pelayanan; ?></td>
        </tr>
        <tr>
            <td class="td">Jenis Kelamin</td>
            <td>: <?= $jenis_kelamin; ?></td>
        </tr>
        <tr>
            <td class="td">Alamat</td>
            <td>: <?= $alamat; ?></td>
        </tr>
    </table>
    <br>
    <hr style="margin-top: 10px;">
    <br>
    <?php
    $arrayDiagnosa = explode(',', $diagnosa_ids);
    $arrayTindakan = explode(',', $tindakan_ids);
    $arrayObat = explode(',', $obat_ids);

    ?>
    <table class="content">
        <tr>
            <td class="td">Riwayat Penyakit</td>
            <td>: <?= $riwayat_penyakit; ?></td>
        </tr>
        <tr>
            <td class="td">Anamnesa</td>
            <td>: <?= $anamnesa; ?></td>
        </tr>
        <tr>
            <td class="td">Pemeriksaan Fisik</td>
            <td>: sudah</td>
        </tr>
        <tr>
            <td class="td">Diagnosa</td>
            <td>
                <?php if ($arrayDiagnosa[0] != '') : ?>
                    <ol class="ol">
                        <?php foreach ($arrayDiagnosa as $item) : ?>
                            <li><?= $item; ?></li>
                        <?php endforeach ?>
                    </ol>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td class="td">Tindakan</td>
            <td>
                <?php if ($arrayTindakan[0] != '') : ?>
                    <ol class="ol">
                        <?php foreach ($arrayTindakan as $item) : ?>
                            <li><?= $item; ?></li>
                        <?php endforeach ?>
                    </ol>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td class="td">Obat</td>
            <td class="ol">
                <?php if ($arrayObat[0] != '') : ?>
                    <ol>
                        <?php foreach ($arrayObat as $item) : ?>
                            <li><?= $item; ?></li>
                        <?php endforeach ?>
                    </ol>
                <?php endif; ?>
            </td>
        </tr>

        <tr>
            <td></td>
            <td colspan="2" style="text-align:right;">Kefamenanu <?= date('Y-m-d'); ?></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2" style="text-align:right;"><img src="data:image/jpeg;base64,<?= base64_encode($signature); ?>" alt="Signature" height="100px"></td>
        </tr>
        <br>
        <tr style="align-items: left;">
            <td></td>
            <td colspan="1" style="text-align:right;"><?= $nama_dokter; ?></td>
        </tr>
    </table>
</body>

</html>