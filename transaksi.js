let totalHarga = 0;
let totalUnit = 0;
let cart = [];

document.addEventListener("click", function (e) {

    if (!e.target.classList.contains("plus") &&
        !e.target.classList.contains("minus")) return;

    const card = e.target.closest(".produk-card");
    const id = card.dataset.id;
    const price = parseInt(card.dataset.price);
    const name = card.querySelector(".product-name").innerText;
    const qtySpan = card.querySelector(".qty span");

    let qty = parseInt(qtySpan.innerText);

    // PLUS
    if (e.target.classList.contains("plus")) {

        qty++;
        qtySpan.innerText = qty;

        totalHarga += price;
        totalUnit++;

        let item = cart.find(p => p.id === id);

        if (item) {
            item.qty++;
            item.subtotal += price;
        } else {
            cart.push({
                id: id,
                name: name,
                harga: price,
                qty: 1,
                subtotal: price
            });
        }
    }

    // MINUS
    if (e.target.classList.contains("minus") && qty > 0) {

        qty--;
        qtySpan.innerText = qty;

        totalHarga -= price;
        totalUnit--;

        let item = cart.find(p => p.id === id);

        if (item) {
            item.qty--;
            item.subtotal -= price;

            if (item.qty === 0) {
                cart = cart.filter(p => p.id !== id);
            }
        }
    }

    updateTotal();
});

// UPDATE TOTAL
function updateTotal() {

    const totalBox = document.getElementById("totalBayar");

    if (totalUnit === 0) {
        totalBox.style.display = "none";
        return;
    }

    totalBox.style.display = "block";

    document.getElementById("totalHarga").innerText =
        "Rp " + totalHarga.toLocaleString("id-ID");

    document.getElementById("totalUnit").innerText =
        totalUnit + " item";

    document.getElementById("dataProduk").value = JSON.stringify(cart);
    document.getElementById("inputTotalHarga").value = totalHarga;
    document.getElementById("inputTotalUnit").value = totalUnit;
}

// SEARCH PRODUK
function searchProduct() {
    let keyword = document.getElementById("search").value.toLowerCase();

    document.querySelectorAll(".produk-card").forEach(card => {
        let name = card.querySelector(".product-name").innerText.toLowerCase();
        card.style.display = name.includes(keyword) ? "block" : "none";
    });
}