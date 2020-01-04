@extends('layouts.backend')
@push('head')
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/daterangepicker/daterangepicker.css') }}">
@endpush
@section('content')
<!-- File export -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<button class="btn btn-info float-right" data-toggle="collapse" data-target="#form-filter"><i class="fas fa-filter"></i> Filter</button>
				<h4 class="card-title">{{ $page_title }}</h4>
				<h6 class="card-subtitle">{{ $page_description }}</h6>
				<div class="row collapse{{ g('date-range') ? ' show' : ''}}" id="form-filter">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Filter</h4>
								<hr>
								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<label for="gender">Date Range</label>
											<form action="" method="GET">
												<div class='input-group mb-3'>
													<input value="{{ g('date-range') }}" type="text" name="date-range" class="form-control date-range" />
													<div class="input-group-append">
														<span class="input-group-text">
															<span class="ti-calendar"></span>
														</span>
													</div>
													@if(!g('date-range'))
													<button type="button" class="btn btn-secondary waves-effect ml-3" data-toggle="collapse" data-target="#form-filter">Cancel</button>
													@else
													<a class="btn btn-secondary waves-effect ml-3" href="{{ url('log_activity') }}">Reset</a>
													@endif
													<button type="submit" class="btn btn-danger waves-effect waves-light ml-2">Submit</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table id="file_export" class="table table-striped table-bordered display">
						<thead>
							<tr>
								<th>#</th>
								<th>Action</th>
								<th>Page</th>
								<th>Description</th>
								<th>Datetime</th>
								<th>Info</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $key => $row)
							<tr>
								<td>{{ $key + 1 }}</td>
								<?php
								if ($row->action == 'Create') {
									$btn = 'success';
								}elseif ($row->action == 'Update') {
									$btn = 'info';
								}elseif ($row->action == 'Read') {
									$btn = 'primary';
								}else{
									$btn = 'danger';
								}
								?>
								<td><span class="btn btn-{{ $btn }} btn-xs">{{ $row->action }}</span></td>
								<td>{{ $row->page }}</td>
								<td>{{ $row->description }}</td>
								<td>{{ dt($row->created_at)->format('d-m-Y H:i') }}</td>
								<td>{{ timeHumanReadable($row->created_at) }}</td>
							</tr>
							@endforeach
						</tbody>
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
<script src="{{ asset('assets/libs/daterangepicker/daterangepicker.js') }}"></script>
<script type="text/javascript">
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
</script>
@endpush