@extends('layouts.master')

@section('content')
   <div class="w-full flex flex-col gap-5 justify-center items-center">
        @foreach($points as $index => $point)
            <div class="flex flex-col gap-4">
                
                @if(auth()->user()->id == $point->joueur_id)
                    C'est vous : {{$point->points}}, vous etes {{$index + 1}}
                @else
                {{$point->points}}, {{$index + 1}}
                @endif
            </div>
        @endforeach
   </div>
@endsection


