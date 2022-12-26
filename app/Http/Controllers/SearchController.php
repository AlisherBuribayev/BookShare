<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class SearchController extends Controller
{
     /**
     * Display a listing of the resource.
     * 
     * @urlParam text required The text to search.
     */
    public function search(Request $request) 
    {
        try {
            $books = new Book;
            $text = $request->text;
            $showcampaign = Book::select([
                 'books.*', 'categories.name as category_name'
            ])->join('categories','categories.id', '=', 'books.category_id')
                ->where('books.name','LIKE', '%'.$text.'%')
                ->orWhere('categories.name', 'LIKE','%'.$text.'%')
                ->take(10)->get(); 
            return response()->json([
                'books'      => $showcampaign,
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'is_success' => false,
                'message'    => 'Error occurred ',
            ]);
        } 
    }
}