@extends('layouts.app')

@section('content')

<h2>Register</h2>

<form id="registerForm">
    <input type="text" id="name" placeholder="Name"><br>
    <input type="email" id="email" placeholder="Email"><br>
    <input type="password" id="password" placeholder="Password"><br>

    <select  id="role">
        <option value="student">student</option>
        <option value="teacher">teacher</option>
    </select><br>

    <button type="submit">Register</button>

</form>

@endsection