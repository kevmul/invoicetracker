@extends('layout.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-content">
                <form action="{{route('project.store', [$clientId])}}" method="POST" class="Form">
                    {{csrf_field()}}
                    <!-- Text field for Title -->
                    <div class="field is-horizontal">
                        <div class="field-label">
                            <label for="title" class="label">Title</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control is-expanded">
                                    <input type="text" id="title" name="title" class="input" value="{{old('title')}}">
                                </p>
                            </div>
                        </div>
                    </div>

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

                    <div class="field is-horizontal">
                        <div class="field-label"></div>
                        <div class="field-body">

                        <button class="button is-primary" type="submit" name="Submit">Submit</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
