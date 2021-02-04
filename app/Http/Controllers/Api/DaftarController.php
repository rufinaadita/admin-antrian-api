<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Daftar;
use App\Models\Antrian;
use Carbon\Carbon;

use Illuminate\Http\Request;

class DaftarController extends Controller
{
    public function getAll()
    {
        // $data = Daftar::all();
        $data = Daftar::with(['users', 'antrians'])->get();

        if($data)
        {
            return response()->json([
                'data' => $data
            ]);
        }

        return response()->json([
            'message' => 'Data tidak ada'
        ]);
    }

    public function show($id)
    {
        $data = Daftar::where('id_user', $id)->with(['users', 'antrians'])->first();
        $current = Daftar::where('status', 'Dilayani')->first();
        $myqueue = Daftar::where('id_user', $id)->first();
        $rest = "";
        $status_antri = "";

        if(isset($myqueue)) {
            if($myqueue['status'] == "Selesai") {
                $rest = "Selesai";
                $status_antri = false;
            } else {
                $rest = $myqueue['nomor_antrian'];
                $status_antri = false;
            }
        } else {
            $rest = "-";
            $status_antri = true;
        }
        
        return response()->json([
            'nomor_antrian' => $rest,
            'status_antri' => $status_antri
        ]);
        
    }

    public function addDaftar(Request $request)
    {
        $nomor = Daftar::select('nomor_antrian')->latest('nomor_antrian')->first();
        $newNumber = 0;
        $status = "";
        $id_antrian = Antrian::select('id')->latest('id')->first();

        if($nomor){
            $newNumber = $nomor['nomor_antrian'] + 1;
            $status = "Mengantri";
        } else {
            $newNumber = 1;
            $status = "Dilayani";
        }
        
        $daftar = Daftar::create([
            'nomor_antrian' => $newNumber,
            'tgl_antri' => Carbon::now(),
            'status' => $status,
            'id_user' => $request->json('id'),
            'id_antrian' => $id_antrian['id'],
        ]);

        if($daftar)
        {
            return response()->json([
                'message' => 'Berhasil Ditambahkan'
            ]);
        }

        return response()->json([
            'message' => 'Gagal'
        ]);
    }

    public function currentQueue()
    {
        $data = Daftar::where('status', 'Dilayani')->first();

        if($data)
        {
            return response()->json([
                'data' => $data
            ]);
        }
        
        return response()->json([
            'data' => [
                'nomor_antrian' => "kosong"
            ]
        ]);
    }

    public function restQueue($id)
    {
        $current = Daftar::where('status', 'Dilayani')->first();
        $myqueue = Daftar::where('id_user', $id)->first();
        $rest = "";
        
        if($myqueue == null || $current == null) {
            $rest = "-";
        } else {
            $rest = $myqueue['nomor_antrian'] - $current['nomor_antrian'];
            if($rest < 0) {
                return response()->json([
                    'rest' => '-'
                ]);
            } 
        }
            if(isset($rest)) {
            return response()->json([
                'rest' => $rest
            ]);
            }
            return response()->json([
                'message' => 'gagal'
            ]);
    }

    public function lastQueue()
    {
        $daftar = Daftar::select('nomor_antrian')->latest('nomor_antrian')->first();
        if($daftar) {
            return response()->json([
                'nomor_antrian' => $daftar['nomor_antrian']
            ]);
        }

        return response()->json([
            'nomor_antrian' => 'kosong'
        ]);
    }
}
