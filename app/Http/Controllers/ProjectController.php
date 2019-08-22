<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function create($id)
    {
        return view('project.create')->withClientId($id);
    }

    public function show($client_id, $project_id)
    {
        $project = Project::where('id', $project_id)
            ->with(['payments' => function($query) {
                $query->orderBy('created_at', 'ASC');
            }])
            ->first();

        return view('project.show')->withProject($project);
    }

    public function store(Request $request, $client_id)
    {
        $amount = request('dollar_amount') * 100 + request('cent_amount');
        Project::create([
            'title' => request('title'),
            'client_id' => $client_id,
            'amount' => $amount,
        ]);

        return redirect("/client/{$client_id}");
    }

    public function destroy($client_id, $project_id)
    {
        (Project::findOrFail($project_id))->delete();

        return redirect("/client/{$client_id}");
    }
}
