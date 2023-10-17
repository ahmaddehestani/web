<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cycle extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable= [
        'product_id',
        'plan_id',
        'name',
        'price',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
     }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
     }
}
