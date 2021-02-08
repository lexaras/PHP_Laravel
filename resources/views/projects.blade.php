@extends('layouts.app')
@section('content')
 {{-- Validation error, for invalid incoming data display logic --}}
 {{-- @if ($errors->any())
 <div>
     @foreach ($errors->all() as $error)
         <p style="color: red">{{ $error }}</p>
     @endforeach
 </div>
@endif --}}

    @foreach ($projects as $project)
        <h1>{{ $project['title'] }}</h1>
        <p>{{ $project['text'] }}</p>
        <p style="font-size: 10px">Comment count: {{ count($project->comments) }} 
            | <a href="{{ route('projects.show', $project['id']) }}">View post details and comment on it</a></p>
   {{-- Hide buttons if the user is not logged in  --}}
   @if (auth()->check())
   <div class="btn-group" style="overflow: auto">
       <form style='float: left;' action="{{ route('projects.destroy', $project['id']) }}" method="POST">
           @method('DELETE') @csrf
           <input class="btn btn-danger" type="submit" value="DELETE"> 
       </form>
       &nbsp;
       <form style='float: left;' action="{{ route('projects.show', $project['id']) }}" method="GET">
           <input class="btn btn-primary" type="submit" value="UPDATE">
       </form>
   </div>
@endif

    

    @endforeach
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

@endsection
