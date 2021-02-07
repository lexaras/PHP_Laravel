@extends('layouts.master')
@section('content')


@if (session('status_success'))
     <p style="color: green"><b>{{ session('status_success') }}</b></p>
    @else
     <p style="color: red"><b>{{ session('status_error') }}</b></p>
    @endif
@if ($errors->any())
<div>
    @foreach ($errors->all() as $error)
        <p style="color: red">{{ $error }}</p>
    @endforeach
</div>
@endif
<form action="{{ route('projects.update', $project['id']) }}" method="POST">
    @method('PUT') @csrf 
    <input type="text" name="title" value="{{ $project['title'] }}"><br>
    <input type="text" name="text" value="{{ $project['text'] }}"><br>
    <input type="text" name="credit_count" value="{{ $project['credit_count'] }}"><br>
    <input class="btn btn-primary" type="submit" value="UPDATE">
</form>
<p style="font-size: 10px; margin-top: 15px">Comments: </p>
@foreach ($project->comments as $comment)
    <p style="font-size: 10px">{{ $comment['text'] }}</p>
@endforeach
<form action="{{ route('projects.comments.store', $project['id']) }}" method="POST">
    @csrf
    <input type="text" name="text"><br>
    <input class="btn btn-primary" type="submit" value="ADD COMMENT">
</form>

@endsection
