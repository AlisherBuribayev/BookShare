<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;


class HomeController extends Controller
{
    public function getBooks()
    {
        try {
            
            $books = Book::latest()->paginate(6);
            return response()->json([
                'data' => $books
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'is_success' => false,
                'message'    => 'Error occurred ',
            ]);
        }
    }

    public function getBookById($id)
    {
        try {
            $books = Book::with('category')->find($id);
            return response()->json([
                'data' => $books
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'is_success' => false,
                'message'    => 'Error occurred ',
            ]);
        }
    }
    public function getBookByCategory($id)
    {
        $category = Category::with('book')->where('categories.id', 'LIKE',$id )->get();
            
            return response()->json([
                'data' => $category
            ]);
       /*  try {
            $category = Category::with('books')->get();
            
            return response()->json([
                'data' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'is_success' => false,
                'message'    => 'Error occurred ',
            ]);
        } */
    }

    public function getCategories()
    {
        try {
            $categories = Category::latest()->paginate(9);
            return response()->json([
                'data' => $categories
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'is_success' => false,
                'message'    => 'Error occurred ',
            ]);
        }
    }
    
}