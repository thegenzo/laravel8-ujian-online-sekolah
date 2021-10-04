@extends('layout.app')

@section('title', 'Edit Petugas | Ujian Online SMAN 2 Baubau')

@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Data Petugas</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="#">Data Petugas</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Petugas</li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h3 class="mb-0">Edit Data Petugas</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('petugas.update', $petugas->id) }}" method="POST">
            @method('PUT')
            @csrf
            <h3>Data Petugas</h3>
              <div class="form-group">
                <label class="form-control-label">Nama</label>
                <input type="text" class="form-control" name="name" value="{{ $petugas->name }}" required>
              </div>
              <div class="form-group">
                <label class="form-control-label">Level</label>
                <select class="form-control" data-toggle="select" name="level" required>
                    <option value="admin" {{ $petugas->level == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="kepsek" {{ $petugas->level == 'kepsek' ? 'selected' : '' }}>Kepala Sekolah</option>
                </select>
              </div>
              <div class="form-group">
                <label class="form-control-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $petugas->email }}" required>
              </div>
              <div class="form-group">
                <label class="form-control-label">Password</label>
                <input type="password" class="form-control" name="password" required>
              </div>
              <div class="form-group">
                <label class="form-control-label">Konfirmasi Password</label>
                <input type="password" class="form-control" name="konfirmasi_password" required>
              </div>
            <a href="/petugas" class="btn btn-md btn-warning">Kembali</a>
            <button type="submit" class="btn btn-md btn-success">Kirim</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection