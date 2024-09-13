<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormLimbah extends Model
{
    use HasFactory;
    protected $fillable = [
        'destination_id',
        'no_policy',
        'no_truck',
        'description',
        'photo',
    ];
    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
    public function detailLimbah()
    {
        return $this->hasMany(DetailFormLimbah::class, 'form_limbah_id');
    }
}
