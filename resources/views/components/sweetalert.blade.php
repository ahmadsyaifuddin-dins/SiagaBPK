@if (session('success'))
    <script type="module">
        window.showToast('success', "{!! session('success') !!}");
    </script>
@endif

@if (session('error'))
    <script type="module">
        window.showToast('error', "{!! session('error') !!}");
    </script>
@endif

@if ($errors->any())
    <script type="module">
        let errorList = '';
        @foreach ($errors->all() as $error)
            errorList += '<li class="mb-1">{{ $error }}</li>';
        @endforeach

        // Gunakan window.Swal di sini
        window.Swal.fire({
            icon: 'error',
            title: 'Oops! Validasi Gagal',
            html: '<ul class="text-left text-sm text-red-600 bg-red-50 p-4 rounded-xl list-disc list-inside">' +
                errorList + '</ul>',
            confirmButtonColor: '#ef4444',
            confirmButtonText: '<i class="fa-solid fa-check mr-2"></i> Mengerti',
            customClass: {
                popup: 'rounded-2xl',
                confirmButton: 'rounded-xl px-6 py-2.5 font-semibold shadow-md'
            }
        });
    </script>
@endif
