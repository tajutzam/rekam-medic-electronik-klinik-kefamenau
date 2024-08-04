<?php
// Membuat koneksi
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "kpop_store";
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Variabel untuk menyimpan hasil pencarian
$result = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];
    $stmt = $conn->prepare("SELECT name, email, address FROM checkout WHERE phone = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Resi - Merch Kpop Store</title>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./style2.css">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        .header .navbar2 a {
            font-size: 2rem;
            margin-right: 3rem;
            color: var(--blue);
            font-weight: bold;
        }

        .header .navbar2 a:hover {
            border-bottom: .1rem solid var(--blue);
            padding-bottom: .4rem;
        }

        .cekresi-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 7%;
            min-height: calc(100vh - 100px);
        }

        .cekresi-container h2 {
            font-size: 3rem;
            font-weight: bolder;
            color: var(--blue);
            margin-bottom: 1rem;
            text-align: center;
        }

        .cekresi-container p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .cekresi-container form {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 500px;
        }

        .cekresi-container input[type="text"] {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .cekresi-container button[type="submit"] {
            padding: 0.8rem 2rem;
            background-color: var(--blue);
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .cekresi-container button[type="submit"]:hover {
            background-color: darkblue;
        }

        .result-container {
            width: 100%;
            max-width: 500px;
            padding: 2rem;
            background-color: var(--white);
            border-radius: 0.5rem;
            box-shadow: var(--box-shadow);
            margin-top: 2rem;
            text-align: left;
        }

        .result-container h3 {
            font-size: 2.5rem;
            color: var(--blue);
            margin-bottom: 1rem;
        }

        .result-container p {
            text-align: left;
            font-size: 1.5rem;
            margin: 0.5rem 0;
        }

        .result-container p span {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="logoContent">
            <a href="./cekresi.php" class="logo"><img src="images/logo.png" alt="Logo"></a>
            <h1 class="logoName">Merch Kpop</h1>
        </div>
        <nav class="navbar2">
            <a href="./tampilanutama.php">home</a>
        </nav>
    </header>

    <section class="cekresi-container">
        <h2>Cek Resi</h2>
        <p>Silakan masukkan nomor HP untuk mengecek resi:</p>
        <form method="POST" action="">
            <input type="text" name="phone" placeholder="Masukkan nomor HP" required>
            <button type="submit">Cek Resi</button>
        </form>

        <div class="result-container">
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<h3>Detail Pesanan</h3>";
                    echo "<p><span>Nama:</span> " . $row['name'] . "</p>";
                    echo "<p><span>Email:</span> " . $row['email'] . "</p>";
                    echo "<p><span>Alamat:</span> " . $row['address'] . "</p>";
                }
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo "<p>Tidak ada pesanan dengan nomor HP tersebut.</p>";
            }
            ?>
        </div>
    </section>

    <!-- Custom JS -->
    <script src=""></script>

</body>

</html>