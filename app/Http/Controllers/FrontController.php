<?php

namespace App\Http\Controllers;

use App\Models\Masakan;
use App\Models\Meja;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        return view('front.index');
    }
    public function create_pesanan(){
        if (Meja::where('status_meja','kosong')->get()) {
            return redirect()->to("/")->with('error','Tidak ada meja yang kosong!');
        }
        $data = [
            'tgl_pesanan' => now(),
            'id' => Auth::user()->id,
            'no_meja' => Meja::where('status_meja','kosong')->first()->no_meja,
            'total_harga' => null,
            'bayar' => null,
            'kembalian' => null,
            'status_pesanan' => 'belum_bayar',
            'status_makanan_pesanan' => 'sedang_diproses',
        ];
        $id_pesanan = Pesanan::create($data)->id;
        return redirect()->to("/pesanan/$id_pesanan");
    }
    public function pesanan(){
        $data['makanan'] = Masakan::where('type','makanan')->get();
        $data['minuman'] = Masakan::where('type','minuman')->get();
        return view('front.pesanan',$data);
    }
    public function list_pesanan(){
        $data['pesanan'] = Pesanan::where('status_pesanan','belum_bayar')->get();

        return view('front.list_pesanan',$data);
    }
    public function search_makanan(){
        if (request()->ajax()) {
            $output = '';
            $makanan = Masakan::where('type','makanan')->where('nama_masakan','LIKE','%'.request()->search.'%')->get();
            foreach($makanan as $row){
                $output .= "<div class='col-12 col-md-6 col-xl-4'>
                <button class='btn btn-link' value='$row->id_masakan' name='id_masakan' id='select-masakan' onclick='return select_masakan( $row->id_masakan )'>
                    <div class='card p-2'>
                        <img src='".asset('images/masakan/'.$row->image)."' alt='' class='mx-auto' style='width: 200px;height:200px;margin:5px;'>
                        <div class='card-body'>
                            <h6>".$row->nama_masakan."</h6>
                            <p>Rp.".number_format($row->harga,0,',','.')."</p>
                        </div>
                    </div>
                </button>
            </div>";
            }
            if ($makanan->count() <= 0) {
                $output .= "
                <div class='mx-auto'>
                    <div style='min-height:150px;margin-top:75px;'>
                        Not Found
                    </div>
                </div>
                ";
            }
            return Response($output);
        }
    }
    public function search_minuman(){
        if (request()->ajax()) {
            $output = '';
            $minuman = Masakan::where('type','minuman')->where('nama_masakan','LIKE','%'.request()->search.'%')->get();
            foreach($minuman as $row){
                $output .= "<div class='col-12 col-md-6 col-xl-4'>
                <button class='btn btn-link' value='$row->id_masakan' name='id_masakan' id='select-masakan' onclick='return select_masakan( $row->id_masakan )'>
                    <div class='card p-2'>
                        <img src='".asset('images/masakan/'.$row->image)."' alt='' class='mx-auto' style='width: 200px;height:200px;margin:5px;'>
                        <div class='card-body'>
                            <h6>".$row->nama_masakan."</h6>
                            <p>Rp.".number_format($row->harga,0,',','.')."</p>
                        </div>
                    </div>
                </button>
            </div>";
            }
            if ($minuman->count() <= 0) {
                $output .= "
                <div class='mx-auto'>
                    <div style='min-height:150px;margin-top:75px;'>
                        Not Found
                    </div>
                </div>
                ";
            }
            return Response($output);
        }
    }
    public function select_masakan(){
        if (request()->ajax()) {
            $output = '';
            $makanan = Masakan::where('id_masakan',request()->id_masakan)->first();
            $output .= "
            <form action='' method='post'>
                <div class='mx-auto text-center'>
                    <img src='".asset('images/masakan/'.$makanan->image)."' style='width:80px;height:80px;margin-bottom:5px;'>
                    <p>".$makanan->nama_masakan."</p>
                    <p>Rp.".number_format($makanan->harga,0,'.',',')."</p>
                </div>
                <input type='search' class='form-control' placeholder='qty' name='qty' id='qty-masakan' onkeyup='return qty_masakan(value,".$makanan->harga.")'>
                <h5 class='mt-1 float-right'>Subtotal : <span id='subtotal-masakan'>Rp.0</span></h5>
            </form>
            
            ";
            if ($makanan->count() <= 0) {
                $output .= "
                <div class='mx-auto'>
                    <div style='min-height:150px;margin-top:75px;'>
                        Not Found
                    </div>
                </div>
                ";
            }
            return Response($output);
        }
    }
}
