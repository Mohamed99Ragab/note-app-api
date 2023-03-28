<?php

namespace App\Http\Controllers;

use App\Http\Traits\HttpResponse;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{

    use HttpResponse;
    public function index()
    {

        $user = User::find(Auth::id());

        $notes = Note::where('user_id',$user->id)->get();

        if(isset($notes) && $notes->count()>0){
            return $this->responseJson($notes,null,true);

        }
        return $this->responseJson(null,"Not Found Added Notes Yet .",false);




    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        Note::create([
            'note'=>$request->note,
            'desc'=>$request->desc,
            'user_id'=>Auth::id()
        ]);

        return $this->responseJson(null,'Note Added Successfully',true);
    }


    public function show($note_id)
    {
        $note = Note::find($note_id);

        return $this->responseJson($note,null,true);


    }


    public function edit(Note $note)
    {

    }


    public function update(Request $request, $note_id)
    {
        $note = Note::find($note_id);
        $note->update([
            'note'=>$request->note,
            'desc'=>$request->desc
        ]);

        return $this->responseJson(null,'Note Updated Successfully',true);
    }


    public function destroy($note_id)
    {
        Note::destroy($note_id);
        return $this->responseJson(null,'Note Deleted Successfully',true);


    }
}
