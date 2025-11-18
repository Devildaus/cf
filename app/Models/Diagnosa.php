<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gejala;

class Diagnosa extends Model
{
    use HasFactory;

    protected $guarded = [];

    function Gejala(){
        return $this->belongsTo(Gejala::class);
    }
}
