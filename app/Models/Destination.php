<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;
    protected $table = 'tm_destinations';
    protected $fillable = [
        'nama_destinasi'
    ];
    public function formLimbah()
    {
        return $this->hasMany(FormLimbah::class, 'destination_id');
    }
}
