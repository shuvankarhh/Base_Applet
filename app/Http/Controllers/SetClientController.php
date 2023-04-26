<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class SetClientController extends Controller
{
    public function create()
    {
        $clients = Client::with('company')
            ->get()
            ->pluck('company.Company_Name', 'Client_ID')
            ->prepend('Please select', '')
            ->all();

        return view('setup.set-client', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
        ]);

        $request->session()->put('client_id', $request->get('client_id'));

        $request->session()->forget('project_id');

        return redirect()->route('set-project.create');
    }
}
