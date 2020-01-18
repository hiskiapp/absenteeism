@extends('layouts.backend')
@push('head')
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link href="{{ asset('assets/libs/toastr/build/toastr.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endpush
@section('content')
<!-- File export -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="float-right mb-3">
					<button class="btn btn-secondary" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Add</button>
				</div>
				<h4 class="card-title">{{ $page_title }}</h4>
				<div class="table-responsive">
					<table id="file_export" class="table table-striped table-bordered display">
						<thead>
							<tr>
								<th>#</th>
								<th>Hari & Tanggal</th>
								<th>Description</th>
								<th width="160px">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $key => $row)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ dt($row->date)->format('d F Y') }}</td>
								<td>{{ $row->description }}</td>
								<td>
									<button onclick="editRow({{ $row->id }})" class="btn btn-xs btn-warning text-white"><i class="fas fa-pencil-alt"></i></button>
									<button onclick="deleteRow({{ $row->id }})" class="btn btn-xs btn-danger text-white"><i class="fas fa-trash-alt"></i></button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah {{ $page_title }}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<form action="{{ url(request()->segment(1))}}/add" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="modal-body">
					<div class="form-group">
						<label for="date-range">Date Range</label>
						<input required="" type="text" name="date-range" id="date-range" class="form-control date-range" />
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea required="" class="form-control" rows="3" placeholder="Text Here..." name="description" id="description"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default waves-effect" id="close-modal-add" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-danger waves-effect waves-light">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit {{ $page_title }}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<form action="{{ url(request()->segment(1))}}/edit" id="form-edit" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="modal-body">
					<div class="form-group">
						<label for="date-range">Date</label>
						<input required="" type="text" name="edit_date" id="edit_date" class="form-control mydatepicker" />
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea required="" class="form-control" rows="3" placeholder="Text Here..." name="edit_description" id="edit_description"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default waves-effect" id="close-modal-edit" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-danger waves-effect waves-light">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@push('bottom')
<script src="{{ asset('assets/libs/moment/moment.js') }}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/libs/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
	$(".select2").select2();

	//=============================================//
	//    Data Tables                              //
	//=============================================//
	$('#file_export').DataTable();

	$('.date-range').daterangepicker({
		ranges: {
			'Today': [moment(), moment()],
			'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		alwaysShowCalendars: true,
	});

	jQuery('.mydatepicker, #datepicker, .input-group.date').datepicker();

	$('#close-modal-add').click(function(){
		$('#name').val('');
	});

	$('#close-modal-add').click(function(){
		$("#edit_id").val('');
		$('#edit_name').val('');
	});
</script>

<script src="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script>
	function deleteRow(id){
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.value) {
				window.location = "{{ url(request()->segment(1))}}/delete/"+id;
			}
		});
	}
	function editRow(id){
		$.ajax({
			url: "{{ url(request()->segment(1))}}/edit/"+id,
			cache: false,
			dataType: "json",
			success: function(data){
				$('#edit').modal('show');
				$('#edit_date').val(data.date);
				$('#edit_description').val(data.description);
				$('#form-edit').attr('action','{{ url(request()->segment(1))}}/edit/'+id);
			},
			error: function(data) { 
				console.log(data);
			}
		});
	}
</script>
@endpush