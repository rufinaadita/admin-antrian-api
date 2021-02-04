<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $fillable = [
        'usia',
        'alamat',
        'nohp',
        'gender'
    ];

    protected $hidden = [
        'id',
    ];

    protected $primaryKey = 'id';

    public $timestamps = false;
}
