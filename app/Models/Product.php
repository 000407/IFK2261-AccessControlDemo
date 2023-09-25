<?php

namespace App\Models;

use App\Enums\Status;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => Status::class
    ];

    public function locations(): BelongsToMany
    {
      return $this->belongsToMany(Location::class, 'location_product_stock')
        ->withTimestamps();
    }
}
