<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;
use Carbon\Carbon;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
    {
        $groupId = Word::where('word', $request->search)->value('group_id');
        $data = Word::where('group_id', $groupId)->get()->toArray();
        
        return $data;
    }

    public function getWords(Request $request)
    {
        $searchWord = Word::where('word',$request->search)->first();
        
        // if search is not found then we dont need all synonyms
        if(!$searchWord){
            $data = Word::selectRaw('word')->get()->toArray();
        }else{
            $groupId = Word::where('word',$request->search)->value('group_id');    ;       
            $data = Word::where('group_id',$groupId)->get()->toArray();
        }
        
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request )
    {
        // generate random id
        $group_id = Carbon::now()->format('YmdHis');

        //gather all synonyms sent
        foreach($request->selected as $selected){
            $synonyms[] = $selected['word'];
        };

        //get group_id of all synonyms 
        $allSynonymsGroups = Word::whereIn('word',$synonyms)->pluck('group_id')->toArray();

        //update with the new group id
        Word::whereIn('group_id',$allSynonymsGroups)->update([
            'group_id' => $group_id
        ]);
        
        // check if the word is present, if not add else update the group id
        Word::updateOrCreate(
            ['word' => $request->word], 
            ['group_id' => $group_id]
        );

        // update group_id of all synonyms
        foreach($request->selected as $selected){               
            Word::updateOrCreate(
                ['word' => $selected['word'],], 
                ['group_id' => $group_id]
            );            
        }
    }


    public function delete(Request $request)
    {
        Word::find($request->id)->delete();
    }
}
