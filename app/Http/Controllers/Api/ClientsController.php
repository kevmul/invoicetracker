<?php

namespace App\Http\Controllers\Api;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;

class ClientsController extends Controller
{
    public function index()
    {
        $clients = Client::with('projects', 'projects.payments')->get();

        return response()->json([
            'clients' => $clients
        ]);
    }

    public function getClient($id)
    {
        return response()->json([
            'client' => Client::where('id', $id)
                            ->with('projects', 'prodject.payments')
                            ->first()
        ]);
    }

    public function store(ClientRequest $request)
    {
        $client = Client::create([
            'name' => request('name'),
            'email' => request('email'),
            'phone' => request('phone'),
        ]);
        // dd($request->all());
        return response()->json([
            'message' => 'success',
            'client' => $client
        ]);
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json([
            'message' => "{$client->name} deleted"
        ]);
    }
}
