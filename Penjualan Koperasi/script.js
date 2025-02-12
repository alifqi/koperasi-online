// Fungsi untuk menambahkan produk ke keranjang
function tambahKeKeranjang(id, nama, harga) {
    let keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];

    keranjang.push({
        id: id,
        nama: nama,
        harga: harga,
        jumlah: 1 // Tambahkan properti jumlah, default 1
    });

    localStorage.setItem('keranjang', JSON.stringify(keranjang));
    alert(nama + " berhasil ditambahkan ke keranjang!");
}

// Ambil semua tombol "Beli"
const tombolBeli = document.querySelectorAll('.produk-item button');

tombolBeli.forEach(tombol => {
    tombol.addEventListener('click', () => {
        const produkItem = tombol.parentElement;
        const idProduk = produkItem.dataset.id;
        const namaProduk = produkItem.querySelector('h3').textContent;
        const hargaProduk = produkItem.querySelector('.harga').textContent;

        // Kirim data ke server untuk disimpan ke database
        fetch('simpan_ke_database.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id_produk=${idProduk}&nama_produk=${namaProduk}&harga_produk=${hargaProduk}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Tampilkan pesan dari server (misalnya, "Berhasil disimpan" atau pesan error)
        })
        .catch(error => console.error('Error:', error));
    });
});

// Fungsi untuk menampilkan data keranjang di tabel
function tampilkanKeranjang() {
    const keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];
    const tabelKeranjang = document.getElementById('tabel-keranjang').querySelector('tbody');

    if (tabelKeranjang) {
        tabelKeranjang.innerHTML = ''; // Kosongkan tabel sebelum diisi data baru

        keranjang.forEach(produk => {
            const barisBaru = tabelKeranjang.insertRow();
            const idSel = barisBaru.insertCell();
            const namaSel = barisBaru.insertCell();
            const hargaSel = barisBaru.insertCell();
            const jumlahSel = barisBaru.insertCell();
            const totalSel = barisBaru.insertCell();

            idSel.textContent = produk.id;
            namaSel.textContent = produk.nama;
            hargaSel.textContent = produk.harga;
            jumlahSel.textContent = produk.jumlah;
            totalSel.textContent = produk.harga * produk.jumlah;
        });
    } else {
        console.error("Tabel keranjang tidak ditemukan!");
        alert("Tabel keranjang tidak ditemukan!");
    }
}

// Panggil fungsi tampilkanKeranjang() saat halaman keranjang.html di load
document.addEventListener('DOMContentLoaded', () => {
    if (window.location.pathname.includes('keranjang.html')) {
        tampilkanKeranjang();
    }
});

// Data produk (contoh)
const dataProduk = [
    { id: 1, nama: "Dasi", harga: 20000 },
    { id: 2, nama: "Topi", harga: 20000 },
    { id: 3, nama: "Sabuk", harga: 30000 },
    { id: 4, nama: "Buku Fisika", harga: 45000 },
    { id: 5, nama: "Buku Ekonomi", harga: 45000 },
    { id: 6, nama: "Buku B.Indonesia", harga: 45000 },
    { id: 7, nama: "Buku Sosiologi", harga: 45000 },
    { id: 8, nama: "Buku Kimia", harga: 45000 },
    { id: 9, nama: "Buku B.Jawa", harga: 45000 },
    { id: 10, nama: "Buku Geografi", harga: 45000 },
    { id: 11, nama: "Buku Biologi", harga: 45000 },
    { id: 12, nama: "Buku B.Inggris", harga: 45000 }
];

// Tampilkan produk di halaman produk.html
if (window.location.pathname.includes('produk.html')) {
    const daftarProduk = document.querySelector('.daftar-produk');
    dataProduk.forEach(produk => {
        const produkItem = document.createElement('div');
        produkItem.classList.add('produk-item');
        produkItem.dataset.id = produk.id; // Tambahkan data-id
        produkItem.innerHTML = `
            <img src="images/${produk.nama.toLowerCase().replace(/ /g, '_')}.jpg" alt="${produk.nama}">
            <h3>${produk.nama}</h3>
            <div class="harga-dan-tombol">
                <span class="harga">Rp ${produk.harga}</span>
                <button>Beli</button>
            </div>
        `;
        daftarProduk.appendChild(produkItem);
    });
}