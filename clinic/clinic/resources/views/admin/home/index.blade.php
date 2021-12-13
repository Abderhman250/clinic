@extends('admin.layouts.master')
@section('title')
Home
@endsection
@section('body')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Dashboard</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Dashboard v1</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

@if(Auth::user()->role_id  == 1)
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3>{{ $user }}</h3>

							<p>All Users</p>

						</div>
						<div class="icon">
							<i class="fa fa-users"></i>
						</div>
						<a href="{{route('users.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-success">
						<div class="inner">
							<h3>{{ $dr }}</h3>

							<p>Doctors</p>
						</div>
						<div class="icon">
							<i class="fa fa-user-md"></i>
						</div>
						<a href="{{url('user/doctor')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-warning">
						<div class="inner">
							<h3>{{ $pharmacy }}</h3>

							<p>Pharmacies</p>
						</div>
						<div class="icon">
							<i class="fa fa-plus-square"></i>
						</div>
						<a href="{{url('user/Pharmacies')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-danger">
						<div class="inner">
							<h3>{{ $block }}</h3>

							<p>Black List</p>
						</div>
						<div class="icon">
							<i class="fa fa-ban"></i>
						</div>
						<a href="{{url('blacklist/index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
			</div>
			<!-- /.row -->
			
		</div>
		<!-- /.row (main row) -->
	</div><!-- /.container-fluid -->
</section>


@else
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
	  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
	  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	</ol>
	<div class="carousel-inner">
	  <div class="carousel-item active">
		<img class="d-block w-100" src="https://www.portea.com/static/86d34fbc8306b7f62dae2b08aa754e4f/1abfa/banner-img-doctor.jpg" alt="First slide">
	  </div>
	  <div class="carousel-item">
		<img class="d-block w-100" src="https://www.williamsnickl.com/images/illinois-pharmacy-license-discipline-attorney.jpg" alt="Second slide">
	  </div>
	  <div class="carousel-item">
		<img class="d-block w-100" src="https://www.ucsfhealth.org/-/media/project/ucsf/ucsf-health/service/hero/breast-cancer-decision-services-2x.jpg" alt="Third slide">
	  </div>
	</div>
	<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	  <span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	  <span class="carousel-control-next-icon" aria-hidden="true"></span>
	  <span class="sr-only">Next</span>
	</a>
  </div>
@endif
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop