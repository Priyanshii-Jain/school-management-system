@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
	  <div class="container-full">
		

		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Update User</h4>
			  
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('user.update',$editdata->id) }}">
                        @csrf
					  <div class="row">
						<div class="col-12">

                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
								<h5>User Roll<span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="user_type" id="user_type" required="" class="form-control">
										<option value="" selected="" disable="">Select Role</option>
										<option value="Admin" {{ ($editdata->user_type == "Admin" ? "selected":"") }}>Admin</option>
										<option value="User" {{ ($editdata->user_type == "Admin" ? "selected":"") }}>User</option>
									</select>
								</div>
							</div>
                            </div> <!--  End col-md-6 -->
                            <div class="col-md-6">
                            <div class="form-group">
								<h5>User Name<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" value="{{ $editdata->name }}" name="name" class="form-control" required="">
                                </div>
								
							</div>  
                            </div> <!--  End col-md-6 -->
                        </div>  <!-- End row -->

                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
								<h5>User Email<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="email" value="{{ $editdata->email }}" name="email" class="form-control" required="">
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

@endsection