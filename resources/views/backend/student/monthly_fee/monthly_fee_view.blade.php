@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script>

<div class="content-wrapper">
	  <div class="container-full">
		

		<!-- Main content -->
		<section class="content">
		  <div class="row"> 
		  <div class="col-12">
		  
				<div class="box bl-3 border-primary">
				  <div class="box-header">
					<h4 class="box-title">Student <strong>Monthly Fee</strong></h4>
				  </div>

				  <div class="box-body">
					
						<div class="row">
						<div class="col-md-3">
                                <div class="form-group">
								<h5>Class<span class="text-danger"></span></h5>
								<div class="controls">
								<select name="class_id" id="class_id" required="" class="form-control">
										<option value="" selected="" disable="">Select Class</option>
										@foreach($classes as $class)
										<option value="{{ $class->id }}">{{ $class->name }}</option>
										@endforeach
									</select>
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-3-->

                                <div class="col-md-3">
                                <div class="form-group">
								<h5>Year<span class="text-danger"></span></h5>
								<div class="controls">
								<select name="year_id" id="year_id" required="" class="form-control">
										<option value="" selected="" disable="">Select Year</option>
										@foreach($years as $year)
										<option value="{{ $year->id }}">{{ $year->name }}</option>
										@endforeach
									</select>
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-3-->

                                <div class="col-md-3">
                                <div class="form-group">
								<h5>Month<span class="text-danger"></span></h5>
								<div class="controls">
								<select name="month" id="month" required="" class="form-control">
										<option value="" selected="" disable="">Select Month</option>
				
										<option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
										
									</select>
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-3-->

							<div class="col-md-3" style="padding-top: 25px;">
		<a class="btn btn-primary" id="search" name="search">Search</a>
							</div>
						</div>

<!-- //////////////////////////////////////// Registration Fee Table /////////////////////////////////////////////////////// -->
                    <div class="row">
                        <div class="col-md-12">
                            <div id="DocumentResults">
                                <script type="text/x-handelbars-template" id="document-template">
                                    <table class="table table-bordered table-striped" style="width : 100%;">
                                        <thead>
                                            <tr>
                                                @{{{thsource}}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @{{#each this}}
                                            <tr>
                                                @{{{tdsource}}}
                                            </tr>

                                            @{{/each}}
                                        </tbody>
                                    </table>
                                </script>
                            </div>
                            
                        </div>

                    </div>
                    </div>
                    </div>
			           
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
</div>

<script type="text/javascript">
  $(document).on('click','#search',function(){
    var year_id = $('#year_id').val();
    var class_id = $('#class_id').val();
    var month = $('#month').val();
     $.ajax({
      url: "{{ route('student.monthly.fee.classwise.get')}}",
      type: "get",
      data: {'year_id':year_id,'class_id':class_id,'month':month},
      beforeSend: function() {       
      },
      success: function (data) {
        var source = $("#document-template").html();
        var template = Handlebars.compile(source);
        var html = template(data);
        $('#DocumentResults').html(html);
        $('[data-toggle="tooltip"]').tooltip();
      }
    });
  });

</script>

@endsection
