@extends('layouts.master')
@section('title', "Register | PT ChipiChapa")

@section('content')
    <section class="container container-fluid">
        <h1>Register Page</h1>

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group mb-4">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required minlength="3" maxlength="40">
            </div>
            <div class="form-group mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required minlength="6" maxlength="12">
            </div>
            <div class="form-group mb-4">
                <label for="nomor_handphone" class="form-label">Nomor Handphone</label>
                <input type="text" class="form-control" id="phone" name="nomor_handphone" value="{{ old('nomor_handphone') }}" required pattern="^08\d{8,10}$">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section>
@endsection
