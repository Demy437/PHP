<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ArticleController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
$articles = Article::all();
return response()->json([
"success" => true,
"message" => "Article List",
"data" => $articles
]);
}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
$input = $request->all();
$validator = Validator::make($input, [
'name' => 'required',
'detail' => 'required'
]);
if($validator->fails()){
return $this->sendError('Validation Error.', $validator->errors());       
}
$article = Article::create($input);
return response()->json([
"success" => true,
"message" => "Article created successfully.",
"data" => $article
]);
} 
/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
$article = Article::find($id);
if (is_null($article)) {
return $this->sendError('Article not found.');
}
return response()->json([
"success" => true,
"message" => "Article retrieved successfully.",
"data" => $article
]);
}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, Article $article)
{
$input = $request->all();
$validator = Validator::make($input, [
'name' => 'required',
'detail' => 'required'
]);
if($validator->fails()){
return $this->sendError('Validation Error.', $validator->errors());       
}
$article->name = $input['name'];
$article->detail = $input['detail'];
$article->save();
return response()->json([
"success" => true,
"message" => "Article updated successfully.",
"data" => $article
]);
}
/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy(Article $article)
{
$article->delete();
return response()->json([
"success" => true,
"message" => "Article deleted successfully.",
"data" => $article
]);
}
}