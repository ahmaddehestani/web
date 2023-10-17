<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    use Uuid;
    protected $fillable= [
        'uuid',
        'category_id',
        'url',
        'title',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
