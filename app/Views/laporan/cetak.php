<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapan Kunjungan Pelayanan Klinik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <h1>REKAPAN KUNJUNGAN PELAYANAN KLINIK</h1>
    <h3>Bulan : <?= $bulan; ?></h3>
    <h3>Tahun <?= $tahun; ?></h3>
    <table>
        <thead>
            <tr>
                <th rowspan="1">No</th>
                <th>Nama Kelurahan / Desa</th>
                <th style="text-align: center;" colspan="2">Jenis Kunjungan</th>
                <th>TOTAL</th>
                <th style="text-align:center;" colspan="2">Jenis Pelayanan</th>
                <th>Total Kunjungan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td>UMUM</td>
                <td>BPJS</td>
                <td></td>
                <td>Poli Umum</td>
                <td>Total</td>
            </tr>
            <?php $index = 1;
            $totalKeseluruhan  = 0 ?>
            <?php foreach ($data as $item) : ?>
                <tr>
                    <td>
                        <?= $index; ?>
                    </td>
                    <td>
                        <?= $item['desa']; ?>
                    </td>
                    <td>
                        <?= $item['total_umum']; ?>
                    </td>
                    <td>
                        <?= $item['total_bpjs']; ?>
                    </td>
                    <?php $total = $item['total_umum'] + $item['total_bpjs']; ?>
                    <?php $totalKeseluruhan += $total; ?>
                    <?php $totalKunjungan = 0; ?>
                    <td>
                        <?= $total; ?>
                    </td>
                    <td>
                        <?= $item['total_pelayanan']; ?>
                    </td>
                    <td>
                        <?= $total; ?>
                    </td>
                    <td>
                        <?= $item['total_pelayanan']; ?>
                        <?php $totalKunjungan += $item['total_pelayanan']; ?>
                    </td>
                </tr>
                <?php $index++; ?>
            <?php endforeach ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><?= $totalKeseluruhan; ?></td>
                <td></td>
                <td><?= $totalKeseluruhan; ?></td>
                <td><?= $totalKunjungan; ?></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <div class="mengetahui">
            <p>Mengetahui</p>
            <p>Kepala Klinik</p>
            <br>
            <p>Dr.Benhur Malelak</p><br>
        </div>
        <div class="mengetahui">
            <p>Kemeanu, <?= date('d, M'); ?></p>
            <p>Kepala Klinik</p>
            <br>
            <p>Dr.Benhur Malelak</p><br>
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>