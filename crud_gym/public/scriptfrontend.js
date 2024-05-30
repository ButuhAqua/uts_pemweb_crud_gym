document.getElementById('registrationForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent form submission

    // Get form values
    const nama = document.getElementById('nama').value;
    const tempat = document.getElementById('tempat').value;
    const tanggal_lahir = document.getElementById('tanggal_lahir').value;
    const jenis_kelamin = document.getElementById('jenis_kelamin').value;
    const nomor = document.getElementById('nomor').value;

    // Simulate form submission and display success message
    const messageDiv = document.getElementById('message');
    messageDiv.innerHTML = `Terima kasih ${nama}, registrasi Anda telah berhasil!`;
});