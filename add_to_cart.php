<?php
session_start();
require_once "config.php"; // Koneksi MongoDB

// Periksa apakah data produk dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id']; // ID produk dari form
    $quantity = (int)$_POST['quantity']; // Jumlah yang diminta

    // Validasi input
    if (empty($productId) || $quantity <= 0) {
        echo json_encode(["status" => "error", "message" => "Produk atau jumlah tidak valid."]);
        exit;
    }

    // Ambil detail produk dari database
    $product = $db->products->findOne(['_id' => new MongoDB\BSON\ObjectId($productId)]);

    if (!$product) {
        echo json_encode(["status" => "error", "message" => "Produk tidak ditemukan."]);
        exit;
    }

    // Format data produk yang akan dimasukkan ke keranjang
    $cartItem = [
        'product_id' => (string)$product['_id'],
        'name' => $product['name'],
        'price' => (int)$product['price'],
        'quantity' => $quantity,
        'subtotal' => $quantity * (int)$product['price'],
    ];

    // Simpan ke sesi sebagai keranjang belanja
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Cek apakah produk sudah ada di keranjang
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] === $cartItem['product_id']) {
            $item['quantity'] += $quantity;
            $item['subtotal'] = $item['quantity'] * $item['price'];
            $found = true;
            break;
        }
    }
    unset($item); // Lepaskan referensi variabel

    // Jika produk belum ada di keranjang, tambahkan baru
    if (!$found) {
        $_SESSION['cart'][] = $cartItem;
    }

    echo json_encode(["status" => "success", "message" => "Produk berhasil ditambahkan ke keranjang."]);
    exit;
}

// Jika tidak ada data POST, tampilkan error
echo json_encode(["status" => "error", "message" => "Akses tidak valid."]);
exit;
?>
