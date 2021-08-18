<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $data = [
            'nama_sekolah' => 'SMAN 1 margahayu',
            'alamat'       => 'margahayu'
        ];
        return view('v_home', $data);


    }
}
