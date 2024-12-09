<form action="process_register.php" method="POST">
    <label for="name">Nama:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <label for="confirm_password">Konfirmasi Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required>

    <label for="phone">Nomor Telepon:</label>
    <input type="tel" id="phone" name="phone" required>

    <label for="address">Alamat:</label>
    <textarea id="address" name="address" required></textarea>

    <button type="submit">Daftar</button>
</form>
