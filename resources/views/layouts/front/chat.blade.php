@extends('layouts.front.app')
@section('meta-description')
@endsection
@section('title')
Magaxat | Chat
@endsection
@section('styles')
<link rel="stylesheet" href="{{ asset('css/chat.css?version=33') }}"/>
@endsection
@section('content')
<div id="root"></div>
@if(Auth::check())
<script src="{{ asset('js/app.js') }}"></script>
@endif
@endsection