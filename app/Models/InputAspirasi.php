<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InputAspirasi extends Model
{
    protected $table = 'table_input_aspirasi';

    protected $fillable = [
        'user_id',
        'id_kategori',
        'lokasi',
        'keterangan',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function aspirasi(): HasOne
    {
        return $this->hasOne(Aspirasi::class, 'input_aspirasi_id');
    }
}
