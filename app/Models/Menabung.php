<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menabung extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tabungan', 'nominal', 'tanggal_menabung'
    ];

    public function tabungan()
    {
        return $this->belongsTo(Tabungan::class);
    }

    public $timestamps = false;
}
