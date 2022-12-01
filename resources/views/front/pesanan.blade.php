@extends('front.layout.app')
@section('title','Restaurant WEI')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <div class="container-fluid">
        <div class="card my-5">
            <div class="card-body">
                <div class="row">
                    <div class="mx-auto">
                        <a href="/" class="btn btn-secondary">Back</a>
                        <a href="/list_pesanan" class="btn btn-secondary">Finish</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-secondary mx-1 btn-makanan" onclick="return makanan()">Makanan</button>
                            <button class="btn btn-secondary mx-1 btn-minuman" onclick="return minuman()">Minuman</button>
                        </div>
                        <hr style="border-top:3px solid grey;">
                        <div class="mx-auto">
                            <div class="search-makanan">
                                <div class="row">
                                    <div class="col-6 offset-3">
                                        <div class="input-group">
                                            <input type="search" id="search-makanan" name="search" class="form-control mx-auto">
                                            <label class="mt-1 ml-2" for="search"><i class="fas fa-search"></i></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row search-makanans">
                                    @foreach ($makanan as $row)
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <button class="btn btn-link {{ $row->status_masakan == 'hadis' ? 'disabled' : '' }}" value="{{ $row->id_masakan }}" name="id_masakan" id="select-masakan" onclick="return select_masakan({{ $row->id_masakan }})">
                                                <div class="card p-2">
                                                    <img src="{{ asset('images/masakan/'.$row->image) }}" alt="" class="mx-auto" style="width: 180px;height:180px;margin:5px;">
                                                    <div class="card-body">
                                                        <h6>{{ $row->nama_masakan }}</h6>
                                                        @if ($row->status_masakan == 'habis')
                                                        <h5 class="text-danger">HABIS</h5>
                                                        @else
                                                        <p>Rp.{{ number_format($row->harga,0,',','.') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </button> 
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="search-minuman d-none">
                                <div class="row">
                                    <div class="col-6 offset-3">
                                        <div class="input-group">
                                            <input type="search" id="search-minuman" name="search" class="form-control mx-auto">
                                            <label class="mt-1 ml-2" for="search"><i class="fas fa-search"></i></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row search-minumans">
                                    @foreach ($minuman as $row)
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <button class="btn btn-link {{ $row->status_masakan == 'hadis' ? 'disabled' : '' }}" value="{{ $row->id_masakan }}" name="id_masakan" id="select-masakan" onclick="return select_masakan({{ $row->id_masakan }})">
                                                <div class="card p-2">
                                                    <img src="{{ asset('images/masakan/'.$row->image) }}" alt="" class="mx-auto" style="width: 180px;height:180px;margin:5px;">
                                                    <div class="card-body">
                                                        <h6>{{ $row->nama_masakan }}</h6>
                                                        @if ($row->status_masakan == 'habis')
                                                        <h5 class="text-danger">HABIS</h5>
                                                        @else
                                                        <p>Rp.{{ number_format($row->harga,0,',','.') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 " style="background-color: #212121;border-radius:10px;">
                        <div class="select-masakan my-3">

                        </div>
                        <div class="select-masakan-table">
                            <table class="table table-bordered text-light">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Masakan</th>
                                        <th>Qty</th>
                                        <th>Sub Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                        $total = 0;
                                    @endphp
                                    @foreach ($pesanan as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->nama_masakan }}</td>
                                            <td>{{ $row->qty }}</td>
                                            <td>Rp.{{ number_format($row->sub_total) }}</td>
                                            <td>
                                                <button class='btn btn-warning' name='id_masakan' id='select-masakan' onclick="return select_masakan( {{ $row->id_masakan}} )" >
                                                    Edit
                                                </button>
                                                <button class="btn btn-danger" onclick="return remove_pesanan('{{ $row->id_detail }}')">Remove</button>
                                            </td>
                                        </tr>
                                        @php
                                            $total += $row->sub_total;
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan='4' class='text-center'>SUBTOTAL</th>
                                        <th class='text-center'>Rp.{{ $total }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function makanan(){
            document.querySelector('.search-makanan').classList.remove('d-none');
            document.querySelector('.search-minuman').classList.add('d-none');
            document.querySelector('.btn-makanan').classList.add('active');
            document.querySelector('.btn-minuman').classList.remove('active');
        }
        function minuman(){
            document.querySelector('.search-minuman').classList.remove('d-none');
            document.querySelector('.search-makanan').classList.add('d-none');
            document.querySelector('.btn-makanan').classList.remove('active');
            document.querySelector('.btn-minuman').classList.add('active');
        }
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $('#search-makanan').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                type : 'get',
                url : '/search_makanan',
                data:{'search':$value},
                success:function(data){
                    $('.search-makanans').html(data);
                }
            });
        });
        $('#search-minuman').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                type : 'get',
                url : '/search_minuman',
                data:{'search':$value},
                success:function(data){
                    $('.search-minumans').html(data);
                }
            });
        });
        function select_masakan(id){
            $.ajax({
                type : 'get',
                url : '/select_masakan',
                data:{
                    'id_masakan': id,
                    'id_pesanan': {{ $id_pesanan }}
                },
                success:function(data){
                    $('.select-masakan').html(data);
                }
            });
        }
        function qty_masakan(value,harga) {    
            $total = value * harga;
            $format = $total.toLocaleString();
            $('#subtotal-masakan').text('Rp.' + $format);
        }
        function add_pesanan(id_masakan){
            $qty = document.getElementById("qty-masakan").value;
            $.ajax({
                type : 'post',
                url : '/add_pesanan',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    'qty': $qty,
                    'id_masakan': id_masakan,
                    'id_pesanan': {{ $id_pesanan }}
                },
                success:function(data){
                    $('.select-masakan-table').html(data);
                },
            });
        }
        function remove_pesanan(id_detail) {
            $.ajax({
                type : 'get',
                url : '/remove_pesanan',
                data:{
                    'id_detail': id_detail,
                    'id_pesanan': {{ $id_pesanan }}
                },
                success:function(data){
                    $('.select-masakan-table').html(data);
                }
            });
        }
    </script>
    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>
@endsection