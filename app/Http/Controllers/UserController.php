<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $data['user'] = User::all();
        $data['sidebar'] = 'user';
        return view('admin.pages.user.user',$data);
    }
    
    public function tambah(){
        $data['sidebar'] = 'user';
        return view('admin.pages.user.tambah',$data);
    }
    public function tambah_data(){
        request()->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => request()->nama,
            'level' => request()->level,
            'email' => request()->email,
            'password' => request()->password,
        ]);

        return redirect()->to('/admin/user')->with('success','User telah di tambahkan');
    }

    public function edit($id){
        $data['user'] = User::where('id',$id)->first();
        $data['sidebar'] = 'user';

        return view('admin.pages.user.edit',$data);
    }
    public function edit_data($id){
        request()->validate([
            'nama' => ['required', 'string', 'max:255'],
        ]);

        User::where('id',$id)->update([
            'name' => request()->nama,
            'level' => request()->level,
            'email' => request()->email,
        ]);

        return redirect()->to('/admin/user')->with('update','User telah di ubah');
    }

    public function delete($id){
        User::where('id',$id)->delete();

        return redirect()->back()->with('delete','User telah di hapus');
    }
}
