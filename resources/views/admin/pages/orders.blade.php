@extends('layouts.dashboard')

@section('content')
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!--overview start-->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="fa fa-users">Orders</a></li>
                </ol>
            </div>
        </div>

        <div class="flash-message">
            @if(\Session::has('message'))

            <p class="alert
            {{ Session::get('alert-class', 'alert-success') }}">{{Session::get('message') }}</p>
            @endif
        </div> <!-- end .flash-message -->

        <!--/.row-->
        <div class="row">

            <div class="col-lg-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2><i class="fa fa-flag-o red"></i><strong>Orders</strong></h2>
                        <div class="panel-actions">
                            <a href="/dashboard/home" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                            <a href="/dashboard/home" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                            <a href="/dashboard/home" class="btn-close"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table bootstrap-datatable countries">
                            <thead>
                                <tr>
                                    <th>Address</th>
                                    <th>User Name</th>
                                    <th>Book name</th>
                                    <th>Status</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($orders)> 0)
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{$order->address}}</td>
                                    <td>{{$order->user->name}}</td>
                                    <td>{{$order->book->name}}</td>
                                    <td>{{$order->status}}</td>
                                    <td><a href="{{route('order.edit', $order->id)}}"><i
                                                class="fa fa-edit text-info"></i></a></td>
                                    <td><a href="{{route('order.destroy', $order->id)}}" class="text-danger"><i
                                                class="fa fa-trash"></i>Delete</a></td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>


                        </table>


                    </div>

                </div>

            </div>

        </div>
        <!--/col-->

        </div>



    </section>


</section>
<!--main content end-->
@endsection