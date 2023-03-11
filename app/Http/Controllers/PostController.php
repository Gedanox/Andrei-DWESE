<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;

class PostController extends Controller {

    public function create() {
        return view('post.create');
    }

    public function destroy(Post $post) {
            $timedif =  Carbon::now()->diff($post->created_at);
            $min = intval($timedif->format('%i'));
            
            if( $post->iduser == Auth::id() && $min<1){
                $post->delete();
                return back();
            }else if ($min>1){
                return back()->withErrors(['message' => 'Time passed!']); 
            }else{
                return back()->withErrors(['message' => 'Not your post.']); 
            }
    }

    public function edit(Post $post) {
            $timedif =  Carbon::now()->diff($post->created_at);
            $min = intval($timedif->format('%i'));
            
            if( $post->iduser == Auth::id() && $min<1){
                return view('post.edit', ['post' => $post]);   
            }else if ($min>1){
                return back()->withErrors(['message' => 'Time passed!']); 
            }else{
                return back()->withErrors(['message' => 'Not your post.']); 
            }
    }
    
    public function index() {
        $posts = Post::all();
        return view('post.index', ['posts' => $posts]);
    }

    public function show(Post $post) {
        return view('post.show', ['post' => $post]);
    }

    public function store(Request $request) {
        $post = new Post($request->all());
        $post->iduser = Auth::id();
        $post->save();
        
        return redirect('/');
    }

    public function update(Request $request, Post $post) {
        $timedif =  Carbon::now()->diff($post->created_at);
        $min = intval($timedif->format('%i'));
        
        if( $post->iduser == Auth::id() && $min<1){
            $post->update($request->all());
        } else if ($post->iduser != Auth::id()) {
            session()->flash('message', 'Not your post.');
        } else{
            session()->flash('message', 'You cant edit anymore');
        }
    }
}