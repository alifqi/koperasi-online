<?php
$host = 'localhost';
$dbname = 'koperasi';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

//Menampilkan values table
function query($query)
{
    global $conn;

    // Eksekusi query
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Ambil semua hasil
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Tambah Keranjang
function tambahKeranjang($data)
{
    global $conn;
    $id_produk = htmlspecialchars($data["id_produk"]);
    $nama_produk = htmlspecialchars($data["nama_produk"]);
    $harga_produk = htmlspecialchars($data["harga_produk"]); // Harga per satuan produk
    $jumlah_produk = 1; // Default jumlah jika pertama kali ditambahkan
    $total_harga = $harga_produk; // Total harga awal (harga satuan)

    try {
        // Cek apakah produk sudah ada di keranjang
        $stmt = $conn->prepare("SELECT jumlah_produk, total_harga FROM keranjang WHERE id_produk = :id_produk");
        $stmt->bindParam(':id_produk', $id_produk);
        $stmt->execute();
        $existingProduct = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingProduct) {
            // Jika produk sudah ada, update jumlah dan total harga
            $new_jumlah = $existingProduct['jumlah_produk'] + 1;
            $new_total_harga = $existingProduct['total_harga'] + $harga_produk;

            $stmt = $conn->prepare("UPDATE keranjang SET jumlah_produk = :jumlah_produk, total_harga = :total_harga WHERE id_produk = :id_produk");
            $stmt->bindParam(':jumlah_produk', $new_jumlah);
            $stmt->bindParam(':total_harga', $new_total_harga);
            $stmt->bindParam(':id_produk', $id_produk);
        } else {
            // Jika produk belum ada, insert baru
            $stmt = $conn->prepare("INSERT INTO keranjang (id_produk, nama_produk, jumlah_produk, total_harga) VALUES (:id_produk, :nama_produk, :jumlah_produk, :total_harga)");
            $stmt->bindParam(':id_produk', $id_produk);
            $stmt->bindParam(':nama_produk', $nama_produk);
            $stmt->bindParam(':jumlah_produk', $jumlah_produk);
            $stmt->bindParam(':total_harga', $total_harga);
        }

        return $stmt->execute();
    } catch (PDOException $e) {
        die("Gagal menambahkan ke keranjang: " . $e->getMessage());
    }
}

// Edit produk dari keranjang
function editKeranjang($data)
{
    global $conn;
    $id_produk = htmlspecialchars($data["id_produk"]);
    $jumlah_produk = htmlspecialchars($data["jumlah_produk"]);

    try {
        // Ambil harga satuan dari produk di keranjang
        $stmt = $conn->prepare("SELECT total_harga, jumlah_produk FROM keranjang WHERE id_produk = :id_produk");
        $stmt->bindParam(':id_produk', $id_produk);
        $stmt->execute();
        $existingProduct = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingProduct) {
            $harga_satuan = $existingProduct['total_harga'] / $existingProduct['jumlah_produk'];
            $total_harga = $harga_satuan * $jumlah_produk;

            // Update jumlah dan total harga
            $stmt = $conn->prepare("UPDATE keranjang SET jumlah_produk = :jumlah_produk, total_harga = :total_harga WHERE id_produk = :id_produk");
            $stmt->bindParam(':jumlah_produk', $jumlah_produk);
            $stmt->bindParam(':total_harga', $total_harga);
            $stmt->bindParam(':id_produk', $id_produk);
            return $stmt->execute();
        }
        return false;
    } catch (PDOException $e) {
        die("Gagal mengedit keranjang: " . $e->getMessage());
    }
}

// Hapus produk dari keranjang
function hapusKeranjang($id_produk)
{
    global $conn;

    try {
        $stmt = $conn->prepare("DELETE FROM keranjang WHERE id_produk = :id_produk");
        $stmt->bindParam(':id_produk', $id_produk);
        return $stmt->execute();
    } catch (PDOException $e) {
        die("Gagal menghapus produk dari keranjang: " . $e->getMessage());
    }
}
?>