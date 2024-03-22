@extends('layouts.app')

@section('page')
    @include('layouts.partials.header')
    @include('layouts.conversations.chat')
    <div class="">
        @yield('content')
    </div>
    

@endsection
