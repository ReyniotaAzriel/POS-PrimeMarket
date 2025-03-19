@extends('layout.app')

@section('content')
    <h1>Admin Dashboard</h1>
    <p>Selamat datang, {{ Auth::user()->name }}! Anda login sebagai <strong>Admin</strong>.</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endsection
