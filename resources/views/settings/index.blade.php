@extends('layouts.backend')
@push('head')
<link href="{{ asset('assets/libs/toastr/build/toastr.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<!-- File export -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">{{ $page_title }}</h4>
				<form class="form-horizontal r-separator" method="POST" action="{{ url(request()->segment(1)) }}/add">
				{{ csrf_field() }}
				<div class="card-body">
					<div class="form-group row align-items-center m-b-0">
						<label for="title" class="col-3 text-right control-label col-form-label">Judul Website</label>
						<div class="col-9 border-left p-b-10 p-t-10">
							<input autocomplete="off" required="" value="{{ getSettings('title') }}" type="text" name="title" class="form-control" id="title" placeholder="Judul Website">
						</div>
					</div>
					<div class="form-group row align-items-center m-b-0">
						<label for="name" class="col-3 text-right control-label col-form-label">Jam Masuk</label> 
						<div class="col-9 border-left p-b-10 p-t-10">
							<!-- Form Disini -->
							<input autocomplete="off" required="" value="{{ getSettings('time_in') }}" type="time" name="time_in" class="form-control" id="time_in" placeholder="Jam Masuk">
						</div>
					</div>
					<div class="form-group row align-items-center m-b-0">
						<label for="position" class="col-3 text-right control-label col-form-label">Jam Keluar</label> 
						<div class="col-9 border-left p-b-10 p-t-10">
							<!-- Form Disini -->
							<input autocomplete="off" required="" value="{{ getSettings('time_out') }}" type="time" name="time_out" class="form-control" id="time_out" placeholder="Jam Keluar">
						</div>
					</div>
					<div class="form-group row align-items-center m-b-0">
						<label for="position" class="col-3 text-right control-label col-form-label">Jam Set Tanpa Keterangan</label> 
						<div class="col-9 border-left p-b-10 p-t-10">
							<!-- Form Disini -->
							<input autocomplete="off" required="" value="{{ getSettings('set_alpa') }}" type="time" name="set_alpa" class="form-control" id="set_alpa" placeholder="Set Tanpa Keterangan">
						</div>
					</div>
					<div class="form-group row align-items-center m-b-0">
						<label for="position" class="col-3 text-right control-label col-form-label">Jam Set Bolos</label> 
						<div class="col-9 border-left p-b-10 p-t-10">
							<!-- Form Disini -->
							<input autocomplete="off" required="" value="{{ getSettings('set_bolos') }}" type="time" name="set_bolos" class="form-control" id="set_bolos" placeholder="Set Bolos">
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="form-group m-b-0 text-right">
						<button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('bottom')
<script src="{{ asset('assets/libs/toastr/build/toastr.min.js') }}"></script>
@if(Session::has('message'))
<script>
	$(function() {
		toastr.{{ session::get('message_type') }}('{{ session::get('message') }}', '{{ ucwords(session::get('message_type')) }}!');
	});
</script>
@endif
@endpush