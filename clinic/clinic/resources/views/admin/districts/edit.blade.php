@extends('admin.layouts.master')
@section('title')
    Edit
@endsection
@section('body')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="color: #11304e">Update City</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Update City</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        @if (Session::has('errors'))
                            <div style="background: #11304e; border: none;" class="alert alert-success" role="alert">
                                <h4 class="alert-heading">City validation!</h4>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif

                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header" style="background: #11304e;">
                                <h3 class="card-title">Update City <small></small></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->


                            <form id="quickForm" method="POST" action=" {{ route('districts.update',$district->id) }}">
                                {!! csrf_field() !!}
                                {{ method_field('PUT') }}
                                <div class="card-body" style="color: #11304e;">

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="exampleInputEmail1">Name</label>
                                                <input type="text" name="name" value="{{$district->name}}" class="form-control"
                                                    id="exampleInputEmail1" placeholder="Enter name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>City</label>
                                                <select class="custom-select" name="city_id">
                                                    <option value="0">Choose role...</option>
                                                    @foreach ($City as $city)
                                                        <option @if($district->city_id == $city->id) selected   @endif value="{{ $city->id }}">{{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button style="background: #07b690; border: none;" type="submit"
                                                class="btn btn-primary">Update Districts</button>
                                        </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@stop
