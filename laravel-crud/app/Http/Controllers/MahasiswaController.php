<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $mahasiswa = DB::table('mahasiswa')->get();
        return view('index', ['mahasiswa' => $mahasiswa]);
    }
    
    public function tambah(){
        return view('tambah');
    }

    public function simpan(Request $request){
        $this->validate($request, [
            'namamhs' => 'required',
            'nimmhs' => 'required|numeric',
            'emailmhs' => 'required|email',
            'jurusanmhs' => 'required'

        ]);

        DB::table('mahasiswa')->insert([
            'nama' => $request->namamhs,
            'nim' => $request->nimmhs,
            'email' => $request->emailmhs,
            'jurusan' => $request->jurusanmhs
        ]);
        return view('simpan', ['data' => $request]);
        // return redirect('/mahasiswa', ['data' => $request]);
    }

    public function detail($id){
        //mengambil data mahasiswa berdasarkan id yang dipilih
        $mahasiswa = DB::table('mahasiswa')->where('id',$id)->get();
        //kirim data mahasiswa yang diambil ke view edit.blade.php
        return view('detail',['mahasiswa' => $mahasiswa]);
    }

    public function edit($id){
        //mengambil data mahasiswa berdasarkan id yang dipilih
        $mahasiswa = DB::table('mahasiswa')->where('id',$id)->get();
        //kirim data mahasiswa yang diambil ke view edit.blade.php
        return view('edit',['mahasiswa' => $mahasiswa]);
    }

    public function update(Request $request){
        //update data mahasiswa
        DB::table('mahasiswa')->where('id',$request->id)->update([
            'nama' => $request->namamhs,
            'nim' => $request->nimmhs,
            'email' => $request->emailmhs,
            'jurusan' => $request->jurusanmhs 
        ]);
        return redirect('/mahasiswa');
    }

    public function hapus($id){
        //menghapus data mahasiswa berdasarkan id yang dipilih
        DB::table('mahasiswa')->where('id',$id)->delete();

        return redirect('/mahasiswa');
    }

}
