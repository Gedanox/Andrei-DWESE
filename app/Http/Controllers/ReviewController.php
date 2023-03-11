<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\Image;

class ReviewController extends Controller {

    function __construct() {
        $this->middleware('auth', ['except' => ['index', 'show', 'film', 'record', 'book']]);
    }

    public function create() {
        return view('review.create');
    }

    public function destroy(Review $review) {
            if ($review->iduser == Auth::id()) {
                foreach($review->images as $image) {
                    Storage::disk('local')->delete($image->imageroute);
                    Image::where('name', $image->name)->delete();
                }
                $review->delete();
                return redirect('/');
            } else if ($review->iduser != Auth::id()){
               return back()->withErrors(['message' => 'Its not your post']); 
            } else {
               return back()->withErrors(['messaeg' => 'Error while deleting']); 
            }
    }

    public function edit(Review $review) {
            if ($review->iduser == Auth::id()) {
                return view('review.edit', ['review' => $review]);    
            } else if ($review->iduser != Auth::id()){
               return back()->withErrors(['message' => 'Its not your post']); 
            } else {
               return back()->withErrors(['messaeg' => 'Error while loading edit']); 
            }
    }

    
    
    public function index() {
        $reviews = Review::orderBy('created_at', 'desc')->get();
        /*foreach ($reviews as $review) {
            dd($review->images);
        }*/
        return view('review.index', ['reviews' => $reviews]);
    }

    public function show(Review $review) {
        return view('review.show', ['review' => $review]);
    }

    public function store(Request $request) {
        
        $review = new Review();
        $review->type = $request->type;
        $review->title = $request->title;
        $review->review = $request->review;
        $review->iduser = Auth::user()->id;
        
        $image = new Image();
        $file = $request->file('image');
        $target = 'storage/';
        $date = (string)Carbon::parse(Carbon::now())->format('YmdHis');
        $name = $date . $file->getClientOriginalName();
        $file->move($target, $name);
        
        $image->name = $file->getClientOriginalName();
        $image->imageroute = $target.$name;
        $image->thumbnail = base64_encode($file);
        
        //dd($review);
        
        $review->save();
        $image->idreview = $review->id;
        $image->save();
        
        return redirect('/');
    }

    public function update(Request $request, Review $review) {
        if ($review->iduser == Auth::id()) {
            $review->type = $request->type;
            $review->title = $request->title;
            $review->review = $request->review;
            $review->update();
            
            if($request->file('image')){
                foreach($review->images as $imageold) {
                    Storage::disk('local')->delete('public/images/' . $imageold->name);
                    Image::where('name', $imageold->name)->delete();
                }
                
                $image = new Image();
                $file = $request->file('image');
                $target = 'storage/';
                $date = (string)Carbon::parse(Carbon::now())->format('YmdHis');
                $name = $date . $file->getClientOriginalName();
                $file->move($target, $name);
                
                $image->name = $file->getClientOriginalName();
                $image->imageroute = $target.$name;
                $image->thumbnail = base64_encode($file);
                
                //dd($review);
                
                $review->save();
                $image->idreview = $review->id;
                $image->save();
            }
            return redirect('/');
        } else if ($review->iduser != Auth::id()){
           return back()->withErrors(['message' => 'Its not your post']); 
        } else {
           return back()->withErrors(['messaeg' => 'Error while saving edit']); 
        }
    }
    
    public function film(){
        $reviews = Review::where('type', '=', 'film')->orderBy('created_at', 'desc')->get();
        return view('review.index', ['reviews' => $reviews]);
    }
    
    public function record(){
        $reviews = Review::where('type', '=', 'record')->orderBy('created_at', 'desc')->get();
        return view('review.index', ['reviews' => $reviews]);
    }
    public function book(){
        $reviews = Review::where('type', '=', 'book')->orderBy('created_at', 'desc')->get();
        return view('review.index', ['reviews' => $reviews]);
    }
}