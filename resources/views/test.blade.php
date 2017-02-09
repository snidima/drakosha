@extends('layouts/main')

@section('content')

    <div class="container">
        <h2>wg</h2>
        <div id="app">
            <login-form action="{{route('login')}}"></login-form>
        </div>
    </div>

@endsection