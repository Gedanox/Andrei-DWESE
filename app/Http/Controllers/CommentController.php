<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller {

    public function create(Request $request) {
        $request->session()->put(['post'=> $request->input('idpost')]);
        return view('comment.create');
    }
    
    public function index() {
        $posts = Post::all();
        return view('post.index', ['posts' => $posts]);
    }

    public function destroy(Comment $comment) {
            $timedif =  Carbon::now()->diff($comment->created_at);
            $min = intval($timedif->format('%i'));
            
            if( $comment->iduser == Auth::id() && $min<1){
                $comment->delete();
                return back();   
            }else if ($min>1){
                return back()->withErrors(['message' => 'Time passed!']); 
            }else{
                return back()->withErrors(['message' => 'Not your comment.']); 
            }
    }

    public function edit(Comment $comment) {

    }

    public function store(Request $request) {
        $comment = new Comment($request->all());
        $comment->iduser = Auth::id();
        $comment->save();
        return redirect('post/' . $comment->postid);
    }

    public function update(Request $request, Comment $comment) {
        
}