@extends('admin.layouts.master')
@section('title')
Add
@endsection
@section('body')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 style="color: #11304e">Add User</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a  href="{{ url('admin/home') }}">Home</a></li>
            <li class="breadcrumb-item active">Add User</li>
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
          @if(Session::has('errors'))
          <div style="background: #11304e; border: none;" class="alert alert-success" role="alert">
            <h4 class="alert-heading">User validation!</h4>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </div>
          @endif 

          @if(Session::has('error'))
          <div class="alert alert-danger">
            {{Session::get('error')}}
          </div>
          @endif
          <!-- jquery validation -->
          <div class="card card-primary">
            <div class="card-header" style="background: #11304e;">
              <h3 class="card-title">Add <small>User</small></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            <form id="quickForm" method="POST" action="{{ route('users.store') }}">
              {!! csrf_field() !!}
              <div class="card-body" style="color: #11304e;">

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-12">
                          <label for="exampleInputEmail1">Name</label>
                          <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6">
                   <div class="form-group">
                    <div class="row">
                      <div class="col-sm-12">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Email">
                      </div>
                    </div>
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-lg-6">
                 <div class="form-group">
                  <div class="row">
                    <div class="col-sm-12">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="Enter Password">
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
               <div class="form-group">
                <div class="row">
                  <div class="col-sm-12">
                    <label for="exampleInputEmail1">Config Password</label>
                    <input type="password" name="configPass" class="form-control" id="exampleInputEmail1" placeholder="Enter Password">
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-12">
                    <label for="exampleInputEmail1">Scout</label>
                    <input type="text" name="scout" class="form-control" id="exampleInputEmail1" placeholder="Enter Scout">
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
             <div class="form-group">
              <label>{{ trans('messeges.role') }}</label>
              <select class="custom-select" name="role_id">
                <option value="0">Choose role...</option>
                @foreach($roles as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label>{{ trans('messeges.city') }}</label>
              <select class="custom-select" name="city_id">
                <option>Choose city...</option>
                @foreach($cities as $city)
                <option value="{{$city->id}}">{{$city->name}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group">
              <label>{{ trans('messeges.district') }}</label>
              <select class="custom-select" name="district_id">
                <option>Choose district...</option>
                 @foreach($districts as $district)
                <option value="{{$district->id}}">{{$district->name}}</option>
                @endforeach
              </select>
            </div>
          </div>

        </div>


      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button style="background: #11304e; border: none;" type="submit" class="btn btn-primary">Add User</button>
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