<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $data['sidebar'] = 'dashboard';
        return view('admin.index',$data);
    }
}
