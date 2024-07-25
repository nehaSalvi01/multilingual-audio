<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AudioFile extends Model
{
    use HasFactory;
    protected $fillable = ['language', 'file_path', 'collection_id'];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
}
