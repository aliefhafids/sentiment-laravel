<?php

namespace App\Imports;

use App\Models\Testing;
use Maatwebsite\Excel\Concerns\ToModel;

class UjiImport implements ToModel
{
   /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Testing([
            'review' => $row[1],
            'rating_id' => $row[2],
            'classification_id' => $row[3],
            'sysclassification_id' => $row[4],
        ]);
    }
}
