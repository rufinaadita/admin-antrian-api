<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AntrianController extends Controller {
    public function getAll()
    {
        $data = Antrian::all();

        if($data) {
            return response()->json([
                'data' => $data
            ]);
        }
        
        return reponse()->json([
            'message' => 'Data Tidak Ada'
        ]);
    }

    public function addAntrian(Request $request)
    {
        $data = [
            'usia' => $request->json('usia'),
            'alamat' => $request->json('alamat'),
            'nohp' => $request->json('nohp'),
            'gender' => $request->json('gender')
        ];

        $antrian = Antrian::create($data);
        
        if ($antrian) {
            return response()->json([
                'message' => 'Berhasil menambahkan antrian !'
            ]);
        }

        return response()->json([
            'message' => 'Gagal Menambahkan'
        ]);
    }
}