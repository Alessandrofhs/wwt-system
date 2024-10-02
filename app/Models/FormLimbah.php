<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormLimbah extends Model
{
    use HasFactory;
    protected $fillable = [
        'destination_id',
        'license_plate',
    ];
    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
    public function details()
    {
        return $this->hasMany(DetailFormLimbah::class, 'form_limbah_id');
    }
}
