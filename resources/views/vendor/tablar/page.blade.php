@extends('tablar::master')

@section('tablar_css')
    <link rel="icon" type="image/png" href="{{ asset('storage/images/Profile.png') }}">
    @stack('css')
    @yield('css')
@stop

@inject('layoutHelper', 'TakiElias\Tablar\Helpers\LayoutHelper')

@section('tablar_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body')
    <div class="page">
        @include('tablar::partials.navbar.condensed-top')
        <div class="page-wrapper">
            @include('partials.alerts')
            @yield('content')
            @include('tablar::partials.footer.bottom')
        </div>
    </div>
@stop

@section('tablar_js')
    @stack('js')
    @yield('js')
@stop
