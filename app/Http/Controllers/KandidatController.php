<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Kandidat;

class KandidatController extends Controller
{
    public function __contruct(){
        $this->middleware('auth');
    }

    public function index(){
        $kandidat = DB::table('kandidat')->get();
        return view('dashboard.kandidat.kandidat',[
            'kandidat' => $kandidat
        ]);
    }

    public function tambah(){
        return view('dashboard.kandidat.tambah');
    }

    public function store(Request $data){
        $file       = $data->file('gambar');
        $oriname    = $data->file('gambar')->getClientOriginalName();
        $nama_file  = time()."_".$oriname;
        $file->move(public_path('foto_kandidat/'), $nama_file);

        DB::table('kandidat')->insert([
            'nama'          => $data->nama,
            'visi'          => $data->visi,
            'misi'          => $data->misi,
            'periode'       => 1,
            'gambar'        => $nama_file,
            'jumlah_suara'  => 0
        ]);
        return redirect('/admin/kandidat');
    }

    public function detail($id){
        $detailkandidat = Kandidat::find($id);
        return view('dashboard.kandidat.edit',[
            'edit' => $detailkandidat
        ]);
    }

    public function update($id, Request $data){
        $edit = Kandidat::find($id);
        $edit->nama = $data->nama;
        $edit->visi = $data->visi;
        $edit->misi = $data->misi;
        $edit->save();
        return redirect('/admin/kandidat/detail/'.$id);
    }

    public function hapus($id){
        $kandidat = Kandidat::find($id);
        $kandidat->delete();
        return redirect('/admin/kandidat');
    }
}
