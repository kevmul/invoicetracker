@extends('layout.master')

@section('content')
    <div class="container">
        <h1>Create a new Payment for {{$project->client->name}}</h1>
        <form action="{{route('payment.store', [$project->client->id, $project->id])}}" method="POST" class="Form">
            {{csrf_field()}}
            <!-- Integer field for Amount -->
            <div class="field is-horizontal">
                <div class="field-label">
                    <label for="dollar_amount" class="label">Amount</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control is-expanded">
                            <input type="number" min="0" class="input" id="dollar_amount" name="dollar_amount" class="input" placeholder="Dollar Amount" value="{{old('dollar_amount')}}">
                        </p>
                    </div>
                    <div class="field">
                        <p class="control is-expanded">
                            <input type="number" min="0" max="99" class="input" id="cent_amount" name="cent_amount" class="input" placeholder="Cent Amount" value="{{old('cent_amount')}}">
                        </p>
                    </div>
                </div>
            </div>
            <!-- Datetime field for Paid On -->
            <div class="field is-horizontal">
                <div class="field-label">
                    <label for="paid_on" class="label">Paid On</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <input type="date" id="paid_on" name="paid_on" class="input" value="{{old('paid_on') ?? Carbon\Carbon::now()->format('Y-m-d')}}">
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label"></div>
                <div class="field-body">
                    <div class="field">
                        <button class="button is-primary" type="submit" name="Submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
