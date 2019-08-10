<?php

namespace App\Exports;

use App\Note;
use Maatwebsite\Excel\Concerns\FromCollection;

class excelExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Note::get();
    }
}
