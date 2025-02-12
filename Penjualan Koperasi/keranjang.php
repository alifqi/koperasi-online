<?php
require 'koneksi.php';

// Query SELECT produk
$keranjang = query("
    SELECT * FROM keranjang
");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['hapus'])) {
      $id_produk = $_POST['id_produk'];
      if (hapusKeranjang($id_produk)) {
          echo "<script>alert('Produk berhasil dihapus dari keranjang!'); window.location.href='keranjang.php';</script>";
      } else {
          echo "<script>alert('Gagal menghapus produk dari keranjang.');</script>";
      }
  } elseif (isset($_POST['edit'])) {
      if (editKeranjang($_POST)) {
          echo "<script>alert('Produk berhasil diperbarui!'); window.location.href='keranjang.php';</script>";
      } else {
          echo "<script>alert('Gagal memperbarui produk.');</script>";
      }
  }
}

// Ambil data keranjang untuk ditampilkan
$keranjang = query("SELECT * FROM keranjang");

// Ambil data keranjang untuk ditampilkan
$keranjang = query("SELECT * FROM keranjang");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Keranjang</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
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
    <section class="daftar-produk">
      <h2>Daftar Pembelian</h2>
      <div class="produk-container">
        </div>
    </section>
    <section id="tabel-keranjang">
        <table id="daftar-belanja">
            <thead>
              <tr>
                <th>No</th>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Jumlah Produk</th>
                <th>Total Harga</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1; // Inisialisasi nomor
                foreach ($keranjang as $krjg): 
                ?>
                <tr>
                    <td><?= $no++; ?></td> <!-- Auto-increment -->
                    <td><?= $krjg["id_produk"]; ?></td>
                    <td><?= $krjg["nama_produk"]; ?></td>
                    <td><?= $krjg["jumlah_produk"]; ?></td>
                    <td><?= $krjg["total_harga"]; ?></td>
                    <td style="display: flex; align-items: center; gap: 5px;">
                      <form method="POST" action="keranjang.php" style="display: flex; align-items: center; gap: 5px;">
                          <input type="hidden" name="id_produk" value="<?= $krjg['id_produk']; ?>">
                          <input type="number" name="jumlah_produk" value="<?= $krjg['jumlah_produk']; ?>" min="1" style="width: 50px; text-align: center;">
                          <button type="submit" name="edit" class="btn-edit">Edit</button>
                      </form>
                      <form method="POST" action="keranjang.php" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                          <input type="hidden" name="id_produk" value="<?= $krjg['id_produk']; ?>">
                          <button type="submit" name="hapus" class="btn-hapus">Hapus</button>
                      </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 keysaval</p>
  </footer>

  <script src="js/script.js"></script>
</body>
</html>