@extends('layouts.master')

@section('title')
    Dashboard Member
@endsection

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Chào mừng, {{ Auth::user()->name }}!</h2>
    <div class="card mt-4">
        <div class="card-header">
            Thông tin tài khoản
        </div>
        <div class="card-body">
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Loại người dùng:</strong> {{ Auth::user()->type }}</p>
            <p>Chúc bạn một ngày tốt lành!</p>
        </div>
    </div>
    
    <div class="text-center mt-4">
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-danger">Đăng xuất</button>
        </form>
    </div>
</div>
@endsection
