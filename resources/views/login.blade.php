@extends('layouts.app')

@section('content')

<h2>Login</h2>

<form id="loginForm">
    <input type="email" id="email" placeholder="Email"><br>
    <input type="password" id="password" placeholder="Password"><br>
    
    <button type="submit">Login</button>
</form>
@endsection