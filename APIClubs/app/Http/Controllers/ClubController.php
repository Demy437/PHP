<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;


class ClubController extends Controller
{

    public function index()
    {
        $response = Http::get('http://127.0.0.1:8000/api/clubs');
        $clubs = json_decode($response->getBody());
        return view('clubs.index', compact('clubs'));
    }
     
    public function create()
    {
        return view('clubs.create');
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Http::post('http://127.0.0.1:8000/api/clubs', $request->all());
     
        return redirect()->route('clubs.index')->with('success','Club created successfully.');
    }
     
    public function show($id)
    {
        $response = Http::get('http://127.0.0.1:8000/api/clubs/' . $id);
        $club = head(json_decode($response->getBody()));
        return view('clubs.show', compact('club'));
    } 

    public function edit($id)
    {
        $response = Http::get('http://127.0.0.1:8000/api/clubs/' . $id);
        $club = head(json_decode($response->getBody()));
        return view('clubs.edit',compact('club'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
    
        Http::put('http://127.0.0.1:8000/api/clubs/' . $id, $request->all());

        return redirect()->route('clubs.index')->with('success','Club updated successfully');
    }
  
    public function destroy($id)
    {
        Http::delete('http://127.0.0.1:8000/api/clubs/' . $id);

        return redirect()->route('clubs.index')->with('success','Club deleted successfully');
    }
}
