@extends('front.layout.app')
@section('title','Restaurant WEI')
@section('content')
@php
    use App\Models\Meja;
    use App\Models\DetailMasakan;
@endphp
<div class="container-fluid">
    <div class="card my-5">
        <div class="card-body">
            <div class="row">
                <div class="col-12 my-5">
                    <h1>List Pesanan</h1>
                    <table id="myTable" class="table table-bordered text-light">
                        <thead>
                            @php
                                $no = 1;
                            @endphp
                            <tr>
                                <th>No</th>
                                <th>ID Pesanan</th>
                                <th>No Meja</th>
                                <th>Tanggal Pesanan</th>
                                <th>Total Harga</th>
                                <th>Status Makanan</th>
                                <th>Status Pesanan</th>
                                <th>List Pesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->id_pesanan }}</td>
                                    <td>{{ $row->no_meja }}</td>
                                    <td>{{ $row->tgl_pesanan }}</td>
                                    <td>{{ $row->total_harga }}</td>
                                    <td>
                                        <form method="post">
                                            <button class="btn btn-danger" name="status_pesanan">{{ str_replace('_',' ',ucfirst($row->status_pesanan)) }}</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST">
                                            <select name="status_makanan" id="" class="form-control">
                                                <option value="sedang_diproses" {{ $row->status_makanan_pesanan == 'sedang_diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                                <option value="siap_antar" {{ $row->status_makanan_pesanan == 'siap_antar' ? 'selected' : '' }}>Siap Antar</option>
                                                <option value="telah_tersaji" {{ $row->status_makanan_pesanan == 'telah_tersaji' ? 'selected' : '' }}>Telah Tersaji</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-10">
                                                <table class="table table-bordered text-light">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nama Makanan</th>
                                                            <th>Qty</th>
                                                            <th>SubTotal</th>
                                                            <th>Keterangan Pesanan</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $p = 1;
                                                            $detail_pesanan = DetailMasakan::where('id_pesanan',$row->id_pesanan)->get();
                                                        @endphp
                                                        @foreach ($detail_pesanan as $item)
                                                            <tr>
                                                                <td>{{ $p++ }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-2">
                                                <a href="/pesanan/{{ $row->id_pesanan }}" class="btn btn-warning">Edit</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection