@extends('layouts.app')
@section('content')

{{-- Auto responds when deleting/updating/adding information --}}
@if (session('status_success'))
<p style="color: green"><b>{{ session('status_success') }}</b></p>
@else
<p style="color: red"><b>{{ session('status_error') }}</b></p>
@endif

    @foreach ($projects as $project)
        <h1>{{ $project['title'] }}</h1>
        <p>{{ $project['text'] }}</p>
        <p style="font-size: 10px">Comment count: {{ count($project->comments) }} 
            | <a href="{{ route('projects.show', $project['id']) }}">View project details and comment on it</a>
            | Author: {{ $project['user']['name'] }} , {{ $project['user']['email'] }}</p>
   {{-- Hide buttons if the user is not logged in  --}}
   @if (auth()->check())
   <div class="btn-group" style="overflow: auto">

    @if (auth()->user()->id === $project['user_id'])

    <form style='float: left;' action="{{ route('projects.destroy', $project['id']) }}" method="POST">
        @method('DELETE') @csrf
        <input class="btn btn-danger"  type="submit" value="DELETE">
    </form>
@endif
       &nbsp;
       @if (auth()->user()->id === $project['user_id'])

       <form style='float: left;' action="{{ route('projects.show', $project['id']) }}" method="GET">
           <input class="btn btn-primary" type="submit" value="UPDATE">
       </form>
       @endif
   </div>
@endif

    

    @endforeach
    @if (auth()->check())
    <form method="POST" action="/projects">
        @csrf

        {{-- Validacijos kodas dedamas virs label --}}
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="title">Project title:</label><br>
        <input type="text" id="title" name="title"><br>

        @error('text')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="text">Project text:</label><br>
        <input type="text" id="text" name="text"><br><br>

        @error('credit_count')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="credit_count">Credit count:</label><br>
        <input type="text" id="credit_count" name="credit_count"><br><br>

        <input class="btn btn-primary" type="submit" value="Submit">
    </form>
    @endif
@endsection
