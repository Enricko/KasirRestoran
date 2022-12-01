@extends('admin.layout.app')
@section('title','Admin Restaurant WEI')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">Tambah Masakan
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form action="/admin/edit_data_user/{{ $user->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" value="{{ $user->name }}" id="nama" placeholder="Nama User" required>
            </div>
            <div class="form-group">
                <label for="level">Level</label>
                <select name="level" id="level" class="form-control">
                    <option value="">== Select Level ==</option>
                    @if (Auth::user()->level == 'owner')
                    <option value="owner" {{ $user->level == 'owner' ? 'selected' : '' }}>Owner</option>
                    @endif
                    <option value="admin" {{ $user->level == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="kasir" {{ $user->level == 'kasir' ? 'selected' : '' }}>Kasir</option>
                    <option value="waiter" {{ $user->level == 'waiter' ? 'selected' : '' }}>Waiter</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $user->email }}" id="email" placeholder="Email User" required>
            </div>

            <button class="btn btn-primary mt-1 float-right" type="submit">Tambah</button>
        </form>
      </div>
    </section>
</div>
@endsection