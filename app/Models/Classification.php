<?php

namespace App\Models;

use App\Models\Testing;
use App\Models\Training;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classification extends Model
{
    use HasFactory;

     protected $guarded = ['id'];

      public function training()
    {
        return $this->hasMany(Training::class);
    }

      public function testing()
    {
        return $this->hasMany(Testing::class);
    }

}
