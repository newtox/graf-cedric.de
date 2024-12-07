@extends('tablar::page')

@section('title', __('about.title'))

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">{{ __('about.title') }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('storage/images/Profile.png') }}"
                                 alt="Profile"
                                 class="img-fluid rounded mb-3"
                                 style="max-width: 300px;">
                        </div>
                        <div class="col-md-8">
                            {!! nl2br(e(__('about.content'))) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
