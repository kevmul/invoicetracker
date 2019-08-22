<?php

namespace App\Http\Controllers\Api;

use App\Client;
use App\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;

class ClientProjectsController extends Controller
{
    public function store(ProjectRequest $request, Client $client)
    {
        $project = Project::create([
            'title' => request('title'),
            'client_id' => $client->id,
            'amount' => request('amount') * 100,
        ]);

        // This just gives us an empty array for Payments we need for Vue
        $project->payments = [];

        return response()->json([
            'message' => 'success',
            'project' => $project
        ]);
    }
}
