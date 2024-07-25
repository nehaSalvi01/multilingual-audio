@extends('layout.master')
@section('content')
    <div class="welcome-text text-center">
        <h1>Welcome</h1>
        <p class="lead">This is a simple application to demonstrate audio file uploads </p>
        <a href="{{route('audio.create')}}" class="btn btn-primary">Upload Audio File</a>
    </div>
@endsection
