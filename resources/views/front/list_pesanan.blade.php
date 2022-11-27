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
                <div class="col-12">
                    <a href="/" class="btn btn-secondary">Back</a>
                </div>
                <div class="col-12 my-5">
                    <h1>List Pesanan</h1>
                    <div id="list_table">
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
                                    <th>Status Pesanan</th>
                                    <th>Status Makanan Pesanan</th>
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
                                        <td>Rp.{{ number_format($row->total_harga) }}</td>
                                        <td>
                                            <button class="btn btn-danger" onclick="return konfirmasi_pembayaran({{ $row->id_pesanan }})">{{ str_replace('_',' ',ucfirst($row->status_pesanan)) }}</button>
                                        </td>
                                        <td>
                                            <form method="POST">
                                                <select name="status_makanan" id="" class="form-control" onchange="return change_status_pesanan(value,{{ $row->id_pesanan }})">
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
                                                                $detail_pesanan = DetailMasakan::join('masakans','masakans.id_masakan','=','detail_masakans.id_masakan')->where('id_pesanan',$row->id_pesanan)->get();
                                                            @endphp
                                                            @foreach ($detail_pesanan as $item)
                                                                <tr>
                                                                    <td>{{ $p++ }}</td>
                                                                    <td>{{ $item->nama_masakan }}</td>
                                                                    <td>{{ $item->qty }}</td>
                                                                    <td>Rp.{{ number_format($item->sub_total) }}</td>
                                                                    <td>{{ $item->keterangan_pesanan }}</td>
                                                                    <td>{{ $item->status }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-2">
                                                    <a href="/pesanan/{{ $row->id_pesanan }}" class="btn btn-warning float-right">Edit</a>
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
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function change_status_pesanan(value,id_pesanan) {
        $.ajax({
            type: 'post',
            url : '/change_status_pesanan',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                'status_pesanan': value,
                'id_pesanan': id_pesanan,
            },
            success:function(data){
                console.log(data);
            }
        });
    }
    function konfirmasi_pembayaran(id_pesanan) {
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
                $.ajax({
                    type: 'post',
                    url : '/konfirmasi_pembayaran',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        'status_pemesanan': 'sudah_bayar',
                        'id_pesanan': id_pesanan,
                    },
                    success:function(data){
                        console.log(data);
                    }
                });
                location.reload();
            }
        })
    }
</script>
<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endsection