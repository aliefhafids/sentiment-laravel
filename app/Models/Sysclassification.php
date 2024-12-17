<?php

namespace App\Models;

use App\Models\Testing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sysclassification extends Model
{
    use HasFactory;

     protected $guarded = ['id'];

      public function testing()
    {
        return $this->hasMany(Testing::class);
    }
}
