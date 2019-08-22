@extends('layout.master')

@section('content')
    <div class="container">
        <h1>{{$project->client->name}} : {{$project->title}}</h1>
        <p>Charged {{$project->formatted_price}}</p>
        <p>Paid {{$project->amountPaid()}}</p>
        <h2>Remaining: {{$project->formatted_amount_remaining}}</h2>
        <table class="table">
            <tr>
                <th>Payment Date</th>
                <th>Payment Amount</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($project->payments as $payment)
                <tr>
                    <td>{{$payment->paid_on}}</td>
                    <td>{{$payment->formattedPrice}}</td>
                    <td><a href="{{route('payment.show', [$project->client->id, $project->id, $payment->id])}}">View</a></td>
                    <td>
                        <form action="{{route('payment.destroy', [$project->client->id, $project->id, $payment->id])}}">
                            <button type="submit" class="button is-danger">DELETE</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        <a class="button is-primary" href="{{route('payment.create', [$project->client->id, $project->id])}}">Create Payment</a>
    </div>

@endsection
