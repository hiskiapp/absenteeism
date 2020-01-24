@extends('layouts.backend')
@section('content')
<!-- File export -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="form-group row align-items-center m-b-0">
					<label for="api_url" class="col-3 text-right control-label col-form-label">API URL</label>
					<div class="col-6 border-left p-b-10 p-t-10">
						<input readonly="" value="{{ url('api/add-scan') }}" type="text" name="api_url" id="api_url" class="form-control">
					</div>
				</div>
				<div class="form-group row align-items-center m-b-0">
					<label for="api_url" class="col-3 text-right control-label col-form-label">Method</label>
					<div class="col-6 border-left p-b-10 p-t-10">
						<span class="label label-success">POST</span>
					</div>
				</div>
				<div class="form-group row align-items-center m-b-0">
					<label for="api_url" class="col-3 text-right control-label col-form-label">Parameter</label>
					<div class="col-6 border-left p-b-10 p-t-10">
						<span class="label label-info">member_id</span> (NIS / ID Guru)
					</div>
				</div>
				<div class="form-group row align-items-center m-b-0">
					<label for="api_url" class="col-3 text-right control-label col-form-label">Response</label>
					<div class="col-6 border-left p-b-10 p-t-10">
						<span class="label label-warning">api_status</span>
						<span class="label label-danger">api_message</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection