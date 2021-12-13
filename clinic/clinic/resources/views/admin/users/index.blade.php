@extends('admin.layouts.master')
@section('title')
    Users
@endsection
@section('body')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
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
                                        <h3 style="color: #1f466b;font-weight: bold;font-size: x-large;" class="card-title">
                                            Users</h3>
                                    </div>
                                    <div class="col-lg-6 col-sm-12" style="text-align: right;">
                                        <a style="width: 225px;background: #1f466b;border: #1f466b;"
                                            href="{{ route('users.create') }}" class="btn btn-small btn-success">
                                            <i style="margin-right: 8px;" class="far fa-plus-square"></i>Add new User
                                        </a>
                                    </div>
                                </div>


                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                @if (Session::has('success'))
                                    <div style="background: #11304e; border: none;" class="alert alert-danger">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead style="color: #052a6f">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Scout</th>
                                            <th>Status</th>
                                            <th>Role</th>
                                            <th>City </th>
                                            <th>District</th>
                                            <th>Control</th>
                                            <th>Control</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)


                                            <tr>
                                                <td>
                                                    @if ($user->role_id == 2)
                                                        @php
                                                            $color = '#978d8e';
                                                        @endphp

                                                        @foreach ($BestDoctor as $bestDoctor)
                                                            @php
                                                                if ($user->id == $bestDoctor->id_doctor) {
                                                                    $color = '#bb891e';
                                                                }
                                                            @endphp

                                                        @endforeach
                                                        <a href="{{ url('/BestDoctor') }}/{{ $user->id }}"
                                                            style="color:{{$color}}">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        </a>
                                                    @endif
                                                    {{ $user->id }}
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                @if (!empty($user->scout))
                                                    <td>${{ $user->scout }}</td>
                                                @else
                                                    <td style="text-align:center;">_</td>
                                                @endif

                                                @if ($user->isActive == 1)
                                                    <td style="color:green;">OnLine</td>
                                                @else
                                                    <td style="color:red;">OffLine</td>
                                                @endif

                                                @if (!empty($users[$key]->userRole->name))
                                                    <td>{{ $users[$key]->userRole->name }}</td>
                                                @else
                                                    <td style="text-align:center;">_</td>
                                                @endif

                                                @if (!empty($users[$key]->city->name))
                                                    <td>{{ $users[$key]->city->name }}</td>
                                                @else
                                                    <td style="text-align:center;">_</td>
                                                @endif

                                                @if (!empty($users[$key]->district->name))
                                                    <td>{{ $users[$key]->district->name }}</td>
                                                @else
                                                    <td style="text-align:center;">_</td>
                                                @endif


                                                <td style="text-align:center;">
                                                    <form method="POST" action="{{ route('roles.destroy', $user->id) }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}

                                                        <div class="form-group">
                                                            <button style="background: #af0212;border: #af0212;"
                                                                class="btn btn-small btn-danger delete-btn"><i
                                                                    style="margin-right: 4px"
                                                                    class="fa fa-trash"></i>Delete</button>
                                                        </div>
                                                    </form>

                                                    <a style="background: #1f466b;border: #1f466b;"
                                                        href="{{ url('user/edit/') }}/{{ $user->id }}"
                                                        class="btn btn-small btn-info">
                                                        <i style="margin-right: 4px" class="fa fa-edit"></i>Update
                                                    </a>

                                                </td>

                                                <td>
                                                    <a style="background: #af0212;border: #af0212;"
                                                        href="{{ url('blacklist/block') }}/{{ $user->id }}"
                                                        class="btn btn-small btn-danger delete-btn">
                                                        <i style="margin-right: 4px" class="fa fa-lock"></i>Block
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
