<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request){
        Like::create([
                'post_id' => $request->post_id,
                'user_id' => $request->user_id,
                'like' => 1

        ]);
        return back();
    }
    public function destroy(Like $like){
        $like->delete();
           return back();
       }
}
