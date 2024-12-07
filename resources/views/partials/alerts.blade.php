@if(session('success'))
    <div class="alert alert-success alert-dismissible">
        <div class="d-flex">
            <div><i class="ti ti-check icon"></i></div>
            <div>{{ session('success') }}</div>
        </div>
        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible">
        <div class="d-flex">
            <div><i class="ti ti-alert-circle icon"></i></div>
            <div>{{ session('error') }}</div>
        </div>
        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
@endif
