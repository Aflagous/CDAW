@extends('layouts.app')

@section('page')
    @if(Auth::check())
        @include('layouts.partials.header')
    @else
        @include('layouts.partials.header_admin')
    @endif

    <div class="">
        @yield('content')
    </div>
    

@endsection
