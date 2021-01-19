<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;

class NoteController extends Controller
{
    private $array = ['error' => '', 'result' => [] ];
    
    public function all(){
        $notes = Note::all();

        foreach($notes as $note){   
            $this->array['result'][] = [
                'id' => $note->id,
                'tittle' => $note->tittle
            ];
        }

        return $this->array;
    }
}
