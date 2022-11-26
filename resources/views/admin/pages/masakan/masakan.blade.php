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
            <a href="/admin/tambah_masakan" class="btn btn-primary float-right">Tambah</a>
          </h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <table id="myTable" class="table table-bordered text-light">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Image Masakan</th>
                    <th>Nama Masakan</th>
                    <th>Type Masakan</th>
                    <th>Harga Masakan</th>
                    <th>Status Masakan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($masakan as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td><img src="{{ asset('images/masakan/'.$row->image) }}" alt="" style="width: 100px"></td>
                    <td>{{ $row->nama_masakan }}</td>
                    <td>{{ $row->type }}</td>
                    <td>{{ $row->harga }}</td>
                    <td>
                        <form action="/admin/status_masakan" method="POST">
                            @csrf
                            <button class="btn btn-{{ $row->status_masakan == 'habis' ? 'danger' : 'success' }}" value="{{ $row->id_masakan }}" name="ubah_status">{{ $row->status_masakan }}</button>
                        </form>
                    </td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </section>
</div>
@endsection