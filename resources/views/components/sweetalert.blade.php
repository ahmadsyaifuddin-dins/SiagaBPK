@if (session('success'))
    <script type="module">
        // type="module" memastikan script berjalan setelah app.js selesai di-load oleh Vite
        window.showToast('success', "{!! session('success') !!}");
    </script>
@endif

@if (session('error'))
    <script type="module">
        window.showToast('error', "{!! session('error') !!}");
    </script>
@endif

@if (session('warning'))
    <script type="module">
        window.showToast('warning', "{!! session('warning') !!}");
    </script>
@endif

@if (session('info'))
    <script type="module">
        window.showToast('info', "{!! session('info') !!}");
    </script>
@endif
