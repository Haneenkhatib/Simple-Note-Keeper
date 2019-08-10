<?php

namespace App\Imports;

use App\Note;
use Maatwebsite\Excel\Concerns\ToModel;

class NoteExcel implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Note([
            'title'=>$row[1],
            'content'=>$row[2],
            'note_image'=>$row[3],
            'created_at'=>$row[4],
            'updated_at'=>$row[5],

        ]);
    }
}
