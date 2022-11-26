@extends('admin.layout.app')
@section('title','Admin Restaurant WEI')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">Masakan
              <a href="/tambah_masakan" class="btn btn-primary float-right">Tambah</a>
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form action="/admin/tambah_data_masakan" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Image Masakan</label>
                <input type="file" class="form-control" name="image_masakan" id="image" placeholder="Harga Masakan" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama Masakan</label>
                <input type="text" class="form-control" name="nama_masakan" id="nama" placeholder="Nama Masakan" required>
            </div>
            <div class="form-group">
                <label for="type">Type Masakan</label>
                <select name="type_masakan" id="type" class="form-control">
                    <option value="">== Select Type ==</option>
                    <option value="makanan">Makanan</option>
                    <option value="minuman">Minuman</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Status">Status Masakan</label>
                <select name="status_masakan" id="Status" class="form-control">
                    <option value="">== Select Status ==</option>
                    <option value="tersedia">Tersedia</option>
                    <option value="habis">Habis</option>
                </select>
            </div>
            <div class="form-group">
                <label for="harga">Harga Masakan</label>
                <input type="number" class="form-control" name="harga_masakan" id="harga" placeholder="Harga Masakan" required>
            </div>
            <button class="btn btn-primary mt-1" type="submit">Tambah</button>
        </form>
      </div>
    </section>
</div>
@endsection