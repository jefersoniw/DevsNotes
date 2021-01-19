<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;

class NoteController extends Controller
{   
    private $array = ['error' => '', 'result' => [] ];
    
    // LISTANDO TODAS AS NOTAS
    public function all(){
        $notes = Note::all();

        foreach($notes as $note){   
            $this->array['result'][] = [
                'id' => $note->id,
                'tittle' => $note->title
            ];
        }

        return $this->array;
    }

    //PEGANDO APENAS UMA NOTA
    public function one($id){
        $note = Note::find($id);

        if($note){
            $this->array['result'] = $note;
        }else{
            $this->array['error'] = 'ID NÃO ENCONTRADO!!!';
        }

        return $this->array;
    }

    //ADICIONANDO UMA NOTA
    public function new(Request $request){
        $title = $request->input('title');
        $body = $request->input('body');

        if ($title && $body){
            
            $note = new Note();
            $note->title = $title;
            $note->body = $body;
            $note->save();

            //retornando para quando fizer o teste da api
            $this->array['result'] = [
                'id' => $note->id,
                'title' => $title,
                'body' => $body
            ];

        }else{
            $this->array['error'] = 'CAMPOS NÃO ENVIADOS';
        }
        
        return $this->array;
    }

    //EDITANDO UMA NOTA
    public function edit(Request $request, $id){
        $title = $request->input('title');
        $body = $request->input('body');

        if($id && $title && $body){

            $note = Note::find($id);

            if($note){

                $note->title = $title;
                $note->body = $body;
                $note->save();

                $this->array['result'] = [
                    'id' => $id,
                    'title' => $title,
                    'body' => $body
                ];

            }else{
                $this->array['error'] = 'Nota não existe';
            }

        }else{
            $this->array['error'] = 'Campos não enviados';
        }

        return $this->array;
    }
}
