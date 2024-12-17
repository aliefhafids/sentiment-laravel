<?php

namespace App\Models;

use App\Models\Result;
use App\Models\Dataset;
use App\Models\Testing;
use App\Models\Training;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rating extends Model
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

     public function result()
    {
        return $this->hasMany(Result::class);
    }

     public function datasets()
    {
        return $this->hasMany(Dataset::class);
    }

}
