@extends('layout.app')

@section('title', 'Edit Soal | Ujian Online SMAN 2 Baubau')

@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">Data Soal</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Data Soal</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Soal</li>
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
            <h3 class="mb-0">Edit Data Soal</h3>
          </div>
          <div class="card-body">
            <form action={{ route('soal.update', $soal->id) }} method="POST">
              @method('PUT')
              @csrf
              <div class="form-group">
                <label class="form-control-label">Mata Pelajaran</label>
                <select class="form-control" data-toggle="select" name="id_mapel" required>
                    @foreach ($mapel as $data)
                    <option value="{{ $data->id }}" {{ $data->id == $soal->id_mapel ? 'selected' : '' }}>{{ $data->nama_mapel }}</option>
                    @endforeach
                </select>              
              </div>
              <div class="form-group">
                <label class="form-control-label">Nama Soal</label>
                <textarea name="nama_soal" id="summernote" class="form-control">{!! $soal->nama_soal !!}</textarea>
              </div>
              @foreach ($soal->opsi as $key => $value)
              <input type="hidden" name="id_opsi[]" value="{{$value->id}}">
              <div class="form-group">
                <label for="nama_opsi">Opsi {{++$key}}</label>
                <input type="text" class="form-control" name="nama_opsi[]" value="{{$value->nama_opsi}}" required>
              </div>
              @endforeach
              <div class="form-group">
                  <label for="nama_opsi">Jawaban Benar</label>
                  <input type="text" class="form-control" name="jawaban_benar" value="{{$soal->jawaban_benar}}" required>
              </div>
              <a href="/soal" class="btn btn-md btn-warning">Kembali</a>
              <button type="submit" class="btn btn-md btn-success">Kirim</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('addon-script')
<script>
    $(document).ready(function () {
        $(function () {

            $('#summernote').summernote({
                dialogsInBody: true,
                height: 300,
            });
        })
    })
</script>
@endpush