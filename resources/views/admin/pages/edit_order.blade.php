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
                <h3 class="page-header"><i class="fa fa-edit"></i>Edit Order</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="/dashboard/home">Home</a></li>
                    <li><i class="fa fa-question"></i>Order</li>
                    <li><i class="fa fa-plus"></i>Edit</li>
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
                    @if($project)
                    <form class="form-horizontal" method="POST" action="{{route('order.update', $order->id)}}"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Order Name</label>
                            <div class="col-lg-10">
                                <input name="name" value="{{$order->name}}" class="form-control" />
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-2 control-label">Order User_id</label>
                            <div class="col-lg-10">
                                <input name="user_id" class="form-control" value="{{$order->user_id}}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Order Book_id</label>
                            <div class="col-lg-10">
                                <input name="book_id" class="form-control" value="{{$order->book_id}}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Order Status</label>
                            <div class="col-lg-10">
                                <input name="status" class="form-control" value="{{$order->status}}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="/dashboard/home" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </section>
        </div>


    </section>
</section>
<!--main content end-->

@endsection