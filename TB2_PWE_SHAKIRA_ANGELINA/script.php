<?php
echo '<script>
document.addEventListener("DOMContentLoaded", function() {
    let navbar = document.querySelector(".navbar");
    document.querySelector("#menu-bar").onclick = function() {
        navbar.classList.toggle("active");
    };

    let search = document.querySelector(".search");
    document.querySelector("#search").onclick = function() {
        search.classList.toggle("active");
    };

    let cartDropdown = document.querySelector("#shopping-cart");
    document.querySelector("#cart-btn").onclick = function() {
        cartDropdown.classList.toggle("active");
    };

    var swiper = new Swiper(".popular-row", {
        spaceBetween: 30,
        loop: true,
        centeredSlides: true,
        autoplay: {
            delay: 9500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 1,
            },
            1024: {
                slidesPerView: 1,
            },
        },
    });

    var swiper = new Swiper(".product-row", {
        spaceBetween: 30,
        loop: true,
        centeredSlides: true,
        autoplay: {
            delay: 9500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });

    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    function calculateTotalPrice() {
        let totalPrice = 0;
        cart.forEach(item => {
            totalPrice += item.price * item.quantity;
        });
        return totalPrice;
    }

    function decreaseItem(index) {
        cart[index].quantity -= 1;
        if (cart[index].quantity === 0) {
            cart.splice(index, 1);
        }
        localStorage.setItem("cart", JSON.stringify(cart));
        renderCart();
    }

    function removeItem(index) {
        cart.splice(index, 1);
        localStorage.setItem("cart", JSON.stringify(cart));
        renderCart();
        updateCartCount();
    }

    function renderCart() {
        const cartElement = document.getElementById("cart");
        cartElement.innerHTML = "";
        cart.forEach((item, index) => {
            const itemElement = document.createElement("div");
            itemElement.classList.add("cart-item");

            const itemImage = document.createElement("img");
            itemImage.src = `images/product${index + 1}.png`;
            itemElement.appendChild(itemImage);

            const itemInfo = document.createElement("div");
            itemInfo.innerHTML = `<h4 style="margin-right: 20px;">${item.name}</h4>
                                  <p style="margin-left: 10px;">Rp. ${item.price}</p>`;
            itemElement.appendChild(itemInfo);

            const buttonContainer = document.createElement("div");
            buttonContainer.style.display = "flex";
            buttonContainer.style.alignItems = "center";

            const addButton = document.createElement("button");
            addButton.style.fontSize = "30px";
            addButton.textContent = "+";
            addButton.onclick = () => addItem(item.name, item.price);
            buttonContainer.appendChild(addButton);

            const quantity = document.createElement("p");
            quantity.style.margin = "0 15px";
            quantity.textContent = item.quantity;
            buttonContainer.appendChild(quantity);

            const decreaseButton = document.createElement("button");
            decreaseButton.style.fontSize = "30px";
            decreaseButton.textContent = "-";
            decreaseButton.onclick = () => decreaseItem(index);
            buttonContainer.appendChild(decreaseButton);

            const removeButton = document.createElement("button");
            removeButton.style.fontSize = "20px";
            removeButton.textContent = "🗑️";
            removeButton.onclick = () => removeItem(index);
            buttonContainer.appendChild(removeButton);

            itemElement.appendChild(buttonContainer);
            cartElement.appendChild(itemElement);
        });

        const totalPrice = calculateTotalPrice();
        document.getElementById("total-price").innerText = `Total Price: Rp. ${totalPrice}`;
    }

    function addItem(name, price) {
        const itemIndex = cart.findIndex(item => item.name === name);
        if (itemIndex !== -1) {
            cart[itemIndex].quantity += 1;
        } else {
            cart.push({ name, price, quantity: 1 });
        }
        localStorage.setItem("cart", JSON.stringify(cart));
        renderCart();
        updateCartCount();
    }

    function updateCartCount() {
        const cartCountElement = document.getElementById("cart-count");
        cartCountElement.innerText = cart.length;
    }

    document.querySelector(".co-btn").addEventListener("click", function() {
        alert("Order diterima, Ayo segera lengkapi data pesananmu");
    });

    renderCart();
    updateCartCount();

    const logo = document.querySelector(".logo img");
    if (logo) {
        logo.classList.add("animate-logo");
    }

    document.getElementById("checkout-form").addEventListener("submit", function(event) {
        event.preventDefault();
        var email = document.getElementById("email").value;
        var name = document.getElementById("name").value;
        var phone = document.getElementById("phone").value;
        var address = document.getElementById("address").value;
        var courier = document.getElementById("courier").value;
        var payment = document.getElementById("payment").value;
        var creditCardField = document.getElementById("credit-card-field");
        var creditCardNumber = creditCardField ? document.getElementById("credit-card-number").value : "";

        if (email.trim() === "" || name.trim() === "" || phone.trim() === "" || address.trim() === "" || courier.trim() === "" || payment.trim() === "") {
            alert("Isi data terlebih dahulu ya.");
            return;
        }

        if (payment === "KartuKredit" && creditCardNumber.length !== 10) {
            alert("Nomor kartu kredit harus 10 digit.");
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "process_checkout.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("responseMessage").innerHTML = xhr.responseText;
                document.getElementById("responseMessage").style.display = "block";

                const orderDetails = `<p><strong>Email :</strong> ${email}</p>
                                     <p><strong>Nama   :</strong> ${name}</p>
                                     <p><strong>No. HP :</strong> ${phone}</p>
                                     <p><strong>Alamat :</strong> ${address}</p>
                                     <p><strong>Metode Pembayaran:</strong> ${document.getElementById("payment").options[document.getElementById("payment").selectedIndex].text}</p>`;
                document.getElementById("summary").innerHTML = orderDetails;

                document.getElementById("checkout-container").style.display = "none";
                document.getElementById("summary").style.display = "block";
            }
        };

        var formData = `email=${email}&name=${name}&phone=${phone}&address=${address}&courier=${courier}&payment=${payment}&credit_card_number=${creditCardNumber}`;
        xhr.send(formData);
    });

    document.getElementById("payment").addEventListener("change", toggleCreditCardField);

    function toggleCreditCardField() {
        var paymentMethod = document.getElementById("payment").value;
        var creditCardField = document.getElementById("credit-card-field");
        if (paymentMethod === "KartuKredit") {
            creditCardField.style.display = "block";
        } else {
            creditCardField.style.display = "none";
        }
    }

    var totalBelanja = 850000;
    var totalBerat = 1.5;

    function calculateTotal() {
        var serviceFee = 5000;
        var shippingFee = 0;

        if (totalBelanja < 850000) {
            if (totalBerat <= 1) {
                shippingFee = 10000;
            } else if (totalBerat <= 2.5) {
                shippingFee = 25000;
            } else if (totalBerat >= 3 && totalBerat <= 5) {
                shippingFee = 50000;
            }
        }

        var totalPrice = totalBelanja + serviceFee + shippingFee;

        document.getElementById("total-price-summary").innerText = "Rp." + totalBelanja.toLocaleString();
        document.getElementById("service-fee").innerText = "Rp." + serviceFee.toLocaleString();
        document.getElementById("shipping-fee").innerText = "Rp." + shippingFee.toLocaleString();
        document.getElementById("total-payment").innerText = "Rp." + totalPrice.toLocaleString();
    }

    calculateTotal();
});


</script>';
