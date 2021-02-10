<?php

namespace App\Http\Controllers;
use Gate;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return view('comments', ['comments' => \App\Models\Comment::all()]);
    }
    public function destroy($id){
        \App\Models\Comment::destroy($id);
        return redirect('/comments')->with('status_success', 'Comment deleted!');
    }
}
