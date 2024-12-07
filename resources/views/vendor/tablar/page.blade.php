@extends('tablar::master')

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
