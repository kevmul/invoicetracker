@extends('layout.master')

@section('content')
{{--     <div class="container">
        <h1>Todo</h1>
        <button
            class="button"
            @click="completeAll"
            v-show="! allTodosComplete"
        >Complete All</button>

        <todo v-for="(todo, index) in todos" :key="index" :todo="todo"></todo>
    </div> --}}
    <div class="container">
        <table class="table">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Remaing Balance</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($clients as $client)
                <tr>
                    <td>{{$client->name}}</td>
                    <td>{{$client->email}}</td>
                    <td>{{$client->phone}}</td>
                    <td>{{$client->formatted_amount_remaining}}</td>
                    <td><a href="{{route('client.show', $client->id)}}">View</a></td>
                    <td>
                        <form action="{{route('client.destroy', $client->id)}}" method="POST">
                            {{csrf_field()}}
                            @method('DELETE')
                            <button class="button is-danger" type="submit">DELETE</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </table>
        <a class="button is-primary" href="{{route('client.create')}}">New</a>
    </div>
@endsection
