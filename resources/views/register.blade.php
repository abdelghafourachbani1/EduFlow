@extends('layouts.app')

@section('content')

<h2>Register</h2>

<form id="registerForm">
    <input type="text" id="name" placeholder="Name" required><br>
    <input type="email" id="email" placeholder="Email" required><br>
    <input type="password" id="password" placeholder="Password" required><br>

    <select id="role">
        <option value="student">Student</option>
        <option value="teacher">Teacher</option>
    </select><br>

    <button type="submit">Register</button>
</form>

@endsection
