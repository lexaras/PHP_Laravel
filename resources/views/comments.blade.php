@extends('layouts.app')
@section('content')
@if (session('status_success'))
<p style="color: green"><b>{{ session('status_success') }}</b></p>
@else
<p style="color: red"><b>{{ session('status_error') }}</b></p>
@endif
    @if (count($comments)===0)
        <h1>No comments yet</h1>
    @endif
    @foreach ($comments as $comment)   
    @if (auth()->user()->name === 'admin') 
    <form style='float: left;' action="{{ route('comments.destroy', $comment['id']) }}" method="POST">
        @method('DELETE') @csrf
        <input class="btn btn-danger"  type="submit" value="DELETE">
    </form>
    @endif
    <p>
        <p class="font-weight-bold">"{{ $comment['project']['title'] }}"
        {{ $comment['text'] }} </p>
        {{ $comment['created_at'] }}
    </p>
   
    @endforeach
@endsection