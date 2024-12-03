function TinhTien(button, change) {
    const quantityInput = button.parentElement.querySelector('input[type="number"]');
    let currentQuantity = parseInt(quantityInput.value);
    currentQuantity += change;

    if (currentQuantity < 1) {
        currentQuantity = 1;
    }

    quantityInput.value = currentQuantity;

function updateGrandTotal() {
    const itemTotals = document.querySelectorAll('.item-total');
    let grandTotal = 0;

    itemTotals.forEach(item => {
        const price = parseInt(item.innerText.replace(/[^0-9]/g, ''));
        grandTotal += price;
    });

    document.getElementById('grandTotal').innerText = grandTotal.toLocaleString() + ' VNĐ';
}

// --------- CARD --------------
document.getElementById('order').addEventListener('submit', function (event) {
    const checkboxes = document.querySelectorAll('input[name="checked_products[]"]');
    checkboxes.forEach((checkbox) => {
        if (!checkbox.checked) {
            checkbox.parentElement.removeChild(checkbox); // Loại bỏ checkbox không được chọn
        }
    });
});

}

