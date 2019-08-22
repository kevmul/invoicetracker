@extends('layout.master')

@section('content')
    <div class="container">
        <h1>Payment for {{$payment->client->name}} : {{$payment->project->title}}</h1>
        <form action="{{route('payment.update', [$payment->client->id, $payment->project->id, $payment->id])}}" method="POST">
            {{csrf_field()}}
            @method('PATCH')
            <!-- Number field for Dollar Amount -->
            <div class="field">
                <label for="dollar_amount" class="label">Dollar Amount</label>
                <input type="number" min="0" id="dollar_amount" name="dollar_amount" class="input" value="{{old('dollar_amount') ?? $payment->dollar_amount}}">
            </div>
                <!-- Number field for Cent Amount -->
            <div class="field">
                <label for="cent_amount" class="label">Cent Amount</label>
                <input type="number" id="cent_amount" min="0" max="99" name="cent_amount" class="input" value="{{old('cent_amount') ?? $payment->cent_amount}}">
            </div>
            <!-- Date field for Paid On -->
            <div class="field">
                <label for="paid_on" class="label">Paid On</label>
                <input type="date" id="paid_on" name="paid_on" class="input" value="{{old('paid_on') ?? $payment->paid_on->format('Y-m-d')}}">
            </div>

            <button class="button is-primary" type="submit">Update</button>
        </form>
    </div>
@endsection
