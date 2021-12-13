@extends('admin.layouts.master')
@section('title')
UserRoles
@endsection
@section('body')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>User Roles</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User Roles</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <h3 style="color: #1f466b;font-weight: bold;font-size: x-large;" class="card-title">Roles data</h3>
                </div>
                <div class="col-lg-6 col-sm-12" style="text-align: right;">
                  <a style="width: 225px;background: #1f466b;border: #1f466b;" href="{{ route('roles.create') }}" class="btn btn-small btn-success">
                    <i style="margin-right: 8px;" class="far fa-plus-square"></i>Add new role
                  </a>
                </div>
              </div>


            </div>

            <!-- /.card-header -->
            <div class="card-body">
              @if(Session::has('success'))
              <div style="background: #11304e; border: none;" class="alert alert-danger">
                {{Session::get('success')}}
              </div>
              @endif
              <table id="example1" class="table table-bordered table-striped">
                <thead style="color: #052a6f">
                  <tr>
                   <th>ID</th>
                   <th>Name</th>
                   <th>Control</th>
                 </tr>
               </thead>
               <tbody>
                 @foreach($roles as $role)
                <tr>
                  <td>{{ $role->id }}</td>
                  <td>{{ $role->name}}</td>

                  <td style="text-align:center;">
                    <form method="POST" action="{{ route('roles.destroy', $role->id) }}">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}

                      <div class="form-group">
                        <button style="background: #af0212;border: #af0212;" class="btn btn-small btn-danger delete-btn"><i style="margin-right: 4px" class="fa fa-trash"></i>Delete</button>
                      </div>
                    </form>

                    <a style="background: #1f466b;border: #1f466b;" href="{{ route('roles.edit', $role->id) }}" class="btn btn-small btn-info">
                      <i style="margin-right: 4px" class="fa fa-edit"></i>Update
                    </a>

                  </td>
                </tr>

                @endforeach
              </tbody>

            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->
@stop