<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penyakit;

class Pasien extends Model
{
    use HasFactory;

    protected $guarded = [];

    function penyakit(){
        return $this->belongsTo(Penyakit::class);
    }
}
