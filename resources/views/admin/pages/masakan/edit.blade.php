@extends('admin.layout.app')
@section('title','Admin Restaurant WEI')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">Edit Masakan
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form action="/admin/edit_data_masakan/{{ $id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="image">Image Masakan</label>
            <div class="input-group mb-3">
                <label class="custom-file-label" for="image">Image Masakan</label>
                <input type="text" class="custom-file-input" name="old_image_masakan" value="{{ $masakan->image }}" id="image" placeholder="Harga Masakan" hidden>
                <input type="file" class="custom-file-input" name="image_masakan" id="image" placeholder="Harga Masakan" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama Masakan</label>
                <input type="text" class="form-control" name="nama_masakan" value="{{ $masakan->nama_masakan }}" id="nama" placeholder="Nama Masakan" required>
            </div>
            <div class="form-group">
                <label for="type">Type Masakan</label>
                <select name="type_masakan" id="type" class="form-control">
                    <option value="">== Select Type ==</option>
                    <option value="makanan" {{ $masakan->type == 'makanan' ? 'selected' : '' }}>Makanan</option>
                    <option value="minuman" {{ $masakan->type == 'minuman' ? 'selected' : '' }}>Minuman</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Status">Status Masakan</label>
                <select name="status_masakan" id="Status" class="form-control">
                    <option value="">== Select Status ==</option>
                    <option value="tersedia" {{ $masakan->status_masakan == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="habis" {{ $masakan->status_masakan == 'habis' ? 'selected' : '' }}>Habis</option>
                </select>
            </div>
            <div class="form-group">
                <label for="harga">Harga Masakan</label>
                <input type="number" class="form-control" name="harga_masakan" value="{{ $masakan->harga }}" id="harga" placeholder="Harga Masakan" required>
            </div>
            <button class="btn btn-primary mt-1 float-right" type="submit">Tambah</button>
        </form>
      </div>
    </section>
</div>
@endsection