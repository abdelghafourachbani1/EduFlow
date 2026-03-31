@extends('layouts.app')

@section('content')

<h2>Courses</h2>

<input type="text" id="search" placeholder="Search courses...">

<div id="courseContainer"></div>

<h3>Create Course</h3>

<form id="createCourseForm">
    <input placeholder="Totle" id ="Title"><br>
    <input placeholder="description" id="Description"><br>
    <input placeholder="Price" id ="Price">

    <button type="submit">create</button>
</form>

@endsection