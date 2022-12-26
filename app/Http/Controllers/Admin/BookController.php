<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Book::latest()->paginate(20);

        return view('admin.pages.projects', \compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =Category::latest()->get();
        return view('admin.pages.new_project', \compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->image;
        $namee = $image->getClientOriginalName();
        $new_name = time().$namee;
        $dir = "storage/images/books/";
        $image->move($dir, $new_name);

        $project = new Book;
        $project->name = $request->name;
        $project->desc = $request->desc;
        $project->author = $request->author;
        $project->category_id =$request->category_id ;
        $project->image = $new_name;
        $project->rank = $request->money;
        $project->published_at = $request->date;
        $project->save();

        Session::flash('message', 'Forum Created Successfuly');
        Session::flash('alert-class', 'alert-success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Book::find($id);
        return view('admin.pages.single_project', \compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Book::find($id);
        $categories = Category::latest()->get();
        return view('admin.pages.edit_project', \compact('project','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $image='';
        $name='';
        $new_name='';
        $dir='';
        if($request->image){
            $image    = $request->image;
            $name     = $image->getClientOriginalName();
            $new_name = time().$name;
            $dir      = "storage/images/projects/";
            $image->move($dir, $new_name);
        }
        $project = Book::find($id);
        if($request->name){
            $project->name = $request->name;
        }
        if($request->desc){
            $project->desc = $request->desc;
        }
        if($request->image){
            $project->image = $new_name;
        }
        if($request->category_id){
            $project->category_id =$request->category_id ;
        }
        if($request->date){
            $project->published_at = $request->date;
        }
        if($request->author){
            $project->author = $request->author;
        }
        if($request->money){
            $project->rank = $request->money;
        }
        

        $project->save();
        Session::flash('message', 'Category Updated Successfuly');
        Session::flash('alert-class', 'alert-success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Book::find($id);
        $project->delete();
        Session::flash('message', 'Category Deleted Successfuly');
        Session::flash('alert-class', 'alert-success');
        return back();
    }
}
