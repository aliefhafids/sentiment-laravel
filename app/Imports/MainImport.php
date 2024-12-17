<?php

namespace App\Imports;

use App\Models\Dataset;
use Maatwebsite\Excel\Concerns\ToModel;

class MainImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Dataset([
            'review' => $row[1],
            'rating_id' => $row[2],
            'classification_id' => $row[3],
        ]);
    }
}
