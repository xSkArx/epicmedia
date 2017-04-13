@extends('layouts.app')

@section('content')
    @if(!\Illuminate\Support\Facades\Session::get('empresa')->primera_descarga)
        @if(!\Illuminate\Support\Facades\Session::get('empresa')->vip)
            @include('app.note_block')
        @endif
    @endif
@endsection
