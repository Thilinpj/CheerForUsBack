<?php

namespace App\Http\Controllers;

use App\adminArticles;
use Illuminate\Http\Request;

class Articles extends Controller
{
    public function articleStore(Request $request){

        $article=new adminArticles();
        $article->caption = $request->caption;
        $article->img = $request->Input('img');
        $article->description = $request->description;
        $article->save();
        $articles=adminArticles::all();

        //$response = array('response'=>'Article added successfully!','success'=>true);
//            $this->validate($request,[
//    'caption'=>'required',
//   'description'=>'required',
//     ]);
    return response()->json($articles) ;
    }
    public function articleDelete($id){
        
        adminArticles::where('id',$id)->delete();
       $response =array('response'=>'Article deleted!','success'=>true);
       return $response;
    }

    public function getArticle($id){
$select = adminArticles::where('id',$id)->get();
return response()->json($select);

    }
}
