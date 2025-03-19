@extends('layout.app')

@section('content')
    <h1>Pemilik Dashboard</h1>
    <p>Selamat datang, {{ Auth::user()->name }}! Anda login sebagai <strong>Pemilik</strong>.</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endsection
