// ============================================
// Sistem Pencatatan Order - JavaScript
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    // Konfirmasi hapus
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (!confirm('Yakin ingin menghapus order ini? Data tidak dapat dikembalikan.')) {
                e.preventDefault();
            }
        });
    });

    // Auto-hide flash messages setelah 5 detik
    const flash = document.querySelector('.flash');
    if (flash) {
        setTimeout(() => {
            flash.style.transition = 'opacity 0.5s ease';
            flash.style.opacity = '0';
            setTimeout(() => flash.remove(), 500);
        }, 5000);
    }

    // Format tanggal input ke today jika kosong (optional fitur)
    const today = new Date().toISOString().split('T')[0];
    const dateInputs = document.querySelectorAll('input[type="date"]');
    dateInputs.forEach(input => {
        if (!input.value) {
            input.value = today;
        }
    });
});