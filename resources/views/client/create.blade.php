@extends('layout.master')

@section('content')
    <div class="container">
        <form action="{{route('client.store')}}" method="POST" class="Form">
            {{csrf_field()}}
            <!-- Text field for Name -->
            <div class="field">
                <label for="name" class="label">Name</label>
                <input type="text" id="name" name="name" class="input" value="{{old('name')}}">
            </div>
            <!-- Email field for Email -->
            <div class="field">
                <label for="email" class="label">Email</label>
                <input type="email" id="email" name="email" class="input" value="{{old('email')}}">
            </div>
            <!-- Text field for Phone -->
            <div class="field">
                <label for="phone" class="label">Phone</label>
                <input type="text" id="phone" name="phone" class="input" value="{{old('phone')}}">
            </div>
            <button class="button is-primary" type="submit" name="Submit">Submit</button>
        </form>
    </div>
@endsection
