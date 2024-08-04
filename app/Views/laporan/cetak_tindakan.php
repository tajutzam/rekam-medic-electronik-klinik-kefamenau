<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top 10 Tindakan Terpopuler</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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

        .print-btn {
            display: block;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-align: center;
            border: none;
            cursor: pointer;
        }

        .print-btn:hover {
            background-color: #0056b3;
        }

        .tengah {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 class="tengah">Top 10 Tindakan Terpopuler</h1>
    <p class="tengah">Periode <?= $start_date; ?> - <?= $end_date; ?></p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode tindakan</th>
                <th>Nama Tindakan</th>
                <th>Jumlah Pelayanan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($topTindakan as $tindakan) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $tindakan['kode_tindakan']; ?></td>
                    <td><?= $tindakan['nama_tindakan']; ?></td>
                    <td><?= $tindakan['jumlah_pelayanan']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        // Optional: Automatically print when the page loads
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>