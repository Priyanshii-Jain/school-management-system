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
			  <h4 class="box-title">Edit User Profile</h4>
			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                        @csrf
					  <div class="row">
						<div class="col-12">

                        

                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
								<h5>User Name<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" value="{{ $editprofile->name }}" name="name" class="form-control" required="">
                                </div>
								
							</div>  
                            </div> <!--  End col-md-6 -->

                            <div class="col-md-6">
                            <div class="form-group">
								<h5>User Email<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="email" value="{{ $editprofile->email }}" name="email" class="form-control" required="">
                                </div>
								
							</div>
                            </div> <!--  End col-md-6 -->
                            
                        </div>  <!-- End row -->

                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
								<h5>User Mobile<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" value="{{ $editprofile->mobile }}" name="mobile" class="form-control" required="">
                                </div>
								
							</div>  
                            </div> <!--  End col-md-6 -->

                            <div class="col-md-6">
                            <div class="form-group">
								<h5>User Address<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" value="{{ $editprofile->address }}" name="address" class="form-control" required="">
                                </div>
								
							</div>
                            </div> <!--  End col-md-6 -->
                            
                        </div>  <!-- End row -->

                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
								<h5>User Gender<span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="gender" id="gender" required="" class="form-control">
										<option value="" selected="" disable="">Select Gender</option>
										<option value="Male" {{ ($editprofile->gender == "Male" ? "selected":"") }}>Male</option>
										<option value="Female" {{ ($editprofile->gender == "Female" ? "selected":"") }}>Female</option>
                                        <option value="Transgender" {{ ($editprofile->gender == "Transgender" ? "selected":"") }}>Transgender</option>
									</select>
								</div>
							</div>
                            </div> <!--  End col-md-6 -->
                            <div class="col-md-6">
                            <div class="form-group">
								<h5>Profile image<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="file" name="image" id="image" class="form-control">
                                </div>
								
							</div> 
                            
                            <div class="form-group">
								
								<div class="controls">
									<img id="showImage" src="{{ (!empty($user->image))? url('upload/user_image/'.$user->image):url('upload/no_image.jpg') }}" alt="" style="width: 100px; length: 100px; border: 1px solid #000000;">
                                </div>
								
							</div>
                            </div> <!--  End col-md-6 -->
                        </div>  <!-- End row -->
														
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