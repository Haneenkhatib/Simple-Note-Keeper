<?php

namespace App\Http\Controllers;

use App\Exports\excelExport;
use App\Imports\NoteExcel;
use App\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{

    public function importExport()
    {
        return view('index2');
    }
    public function import()
    {
        Excel::import(new NoteExcel(), request()->file('file'));

        return back();
    }
    public function export(){
            return Excel::download(new excelExport, 'notes.xlsx');
    }
//    public function exportToExcel(){
//        $notes=Note::all();
//        $notesData[]=array('Title','Content');
//        foreach ($notes as $note){
//            $notesData[]=array('Title'=>$note->title,'Content'=>$note->content);
//        }
//        Excel::create('notesData', function($excel) use($notesData) {
//            $excel->sheet('ExportFile', function($sheet) use($notesData) {
//                $sheet->fromArray($notesData);
//            });
//        })->export('xls');
//
//
//    }
}
