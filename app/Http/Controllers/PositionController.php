<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Position;
use App\Snippet;
use App\Api;

class PositionController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');
    }
  
    public function index(){
      //return Position::all();
      return response()->json(
        Position::all()
      )->withHeaders([
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => '*',
                'Access-Control-Allow-Headers' => '*',
            ]);
    }
  
    public function create(){
      return response()->json(
      Position::create([
        'snippet_id' => request()->snippet_id or 0,
        'url' => request()->url or '',
        'element_id' => request()->element_id or '',
        'element_class' => request()->element_class or '',
        'location' => request()->location or '',
        'alignment' => request()->alignment or '',
      ])
      )->withHeaders([
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => '*',
                'Access-Control-Allow-Headers' => '*',
            ]);
    }
  
    public function remove(){
      return Position::find(request()->id)->delete();
    }
  
    public function search(){
      return Position::where('url', request()->url)->get();
    }
  
    public function snippets(){
        return response()->json(
          Api::all()
        )->withHeaders([
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => '*',
                'Access-Control-Allow-Headers' => '*',
            ]);
    }
  
    public function update($id){
      return response()->json( 
        Position::find($id)->update([
        'snippet_id' => request()->snippet_id or 0,
        'url' => request()->url or '',
        'element_id' => request()->element_id or '',
        'element_class' => request()->element_class or '',
        'location' => request()->location or '',
        'alignment' => request()->alignment or '',
      ])
      )->withHeaders([
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => '*',
                'Access-Control-Allow-Headers' => '*',
            ]);
    }
}
