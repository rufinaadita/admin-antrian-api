<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_antrian',
        'tgl_antri',
        'status',
        'id_user',
        'id_antrian'
    ];

    protected $relation = [
        'antrians',
        'users'
    ];

    protected $hidden = [
        'id_user',
        'id_antrian'
    ];

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'id_user', 'id');
    }
    public function antrians()
    {
        return $this->belongsTo('App\Models\Antrian', 'id_antrian', 'id');
    }
}
