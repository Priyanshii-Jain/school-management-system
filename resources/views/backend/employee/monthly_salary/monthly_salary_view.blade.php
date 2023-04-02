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
					<h4 class="box-title">Employee <strong>Monthyly Salary</strong></h4>
				  </div>

				  <div class="box-body">
					
						<div class="row">
						<div class="col-md-6">
                        <div class="form-group">
								<h5>Attendance Date<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="date" name="date" id="date" class="form-control">
                                    
                                </div>
								
							</div>

                                </div> <!--end col-md-6-->


							<div class="col-md-6" style="padding-top: 25px;">
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
    var date = $('#date').val();
     $.ajax({
      url: "{{ route('employee.monthly.salary.get')}}",
      type: "get",
      data: {'date':date},
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
