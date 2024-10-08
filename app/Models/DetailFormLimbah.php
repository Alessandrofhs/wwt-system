<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailFormLimbah extends Model
{
    use HasFactory;
    protected $table = 'tr_detail_form_limbahs';
    protected $fillable = [
        'form_limbah_id',
        'limbah_id',
        'quantity',
        'unit',
        'description',
        'photo'
    ];
    public function formLimbah()
    {
        return $this->belongsTo(FormLimbah::class, 'form_limbah_id');
    }
    public function limbah()
    {
        return $this->belongsTo(Limbah::class, 'limbah_id');
    }
}
