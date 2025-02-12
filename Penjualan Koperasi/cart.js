const dataProduk = [
    {
        nama: "dasi",
        gambar: "images/dasi.jpg",
        harga: 20000,
        keterangan: "Dasi berkualitas tinggi, cocok untuk acara formal maupun santai."
      },
      {
        nama: "topi",
        gambar: "images/topi.jpg",
        harga: 20000,
        keterangan: "Topi trendy dan nyaman, melindungi Anda dari panas dan debu."
      }, 
  ];
  
  const cart = JSON.parse(localStorage.getItem('cart')) || []; // Ambil data dari local storage atau buat array kosong
  
  // ... kode untuk menampilkan produk di daftar produk ...
  
  tombolBeli.forEach(tombol => {
    tombol.addEventListener('click', () => {
      const produkItem = tombol.parentElement;
      const namaProduk = produkItem.querySelector('h3').textContent;
      const hargaProduk = produkItem.querySelector('.harga').textContent;
  
      const produk = {
        nama: namaProduk,
        harga: hargaProduk
      };
  
      cart.push(produk); // Tambahkan produk ke keranjang
  
      tampilkanKeranjang(); // Tampilkan produk di tabel keranjang
    });
  });
  
  function tampilkanKeranjang() {
    const daftarBelanja = document.getElementById('daftar-belanja').querySelector('tbody');
    daftarBelanja.innerHTML = ''; // Kosongkan tabel sebelum menampilkan data baru
  
    cart.forEach(produk => {
      const barisBaru = daftarBelanja.insertRow();
      const namaSel = barisBaru.insertCell();
      const hargaSel = barisBaru.insertCell();
      const keteranganSel = barisBaru.insertCell();
  
      namaSel.textContent = produk.nama;
      hargaSel.textContent = produk.harga;
      keteranganSel.textContent = ''; // Keterangan dikosongkan
    });
  }

  tampilkanKeranjang(); // Tampilkan data keranjang saat halaman dimuat