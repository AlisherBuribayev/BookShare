<?php
use Illuminate\Support\Facades\Session;
?>
@extends('layouts.dashboard')

@section('content')
          <!--main content start-->
       
          
    <section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"><i class="fa fa-edit"></i>Add new Book</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="/dashboard/home">Home</a></li>
                <li><i class="fa fa-question"></i>Book</li>
              <li><i class="fa fa-plus"></i>Add</li>
              </ol>
            </div>
          </div>


          <!-- edit-profile -->
<div id="edit-profile" class="tab-pane">
  <section class="panel">
    <div class="panel-body bio-graph-info">
        @if (session()->has('errors'))
            @foreach ($errors as $error)
                {{$error}}
            @endforeach
        @endif
      @if(\Session::has('message'))

      <p class="alert
      {{ Session::get('alert-class', 'alert-success') }}">{{Session::get('message') }}</p>
      
      @endif
      <form class="form-horizontal" method="POST" action="{{ route('project.store')}}" enctype="multipart/form-data">
          @csrf
      
        <div class="form-group">
          <label class="col-lg-2 control-label">Book Name</label>
          <div class="col-lg-10">
          <input name="name" class="form-control" value=""/>
          </div>
        </div>

        @error('name')
          <p class="alert alert-danger"> {{$message}}</p>
        @enderror

        <div class="form-group">
            <label class="col-lg-2 control-label">Book category</label>
            <div class="col-lg-10">
            <select name="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            </div>
          </div>

          <div class="form-group">
          <label class="col-lg-2 control-label">Book Author</label>
          <div class="col-lg-10">
          <input name="author" class="form-control" value=""/>
          </div>
        </div>

        @error('author')
          <p class="alert alert-danger"> {{$message}}</p>
        @enderror

          
          @error('category_id')
          <p class="alert alert-danger"> {{$message}}</p>
           @enderror
          
        <div class="form-group">
          <label class="col-lg-2 control-label">Book Description</label>
          <div class="col-lg-10">
          <textarea name="desc" id="message" class="form-control" cols="30" rows="5"></textarea>
          </div>
        </div>
       

        @error('desc')
          <p class="alert alert-danger"> {{$message}}</p>
           @enderror

           <div class="form-group">
            <label class="col-lg-2 control-label">Book Image</label>
            <div class="col-lg-10">
            <input type="file" name="image" class="form-control" />
            </div>
          </div>
          @error('image')
          <p class="alert alert-danger"> {{$message}}</p>
           @enderror

           <div class="form-group">
          <label class="col-lg-2 control-label">Book Rank</label>
          <div class="col-lg-10">
          <input name="money" class="form-control" value=""/>
          </div>
        </div>

        @error('money')
          <p class="alert alert-danger"> {{$message}}</p>
        @enderror

        <div class="form-group">
          <label class="col-lg-2 control-label">Book Published Date</label>
          <div class="col-lg-10">
          <input type="datetime-local" id="meeting-time"
             name="date" value="2022-06-12T00:00"
             min="1950-04-24T00:00" max="2030-06-14T00:00">
          </div>
        </div>

        <div class="form-group">
          <div class="col-lg-offset-2 col-lg-10">
            <button type="submit" class="btn btn-success">Add Book</button>
            <a href="/dashboard/home" class="btn btn-danger">Cancel</a>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>


        </section>
      </section>
      <!--main content end-->
      
@endsection
