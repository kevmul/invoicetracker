<?php

namespace App\Http\Controllers;

use App\Client;
use App\Project;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('projects')->get();

        return view('client.index')->withClients($clients);
    }

    public function create()
    {
        return view('client.create');
    }

    public function store(Request $request)
    {
        Client::create([
            'name' => request('name'),
            'email' => request('email'),
            'phone' => request('phone'),
        ]);
        return redirect('/client/');
    }

    public function show($id)
    {
        $client = Client::where('id', $id)->with('projects')->first();

        return view('client.show')->withClient($client);
    }

    public function destroy($id)
    {
        (Client::find($id))->delete();

        return redirect('/client');
    }
}
