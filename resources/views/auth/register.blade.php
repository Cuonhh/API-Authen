@extends('layouts.master')

@section('title')
    Register
@endsection
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        
                    </div>
                    <div class="card-body">
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="mt-4">Name</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email" class="mt-4">Email</label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="mt-4">Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="mt-4">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mt-4">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
