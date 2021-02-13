<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'ad';
    protected $fillable = [
        'ad_title',
        'ad_start_date',
        'ad_end_date',
        'ad_daily_price',
        'ad_total_price',
    ];


//    public function adImages() {
//        return $this->hasMany(AdImage::class);
//    }
}
