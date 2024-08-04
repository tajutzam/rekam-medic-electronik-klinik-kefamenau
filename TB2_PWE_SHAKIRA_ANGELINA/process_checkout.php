<?php
$servername = "localhost";
$username = "root"; // username database Anda
$password = ""; // password database Anda
$dbname = "kpop_store";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan data dari form
$email = $_POST['email'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$total_payment = $_POST['total_bayar'];
$courier = $_POST['courier'];
$shipping_fee = $_POST['ongkos_kirim'];
$payment = $_POST['payment'];
$credit_card_number = isset($_POST['credit_card_number']) ? $_POST['credit_card_number'] : "";

// Menyimpan data ke database menggunakan prepared statements
$stmt = $conn->prepare("INSERT INTO checkout (email, name, phone, address, total_bayar, courier, ongkos_kirim, payment, credit_card_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $email, $name, $phone, $address, $total_payment, $courier, $shipping_fee, $payment, $credit_card_number);

if ($stmt->execute()) {
    echo "<script>
            localStorage.removeItem('cart');
            window.location.href = 'cekresi.php';
        </script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
