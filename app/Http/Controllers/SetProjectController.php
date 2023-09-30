<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class SetProjectController extends Controller
{
    public function create(Request $request)
    {
        if (!session('client_id')) {
            return redirect()->route('set-client.create');
        }

        $clientID = $request->session()->get('client_id');
        
        $projects = Project::whereHas('userProject', function ($query) use ($clientID) {
            $query->where('User_ID', auth()->id())->where('Client_ID', $clientID);
        })
        ->pluck('Project_Name', 'Project_ID')
        ->prepend('Please select', '')
        ->all();

        return view('setup.set-project', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
        ]);

        $request->session()->put('project_id', $request->get('project_id'));

        return redirect()->route('action');
    }
}
