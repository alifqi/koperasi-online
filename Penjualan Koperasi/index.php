<?php
require 'koneksi.php';

// Query SELECT produk
$produk = query("
    SELECT * FROM produk
");

// Proses jika tombol "Beli" diklik
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah_keranjang'])) {
  if (tambahKeranjang($_POST)) {
      echo "<script>alert('Produk berhasil ditambahkan ke keranjang!');</script>";
  } else {
      echo "<script>alert('Gagal menambahkan produk ke keranjang.');</script>";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Koperasi Online</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Koperasi Online SMA N 12</h1>
    <nav>
      <ul>
        <li><a href="index.php">Beranda</a></li>
        <li><a href="produk.php">Produk</a></li>
        <li><a href="keranjang.php">Keranjang</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="produk">
        <h2>Produk Unggulan</h2>
        <div class="daftar-produk home">
            <?php 
            $produk_terbatas = array_slice($produk, 0, 3); // Ambil hanya 3 produk pertama
            foreach ($produk_terbatas as $prdk): 
            ?>
                <div class="produk-item">
                    <img src="images/<?= $prdk["gambar_produk"]; ?>" alt="<?= $prdk["nama_produk"]; ?>">
                    <h3><?= $prdk["nama_produk"]; ?></h3>
                    <div class="harga-dan-tombol">
                        <span class="harga">Rp <?= number_format($prdk["harga_produk"], 0, ',', '.'); ?></span>
                        <form method="POST" action="">
                            <input type="hidden" name="id_produk" value="<?= $prdk["id"]; ?>">
                            <input type="hidden" name="nama_produk" value="<?= $prdk["nama_produk"]; ?>">
                            <input type="hidden" name="harga_produk" value="<?= $prdk["harga_produk"]; ?>">
                            <button type="submit" name="tambah_keranjang">Beli</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
  <footer>
    <p>&copy; 2025 keysaval</p>
  </footer>

  <script src="script.js"></script>

</body>
</html>