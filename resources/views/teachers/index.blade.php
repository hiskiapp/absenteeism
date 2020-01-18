@extends('layouts.backend')
@push('head')
<link href="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endpush
@section('content')
<!-- File export -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="float-right">
					<a href="{{ request()->segment(1) }}/add" class="btn btn-secondary"><i class="fa fa-plus"></i> Add</a>
					<button class="btn btn-danger" data-toggle="modal" data-target="#import"><i class="fas fa-sign-in-alt"></i> Import</button>
					<button class="btn btn-warning" data-toggle="modal" data-target="#qr-code"><i class="fas fa-download"></i> Qr Code</button>
				</div>
				<h4 class="card-title">{{ $page_title }}</h4>
				<h6 class="card-subtitle">{{ $page_description }}</h6>
				<div class="table-responsive">
					<table id="file_export" class="table table-striped table-bordered display">
						<thead>
							<tr>
								<th>Kode</th>
								<th>Nama</th>
								<th>Mapel</th>
								<th>Tugas Khusus</th>
								<th width="160px">Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="import" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Export {{ $page_title }}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<form action="{{ url(request()->segment(1))}}/import" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="modal-body">
					<div class="form-group">
						<label for="recipient-name" class="control-label">File Export:</label>
						<input type="file" required="" accept=".xls,.xlsx" name="file_export" class="form-control-file">
						<span class="form-text text-muted">Download Example <a href="{{ url('sample/ExportTeachers.xlsx') }}">Import File Here</a></span>
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
<div id="qr-code" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Cetak QR Code {{ $page_title }}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<form action="{{ url(request()->segment(1))}}/qr-code" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="modal-body">
					<div class="form-group">
						<label for="data_type" class="control-label">Data</label>
						<select name="data_type" id="data_type" class="form-control">
							<option>Custom</option>
							<option>All</option>
						</select>
					</div>
					<div class="form-group" id="form-data">
						<label for="data" class="control-label">Custom Code (Pisah Dengan Koma)</label>
						<input autocomplete="off" type="text" name="data" class="form-control" id="data" placeholder="Tulis Disini.." data-role="tagsinput">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-danger waves-effect waves-light">Submit</button>
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
<script src="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script type="text/javascript">
	$(".select2").select2();

	//=============================================//
	//    File export                              //
	//=============================================//
	var table = $('#file_export').DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			url: '{{ url("teachers/json") }}',
		},
		columns: [
		{ data: 'code', name: 'code' },
		{ data: 'name', name: 'name' },
		{ data: 'subjects', name: 'subjects' },
		{ data: 'position', name: 'position' },
		{ data: 'action', name: 'action' },
		],
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

	$('#data_type').on('change', function(){
		val = this.value;
		if (val == 'Custom') {
			$('#form-data').show();
		}else{
			$('#form-data').hide();
		}
	});
	
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