import './bootstrap';

import Alpine from 'alpinejs';
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import Swal from 'sweetalert2';

// 1. Daftarkan Alpine dan Swal ke Global Window agar bisa diakses dari Blade
window.Alpine = Alpine;
window.Swal = Swal;

Alpine.start();

// Format waktu sekarang
flatpickr("#waktu_kejadian", {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    defaultDate: new Date(),
});

// 2. Konfigurasi Global Toast Notifikasi
window.showToast = (icon, title) => {
    // Pastikan kita memanggil window.Swal sekarang
    const Toast = window.Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', window.Swal.stopTimer)
            toast.addEventListener('mouseleave', window.Swal.resumeTimer)
        }
    });

    Toast.fire({
        icon: icon,
        title: title
    });
};

// 3. Konfigurasi Global Konfirmasi Hapus Data
window.confirmDelete = (event, formElement, message = 'Data yang dihapus tidak dapat dikembalikan!') => {
    event.preventDefault(); 
    
    window.Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444', 
        cancelButtonColor: '#6b7280', 
        confirmButtonText: '<i class="fa-solid fa-trash-can mr-2"></i> Ya, Hapus!',
        cancelButtonText: '<i class="fa-solid fa-xmark mr-2"></i> Batal',
        reverseButtons: true, 
        customClass: {
            confirmButton: 'rounded-lg',
            cancelButton: 'rounded-lg'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            formElement.submit(); 
        }
    });
};