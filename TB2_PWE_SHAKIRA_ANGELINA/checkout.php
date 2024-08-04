<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Merch Kpop Store</title>

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
            margin-right: 8rem;
            color: var(--blue);
            font-weight: bold;
        }

        .header .navbar2 a:hover {
            border-bottom: .1rem solid var(--blue);
            padding-bottom: .4rem;
        }

        /* Styling tambahan untuk form */
        .checkout-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 7%;
            min-height: calc(100vh - 0px);
        }

        .checkout-container h2 {
            font-size: 3rem;
            font-weight: bolder;
            color: var(--blue);
            margin-bottom: 2rem;
            text-align: center;
        }

        #checkout-form .form-group label {
            font-size: 1.8rem;
            /* Ukuran label lebih besar */
            font-weight: bold;
            color: var(--blue);
        }

        #checkout-form .form-group input,
        #checkout-form .form-group select {
            width: 100%;
            padding: 0.5rem;
            font-size: 1.5rem;
            margin-top: 0.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--blue);
            border-radius: 0.5rem;
        }

        #checkout-form .form-group button {
            font-size: 1.8rem;
            background-color: var(--blue);
            color: var(--white);
            border-radius: 0.7rem;
            padding: 0.7rem 2.4rem;
            cursor: pointer;
            margin-top: 1rem;
        }

        #checkout-form .form-group button:hover {
            font-size: 2rem;
        }

        .summary {
            width: 100%;
            padding: 2rem;
            background-color: var(--white);
            border-radius: 0.5rem;
            box-shadow: var(--box-shadow);
            margin-top: 2rem;
            text-align: left;
        }

        .summary h3 {
            font-size: 2rem;
            font-weight: bolder;
            margin-bottom: 1rem;
            color: var(--blue);
        }

        .summary p {
            font-size: 1.5rem;
            color: var(--blue);
            margin-bottom: 0.5rem;
        }

        .summary span {
            font-weight: bold;
            color: var(--blue);
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="logoContent">
            <a href="./checkout.php" class="logo"><img src="images/logo.png" alt="Logo"></a>
            <h1 class="logoName">Merch Kpop</h1>
        </div>
        <nav class="navbar2">
            <a href="./tampilanutama.php">home</a>
        </nav>
        <div class="icon">
            <i class="fas fa-shopping-cart" id="cart-btn"><span id="cart-count">0</span></i>
        </div>
        <div id="shopping-cart" class="shopping-cart">
            <h2>My Cart</h2>
            <div id="cart">
                <div class="cart-item"></div>
            </div>
        </div>
    </header>

    <section class="checkout-container">
        <h2>Checkout</h2>
        <form id="checkout-form" action="process_checkout.php" method="POST">
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="phone">No. HP</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="address">Alamat</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="courier">Pilih Ekspedisi</label>
                <select id="courier" name="courier" required onchange="updateShippingFee()">
                    <option value="JNE">JNE</option>
                    <option value="J&T">J&T</option>
                    <option value="Tiki">Tiki</option>
                    <option value="SiCepat">SiCepat</option>
                    <option value="Cargo">Cargo</option>
                </select>
            </div>
            <div class="form-group">
                <label for="payment">Metode Pembayaran</label>
                <select id="payment" name="payment" required onchange="togglePaymentOptions()">
                    <option value="default">Pilih Metode Pembayaran</option>
                    <option value="bank">Transfer Bank</option>
                    <option value="ewallet">E-Wallet</option>
                    <option value="KartuKredit">Kartu Kredit</option>
                </select>
            </div>
            <div class="form-group" id="bank-options" style="display: none;">
                <label for="bank">Pilih Bank</label>
                <select id="bank" name="bank">
                    <option value="BCA">BCA</option>
                    <option value="BNI">BNI</option>
                    <option value="BRI">BRI</option>
                    <option value="Mandiri">Mandiri</option>
                    <option value="SeaBank">SeaBank</option>
                </select>
            </div>
            <div class="form-group" id="ewallet-options" style="display: none;">
                <label for="ewallet">Pilih E-Wallet</label>
                <select id="ewallet" name="ewallet">
                    <option value="Ovo">Ovo</option>
                    <option value="Gopay">Gopay</option>
                    <option value="ShopeePay">ShopeePay</option>
                </select>
            </div>
            <div class="form-group" id="credit-card-field" style="display: none;">
                <label for="credit-card-number">Nomor Kartu Kredit</label>
                <input type="text" id="credit-card-number" name="credit_card_number" minlength="10" maxlength="10">
            </div>
            <!-- Input hidden untuk total_bayar dan ongkos_kirim -->
            <input type="hidden" id="total_bayar" name="total_bayar">
            <input type="hidden" id="ongkos_kirim" name="ongkos_kirim">
            <div class="form-group">
                <button type="submit" onclick="validateForm()">Submit</button>
            </div>
        </form>
        <div id="responseMessage" style="display: none;"></div>
        <div class="summary">
            <h3>Summary</h3>
            <p>Total Harga Barang: <span id="total-price-summary">Rp.0</span></p>
            <p>Biaya Pelayanan: <span id="service-fee">Rp.5000</span></p>
            <p>Total Berat: <span id="total-weight"> 0 Kg</span></p>
            <p>Ongkos Kirim: <span id="shipping-fee">Rp.0</span></p>
            <p>Total yang Harus Dibayar: <span id="total-payment">Rp.0</span></p>
        </div>
    </section>

    <!-- Custom JS -->
    <script src="./js/cart.js"></script>
    <script src="./js/checkout.js"></script>

    <script>
        document.getElementById('checkout-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir
            alert('Pesananmu Sedang Kami Proses, Mohon Cek Email Secara Berkala Ya Chingu!');
            this.submit(); // Melanjutkan pengiriman formulir secara manual
        });
    </script>

</body>

</html>