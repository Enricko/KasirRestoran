@extends('admin.layout.app')
@section('title','Admin Restaurant WEI')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">User
            <a href="/admin/tambah_user" class="btn btn-primary float-right">Tambah</a>
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
                    <th>Nama User</th>
                    <th>Level User</th>
                    <th>Email</th>
                    <th>Bergabung pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($user as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->level }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td>
                      <a href="/admin/edit_user/{{ $row->id }}" class="btn btn-warning">Edit</a>
                      <a href="/admin/delete_user/{{ $row->id }}" class="btn btn-danger" onclick="return konfirmasi(event)">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </section>
</div>
<script>
    function konfirmasi(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href'); 
        Swal.fire({
        title: 'Are you sure?',
        text: "Apakah Pembayaran Telah Selesai?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Sudah!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'App Said : ',
                    'Pembayaran telah di lakukan !',
                    'success'
                )
                window.location.href = urlToRedirect;
            }
        });
    }
</script>
@endsection