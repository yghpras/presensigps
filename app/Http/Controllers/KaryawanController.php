<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Karyawan;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

class KaryawanController 
{
    public function index(Request $request) 
    {
        $query = Karyawan::query();
        $query->select('karyawan.*', 'nama_dept');
        $query ->join('departemen', 'karyawan.kode_dept', '=', 'departemen.kode_dept');
        $query->orderBY('nama_lengkap');
        if(!empty($request->nama_karyawan)){
            $query->where('nama_lengkap','like','%'.$request->nama_karyawan. '%');
        }
        if(!empty($request->kode_dept)){
            $query->where('karyawan.kode_dept', $request->kode_dept);
        }
        $karyawan = $query->paginate(10);

        $departemen = DB::table('departemen')->get();
        return view('karyawan.index', compact('karyawan', 'departemen'));
    }

    public function store(Request $request){
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_dept = $request->kode_dept;
        $password = Hash::make('12345');
        if ($request->hasFile('foto')) {
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }

        try{
            $data = [
                'nik' => $nik,
                'nama_lengkap' => $nama_lengkap,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
                'kode_dept' => $kode_dept,
                'foto' => $foto,
                'password' => $password
            ];
            $simpan = DB::table('karyawan')->insert($data);
            if($simpan){
                if($request->hasFile('foto')){
                    $folderPath = "public/uploads/karyawan/";
                    $request->file('foto')->storeAs($folderPath, $foto, 'public');
                }
                
                return Redirect::back()->with('success', 'Data Berhasil Disimpan');
            }
        } catch(\Exception $e) {
            if($e->getCode()==23000){
                $message="Data dengan Nik ".$nik. " Sudah ada";
            }
            return Redirect::back()->with('warning', 'Data Gagal Disimpan'.$message);

        }
    }

    public function edit(Request $request){
        $nik = $request->nik;
        $departemen = DB::table('departemen')->get();
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        return view('karyawan.edit', compact('departemen', 'karyawan'));
    }

    public function update($nik, Request $request)
    {
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_dept = $request->kode_dept;
        $password = Hash::make('12345');
        $old_foto = $request->old_foto;
        if ($request->hasFile('foto')) {
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $old_foto;
        }

        try{
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
                'kode_dept' => $kode_dept,
                'foto' => $foto,
                'password' => $password
            ];
            $update = DB::table('karyawan')->where('nik', $nik)->update($data);
            if ($update) {
                if ($request->hasFile('foto')) {
                    $folderPath = public_path("uploads/karyawan/");
                    $folderPathOld = public_path("uploads/karyawan/" . $old_foto);
            
                    // Hapus file lama jika ada
                    if (file_exists($folderPathOld)) {
                        unlink($folderPathOld);
                    }
            
                    // Simpan file baru
                    $request->file('foto')->move($folderPath, $foto);
                }
            
                return Redirect::back()->with('success', 'Data Berhasil Diupdate');
            }
        } catch(\Exception $e) {
            // dd($e-message);
            return Redirect::back()->with('warning', 'Data Gagal Diupdate');
        }
    }

    public function delete($nik)
    {
        $delete = DB::table('karyawan')->where('nik',$nik)->delete();
        if($delete){
            return Redirect::back()->with(['succes' => 'Data Berhasil DIhapus']);
        }else{
            return Redirect::back()->with(['warnig' => 'Data Gagal DIhapus']);
        }
    }

}
