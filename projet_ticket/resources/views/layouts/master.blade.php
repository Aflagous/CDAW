@extends('layouts.app')

@section('page')
        @include('layouts.partials.header')

    <div>
        @yield('content')
    </div>
@endsection
