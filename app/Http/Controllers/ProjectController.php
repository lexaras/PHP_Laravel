<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Gate;

class ProjectController extends Controller
{
    // MODEL::all() → SELECT ALL ROWS
    public function index()
    {
        return view('projects', ['projects' => \App\Models\Project::all()]);
    }
    public function show($id)
    {
        return view('project', ['project' => \App\Models\Project::find($id)]);
    }
    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required|unique:projects,title|max:10',
            'credit_count' => 'required',
            'text' => 'required',
        ]);
        $bp = new \App\Models\Project();
        $bp->title = $request['title'];
        $bp->credit_count = $request['credit_count'];
        $bp->text = $request['text'];
        $bp->user_id = auth()->user()->id; // Trying to get property 'id' of non-object
        return ($bp->save() !== 1) ? 
            redirect('/projects')->with('status_success', 'Project created!') : 
            redirect('/projects')->with('status_error', 'Project was not created!');
    }

    public function destroy($id){
        if(Gate::denies('delete-project', \App\Models\Project::find($id))) // useris paduodamas automatiškai!!!
            return redirect()->back()->with('status_error', 'You can\'t delete this post!');
        \App\Models\Project::destroy($id);
        return redirect('/projects')->with('status_success', 'Post deleted!');
    }


    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:projects,title,' . $id . ',id|max:10',
            'credit_count' => 'required',
            'text' => 'required',
        ]);
        $bp = \App\Models\Project::find($id);
        $bp->title = $request['title'];
        $bp->text = $request['text'];
        $bp->credit_count = $request['credit_count'];
        return ($bp->save() !== 1) ?
            redirect('/projects/' . $id)->with('status_success', 'Project updated!') :
            redirect('/projects/' . $id)->with('status_error', 'Project was not updated!');
    }
    public function storeProjectComment($id, Request $request){
        $this->validate($request, ['text' => 'required']);
        $bp = \App\Models\Project::find($id);
        $cm = new \App\Models\Comment();
        $cm->text = $request['text'];
        $bp->comments()->save($cm); 
        return redirect()->back()->with('status_success', 'Comment added!');
    }

}
