@extends('front.layout.app')
@section('title','Restaurant WEI')
@section('content')
@php
    use App\Models\Meja;
@endphp
<div class="container">
    <div class="card my-5">
        <div class="card-body">
            <div class="row">
                <div class="col-12 my-5">
                    <div class="d-flex justify-content-center">
                        <form action="/create_pesanan" method="POST">
                            @csrf
                            <button class="btn btn-secondary mx-1" type="submit">Mulai Pemesanan</button>
                        </form>
                        <a href="/list_pesanan" class="btn btn-secondary mx-1">Lihat Pesanan yang sedang berlangsung</a><br>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <h3>Meja Yang Tersedia : {{ Meja::where('status_meja','kosong')->get()->count() }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection