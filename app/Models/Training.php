<?php

namespace App\Models;

use App\Models\Rating;
use App\Models\Classification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Training extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with =['classification', 'rating'];

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }
    public function rating()
    {
        return $this->belongsTo(Rating::class);
    }
}
