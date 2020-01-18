@extends('layouts.backend')
@push('head')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
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
						<label for="nis" class="col-3 text-right control-label col-form-label">NIS</label>
						<div class="col-9 border-left p-b-10 p-t-10">
							<input autocomplete="off" required="" value="{{ (empty($data) ? old('nis') : $data->getNis()) }}" type="text" name="nis" class="form-control" id="nis" placeholder="11700599">
						</div>
					</div>
					<div class="form-group row align-items-center m-b-0">
						<label for="name" class="col-3 text-right control-label col-form-label">Nama</label> 
						<div class="col-9 border-left p-b-10 p-t-10">
							<input autocomplete="off" required="" value="{{ (empty($data) ? old('name') : $data->getName()) }}" type="text" name="name" class="form-control" id="name" placeholder="Hiskia Anggi">
						</div>
					</div>
					<div class="form-group row align-items-center m-b-0">
						<label for="rombel_id" class="col-3 text-right control-label col-form-label">Rombel</label>
						<div class="col-9 border-left p-b-10 p-t-10">
							<select required="" class="select2 form-control" style="width: 100%; height:36px;" name="rombel_id" id="rombel_id">
								<option disabled="" selected="">Pilih Rombel..</option>
								@foreach($rombels as $row)
								<option {{  empty($data) ? '' : ($data->getRombelsId()->getId() == $row->id ? 'selected' : '') }} value="{{ $row->id }}">{{ $row->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row align-items-center m-b-0">
						<label for="rayons_id" class="col-3 text-right control-label col-form-label">Rayon</label>
						<div class="col-9 border-left p-b-10 p-t-10">
							<select required="" class="select2 form-control" style="width: 100%; height:36px;" name="rayons_id" id="rayons_id">
								<option disabled="" selected="">Pilih Rayon..</option>
								@foreach($rayons as $row)
								<option {{  empty($data) ? '' : ($data->getRayonsId()->getId() == $row->id ? 'selected' : '') }} value="{{ $row->id }}">{{ $row->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row align-items-center m-b-0">
						<label for="gender" class="col-3 text-right control-label col-form-label">Jenis Kelamin</label>
						<div class="col-9 border-left p-b-10 p-t-10">
							<select required="" class="form-control" name="gender" id="gender">
								<option disabled="" selected="">Pilih Jenis Kelamin..</option>
								<option {{  empty($data) ? '' : ($data->getGender() == 'Laki - Laki' ? 'selected' : '') }} value="Laki - Laki">Laki - Laki</option>
								<option {{  empty($data) ? '' : ($data->getGender() == 'Perempuan' ? 'selected' : '') }} value="Perempuan">Perempuan</option>
							</select>
						</div>
					</div>
					<div class="form-group row align-items-center m-b-0">
						<label for="birth_city" class="col-3 text-right control-label col-form-label">Kota Lahir</label>
						<div class="col-9 border-left p-b-10 p-t-10">
							<div id="birth_city">
								<input required="" value="{{ (empty($data) ? old('birth_city') : $data->getBirthCity()) }}" autocomplete="off" type="text" name="birth_city" class="typeahead form-control" placeholder="Kota Lahir">
							</div>
						</div>
					</div>
					<div class="form-group row align-items-center m-b-0">
						<label for="birth_date" class="col-3 text-right control-label col-form-label">Tanggal Lahir</label>
						<div class="col-9 border-left p-b-10 p-t-10">
							<input autocomplete="off" required="" value="{{ (empty($data) ? old('birth_city') : datePicker($data->getBirthDate())) }}" type="text" name="birth_date" class="form-control mydatepicker" placeholder="dd-mm-yyyy">
						</div>
					</div>
					<div class="form-group row align-items-center m-b-0">
						<label for="religion" class="col-3 text-right control-label col-form-label">Agama</label>
						<div class="col-9 border-left p-b-10 p-t-10">
							<select required="" class="form-control" name="religion" id="religion">
								<option disabled="" selected="">Pilih Agama..</option>
								<option {{  empty($data) ? '' : ($data->getReligion() == 'Islam' ? 'selected' : '') }} value="Islam">Islam</option>
								<option {{  empty($data) ? '' : ($data->getReligion() == 'Kristen' ? 'selected' : '') }} value="Kristen">Kristen</option>
								<option {{  empty($data) ? '' : ($data->getReligion() == 'Buddha' ? 'selected' : '') }} value="Buddha">Buddha</option>
								<option {{  empty($data) ? '' : ($data->getReligion() == 'Katolik' ? 'selected' : '') }} value="Katolik">Katolik</option>
								<option {{  empty($data) ? '' : ($data->getReligion() == 'Hindu' ? 'selected' : '') }} value="Hindu">Hindu</option>
								<option {{  empty($data) ? '' : ($data->getReligion() == 'Konghucu' ? 'selected' : '') }} value="Konghucu">Konghucu</option>
							</select>
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
					<div class="form-group row align-items-center m-b-0">
						<label for="name_of_guardian" class="col-3 text-right control-label col-form-label">Nama Wali</label>
						<div class="col-9 border-left p-b-10 p-t-10">
							<input autocomplete="off" value="{{ (empty($data) ? old('name_of_guardian') : $data->getNameOfGuardian()) }}" required="" type="text" name="name_of_guardian" class="form-control" id="name_of_guardian" placeholder="Tulis Disini..">
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
<script src="{{ asset('assets/libs/typeahead.js/dist/typeahead.jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/typeahead.js/dist/bloodhound.min.js') }}"></script>
<script src="{{ asset('assets/libs/toastr/build/toastr.min.js') }}"></script>
<script>
	$(".select2").select2();
	jQuery('.mydatepicker, #datepicker, .input-group.date').datepicker({
		format: 'dd-mm-yyyy'
	});
</script>
<script>
	//*************
	//The basics
	//*************
	var substringMatcher = function(strs) {
		return function findMatches(q, cb) {
			var matches, substringRegex;

	    // an array that will be populated with substring matches
	    matches = [];

	    // regex used to determine if a string contains the substring `q`
	    substrRegex = new RegExp(q, 'i');

	    // iterate through the pool of strings and for any string that
	    // contains the substring `q`, add it to the `matches` array
	    $.each(strs, function(i, str) {
	    	if (substrRegex.test(str)) {
	    		matches.push(str);
	    	}
	    });

	    cb(matches);
	};
};

var birth_city = ["{!! $birth_city !!}"];;


$('#birth_city .typeahead').typeahead({
	hint: true,
	highlight: true,
	minLength: 1
},
{
	name: 'birth_city',
	source: substringMatcher(birth_city)
});
</script>
@endpush