<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopupMetadata extends Model
{
    use HasFactory;

    protected $fillable = [
        'popup_id',
        'shows',
        'link',
        'path'
    ];

    public function popup() {
        return $this->belongsTo(Popup::class);
    }
}
