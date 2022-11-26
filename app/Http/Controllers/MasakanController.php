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

        $data = [
            'image' => $file_name,
            'nama_masakan' => request()->nama_masakan,
            'type' => request()->type_masakan,
            'status_masakan' => request()->status_masakan,
            'harga' => request()->harga_masakan,
        ];
        Masakan::create($data);
        return redirect()->to('/admin/masakan')->with('success',"Masakan ". request()->nama_masakan." telah di tambahkan!");
        
    }
    public function edit($id_masakan){
        $data['masakan'] = Masakan::where('id_masakan',$id_masakan)->first();
        $data['id'] = $id_masakan;
        $data['sidebar'] = 'masakan';

        return view('admin.pages.masakan.edit',$data);
    }
    public function edit_data($id_masakan){
        $file = request()->image_masakan;
        $file_name = Str::random(25).'-'.$file->getClientOriginalName();
        
        $tujuan_upload = 'images/masakan';
        $file->move($tujuan_upload,$file_name);

        $tmp = public_path('images/masakan/'.request()->old_image_masakan);
        if (file_exists($tmp)) {
            unlink($tmp);
        }
        $data = [
            'image' => $file_name,
            'nama_masakan' => request()->nama_masakan,
            'type' => request()->type_masakan,
            'status_masakan' => request()->status_masakan,
            'harga' => request()->harga_masakan,
        ];
        Masakan::where('id_masakan',$id_masakan)->update($data);
        return redirect()->to('/admin/masakan')->with('update',"Masakan ".request()->nama_masakan." telah di hapus!");
    }
    public function delete($id_masakan){
        $masakan = Masakan::where('id_masakan',$id_masakan)->first();
        $tmp = public_path('images/masakan/'.$masakan->image);
        if (file_exists($tmp)) {
            unlink($tmp);
        }
        Masakan::where('id_masakan',$id_masakan)->delete();
        
        return redirect()->to('/admin/masakan')->with('delete',"Masakan telah di hapus!");
    }
}
