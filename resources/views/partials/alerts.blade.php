@if(session('success') || session('error'))
    <div id="flash-alert" style="position: fixed; top: 80px; left: 50%; transform: translateX(-50%); z-index: 1050; min-width: 350px; max-width: 500px; transition: opacity 0.5s ease; opacity: 1;" class="shadow-lg">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible mb-0">
                <div class="d-flex align-items-center">
                    <div><i class="ti ti-check icon me-2"></i></div>
                    <div>{{ session('success') }}</div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible mb-0">
                <div class="d-flex align-items-center">
                    <div><i class="ti ti-alert-circle icon me-2"></i></div>
                    <div>{{ session('error') }}</div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif
    </div>

    <script>
        setTimeout(() => {
            const alertBox = document.getElementById('flash-alert');
            if (alertBox) {
                alertBox.style.opacity = '0';
                setTimeout(() => alertBox.remove(), 500);
            }
        }, 4000);
    </script>
@endif