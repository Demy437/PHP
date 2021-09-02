<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class PlayerController extends Controller
{

    // public function index()
    // {
    //     $response = Http::get('http://127.0.0.1:8000/api/clubs');
    //     $clubs = json_decode($response->getBody());
    //     return view('clubs.index',compact('clubs'));

    // }
     
    public function create(Request $request)
    {
        return view('players.create', ['club_id' =>$request->club_id]);
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Http::post ('http://127.0.0.1:8000/api/players', $request->all());
     
        return redirect()->route('clubs.show', $request->club_id)->with('success','Player created successfully.');
    }
     
    public function show($id)
    {
        $response = Http::get('http://127.0.0.1:8000/api/players/' . $id);
        $player = head(json_decode($response->getBody()));
        return view('players.show',compact('player'));
    } 

    public function edit($id)
    {
        $response = Http::get('http://127.0.0.1:8000/api/players/' . $id);
        $player = head(json_decode($response->getBody()));
        return view('players.edit',compact('player'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
    
        $response = Http::get('http://127.0.0.1:8000/api/players/' . $id);
        $player = head(json_decode($response->getBody()));
        $club_id = $player->club_id;

        Http::put('http://127.0.0.1:8000/api/players/' . $id, $request->all());

        return redirect()->route('clubs.show', $club_id)->with('success','Player updated successfully');
    }
  
    public function destroy(Request $request ,$id)
    {
        $response = Http::get('http://127.0.0.1:8000/api/players/' . $id);
        $player = head(json_decode($response->getBody()));
        $club_id = $player->club_id;

        Http::delete('http://127.0.0.1:8000/api/players/' . $id);

        return redirect()->route('clubs.show', $club_id)->with('success','Player deleted successfully');
    }
}
