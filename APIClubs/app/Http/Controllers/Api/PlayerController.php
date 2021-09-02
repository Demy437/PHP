<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Player;


class PlayerController extends Controller
{
    public function getAllPlayers() {
        $players = Player::get()->toJson(JSON_PRETTY_PRINT);
        return response($players, 200);
      }

      public function getPlayer($id) {
        if (Player::where('id', $id)->exists()) {
          $player = Player::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
          return response($player, 200);
        } else {
          return response()->json([
            "message" => "Player not found"
          ], 404);
        }
      }

      public function createPlayer(Request $request) {
        $player = new Player;
        $player->name = $request->name;
        $player->club_id = $request->club_id;
        $player->save();
  
        return response()->json([
          "message" => "Player record created"
        ], 201);
      }

      public function updatePlayer(Request $request, $id) {
        if (Player::where('id', $id)->exists()) {
          $player = Player::find($id);
  
          $player->name = is_null($request->name) ? $player->name : $request->name;
          $player->club_id = is_null($request->club_id) ? $player->club_id : $request->club_id;
          $player->save();
  
          return response()->json([
            "message" => "records updated successfully"
          ], 200);
        } else {
          return response()->json([
            "message" => "Player not found"
          ], 404);
        }
      }

      public function deletePlayer ($id) {
        if(Player::where('id', $id)->exists()) {
          $player = Player::find($id);
          $player->delete();
  
          return response()->json([
            "message" => "records deleted"
          ], 202);
        } else {
          return response()->json([
            "message" => "Player not found"
          ], 404);
        }
      }
}
