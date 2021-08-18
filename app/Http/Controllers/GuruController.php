<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuruModel;
class GuruController extends Controller
{
    
    public function __construct()
    {
        $this->GuruModel = new GuruModel();
    }
    
    
    
    public function index ()
    {
        $data = [
            'guru' => $this->GuruModel->allData(),
        ];
        
        return view('v_guru', $data);
    }

    public function detail ($id_guru) 
    {
        if (!$this->GuruModel->detailData($id_guru)) {
            abort(404);
        }
        $data = [
            'guru' => $this->GuruModel->detailData($id_guru),
        ];
        
        return view('v_detailguru', $data);
    }

    public function add ()
    {
        return view('v_addguru');
    }

    public function insert () {
        Request()-> validate([
            'nip' => 'required|unique:tbl_guru,nip|min:4|max:5',
            'nama_guru' => 'required',
            'mapel' => 'required',
            'foto_guru' => 'required|mimes:jpg,jpeg,bmp,png|max:1024'
        ], [
            'nip.required' => 'wajib diisi!',
            'nip.unique' => 'NIP sudah ada',
            'nip.min' => 'NIP minimal 4 karakter',
            'nip.max' => 'NIP maximal 5 karakter',
            'nama_guru' => 'Nama Guru Wajib di isi',
            'mapel' => 'Mata Pelajaran Wajib di isi',
            'foto_guru' => 'Foto wajib dicantumkan'
        ]
    );


        $file = Request()->foto_guru;
        $fileName = Request()->nip. '.' . $file->extension();
        $file ->move(public_path('foto_guru'), $fileName);

        $data = [
            'nip' => Request() ->nip,
            'nama_guru' => Request() ->nama_guru,
            'mapel' => Request() ->mapel,
            'foto_guru' => Request() ->$fileName,

        ];

        $this->GuruModel->addData($data);
        return redirect()->route('guru')-> with('pesan','Data Berhasil ditambahkan');
    }

    public function edit($id_guru)
    {
        if (!$this->GuruModel->detailData($id_guru)) {
            abort(404);
        }
        $data = [
            'guru' => $this->GuruModel->detailData($id_guru),
        ];
        
        return view('v_editguru', $data);
    }

    public function update ($id_guru) {
        Request()-> validate([
            'nip' => 'required|min:4|max:5',
            'nama_guru' => 'required',
            'mapel' => 'required',
            'foto_guru' => 'required|mimes:jpg,jpeg,bmp,png|max:1024'
        ], [
            'nip.required' => 'wajib diisi!',
            'nip.unique' => 'NIP sudah ada',
            'nip.min' => 'NIP minimal 4 karakter',
            'nip.max' => 'NIP maximal 5 karakter',
            'nama_guru' => 'Nama Guru Wajib di isi',
            'mapel' => 'Mata Pelajaran Wajib di isi',
            'foto_guru' => 'Foto wajib dicantumkan'
        ]
    );


        $file = Request()->foto_guru;
        $fileName = Request()->nip.'.' . $file->extension();
        $file ->move(public_path('foto_guru'), $fileName);

        $data = [
            'nip' => Request() ->nip,
            'nama_guru' => Request() ->nama_guru,
            'mapel' => Request() ->mapel,
            'foto_guru' => Request() ->$fileName,

        ];

        $this->GuruModel->editData($id_guru,$data);
        return redirect()->route('guru')-> with('pesan','Data Berhasil DiUpdate !');
    }

    public function delete($id_guru) {
       
        $guru = $this->GuruModel->detailData($id_guru);
        if ($guru->foto_guru <> ""){
            unlink(public_path('foto_guru') . '/' . $guru->foto_guru);
        }
        $this->GuruModel->deleteData($id_guru);
        return redirect()->route('guru')-> with('pesan','Data Berhasil Dihapus !');
    }
}
