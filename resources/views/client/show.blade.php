@extends('layout.master')

@section('content')
    <div class="container">
        <h1>{{$client->name}}</h1>
        <table class="table">
            <tr>
                <th>Project Name</th>
                <th>Project Price</th>
                <th>Remaining Blance</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($client->projects as $project)
                <tr>
                    <td>{{$project->title}}</td>
                    <td>{{$project->formatted_price}}</td>
                    <td>{{$project->formatted_amount_remaining}}</td>
                    <td><a href="{{route('project.show', [$client->id,$project->id])}}">View</a></td>
                    <td>
                        <form action="{{route('project.destroy', [$client->id, $project->id])}}" method="POST">
                            {{csrf_field()}}
                            @method('DELETE')
                            <button class="button is-danger" type="submit">DELETE</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        <a class="button is-primary" href="{{route('project.create', [$client->id])}}">New</a>
    </div>
@endsection
