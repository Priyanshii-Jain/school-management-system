@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<div class="content-wrapper">
	  <div class="container-full">
		

		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Edit Student</h4>
			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('student.registration.update',$editData->student_id) }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $editData->id }}">
					  <div class="row">
						<div class="col-12">

                            <div class="row"> <!--row-1-->
                                <div class="col-md-4">
                                <div class="form-group">
								<h5>Student Name<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" value="{{ $editData['student']['name'] }}" name="name" class="form-control" required="">
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->

                                <div class="col-md-4">
                                <div class="form-group">
								<h5>Father's Name<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" value="{{ $editData['student']['father_name'] }}" name="father_name" class="form-control" required="">
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->

                                <div class="col-md-4">
                                <div class="form-group">
								<h5>Mother's Name<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="mother_name" value="{{ $editData['student']['mother_name'] }}" class="form-control" required="">
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->
                            </div> <!--end row-1-->

							<div class="row"> <!--row-2-->
                                <div class="col-md-4">
                                <div class="form-group">
								<h5>Mobile Number<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="mobile" value="{{ $editData['student']['mobile'] }}" class="form-control" required="">
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->

                                <div class="col-md-4">
                                <div class="form-group">
								<h5>Address<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="address" value="{{ $editData['student']['address'] }}" class="form-control" required="">
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->

                                <div class="col-md-4">
                                <div class="form-group">
								<h5>Gender<span class="text-danger">*</span></h5>
								<div class="controls">
								<select name="gender" id="gender" required="" class="form-control">
										<option value="" selected="" disable="">Select Gender</option>
										<option value="Male" {{ ($editData['student']['gender'] == "Male")? "selected":"" }}>Male</option>
										<option value="Female" {{ ($editData['student']['gender'] == "Female")? "selected":"" }}>Female</option>
									</select>
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->
                            </div> <!--end row-2-->

							<div class="row"> <!--row-3-->

							<div class="col-md-4">
                                <div class="form-group">
								<h5>Religion<span class="text-danger">*</span></h5>
								<div class="controls">
								<select name="religion" id="religion" required="" class="form-control">
										<option value="" selected="" disable="">Select Religion</option>
										<option value="Hindu" {{ ($editData['student']['religion'] == "Hindu")? "selected":"" }}>Hindu</option>
										<option value="Muslim" {{ ($editData['student']['religion'] == "Muslim")? "selected":"" }}>Muslim</option>
										<option value="Christian" {{ ($editData['student']['religion'] == "Christian")? "selected":"" }}>Christian</option>
										<option value="Other" {{ ($editData['student']['religion'] == "Other")? "selected":"" }}>Other</option>
									</select>
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->

                                <div class="col-md-4">
                                <div class="form-group">
								<h5>Date Of Birth<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="date" name="dob" value="{{ $editData['student']['dob'] }}" class="form-control" required="">
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->

                                <div class="col-md-4">
                                <div class="form-group">
								<h5>Discount<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="discount" value="{{ $editData['discount']['discount'] }}" class="form-control" required="">
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->

                                
                            </div> <!--end row-3-->

							<div class="row"> <!--row-4-->

							<div class="col-md-4">
                                <div class="form-group">
								<h5>Class<span class="text-danger">*</span></h5>
								<div class="controls">
								<select name="class_id" required="" class="form-control">
										<option value="" selected="" disable="">Select Class</option>
										@foreach($classes as $class)
										<option value="{{ $class->id }}" {{ ($editData->class_id == $class->id)? "selected":"" }}>{{ $class->name }}</option>
										@endforeach
									</select>
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->

                                <div class="col-md-4">
                                <div class="form-group">
								<h5>Year<span class="text-danger">*</span></h5>
								<div class="controls">
								<select name="year_id" required="" class="form-control">
										<option value="" selected="" disable="">Select Year</option>
										@foreach($years as $year)
										<option value="{{ $year->id }}" {{ ($editData->year_id == $year->id)? "selected":"" }}>{{ $year->name }}</option>
										@endforeach
									</select>
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->

                                <div class="col-md-4">
                                <div class="form-group">
								<h5>Group<span class="text-danger">*</span></h5>
								<div class="controls">
								<select name="group_id" required="" class="form-control">
										<option value="" selected="" disable="">Select Group</option>
										@foreach($groups as $group)
										<option value="{{ $group->id }}" {{ ($editData->group_id == $group->id)? "selected":"" }}>{{ $group->name }}</option>
										@endforeach
									</select>
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->

                                
                            </div> <!--end row-4-->

							<div class="row"> <!--row-5-->

							<div class="col-md-4">
                                <div class="form-group">
								<h5>Shift<span class="text-danger">*</span></h5>
								<div class="controls">
								<select name="shift_id" required="" class="form-control">
										<option value="" selected="" disable="">Select Shift</option>
										@foreach($shifts as $shift)
										<option value="{{ $shift->id }}" {{ ($editData->shift_id == $shift->id)? "selected":"" }}>{{ $shift->name }}</option>
										@endforeach
									</select>
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->

                                <div class="col-md-4">
                                <div class="form-group">
								<h5>Profile image<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="file" value="{{ $editData['student']['image'] }}" name="image" id="image" class="form-control">
                                </div>
								
							</div> 

                                </div> <!--end col-md-4-->

                                <div class="col-md-4">
                                <div class="form-group">
								
								<div class="controls">
									<img id="showImage" src="{{ (!empty($editData['student']['image']))? url('upload/student_image/'.$editData['student']['image']):url('upload/no_image.jpg') }}" alt="" style="width: 100px; length: 100px; border: 1px solid #000000;">
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->

                                
                            </div> <!--end row-5-->

							
                                                    
                                                                                 
                            </div> <!--  End col-12 -->
                        </div>
														
						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-info mb-5" value="Update">
						</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>
		<!-- /.content -->
	  
	  </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>

@endsection