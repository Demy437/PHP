<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerRequest;
use  Validator;

use Illuminate\Http\Request;
use App\models\Player;


class PlayerController extends Controller
{

  public function updatePlayers($model=null, $id=null) 

{ 

if( $this->validateData($model) )    // checks if data is correct 
    { 

      // updating a record with id equal to the value of $id 

} 

// invalid data provided to update 

} 

 

private function validateData($model) 
{ // used for e.q. POST (adding) en PATCH (updating) 

$rq='\App\Http\Requests\PlayerRequest';        // request to validate submitted data 
    $validator=Validator::make(request()->all(), (array)(new $rq())->rules()); 
    if( $validator->fails() ) 
    {  
            $this->success=false; 
            $this->status=412; 
            $this->message='Invalid submitted data provided for '.ucfirst($model); 
            $this->validation=$validator->errors(); 
             return false;            // is invalid 
    } 

  return true;                          // is valid 

} 

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

      public function createPlayer(PlayerRequest $request) {
        $request->validated();
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

      function dataValidator(Request $req)
      {
        $rules=array(
          "club_id"=>"required|min:2|max:4"
        );
        $validator= Validator::make($req->all(),$rules);
        if($validator->fails())
          {
            return $validator->errors();
          }
          else
          {
            $player = new Player;
            $player->name=$req->name;
            $player->club_id=$req->club_id;
            $result=$player->save();
            if($result)
            {
              return response()->json([
                "message" => "records updated successfully"
              ], 200);
            } 
            else {
              return response()->json([
                "message" => "Player not found"
              ], 404);
            }

          }


      }
}
