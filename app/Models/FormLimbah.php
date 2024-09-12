<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormLimbah extends Model
{
    use HasFactory;
    protected $table = 'form_limbah';
    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
    public function detailFormLimbah()
    {
        return $this->hasOne(DetailFormLimbah::class, 'detail_id');
    }
}
