<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Limbah extends Model
{
    use HasFactory;
    protected $table = 'limbah';
    protected $fillable = ([
        'kode_limbah',
        'nama_limbah'
    ]);
    public function detailFormLimbah()
    {
        return $this->hasMany(DetailFormLimbah::class, 'limbah_id');
    }
}
