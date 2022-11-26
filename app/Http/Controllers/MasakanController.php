<?php

namespace App\Http\Controllers;

use App\Models\Masakan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MasakanController extends Controller
{
    public function index(){
        $data['masakan'] = Masakan::all();
        $data['sidebar'] = 'masakan';

        return view('admin.pages.masakan.masakan',$data);
    }
    public function status_masakan(){
        if (request()->ubah_status) {
            $status = Masakan::where('id_masakan',request()->ubah_status)->first();
            if ($status->status_masakan == 'habis') {
                $ubah = ['status_masakan' => 'tersedia'];
                Masakan::where('id_masakan',request()->ubah_status)->update($ubah);
                $s = 'tersedia';
            }elseif($status->status_masakan == 'tersedia'){
                $ubah = ['status_masakan' => 'habis'];
                Masakan::where('id_masakan',request()->ubah_status)->update($ubah);
                $s = 'habis';
            }
        }
        return redirect()->back()->with('success',"Status Masakan $status->nama_masakan telah $s");
    }
    public function tambah(){
        $data['sidebar'] = 'masakan';

        return view('admin.pages.masakan.tambah',$data);
    }
    public function tambah_data(){
        $file = request()->image_masakan;
        $file_name = Str::random(25).'-'.$file->getClientOriginalName();
        
        $tujuan_upload = 'images/masakan';
        $file->move($tujuan_upload,$file_name);
        
    }
}
