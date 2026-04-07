<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aspirasi extends Model
{
    protected $table = 'table_aspirasi';

    protected $fillable = [
        'input_aspirasi_id',
        'status',
        'id_kategori',
        'feedback',
    ];

    public function inputAspirasi(): BelongsTo
    {
        return $this->belongsTo(InputAspirasi::class, 'input_aspirasi_id');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
