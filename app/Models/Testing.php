<?php

namespace App\Models;

use App\Models\Rating;
use App\Models\Classification;
use App\Models\Sysclassification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testing extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
      protected $with = ['classification', 'sysclassification', 'rating'];

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }
    
    public function sysclassification()
    {
        return $this->belongsTo(Sysclassification::class);
    }

    public function rating()
    {
        return $this->belongsTo(Rating::class);
    }
}
