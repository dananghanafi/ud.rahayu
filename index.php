<?php
require_once "config.php";

// Ambil data produk dari koleksi "products"
$products = $db->products->find()->toArray();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD. Rahayu</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <h1>Selamat Datang di UD. Rahayu</h1>
        <nav>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
            <a href="cart.php">Keranjang</a>
        </nav>
    </header>

    <main>
        <h2>Katalog Produk</h2>
        <div class="product-list">
            <?php foreach ($products as $product): ?>
                <div class="product-item">
                    <img src="<?= $product['image_url'] ?>" alt="<?= $product['name'] ?>" class="product-image">
                    <h3><?= $product['name'] ?></h3>
                    <p><?= $product['description'] ?></p>
                    <p>Rp<?= number_format($product['price'], 0, ',', '.') ?></p>
                    <form action="add_to_cart.php" method="POST">
                        <input type="hidden" name="product_id" value="<?= $product['_id'] ?>">
                        <input type="number" name="quantity" min="1" value="1" required>
                        <button type="submit">Tambah ke Keranjang</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 UD. Rahayu - Semua Hak Dilindungi</p>
    </footer>
</body>
</html>
