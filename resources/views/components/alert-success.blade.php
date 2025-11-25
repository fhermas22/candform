@if(session('success'))
    <div id="alert-success" class="fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg">
        ✓ {{ session('success') }}
    </div>
    <script>
        setTimeout(
            () => document.getElementById('alert-success')?.remove(), 4000
        );
    </script>
@endif
