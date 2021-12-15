@extends('layouts.admin')

@section('header', 'Publisher')

@section('content')
	<div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              	<div class="card-header">
                	<h3 class="card-title">Create New Publisher Data</h3>
              	</div>
              	<!-- /.card-header -->
              	<!-- form start -->
              	<form action="{{ url('publishers') }}" method="post">
              		@csrf
	                <div class="card-body">
		                <div class="form-group">
		                	<label>Name</label>
		                  <input type="text" name="name" class="form-control" placeholder="Enter name" required="">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" placeholder="Enter email" required="">
                      <label>Phone Number</label>
                      <input type="text" name="phone_number" class="form-control" placeholder="Enter phone number">
                      <label>Address</label>
                      <input type="text" name="address" class="form-control" placeholder="Enter address">
		                </div>
		              </div>
	                <!-- /.card-body -->

                  <div class="card-footer">
                  	<button type="submit" class="btn btn-primary">Submit</button>
                	</div>
              	</form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection