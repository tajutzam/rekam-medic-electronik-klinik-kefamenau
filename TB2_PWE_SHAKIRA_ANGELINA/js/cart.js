let cartDropdown = document.querySelector('#shopping-cart');
document.querySelector('#cart-btn').onclick = () => {
    cartDropdown.classList.toggle('active');
};

let cart = JSON.parse(localStorage.getItem("cart")) || [];

function calculateTotalPrice() {
    let totalPrice = 0;
    cart.forEach(item => {
        totalPrice += item.price * item.quantity;
    });
    return totalPrice;
}

function calculateTotalWeight() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let totalWeight = 0;
    cart.forEach(item => {
        totalWeight += item.weight * item.quantity;
    });
    return totalWeight;
}

function updateCartCount() {
    const cartCountElement = document.getElementById("cart-count");
    cartCountElement.innerText = cart.length;
}

function renderCart() {
    const cartElement = document.getElementById("cart");
    cartElement.innerHTML = "";
    cart.forEach((item, index) => {
        const itemElement = document.createElement("div");
        itemElement.classList.add("cart-item");

        const itemImage = document.createElement("img");
        itemImage.src = item.imageUrl;
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
        addButton.onclick = () => addItem(item.name, item.price, item.stock, item.imageUrl, item.weight);
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
        removeButton.textContent = "🗑";
        removeButton.onclick = () => removeItem(index);
        buttonContainer.appendChild(removeButton);

        itemElement.appendChild(buttonContainer);
        cartElement.appendChild(itemElement);
    });

    const totalPrice = calculateTotalPrice();
    document.getElementById("total-price").innerText = `Total Price: Rp. ${totalPrice}`;
}

function addItem(name, price, stock, imageUrl, weight) {
    const itemIndex = cart.findIndex(item => item.name === name);
    const productId = imageUrl.match(/product(\d+)\.png/)[1]; // Ekstraksi ID produk dari URL gambar

    if (itemIndex !== -1) {
        if (cart[itemIndex].quantity < stock) {
            cart[itemIndex].quantity += 1;
        } else {
            alert("Stock is not sufficient");
        }
    } else {
        cart.push({ productId, name, price: parseInt(price), quantity: 1, stock: parseInt(stock), imageUrl, weight: parseFloat(weight) });
    }
    localStorage.setItem("cart", JSON.stringify(cart));
    renderCart();
    updateCartCount();
}

function checkOut() {
    if (cart.length === 0) {
        alert('Keranjang harus memiliki minimal 1 barang.');
    } else {
        window.location.href = 'checkout.php';
    }
}

function decreaseItem(index) {
    cart[index].quantity -= 1;
    if (cart[index].quantity === 0) {
        cart.splice(index, 1);
    }
    localStorage.setItem("cart", JSON.stringify(cart));
    renderCart();
    updateCartCount();
}

function removeItem(index) {
    cart.splice(index, 1);
    localStorage.setItem("cart", JSON.stringify(cart));
    renderCart();
    updateCartCount();
}

document.addEventListener('DOMContentLoaded', () => {
    renderCart();
    updateCartCount();
});

