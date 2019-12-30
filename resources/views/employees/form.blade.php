@extends('layouts.backend')
@push('head')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
<link href="{{ asset('assets/libs/toastr/build/toastr.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<!-- Row -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">{{ $page_title }}</h4>
				<h6 class="card-subtitle">{{ $page_description }}</h6>
			</div>
			<hr class="m-t-0">
			<form class="form-horizontal r-separator" method="POST" action="">
				{{ csrf_field() }}
				<div class="card-body">
					<h4 class="card-title">Personal Info</h4>
					<div class="form-group row align-items-center m-b-0">
						<label for="code" class="col-3 text-right control-label col-form-label">Kode</label>
						<div class="col-9 border-left p-b-10 p-t-10">
							<input autocomplete="off" required="" value="{{ (empty($data) ? old('code') : $data->getCode()) }}" type="text" name="code" class="form-control" id="code" placeholder="A">
						</div>
					</div>
					<div class="form-group row align-items-center m-b-0">
						<label for="name" class="col-3 text-right control-label col-form-label">Nama</label> 
						<div class="col-9 border-left p-b-10 p-t-10">
							<input autocomplete="off" required="" value="{{ (empty($data) ? old('name') : $data->getName()) }}" type="text" name="name" class="form-control" id="name" placeholder="Tulis Disini..">
						</div>
					</div>
					<div class="form-group row align-items-center m-b-0">
						<label for="position" class="col-3 text-right control-label col-form-label">Tugas</label> 
						<div class="col-9 border-left p-b-10 p-t-10">
							<input autocomplete="off" required="" value="{{ (empty($data) ? old('position') : $data->getPosition()) }}" type="text" name="position" class="form-control" id="position" placeholder="Tulis Disini..">
						</div>
					</div>
				</div>
				<div class="card-body bg-light">
					<h4 class="card-title m-t-10 p-b-20">Alamat</h4>
					<div class="row border-bottom">
						<div class="col-sm-12 col-lg-6">
							<div class="form-group row align-items-center m-b-0">
								<label for="district" class="col-3 text-right control-label col-form-label">Kota</label>
								<div class="col-9 border-left p-t-10 p-b-10">
									<input value="{{ (empty($data) ? old('city') : $address->city) }}" required="" type="text" class="form-control" name="city" id="city" placeholder="Jepara">
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-6">
							<div class="form-group row align-items-center m-b-0">
								<label for="district" class="col-3 text-right control-label col-form-label">Kecamatan</label>
								<div class="col-9 border-left p-t-10 p-b-10">
									<input value="{{ (empty($data) ? old('district') : $address->district) }}" required="" type="text" class="form-control" name="district" id="district" placeholder="Keling">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-lg-6">
							<div class="form-group row align-items-center m-b-0">
								<label for="village" class="col-3 text-right control-label col-form-label">Desa</label>
								<div class="col-9 border-left p-t-10 p-b-10">
									<input value="{{ (empty($data) ? old('village') : $address->village) }}" required="" type="text" class="form-control" name="village" id="village" placeholder="Kelet">
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-6">
							<div class="row">
								<div class="col-sm-12 col-lg-6">
									<div class="form-group row align-items-center m-b-0">
										<label for="rt" class="col-3 text-right control-label col-form-label">RT</label>
										<div class="col-9 border-left p-t-10 p-b-10">
											<input value="{{ (empty($data) ? old('rt') : $address->rt) }}" required="" type="number" class="form-control" name="rt" id="rt" placeholder="17">
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-lg-6">
									<div class="form-group row align-items-center m-b-0">
										<label for="rw" class="col-3 text-right control-label col-form-label">RW</label>
										<div class="col-9 border-left p-t-10 p-b-10">
											<input value="{{ (empty($data) ? old('rw') : $address->rw) }}" required="" type="number" class="form-control" name="rw" id="rw" placeholder="3">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="form-group m-b-0 text-right">
						<button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
						<a href="{{ url(request()->segment(1)) }}" class="btn btn-dark waves-effect waves-light">Cancel</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End Row -->
@endsection
@push('bottom')
<script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/libs/moment/moment.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/libs/toastr/build/toastr.min.js') }}"></script>
<script>
	$(".select2").select2();
	jQuery('.mydatepicker, #datepicker, .input-group.date').datepicker({
		format: 'dd-mm-yyyy'
	});
</script>
@endpush