<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\Daftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller {

    public function index()
    {
        $data = Daftar::with(['users', 'antrians'])->get()->toArray();
        return view("admin/index", ['data' => $data]);
    }

    public function ubahStatus($id)
    {
        $daftar = Daftar::where('id', $id)->with(['users', 'antrians'])->first();
        $daftar->status = "Selesai";
        $daftar->save();
        
        $newAntri = $daftar['nomor_antrian'] + 1;
        $daftarNew = Daftar::where('nomor_antrian', $newAntri)->first();
        if($daftarNew) {
            $daftarNew->status = "Dilayani";
            $daftarNew->save();
        }

        return redirect('admin');
        
    }

    public function resetAntrian()
    {
        Daftar::getQuery()->delete();
        Antrian::getQuery()->delete();

        return redirect('admin');
    }
    
}