<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailFormLimbah extends Model
{
    use HasFactory;
    public function formLimbah()
    {
        return $this->belongsTo(FormLimbah::class, 'detail_id');
    }
    public function limbah()
    {
        return $this->belongsTo(Limbah::class, 'limbah_id');
    }
}
