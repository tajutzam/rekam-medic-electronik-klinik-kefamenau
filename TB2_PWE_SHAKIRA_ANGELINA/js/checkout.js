function togglePaymentOptions() {
    var paymentMethod = document.getElementById("payment").value;
    document.getElementById("bank-options").style.display = "none";
    document.getElementById("ewallet-options").style.display = "none";
    document.getElementById("credit-card-field").style.display = "none";

    if (paymentMethod === "bank") {
        document.getElementById("bank-options").style.display = "block";
    } else if (paymentMethod === "ewallet") {
        document.getElementById("ewallet-options").style.display = "block";
    } else if (paymentMethod === "KartuKredit") {
        document.getElementById("credit-card-field").style.display = "block";
    }
}

function validateForm() {
    // Form validation logic if needed
}

function updateShippingFee() {
    const courier = document.getElementById('courier').value;
    let shippingFee = 0;
    const totalWeight = parseFloat(document.getElementById('total-weight').innerText.replace('Kg ', '')) || 0;
    const totalPrice = parseFloat(document.getElementById('total-price-summary').innerText.replace('Rp.', '')) || 0;

    if (totalWeight >= 0 && totalWeight <= 1) {
        switch (courier) {
            case 'JNE':
            case 'J&T':
            case 'Tiki':
            case 'SiCepat':
                shippingFee = 10000;
                break;
        }
    } else if (totalWeight >= 1.1 && totalWeight <= 2) {
        switch (courier) {
            case 'JNE':
            case 'J&T':
            case 'Tiki':
            case 'SiCepat':
                shippingFee = 17000;
                break;
        }
    } else if (totalWeight >= 2.1) {
        switch (courier) {
            case 'Cargo':
                shippingFee = 20000;
                break;
        }
    }

    if (totalPrice > 750000 && totalWeight <= 2) {
        switch (courier) {
            case 'JNE':
            case 'J&T':
            case 'Tiki':
            case 'SiCepat':
                shippingFee = 0;
                break;
        }
    } else if (totalPrice < 750000 && totalWeight > 2) {
        switch (courier) {
            case 'Cargo':
                shippingFee = 20000;
                break;
        }
    }

    document.getElementById('shipping-fee').innerText = `Rp.${shippingFee}`;
    updateTotalPayment();
}

function updateTotalPayment() {
    const totalPrice = parseInt(document.getElementById('total-price-summary').innerText.replace('Rp.', '')) || 0;
    const serviceFee = parseInt(document.getElementById('service-fee').innerText.replace('Rp.', '')) || 0;
    const shippingFee = parseInt(document.getElementById('shipping-fee').innerText.replace('Rp.', '')) || 0;
    const totalPayment = totalPrice + serviceFee + shippingFee;
    document.getElementById('total-payment').innerText = `Rp.${totalPayment}`;
}

function loadCartData() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    let totalPrice = 0;
    let totalWeight = 0;

    cart.forEach(item => {
        totalPrice += item.price * item.quantity;
        totalWeight += item.weight * item.quantity;
    });

    document.getElementById('total-price-summary').innerText = `Rp.${totalPrice}`;
    document.getElementById('total-weight').innerText = `${totalWeight} Kg`;
    updateTotalPayment();
}

document.addEventListener('DOMContentLoaded', loadCartData);
document.getElementById('courier').addEventListener('change', updateShippingFee);
