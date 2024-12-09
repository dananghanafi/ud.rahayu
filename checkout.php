<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simulasi pembayaran berhasil
    echo "Pembayaran berhasil! Pesanan sedang diproses.";
    unset($_SESSION['cart']); // Kosongkan keranjang
} else {
    echo "<h1>Checkout</h1>";
    echo "<form method='POST'>";
    echo "<p>Total Bayar: Rp" . array_sum(array_column($_SESSION['cart'], 'subtotal')) . "</p>";
    echo "<button type='submit'>Bayar</button>";
    echo "</form>";
}
