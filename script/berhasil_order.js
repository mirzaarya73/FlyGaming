function order() {
	alert("Order telah berhasil!");
}

 document.addEventListener('DOMContentLoaded', function () {
  const metodeInput = document.getElementById('metode_pembayaran');
  const paketInput = document.getElementById('paket_terpilih');
  const paymentList = document.getElementById('paymentList');

  paymentList.addEventListener('click', function (e) {
    const target = e.target.closest('.grid-item');
    if (target) {
      document.querySelectorAll('.grid-item').forEach(item => item.classList.remove('active'));
      target.classList.add('active');
      metodeInput.value = target.dataset.metode;
    }
  });

  window.validateForm = function () {
    if (!metodeInput.value) {
      alert("Silakan pilih metode pembayaran!");
      return false;
    }
    if (!paketInput.value) {
      alert("Silakan pilih paket!");
      return false;
    }
    return true;
  };
});
