@extends('admin.layouts.master')
@section('title')
Districts
@endsection
@section('body')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>click</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">click</li>
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
                  <h3 style="color: #1f466b;font-weight: bold;font-size: x-large;" class="card-title">click</h3>
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
                   <th>City</th>
                   <th>Number Click</th>
       
                 </tr>
               </thead>
               <tbody>
                 @foreach($Click as $key => $click)
                 @if($click->user_id ==  Auth::user()->id || Auth::user()->role_id == 1 )
                <tr>

                  <td>{{ $click->id }}</td>
                  @if(!empty($click->user->name))
                  <td>{{$click->user->name}}</td>
                  @else
                  <td style="text-align:center;">_</td>
                  @endif 

                  @if(!empty($click->user->city->name))
                  <td>{{$click->user->city->name}}</td>
                  @else
                  <td style="text-align:center;">_</td>
                  @endif 

                  @if(!empty($click->click))
                  <td>{{$click->click}}</td>
                  @else
                  <td style="text-align:center;">_</td>
                  @endif 

          
                </tr>
                @endif 
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