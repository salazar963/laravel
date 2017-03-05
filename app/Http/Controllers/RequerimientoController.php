<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use \App\Models\Group;
use \App\Models\Section;
use \App\Models\Poll;
use \App\Models\Question;
use Illuminate\Support\Facades\DB;

class RequerimientoController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {

     if(!$request->hasFile('file')){
        //$archivo = $request->file('archivo');
      return response('No hay archivo', 400);
    }

    $file = $request->file('file');
    $nombre = $file->getClientOriginalName();
    //\Storage::disk('local')->put($nombre,  \File::get($file));*/

    $namePall = $request->namePoll;

    Excel::load($file, function($reader) use($namePall, $file){


     $reader->skip(1);
     $result = $reader->noHeading()->get();
     $id = 0;

     $poll = new Poll();
     $poll->name = $namePall; 
     $poll->save();

     foreach ($reader->get() as $encuesta) {

      $aux = Group::where('name' , $encuesta[0])->where('id_pol' , $poll->id)
      ->select('id')->get();

      if (!$aux->isEmpty()){
        $firstUser = $aux->first();
        $id = $firstUser->id;
      }else{
        $group = new Group();
        $group->name = $encuesta[0];
        $group->id_pol = $poll->id;
        $group->save();
        $id = $group->id;
      }

      $aux = Section::where('name' , $encuesta[1])->where('group_id' , $id)
      ->select('id')->get();

      if (!$aux->isEmpty()){
        $firstUser = $aux->first();
        $id = $firstUser->id;
      }else{
        $section = new Section();
        $section->name = $encuesta[1];
        $section->group_id = $id;
        $section->save();
        $id = $section->id;
      }

      $question = new \App\Models\Question();
      $question->name = $encuesta[2];
      $question->section_id = $id;
      $question->save();
      
    }

  });

    return response()->json([
      'msg' => 'Success', 
      ], 200);

  }


  public function listarEncuestas(){

    $data = Poll::select('id', 'name')->get();


    return response()->json([
      'msg' => 'Success', 
      'encuestas' => $data->toArray()
      ], 200);
  }

  public function show($id)
  {
    $data = [];
    $groups = Group::where('id_pol' , $id)->select('id', 'name')->get();
    $poll = Poll::where('id' , $id)->select('name')->first();
    $contador1 = 0;
    $contador2 = 0;
    $dataux = [];

    foreach ($groups as $group) {

      $sections = Section::where('group_id' , $group->id)->select('id', 'name')->get();

      foreach ($sections as $section) {

        $question = Question::where('section_id' , $section->id)->select('id', 'name')->get();
        $dataux[$contador2]['name'] =  $section->name;
        $dataux[$contador2]['questions'] =  $question;
        $contador2++;
      }

      //$data = array_add($data, $contador1, $array2);
      $data[$contador1]['name'] = $group->name;
      $data[$contador1]['sections'] = $dataux;
      $contador1++;
      $dataux = [];

    }

    return response()->json([
      'msg' => 'Success', 
      'encuesta' => $data,
      'namePoll' => $poll->name
      ], 200);
  }

}








