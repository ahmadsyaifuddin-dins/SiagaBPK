import './bootstrap';

import Alpine from 'alpinejs';
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import Swal from 'sweetalert2';

window.Alpine = Alpine;

Alpine.start();

// format waktu sekarang
flatpickr("#waktu_kejadian", {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    defaultDate: new Date(),
});

// 1. Konfigurasi Global Toast Notifikasi (Untuk Sukses/Error)
window.showToast = (icon, title) => {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    Toast.fire({
        icon: icon,
        title: title
    });
};

// 2. Konfigurasi Global Konfirmasi Hapus Data (Reusable)
window.confirmDelete = (event, formElement, message = 'Data yang dihapus tidak dapat dikembalikan!') => {
    event.preventDefault(); // Hentikan form submit langsung
    
    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444', // red-500
        cancelButtonColor: '#6b7280', // gray-500
        confirmButtonText: '<i class="fa-solid fa-trash-can mr-2"></i> Ya, Hapus!',
        cancelButtonText: '<i class="fa-solid fa-xmark mr-2"></i> Batal',
        reverseButtons: true, // Tombol batal di kiri
        customClass: {
            confirmButton: 'rounded-lg',
            cancelButton: 'rounded-lg'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            formElement.submit(); // Lanjutkan submit jika user klik 'Ya'
        }
    });
};