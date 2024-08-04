<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merch Kpop Store</title>

    <!-- swiper link  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- cdn icon link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file  -->
    <link rel="stylesheet" href="./style2.css">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
    <header class="header">
        <div class="logoContent">
            <a href="./tampilanutama.php" class="logo"><img src="images/logo.png" alt=""></a>
            <h1 class="logoName">Merch Kpop</h1>
        </div>
        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#aboutus">about us</a>
            <a href="#popular">popular</a>
            <a href="#product">product</a>
            <a href="#contact">contact</a>
            <a href="./cekresi.php">receipt</a>
        </nav>
        <div class="icon">
            <i class="fas fa-search" id="search"></i>
            <i class="fas fa-bars" id="menu-bar"></i>
            <i class="fas fa-shopping-cart" id="cart-btn"><span id="cart-count">0</span></i>
        </div>
        <div class="search">
            <input type="search" placeholder="search...">
        </div>
        <div id="shopping-cart" class="shopping-cart">
            <h2>My Cart</h2>
            <div id="cart">
                <div class="cart-item"></div>
            </div>
            <hr style="width: 100%; height: 5px; background-color: rgb(0, 0, 0);">
            <h3 id="total-price">Total Price: Rp.0</h3>
            <div><button class="co-btn" onclick="checkOut()">Checkout</button></div>
        </div>
    </header>
    <section class="home" id="home">
        <div class="homeContent">
            <h2>안녕하세요</h2>
            <h2>친구</h2>
            <p>Grab your wishlist here chingu. fast, trusted, originality product, and money back guarantee</p>
            <div class="home-btn">
                <a href="#"><button>see more</button></a>
            </div>
        </div>
    </section>
    <section class="aboutus" id="aboutus">
        <div class="aboutusContent">
            <h2>Berikut adalah tentang kami</h2>
            <p>Merch Kpop didirikan pada tahun [2022] merupakan toko yang menyediakan merch kpop baik original ataupun fanmade. kami menjamin ke-originalitas produk karena kami membeli langsung baik di web resmi, store resmi, dan pop-up store dengan harga yang terjangkau, karena kami first hand dan memiliki warehouse sendiri. Kami juga menyediakan fitur dp minimal 50% ataupun tabungan.</p>
            <div class="aboutus-btn">
                <a href="#"><button>learn more</button></a>
            </div>
        </div>
    </section>
    <section class="popular" id="popular">
        <div class="swiper popular-row">
            <div class="swiper-wrapper">
                <div class="swiper-slide box">
                    <div class="img">
                        <img src="images/blog-img2.png" alt="">
                    </div>
                    <div class="content">
                        <h3>Card Holder Akrilik</h3>
                        <p>siapa yang bingung mau bawa photocard pakai apa? Takut rusak kalau ditaruh dompet bukan? Disini kamu bisa menemukan cardholder berbahan dasar akrilik yang sangat kokoh dan tidak membuat photocard kalian rusak. Dengan lengkungan di tiap sudut sehingga sangat fit dan tidak merusak atau menekuk tiap sudut photocard kalian.</p>
                        <p>Ayo kepoin macam-macam design cardholder berbahan akrilik dengan klik disini...</p>
                        <a href="#popular" class="btn">learn more</a>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <div class="img">
                        <img src="images/blog-img3.png" alt="">
                    </div>
                    <div class="content">
                        <h3>Card Holder PVC</h3>
                        <p>Siapa yang tak asing dengan cardholder yang satu ini? Design dan warna yang beragam dan menarik. Sayangnya cardholder ini beresiko tinggi merusak photocard kalian loh karena bahannya yang lentur sekali.</p>
                        <p>Kami menyediakan beberapa cardholder official dari beberapa group dengan bahan PVC loh, yuk kepoin group apa saja yang tersedia disini...</p>
                        <a href="#popular" class="btn">learn more</a>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <section class="product" id="product">
        <div class="heading">
            <h2>Our Exclusive Products</h2>
        </div>
        <div class="swiper product-row">
            <div class="swiper-wrapper">
                <div class="swiper-slide box" id="product1" data-product-id="1" data-image-url="images/product1.png" data-weight="1.5">
                    <div class="img">
                        <img src="images/product1.png" alt="">
                    </div>
                    <div class="product-content">
                        <h3>LightStick Ofc Treasure</h3>
                        <p>Harga: 700.000</p>
                        <p>Berat: 1.5 Kg</p>
                        <p>Stok: 10</p>
                        <div class="orderNow">
                            <button onclick="addItem('LightStick Ofc Treasure','700000', '10', 'images/product1.png', '1.5')">Add To Cart</button>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide box" id="product2" data-product-id="2" data-image-url="images/product2.png" data-weight="0.5">
                    <div class="img">
                        <img src="images/product2.png" alt="">
                    </div>
                    <div class="product-content">
                        <h3>Collection Book 2P PVC</h3>
                        <p>Harga: 30.000</p>
                        <p>Berat: 0.5 Kg</p>
                        <p>Stok: 5</p>
                        <div class="orderNow">
                            <button onclick="addItem('Collection Book 2P PVC','30000', '10', 'images/product2.png', '0.5')">Add To Cart</button>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide box" id="product3" data-product-id="3" data-image-url="images/product3.png" data-weight="0.5">
                    <div class="img">
                        <img src="images/product3.png" alt="">
                    </div>
                    <div class="product-content">
                        <h3>Collection Book Daiso</h3>
                        <p>Harga: 50.000</p>
                        <p>Berat: 0.5 Kg</p>
                        <p>Stok: 10</p>
                        <div class="orderNow">
                            <button onclick="addItem('Collection Book Daiso','50000', '10', 'images/product3.png', '0.5')">Add To Cart</button>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide box" id="product4" data-product-id="4" data-image-url="images/product4.png" data-weight="2.5">
                    <div class="img">
                        <img src="images/product4.png" alt="">
                    </div>
                    <div class="product-content">
                        <h3>Treasure Reboot Album</h3>
                        <p>Harga: 150.000/Version</p>
                        <p>Berat: 2.5 Kg</p>
                        <p>Stok: 12</p>
                        <div class="orderNow">
                            <select id="treasure-version">
                                <option value="Black">Black</option>
                                <option value="White">White</option>
                                <option value="Grey">Grey</option>
                            </select>
                            <button onclick="addItem('Treasure Reboot Album','150000', '10', 'images/product4.png', '2.5')">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="swiper product-row">
            <div class="swiper-wrapper">
                <div class="swiper-slide box" id="product5" data-product-id="5" data-image-url="images/product5.png" data-weight="1.5">
                    <div class="img">
                        <img src="images/product5.png" alt="">
                    </div>
                    <div class="product-content">
                        <h3>Blackpink Album HYLT</h3>
                        <p>Harga: 200.000/Version</p>
                        <p>Berat: 1.5 Kg</p>
                        <p>Stok: 10</p>
                        <div class="orderNow">
                            <select id="blackpink-version">
                                <option value="Black">Black</option>
                                <option value="Pink">Pink</option>
                            </select>
                            <button onclick="addItem('Blackpink Album HYLT','200000', '10', 'images/product5.png', '1.5')">Add To Cart</button>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide box" id="product6" data-product-id="6" data-image-url="images/product6.png" data-weight="1.25">
                    <div class="img">
                        <img src="images/product6.png" alt="">
                    </div>
                    <div class="product-content">
                        <h3>LightStick Blackpink V2</h3>
                        <p>Harga: 750.000</p>
                        <p>Berat: 1.25 Kg</p>
                        <p>Stok: 10</p>
                        <div class="orderNow">
                            <button onclick="addItem('LightStick Blackpink V2','750000', '10', 'images/product6.png', '1.25')">Add To Cart</button>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide box" id="product7" data-product-id="7" data-image-url="images/product7.png" data-weight="2">
                    <div class="img">
                        <img src="images/product7.png" alt="">
                    </div>
                    <div class="product-content">
                        <h3>New Jeans BBB Album</h3>
                        <p>Harga: 230.000/Version</p>
                        <p>Berat: 2 Kg</p>
                        <p>Stok: 10</p>
                        <div class="orderNow">
                            <select id="new_jeans-version">
                                <option value="Blue">Blue</option>
                                <option value="Black">Black</option>
                                <option value="Pink">Pink</option>
                            </select>
                            <button onclick="addItem('New Jeans BBB Album','230000', '10', 'images/product7.png', '2')">Add To Cart</button>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide box" id="product8" data-product-id="8" data-image-url="images/product8.png" data-weight="0.5">
                    <div class="img">
                        <img src="images/product8.png" alt="">
                    </div>
                    <div class="product-content">
                        <h3>Custom Card Holder Akrilik</h3>
                        <p>Harga: 75.000</p>
                        <p>Berat: 0.5 Kg</p>
                        <p>Stok: 15</p>
                        <div class="orderNow">
                            <button onclick="addItem('Custom Card Holder Akrilik','75000', '10', 'images/product8.png', '0.5')">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <footer class="footer" id="contact">
        <div class="box-container">
            <div class="mainBox">
                <div class="content">
                    <h1 class="logoName">Merch Kpop</h1>
                </div>
                <p>Find and Grab Your Wishlist with Us</p>
                <p>Fast, Trusted, First Hand, Original</p>
            </div>
            <div class="box">
                <h3>Contact Info</h3>
                <a href="#"> <i class="fas fa-phone"></i>+62 896 6118 7120</a>
                <a href="#"> <i class="fas fa-envelope"></i>kirashkr130103@gmail.com</a>
            </div>
        </div>
        <div class="share">
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-whatsapp"></a>
            <a href="#" class="fab fa-instagram"></a>
        </div>
    </footer>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/cart.js"></script>
    <script src="js/checkout.js"></script>

</body>

</html>