@extends('layouts.backend')
@push('head')
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link href="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<!-- File export -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<button class="btn btn-info float-right" onclick="mark_all()"><i class="fas fa-filter"></i> Tandai Semua Menjadi Telah Dibaca</button>
				<h4 class="card-title">{{ $page_title }}</h4>
				<h6 class="card-subtitle">{{ $page_description }}</h6>
				<div class="table-responsive">
					<table id="file_export" class="table table-bordered display">
						<thead>
							<tr>
								<th>Title</th>
								<th>Description</th>
								<th>Time</th>
								<th>Status</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('bottom')
<script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/libs/moment/moment.js') }}"></script>
<script src="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script type="text/javascript">
	var table = $('#file_export').DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			url: '{{ url("json/notifications") }}',
		},
		columns: [
		{ data: 'title', name: 'title' },
		{ data: 'description', name: 'description' },
		{ data: 'time', name: 'time' },
		{ data: 'status', name: 'status' },
		]
	});

	function mark_all(){
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, reset it!'
		}).then((result) => {
			if (result.value) {

				$.ajax({
					url: "{{ url('notifications/mark-all')}}",
					type: "POST",
					dataType: "json",
					success:function(data){
						if (data.ajax_status) {
							table.ajax.reload();
							toastr.success(data.ajax_message);
						}else{
							toastr.error(data.ajax_message);
						}
					},
					error:function(data){
						console.log(data);
					}
				});
			}
		});
	}
</script>
@endpush