@extends('layouts.master')
@section('title', "Login | PT ChipiChapa")

@section('content')
    <section class="container container-fluid">
        <h1>Login Page</h1>

        @if(session('error'))
            <div class="alert alert-danger mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route("login") }}" method="POST">
            @csrf
            <div class="form-group mb-4">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Enter email" required>
            </div>
            <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password"  value="{{ old('password') }}"placeholder="Password" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Role</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="roleUser" value="user" {{ old('role') == 'user' ? 'checked' : '' }} checked required>
                    <label class="form-check-label" for="roleUser">User</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="roleAdmin" value="admin" {{ old('role') == 'admin' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="roleAdmin">Admin</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section>
@endsection
