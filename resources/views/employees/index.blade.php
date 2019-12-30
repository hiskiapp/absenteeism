@extends('layouts.backend')
@push('head')
<link href="{{ asset('assets/libs/toastr/build/toastr.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<!-- File export -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="float-right">
					<a href="{{ request()->segment(1) }}/add" class="btn btn-secondary"><i class="fa fa-plus"></i> Add</a>
					<button class="btn btn-danger" data-toggle="modal" data-target="#export"><i class="fas fa-sign-in-alt"></i> Export</button>
				</div>
				<h4 class="card-title">{{ $page_title }}</h4>
				<h6 class="card-subtitle">{{ $page_description }}</h6>
				<div class="table-responsive">
					<table id="file_export" class="table table-striped table-bordered display">
						<thead>
							<tr>
								<th>Kode</th>
								<th>Nama</th>
								<th>Tugas Khusus</th>
								<th width="160px">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $row)
							<tr>
								<td>{{ $row->code }}</td>
								<td>{{ $row->name }}</td>
								<td>{{ $row->position }}</td>
								<td>
									<a href="{{ request()->segment(1) }}/edit/{{ $row->id }}" class="btn btn-xs btn-warning text-white"><i class="fas fa-pencil-alt"></i></a>
									<button onclick="deleteRow({{ $row->id }})" class="btn btn-xs btn-danger text-white"><i class="fas fa-trash-alt"></i></button>
									<a href="{{ request()->segment(1) }}/detail/{{ $row->id }}" class="btn btn-xs btn-info text-white"><i class="fas fa-eye"></i></a>
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
<div id="export" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Export {{ $page_title }}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<form action="{{ url(request()->segment(1))}}/export" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="modal-body">
					<div class="form-group">
						<label for="recipient-name" class="control-label">File Export:</label>
						<input type="file" required="" accept=".xls,.xlsx" name="file_export" class="form-control-file">
						<span class="form-text text-muted">Download Example <a href="{{ url('sample/ExportTeachers.xlsx') }}">Export File Here</a></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-danger waves-effect waves-light">Execute</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@push('bottom')
<script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script type="text/javascript">
	$(".select2").select2();

	//=============================================//
	//    File export                              //
	//=============================================//
	var table = $('#file_export').DataTable({
		dom: 'Bfrtip',
		buttons: [
		{
			extend: 'copy',
			exportOptions: {
				columns: [ 7, ':visible' ]
			}
		},
		{
			extend: 'csv',
			exportOptions: {
				columns: [ 7, ':visible' ]
			}
		},
		{
			extend: 'excel',
			exportOptions: {
				columns: [ 7, ':visible' ]
			}
		},
		{
			extend: 'pdf',
			exportOptions: {
				columns: [ 7, ':visible' ]
			}
		},
		{
			extend: 'print',
			exportOptions: {
				columns: [ 7, ':visible' ]
			}
		},
		]
	});
	
	$('.buttons-copy').addClass('btn btn-primary mr-1');
	$('.buttons-csv').addClass('btn btn-success mr-1');
	$('.buttons-print').addClass('btn btn-info mr-1');
	$('.buttons-pdf').addClass('btn btn-warning mr-1');
	$('.buttons-excel').addClass('btn btn-danger mr-1');
</script>

<script src="{{ asset('assets/libs/toastr/build/toastr.min.js') }}"></script>
@if(Session::has('message'))
<script>
	$(function() {
		toastr.{{ session::get('message_type') }}('{{ session::get('message') }}', '{{ ucwords(session::get('message_type')) }}!');
	});
</script>
@endif

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
</script>
@endpush