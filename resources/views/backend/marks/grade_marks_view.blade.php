@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
	  <div class="container-full">
		

		<!-- Main content -->
		<section class="content">
		  <div class="row"> 

			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Student Grade List</h3>
                  <a href="{{ route('marks.grade.add') }}" style="float: right;" class=" btn btn-rounded btn-success mb-5">Add Grade Marks</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">SL</th>
								<th>Grade Name</th> 
				                <th>Grade Point</th>
				                <th>Start Marks</th>
				                <th>End Marks </th>
				                <th>Point Range</th>
				                <th>Remarks</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
                            @foreach($alldata as $key => $grade)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ $grade->grade_name }}</td>
								<td>{{ number_format((float)$grade->grade_point,2) }}</td>
								<td>{{ $grade->start_marks }}</td>
								<td>{{ $grade->end_marks }}</td>
								<td>{{ $grade->start_point }} - {{ $grade->end_point }}</td>
								<td>{{ $grade->remarks }}</td>
					
								<td>
                                    <a href="{{ route('grade.marks.edit',$grade->id) }}" class="btn btn-info">Edit</a>
                                    
                                </td>
							</tr>
                            @endforeach
						</tbody>
						<tfoot>
							
						</tfoot>
					  </table>
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
