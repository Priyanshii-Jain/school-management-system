@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
	  <div class="container-full">
		

		<!-- Main content -->
		<section class="content">
		  <div class="row"> 
		  <div class="col-12">
		  
				<div class="box bl-3 border-primary">
				  <div class="box-header">
					<h4 class="box-title">Student <strong>Search</strong></h4>
				  </div>

				  <div class="box-body">
					
					
					<form action="{{ route('student.year.class.wise') }}" method="get">
					
						<div class="row">
						<div class="col-md-4">
                                <div class="form-group">
								<h5>Class<span class="text-danger"></span></h5>
								<div class="controls">
								<select name="class_id" required="" class="form-control">
										<option value="" selected="" disable="">Select Class</option>
										@foreach($classes as $class)
										<option value="{{ $class->id }}" {{ (@$class_id == $class->id)? "selected":"" }}>{{ $class->name }}</option>
										@endforeach
									</select>
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->

                                <div class="col-md-4">
                                <div class="form-group">
								<h5>Year<span class="text-danger"></span></h5>
								<div class="controls">
								<select name="year_id" required="" class="form-control">
										<option value="" selected="" disable="">Select Year</option>
										@foreach($years as $year)
										<option value="{{ $year->id }}" {{ (@$year_id == $year->id)? "selected":"" }}>{{ $year->name }}</option>
										@endforeach
									</select>
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->

							<div class="col-md-4" style="padding-top: 25px;">
		<input type="submit" class="btn btn-rounded btn-dark mb-5" name="search" value="Search">
							</div>
						</div>
						
					</form>

				  </div>
				  </div>
				  
				</div>
			  

			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Student List</h3>
                  <a href="{{ route('student.registration.add') }}" style="float: right;" class=" btn btn-rounded btn-success mb-5">Add Student</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">

		@if(!@$search)
			<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th width="5%">SL</th>
					<th>Name</th>
					<th>Id No.</th>
					<th>Roll</th>
					<th>Year</th>
					<th>Class</th>
					<th>Image</th>
					@if(Auth::user()->role == 'Admin')
					<th>Code</th>
					@endif
					<th width="25%">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($allData as $key => $student)
				<tr>
					<td>{{ $key+1 }}</td>
					<td>{{ $student['student']['name'] }}</td>
					<td>{{ $student['student']['id_no'] }}</td>
					<td>{{ $student->roll }}</td>
					<td>{{ $student['student_year']['name'] }}</td>
					<td>{{ $student['student_class']['name'] }}</td>
					<td><img src="{{ (!empty($student['student']['image']))? url('upload/student_image/'.$student['student']['image']):url('upload/no_image.jpg') }}" alt="" style="width: 60px; length: 60px; border: 1px solid #000000;"></td>
					@if(Auth::user()->role == 'Admin')
					<td>{{ $student['student']['code'] }}</td>
					@endif
					<td>
					<a title="Edit" href="{{ route('student.registration.edit',$student->student_id) }}" class="btn btn-info"> <i class="fa fa-edit"></i> </a>

                    <a title="Promotion" href="{{ route('student.registration.promotion',$student->student_id) }}" class="btn btn-primary" ><i class="fa fa-check"></i></a>

                    <a target="_blank" title="Details" href="{{ route('student.registration.detail',$student->student_id) }}" class="btn btn-danger"  ><i class="fa fa-eye"></i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				
			</tfoot>
			</table>

		@else

			<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th width="5%">SL</th>
					<th>Name</th>
					<th>Id No.</th>
					<th>Roll</th>
					<th>Year</th>
					<th>Class</th>
					<th>Image</th>
					@if(Auth::user()->role == 'Admin')
					<th>Code</th>
					@endif
					<th width="25%">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($allData as $key => $student)
				<tr>
					<td>{{ $key+1 }}</td>
					<td>{{ $student['student']['name'] }}</td>
					<td>{{ $student['student']['id_no'] }}</td>
					<td>{{ $student->roll }}</td>
					<td>{{ $student['student_year']['name'] }}</td>
					<td>{{ $student['student_class']['name'] }}</td>
					<td><img src="{{ (!empty($student['student']['image']))? url('upload/student_image/'.$student['student']['image']):url('upload/no_image.jpg') }}" alt="" style="width: 60px; length: 60px; border: 1px solid #000000;"></td>
					@if(Auth::user()->role == 'Admin')
					<td>{{ $student['student']['code'] }}</td>
					@endif
					<td>
					<a title="Edit" href="{{ route('student.registration.edit',$student->student_id) }}" class="btn btn-info"> <i class="fa fa-edit"></i> </a>

                    <a title="Promotion" href="{{ route('student.registration.promotion',$student->student_id) }}" class="btn btn-primary" ><i class="fa fa-check"></i></a>

                    <a target="_blank" title="Details" href="{{ route('student.registration.detail',$student->student_id) }}" class="btn btn-danger"  ><i class="fa fa-eye"></i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				
			</tfoot>
			</table>


		@endif
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			           
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
</div>

@endsection
