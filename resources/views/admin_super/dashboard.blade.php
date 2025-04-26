@extends('admin_super.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <h1 style="text-align: center">Hallo ! Selamat Datang <strong>{{ auth()->user()->name }} !</strong></h1>
    <p style="text-align: center">Kelola Pengajuan Anggaran Disini</p>
@endsection


