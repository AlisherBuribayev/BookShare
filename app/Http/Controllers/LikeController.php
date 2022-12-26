<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;


class LikeController extends Controller
{
    public function getLikes()
    {
         try {
            $user = Auth::user()->id;
            $like = Like::with('book')->where('user_id', 'like', $user)->take(10)->get();
            
            return response()->json([
                'data'    => $like
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'is_success' => false,
                'message'    => 'Error occurred ',
            ]);
        } 
    }
    
    
    public function like($id)
    {
          try {
            $like = new Like;
            $book = Book::find($id);
            $user = Auth::user()->id;
            $like->user_id = $user;
            $like->book_id = $book->id;
            $like->save();
            
            return response()->json([
                'is_success' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'is_success' => false,
                'message'    => 'Error occurred ',
            ]);
        } 
    }
    
    
    public function isLike($id)
    {
        $like = Like::where('book_id', 'like', $id)
        ->where('user_id', 'LIKE',Auth::user()->id)->delete();
        return response()->json([
            'is_success' => true
        ]);
    }
}