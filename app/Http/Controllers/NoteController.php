<?php

namespace App\Http\Controllers;

use App\Note;
use App\Notifications\createNote;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\StoreImageTrait;
use App\Traits\ImgaeUpload;
use Illuminate\Support\Facades\Validator;
use Mockery\Matcher\Not;
use PDF;


class NoteController extends Controller
{
    use ImgaeUpload,Notifiable; //Using our created Trait to access inside trait method

//    use StoreImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {

            return datatables()->of(
                Note::latest()->get())
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('Note.index2');
//        $notes = DB::table('notes')
//            ->orderBy('created_at', 'desc')
//            ->get();
//        return view('Note.index',["notes"=>$notes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        return view('Note.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'title'    =>  'required',
            'content'     =>  'required',
            'image'         =>  'required|image|max:2048'
        );


        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

//        $image = $request->file('image');
            $request->image=$this->UserImageUpload($request['image'],'notes');

//        $new_name = rand() . '.' . $image->getClientOriginalExtension();
//
//        $image->move(public_path('images'), $new_name);

        $form_data = array(
            'title'        =>  $request->title,
            'content'         =>  $request->content,
            'note_image'             =>  $request->image
        );

        Note::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);

//        $data=$request->validate($this->rules(),$this->messages());
////                dd($data);
//
//        if($data) {
//
////            $request['image']=$this->verifyAndStoreImage($request, 'image', 'notes');
//            $request->image=$this->UserImageUpload($request['image'],'notes');
//
////            $filePath = $this->UserImageUpload($data->image); //Passing $data->image as parameter to our created method
////            $data->image = $filePath;
////            $data->save();
////            return redirect()->back();
//
////            dd($request->all());
//            $note = new Note();
//            $note->title=$request->title;
//            $note->content=$request->content;
//            $note->note_image=$request->image;
////            dd($note);
//            $note->save();
//
//            Auth::user()->notify(new createNote($note));
//
//            return redirect()->route('notes.index');

    }
    public function pdf(){

        $data['first'] = 'Notes List';
        $data['notes'] =  Note::get();

        $pdf = PDF::loadView('Note.list_notes', $data);

        return $pdf->download('tuts_notes.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Note::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $image_name = $request->hidden_image;
        $image = $request->file('image');
        if ($image != '') {
            $rules = array(
                'title' => 'required',
                'content' => 'required',
                'image' => 'required|image|max:2048'
            );
            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $image_name= $this->UserImageUpload($request['image'], 'notes');

        } else {
            $rules = array(
                'title' => 'required',
                'content' => 'required',
            );

            $error = Validator::make($request->all(), $rules);

            if ($error->fails()) {
                return response()->json(['errors' => $error->errors()->all()]);
            }
        }

        $form_data = array(
            'title' => $request->title,
            'content' => $request->content,
            'note_image' => $image_name
        );
        Note::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }
//    }public function update(Request $request, $id)
//    {
//        $image_name = $request->hidden_image;
//        $image = $request->file('image');
//        if($image != '')
//        {
//            $rules = array(
//                'title'    =>  'required',
//                'content'     =>  'required',
//                'image'         =>  'required|image|max:2048'
//            );
//            $error = Validator::make($request->all(), $rules);
//            if($error->fails())
//            {
//                return response()->json(['errors' => $error->errors()->all()]);
//            }
//
//            $request->image=$this->UserImageUpload($request['image'],'notes');
//
//        }
//        else
//        {
//            $rules = array(
//                'title'    =>  'required',
//                'content'     =>  'required',
//            );
//
//            $error = Validator::make($request->all(), $rules);
//
//            if($error->fails())
//            {
//                return response()->json(['errors' => $error->errors()->all()]);
//            }
//        }
//
//        $form_data = array(
//            'title'        =>  $request->title,
//            'content'         =>  $request->content,
//            'note_image'             =>  $request->image
//        );
//        Note::whereId($request->hidden_id)->update($form_data);
//
//        return response()->json(['success' => 'Data is successfully updated']);
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Note::findOrFail($id);
        $data->delete();
    }
    private function rules(){
        return[
            'title'=>'required',
            'content'=>'required',
            'image'=>'required|mimes:jpeg,bmp,png,jpg'
        ];
    }
    private function messages(){
        return[
            'title.required' => 'Title is required',
            'content.required' => 'Content is required',
            'image.required' => 'Image is required',
            'image.mimes' => 'Invalid image'
        ];

    }


//    public function test()
//    {
//        DB::table('notes')->orderBy('created_at')->chunk(10,function ($notes){
//            foreach ($notes as $note){
//                echo $note ->title;
//            }
//        });
//    }
}
