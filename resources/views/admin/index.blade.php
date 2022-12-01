@extends('admin.layout.app')
@section('title','Admin Restaurant WEI')
@section('content')
@php
    use App\Models\User;
    use App\Models\Pesanan;
    use App\Models\Meja;
    use App\Models\Log_trigger;
    $no = 1;
    $log = Log_trigger::all();
@endphp
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard </h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
  
          <div class="info-box-content">
            <span class="info-box-text">User</span>
            <span class="info-box-number">{{ User::all()->count() }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-bill-wave-alt"></i></span>
  
          <div class="info-box-content">
            <span class="info-box-text">Pendapatan Hari ini</span>
            <span class="info-box-number">Rp.{{ number_format(Pesanan::where('status_pesanan','sudah_bayar')->whereDate('tgl_pesanan','=',now())->sum('total_harga'))}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-money-bill-wave-alt"></i></span>
  
          <div class="info-box-content">
            <span class="info-box-text">Pendapatan Bulan ini</span>
            <span class="info-box-number">Rp.{{ number_format(Pesanan::where('status_pesanan','sudah_bayar')->whereMonth('tgl_pesanan',date('m'))->sum('total_harga'))}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-table"></i></span>
  
          <div class="info-box-content">
            <span class="info-box-text">Pendapatan Bulan ini</span>
            <span class="info-box-number">{{ number_format(Meja::all()->count())}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <table class="table table-bordered" id="myTable">
          <thead>
            <tr>
              <th>#</th>
              <th>LOG</th>
              <th>Waktu</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($log as $row)
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $row->deskripsi }}</td>
              <td>{{ $row->created_at }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
@endsection