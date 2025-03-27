@extends('layouts.master')
@section('title', "Login | PT ChipiChapa")

@section('content')
    <section class="container container-fluid">
        <h1>Login Page</h1>

        @if(session('error'))
            <div style="color: red;">
                {{ session('error') }}
            </div>
        @endif

        <form action="" method="POST">
            @csrf
            <div class="form-group mb-4">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
            </div>
            <div class="form-group mb-4">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section>
@endsection
