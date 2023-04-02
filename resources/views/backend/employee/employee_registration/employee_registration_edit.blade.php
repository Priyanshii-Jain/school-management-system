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
			  <h4 class="box-title">Edit Employee</h4>
			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('employee.registration.update',$editData->id) }}" enctype="multipart/form-data">
                        @csrf
					  <div class="row">
						<div class="col-12">

                            <div class="row"> <!--row-1-->
                                <div class="col-md-4">
                                <div class="form-group">
								<h5>Employee Name<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="name" value="{{ $editData->name }}" class="form-control" required="">
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->

                                <div class="col-md-4">
                                <div class="form-group">
								<h5>Father's Name<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="father_name" value="{{ $editData->father_name }}" class="form-control" required="">
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->

                                <div class="col-md-4">
                                <div class="form-group">
								<h5>Mother's Name<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="mother_name" value="{{ $editData->mother_name }}" class="form-control" required="">
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->
                            </div> <!--end row-1-->

							<div class="row"> <!--row-2-->
                                <div class="col-md-4">
                                <div class="form-group">
								<h5>Mobile Number<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="mobile" value="{{ $editData->mobile }}" class="form-control" required="">
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->

                                <div class="col-md-4">
                                <div class="form-group">
								<h5>Address<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="address" value="{{ $editData->address }}" class="form-control" required="">
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->

                                <div class="col-md-4">
                                <div class="form-group">
								<h5>Gender<span class="text-danger">*</span></h5>
								<div class="controls">
								<select name="gender" id="gender" required="" class="form-control">
										<option value="" selected="" disable="">Select Gender</option>
										<option value="Male" {{ ($editData->gender == "Male")? "selected":"" }}>Male</option>
										<option value="Female" {{ ($editData->gender == "Female")? "selected":"" }}>Female</option>
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
										<option value="Hindu" {{ ($editData->religion == "Hindu")? "selected":"" }}>Hindu</option>
										<option value="Muslim" {{ ($editData->religion == "Muslim")? "selected":"" }}>Muslim</option>
										<option value="Christian" {{ ($editData->religion == "Christian")? "selected":"" }}>Christian</option>
										<option value="Other" {{ ($editData->religion == "Other")? "selected":"" }}>Other</option>
									</select>
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->

                                <div class="col-md-4">
                                <div class="form-group">
								<h5>Date Of Birth<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="date" name="dob" value="{{ $editData->dob }}" class="form-control" required="">
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->

                                <div class="col-md-4">
                                <div class="form-group">
								<h5>Designation<span class="text-danger">*</span></h5>
								<div class="controls">
								<select name="designation_id" required="" class="form-control">
										<option value="" selected="" disable="">Select Class</option>
										@foreach($designation as $desig)
										<option value="{{ $desig->id }}" {{ ($editData->designation_id == $desig->id)? "selected":"" }}>{{ $desig->name }}</option>
										@endforeach
									</select>
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-4-->

                                
                            </div> <!--end row-3-->

							<div class="row"> <!--row-4-->
                            @if(!@$editData)
							<div class="col-md-3">
                            <div class="form-group">
								<h5>Salary<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" value="{{ $editData->salary }}" name="salary" class="form-control" required="">
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-3-->

                                <div class="col-md-3">
                                <div class="form-group">
								<h5>Joining Date<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="date" name="join_date" value="{{ $editData->join_date }}" class="form-control" required="">
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-3-->
                                @endif

                                <div class="col-md-3">
                                <div class="form-group">
								<h5>Profile image<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="file" name="image" id="image" value="{{ $editData->image }}" class="form-control">
                                </div>
								
							</div>

                                </div> <!--end col-md-3-->

                                <div class="col-md-3">
                                <div class="form-group">
								
								<div class="controls">
									<img id="showImage" src="{{ (!empty($editData->image))? url('upload/employee_image/'.$editData->image):url('upload/no_image.jpg') }}" alt="" style="width: 100px; length: 100px; border: 1px solid #000000;">
                                </div>
								
							</div>

                                </div> <!--end col-md-3-->

                                
                            </div> <!--end row-4-->
                                                    
                                                                                 
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