<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request){
        // dd('hit');
        $request->validate([
            'body' => 'required',
        ]);
        $comment=new Comment();
        $comment->body=$request->body;
        $comment->blog_id=$request->blog_id;
        $comment->user_id=Auth::user()->id;
        $comment->save();
        return redirect()->back();
    }
}
