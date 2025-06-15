  function updatePaymentAmount(amount) {
    const hargaInput = document.getElementById("harga_terpilih");
    if (hargaInput) {
      hargaInput.value = amount;
    }

    // Opsional: Menandai pilihan yang sedang aktif secara visual
    const allButtons = document.querySelectorAll('.price');
    allButtons.forEach(btn => btn.classList.remove('active'));

    // Tambah class "active" ke tombol yang dipilih (untuk styling)
    event.target.classList.add('active');
  }

function updatePaymentAmount(harga, paket) {
    document.getElementById('harga_terpilih').value = harga;
    document.getElementById('paket_terpilih').value = paket;

    const formattedHarga = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(harga);

    document.getElementById('total-bayar').textContent = 'Total Bayar : ' + formattedHarga;
}

function selectPayment(event) {
  if (event.target.tagName === 'SPAN') {
    const metode = event.target.innerText;
    document.getElementById("metode_pembayaran").value = metode;
  }
}
