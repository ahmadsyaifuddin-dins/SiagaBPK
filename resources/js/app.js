import './bootstrap';

import Alpine from 'alpinejs';
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";

window.Alpine = Alpine;

Alpine.start();

// format waktu sekarang
flatpickr("#waktu_kejadian", {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    defaultDate: new Date(),
});
