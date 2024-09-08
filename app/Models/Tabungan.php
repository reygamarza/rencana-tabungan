<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    use HasFactory;

    protected $table = 'tabungans';

    protected $fillable = [
        'id_user', 'judul', 'foto', 'target_nominal', 'target_tanggal', 'nominal_terkumpul', 'status_tercapai'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menabung()
    {
        return $this->hasMany(Menabung::class);
    }

    public $timestamps = false;
}
