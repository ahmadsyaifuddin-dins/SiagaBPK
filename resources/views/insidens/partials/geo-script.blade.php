<script>
    function getLocation() {
        const latInput = document.getElementById('latitude');
        const lngInput = document.getElementById('longitude');
        const statusText = document.getElementById('geo-status');
        const btnIcon = document.getElementById('gps-icon');

        if (!navigator.geolocation) {
            statusText.innerHTML =
                "<span class='text-red-500 font-bold'>Browser Anda tidak mendukung Geolocation.</span>";
            return;
        }

        statusText.innerHTML =
            "<span class='text-blue-500 font-bold'>Mencari koordinat lokasi... <i class='fa-solid fa-spinner fa-spin'></i></span>";
        btnIcon.classList.replace('fa-location-crosshairs', 'fa-spinner');
        btnIcon.classList.add('fa-spin');

        navigator.geolocation.getCurrentPosition(
            (position) => {
                // Berhasil dapat kordinat
                latInput.value = position.coords.latitude;
                lngInput.value = position.coords.longitude;
                statusText.innerHTML =
                    "<span class='text-green-600 dark:text-green-400 font-bold'><i class='fa-solid fa-check'></i> Koordinat GPS berhasil diamankan!</span>";
                btnIcon.classList.replace('fa-spinner', 'fa-location-crosshairs');
                btnIcon.classList.remove('fa-spin');
            },
            (error) => {
                // Gagal (Ditolak user atau tidak ada sinyal)
                let msg = "Gagal mendeteksi lokasi.";
                if (error.code == 1) msg =
                    "Izin akses lokasi ditolak oleh Anda. Mohon izinkan (Allow) popup di atas.";
                else if (error.code == 2) msg = "Posisi tidak tersedia / sinyal GPS lemah.";
                else if (error.code == 3) msg = "Waktu pencarian lokasi habis (Timeout).";

                statusText.innerHTML =
                    `<span class='text-red-500 dark:text-red-400 font-bold'><i class='fa-solid fa-triangle-exclamation'></i> ${msg}</span>`;
                btnIcon.classList.replace('fa-spinner', 'fa-location-crosshairs');
                btnIcon.classList.remove('fa-spin');
            }, {
                enableHighAccuracy: true,
                timeout: 15000,
                maximumAge: 0
            }
        );
    }
</script>
