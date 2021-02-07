<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:projects,title|max:10',
            'text' => 'required',
            'credit_count' => 'required',
        ]);
        $pb = new \App\Models\Project();
        $pb->title = $request['title'];
        $pb->credit_count = $request['credit_count'];
        $pb->text = $request['text'];
        return ($pb->save() !== 1) ?
            redirect('/projects')->with('status_success', 'Project created!') :
            redirect('/projects')->with('status_error', 'Project was not created!');
     }
    public function destroy($id)
    {
        \App\Models\Project::destroy($id);
        return redirect('/projects')->with('status_success', 'Project deleted!');
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
