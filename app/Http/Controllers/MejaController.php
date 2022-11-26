<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $data['sidebar'] = 'meja';
        $data['meja'] = Meja::all();

        return view('admin.pages.meja.meja',$data);
    }
    public function tambah(){
        Meja::create();
        return redirect()->back()->with('success','Meja Telah Di tambahkan');
    }
    public function delete($no_meja){
        Meja::where('no_meja',$no_meja)->delete();
        return redirect()->back()->with('delete','Meja Telah Di hapus');
    }
}
