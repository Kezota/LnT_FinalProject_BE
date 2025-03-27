@extends('layouts.master')
@section('title', "Register | PT ChipiChapa")

@section('content')
    <section class="container container-fluid">
        <h1>Register Page</h1>

        <form action="" method="POST">
            @csrf
            <div class="form-group mb-4">
                <label for="exampleInputName">Nama Lengkap</label>
                <input type="text" class="form-control" name="text" id="exampleInputName" aria-describedby="nameHelp" placeholder="Enter name" required>
            </div>
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
