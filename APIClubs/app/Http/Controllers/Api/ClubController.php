<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Club;

class ClubController extends Controller
{
    public function getAllClubs() {
        $clubs = Club::get()->toJson(JSON_PRETTY_PRINT);
        return response($clubs, 200);
      }

      public function getClub($id) {
        if (Club::where('id', $id)->exists()) {
          $club = Club::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
          return response($club, 200);
        } else {
          return response()->json([
            "message" => "Club not found"
          ], 404);
        }
      }

      public function createClub(Request $request) {
        $club = new Club;
        $club->name = $request->name;
        $club->save();
  
        return response()->json([
          "message" => "Club record created"
        ], 201);
      }

      public function updateClub(Request $request, $id) {
        if (Club::where('id', $id)->exists()) {
          $club = Club::find($id);
  
          $club->name = is_null($request->name) ? $club->name : $request->name;
          $club->save();
  
          return response()->json([
            "message" => "records updated successfully"
          ], 200);
        } else {
          return response()->json([
            "message" => "Club not found"
          ], 404);
        }
      }

      public function deleteClub ($id) {
        if(Club::where('id', $id)->exists()) {
          $club = Club::find($id);
          $club->delete();
  
          return response()->json([
            "message" => "records deleted"
          ], 202);
        } else {
          return response()->json([
            "message" => "Club not found"
          ], 404);
        }
      }
}
