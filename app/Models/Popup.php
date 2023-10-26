<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'is_enabled',
    ];

    public function popupmetadata() {
        return $this->hasOne(PopupMetadata::class);
    }
}
