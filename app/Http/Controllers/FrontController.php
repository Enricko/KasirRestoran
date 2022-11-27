<?php

namespace App\Http\Controllers;

use App\Models\DetailMasakan;
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
        if (Meja::where('status_meja','kosong')->get()->count() <= 0) {
            return redirect()->to("/")->with('error','Tidak ada meja yang kosong!');
        }
        $data = [
            'tgl_pesanan' => now(),
            'id' => Auth::user()->id,
            'no_meja' => Meja::where('status_meja','kosong')->first()->no_meja,
            'total_harga' => 0,
            'bayar' => null,
            'kembalian' => null,
            'status_pesanan' => 'belum_bayar',
            'status_makanan_pesanan' => 'sedang_diproses',
        ];
        $id_pesanan = Pesanan::create($data)->id;
        return redirect()->to("/pesanan/$id_pesanan");
    }
    public function pesanan($id_pesanan){
        $data['makanan'] = Masakan::where('type','makanan')->get();
        $data['minuman'] = Masakan::where('type','minuman')->get();
        $data['id_pesanan'] = $id_pesanan;
        $data['pesanan'] = DetailMasakan::join('masakans','masakans.id_masakan','=','detail_masakans.id_masakan')->where('id_pesanan',$id_pesanan)->get();
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
        return redirect()->back();
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
        return redirect()->back();
    }
    public function select_masakan(){
        if (request()->ajax()) {
            $output = '';
            $masakan = Masakan::where('id_masakan',request()->id_masakan)->first();
            $pesanan = DetailMasakan::join('masakans','masakans.id_masakan','=','detail_masakans.id_masakan')->where('id_pesanan',request()->id_pesanan)->where('detail_masakans.id_masakan',request()->id_masakan)->first();
            if (!$pesanan) {
                $output .= "
                    <div class='row mx-2'>
                        <div class='mx-auto text-center'>
                            <img src='".asset('images/masakan/'.$masakan->image)."' style='width:80px;height:80px;margin-bottom:5px;'>
                            <p>".$masakan->nama_masakan."</p>
                            <p>Rp.".number_format($masakan->harga,0,'.',',')."</p>
                        </div>
                        <input type='number' class='form-control' placeholder='qty' name='qty' id='qty-masakan' onkeyup='return qty_masakan(value,".$masakan->harga.")'>
                        <h5 class='mt-1 float-right'>Subtotal : <span id='subtotal-masakan'>Rp.0</span></h5>
                        <div class='col-12'>
                            <button class='btn btn-secondary float-right' onclick='return add_pesanan($masakan->id_masakan)'>Pesan</button>
                        </div>
                    </div>
                    
                    ";
            }else{
                $output .= "
                    <div class='row mx-2'>
                        <div class='mx-auto text-center'>
                            <img src='".asset('images/masakan/'.$masakan->image)."' style='width:80px;height:80px;margin-bottom:5px;'>
                            <p>".$masakan->nama_masakan."</p>
                            <p>Rp.".number_format($masakan->harga,0,'.',',')."</p>
                        </div>
                        <input type='number' class='form-control' placeholder='qty' name='qty' id='qty-masakan' value='$pesanan->qty' onkeyup='return qty_masakan(value,".$masakan->harga.")' maxlength='5' oninput='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);'>
                        <h5 class='mt-1 float-right'>Subtotal : <span id='subtotal-masakan'>Rp.0</span></h5>
                        <div class='col-12'>
                            <button class='btn btn-warning float-right' onclick='return add_pesanan($masakan->id_masakan)'>Ubah Pesanan</button>
                        </div>
                    </div>
                    ";
            }
            if ($masakan->count() <= 0) {
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
        return redirect()->back();
    }
    public function add_pesanan()
    {
        if (request()->ajax()) {
            $masakan = Masakan::where('id_masakan',request()->id_masakan)->first();
            $detail = DetailMasakan::where('id_masakan',request()->id_masakan)->where('id_pesanan',request()->id_pesanan)->first();
            if ($detail) {
                $data = [
                    'id_pesanan' => request()->id_pesanan,
                    'id_masakan' => request()->id_masakan,
                    'qty' => request()->qty,
                    'sub_total' => request()->qty * $masakan->harga,
                    'keterangan_pesanan' => 'none',
                    'status' => 'dimasak',
                ];
                DetailMasakan::where('id_detail',$detail->id_detail)->update($data);
            }else{
                $data = [
                    'id_pesanan' => request()->id_pesanan,
                    'id_masakan' => request()->id_masakan,
                    'qty' => request()->qty,
                    'sub_total' => request()->qty * $masakan->harga,
                    'keterangan_pesanan' => 'none',
                    'status' => 'dimasak',
                ];
                DetailMasakan::create($data);
            }
            return Response($this->table_pesanan(request()->id_pesanan));
            
        }
        return redirect()->back();
    }
    public function remove_pesanan(){
        if (request()->ajax()) {
            DetailMasakan::where('id_detail',request()->id_detail)->delete();
            
            return Response($this->table_pesanan(request()->id_pesanan));
        }
        return redirect()->back();
    }

    public static function table_pesanan($id_pesanan){
        $no = 1;
        $total = 0;
        $pesanan = DetailMasakan::join('masakans','masakans.id_masakan','=','detail_masakans.id_masakan')->where('id_pesanan',$id_pesanan)->get();
        $output = "";
        $output .= "
        <table class='table table-bordered text-light'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Masakan</th>
                    <th>Qty</th>
                    <th>Sub Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>";
        foreach ($pesanan as $row){
            $output .= "
            <tr>
                <td>".$no++."</td>
                <td>".$row->nama_masakan."</td>
                <td>$row->qty</td>
                <td>Rp.".wordwrap(number_format($row->sub_total),15,'<br>\n')."</td>
                <td>
                    <button class='btn btn-warning' name='id_masakan' id='select-masakan' onclick='return select_masakan( $row->id_masakan )' >
                        Edit
                    </button>
                    <button class='btn btn-danger' onclick='return remove_pesanan($row->id_detail)'>Remove</button>
                </td>
            </tr>";
            $total += $row->sub_total;
        }
        $output .="
        
            </tbody>
            <tfoot>
                <tr>
                    <th colspan='4' class='text-center'>SUBTOTAL</th>
                    <th class='text-center'>Rp.".number_format( $total)."</th>
                </tr>
            </tfoot>
        </table>";

        return $output;
    }
    public function change_status_pesanan(){
        if (request()->ajax()) {
            Pesanan::where('id_pesanan',request()->id_pesanan)->update(['status_makanan_pesanan'=>request()->status_pesanan]);

            return Response();
        }
        return redirect()->back();
    }
    public function konfirmasi_pembayaran(){
        if(request()->ajax()){
            Pesanan::where('id_pesanan',request()->id_pesanan)->update(['status_pesanan'=>request()->status_pemesanan]);

            return redirect()->to('/list_pesanan');
        }
        return redirect()->back();
    }
}
