@extends('admin.layout.app')
@section('title','Admin Restaurant WEI')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Meja
            <a href="/admin/tambah_meja" class="btn btn-primary float-right">Tambah</a>
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
                    <th>No Meja</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($meja as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->no_meja }}</td>
                    <td>{{ $row->status_meja }}</td>
                    <td>
                      <a href="/admin/delete_meja/{{ $row->no_meja }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </section>
</div>
@endsection