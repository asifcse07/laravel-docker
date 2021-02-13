<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdImage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ad_images';
    protected $fillable = [
        'ad_id',
        'image_name',
    ];


//    public function ads() {
//        return $this->belongsTo(Ad::class);
//    }
}
