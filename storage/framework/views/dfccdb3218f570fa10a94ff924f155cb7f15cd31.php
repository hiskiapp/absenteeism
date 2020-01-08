<?php $__env->startPush('head'); ?>
<link href="<?php echo e(asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('assets/libs/toastr/build/toastr.min.css')); ?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/libs/select2/dist/css/select2.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/libs/lightbox/dist/ekko-lightbox.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- File export -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="float-right">
					<button class="btn btn-success" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Set Absensi</button>
					<button class="btn btn-info" data-toggle="collapse" data-target="#form-filter"><i class="fas fa-filter"></i> Filter</button>
					<button class="btn btn-warning" data-toggle="modal" data-target="#change-date"><i class="fa fa-calendar"></i> Ganti Tanggal</button>
					<button type="button" class="btn btn-primary btn-outline btn-alpa" data-toggle="tooltip" data-placement="top" title="Tandai Status Semua Siswa Yang Belum Absen Menjadi Alpa"><i class="fas fa-compass"></i> Tandai Alpa</button>
					<button type="button" class="btn btn-secondary btn-outline btn-bolos" data-toggle="tooltip" data-placement="top" title="Tandai Status Semua Siswa Yang Belum Absen Keluar Menjadi Bolos"><i class="fas fa-external-link-alt"></i> Tandai Bolos</button>
				</div>
				<h4 class="card-title"><?php echo e($page_title); ?></h4>
				<h6 class="card-subtitle"><?php echo e($page_description); ?></h6>
				<div class="row collapse" id="form-filter">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Filter</h4>
								<hr>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="rombels">Rombel</label>
											<select required="" class="select2 form-control" style="width: 100%; height:36px;" name="rombels" id="rombels">
												<option disabled="" selected="">Pilih Rombel..</option>
												<?php $__currentLoopData = $rombels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option><?php echo e($row->name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="type">Type</label>
											<select required="" class="select2 form-control" style="width: 100%; height:36px;" name="type" id="type">
												<option disabled="" selected="">Pilih Type..</option>
												<option>Tepat Waktu</option>
												<option>Terlambat</option>
												<option>Sakit</option>
												<option>Izin</option>
												<option>Alpa</option>
												<option>Bolos</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row m-t-20">
					<!-- Column -->
					<div class="col-md-4 col-lg-2 col-xlg-2">
						<div class="card card-hover">
							<div class="box bg-success text-center">
								<h1 class="font-light text-white"><?php echo e(absentstat('Tepat Waktu',$date)); ?></h1>
								<h6 class="text-white">Tepat Waktu</h6>
							</div>
						</div>
					</div>
					<!-- Column -->
					<div class="col-md-4 col-lg-2 col-xlg-2">
						<div class="card card-hover">
							<div class="box bg-warning text-center">
								<h1 class="font-light text-white"><?php echo e(absentstat('Terlambat',$date)); ?></h1>
								<h6 class="text-white">Terlambat</h6>
							</div>
						</div>
					</div>
					<!-- Column -->
					<div class="col-md-4 col-lg-2 col-xlg-2">
						<div class="card card-hover">
							<div class="box bg-danger text-center">
								<h1 class="font-light text-white"><?php echo e(absentstat('Sakit',$date)); ?></h1>
								<h6 class="text-white">Sakit</h6>
							</div>
						</div>
					</div>
					<!-- Column -->
					<div class="col-md-4 col-lg-2 col-xlg-2">
						<div class="card card-hover">
							<div class="box bg-info text-center">
								<h1 class="font-light text-white"><?php echo e(absentstat('Izin',$date)); ?></h1>
								<h6 class="text-white">Izin</h6>
							</div>
						</div>
					</div>
					<!-- Column -->
					<div class="col-md-4 col-lg-2 col-xlg-2">
						<div class="card card-hover">
							<div class="box bg-primary text-center">
								<h1 class="font-light text-white"><?php echo e(absentstat('Tanpa Keterangan',$date)); ?></h1>
								<h6 class="text-white">Alpa</h6>
							</div>
						</div>
					</div>
					<!-- Column -->
					<div class="col-md-4 col-lg-2 col-xlg-2">
						<div class="card card-hover">
							<div class="box bg-secondary text-center">
								<h1 class="font-light text-white"><?php echo e(absentstat('Bolos',$date)); ?></h1>
								<h6 class="text-white">Bolos</h6>
							</div>
						</div>
					</div>
					<!-- Column -->
				</div>
				<div class="table-responsive">
					<table id="file_export" class="table table-striped table-bordered display">
						<thead>
							<tr>
								<th>NIS</th>
								<th>Nama Siswa</th>
								<th>Rombel</th>
								<th>Type</th>
								<th>Jam Masuk</th>
							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($row->nis); ?></td>
								<td><?php echo e($row->name); ?></td>
								<td><?php echo e($row->rombel); ?></td>
								<?php
								if ($row->type == "Tepat Waktu") {
									$label = 'success';
								}elseif ($row->type == "Terlambat") {
									$label = 'warning';
								}elseif ($row->type == "Sakit") {
									$label = 'danger';
								}elseif ($row->type == "Izin") {
									$label = 'info';
								}elseif ($row->type == "Tanpa Keterangan") {
									$label = 'primary';
								}elseif ($row->type == "Bolos") {
									$label = 'success';
								}
								?>
								<td>
									<span class="label label-<?php echo e($label); ?>"><?php echo e($row->type); ?></span>
									<?php if($row->photo): ?>
									<a href="<?php echo e(url($row->photo)); ?>" data-toggle="lightbox" data-title="<?php echo e($row->name); ?>" data-footer="Keterangan: <?php echo e($row->type); ?>"><span class="label label-success">Lihat Bukti</span></a>
									<?php endif; ?>
								</td>
								<td><?php echo e($row->time_in ? $row->time_in : '-'); ?></td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
				<h4 class="modal-title">Tambah Absensi</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<form action="<?php echo e(url('absent/add-students-absent')); ?>" method="POST" enctype="multipart/form-data">
				<?php echo e(csrf_field()); ?>

				<div class="modal-body">
					<div class="form-group">
						<label for="nis">NIS</label>
						<div class="input-group">
							<input required="" value="" autocomplete="off" type="text" name="nis" id="nis" class="form-control" placeholder="NIS">
							<div class="input-group-append">
								<button class="btn btn-outline-secondary" type="button" style="width: 100px;" data-toggle="modal" data-target="#modal-students-data">Pilih</button>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="add-type">Tanggal</label>
						<div class="input-group">
							<input name="add-date" required="" type="text" class="form-control mydatepicker" value="<?php echo e($date); ?>" placeholder="mm/dd/yyyy">
							<div class="input-group-append">
								<span class="input-group-text"><i class="icon-Calendar"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="add-type">Type</label>
						<select required="" class="select2 form-control" style="width: 100%; height:36px;" name="add-type" id="add-type">
							<option disabled="">Pilih Type..</option>
							<option>Tepat Waktu</option>
							<option>Terlambat</option>
							<option selected="">Sakit</option>
							<option>Izin</option>
							<option>Tanpa Keterangan</option>
						</select>
					</div>
					<div class="form-group" id="form-photo">
						<label for="add-type">Bukti (Photo) <span class="badge badge-primary ml-2">Optional</span></label>
						<div class="input-group">
							<input type="file" name="photo" id="photo" class="form-control-file">
						</div>
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
<div id="change-date" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ganti Tanggal</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<form action="" method="GET" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label for="add-type">Tanggal</label>
						<div class="input-group">
							<input name="date" required="" type="text" class="form-control mydatepicker" value="<?php echo e($date); ?>" placeholder="mm/dd/yyyy">
							<div class="input-group-append">
								<span class="input-group-text"><i class="icon-Calendar"></i></span>
							</div>
						</div>
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
<div id="modal-students-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Data Siswa</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<form action="<?php echo e(url(request()->segment(1))); ?>/add" method="POST" enctype="multipart/form-data">
				<?php echo e(csrf_field()); ?>

				<div class="modal-body">
					<div class="table-responsive">
						<table id="students-data" class="table table-striped table-bordered display" style="width:100%">
							<thead>
								<tr>
									<th>NIS</th>
									<th>Nama Siswa</th>
									<th>Rombel</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('bottom'); ?>
<script src="<?php echo e(asset('assets/libs/moment/moment.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/select2/dist/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/extra-libs/DataTables/datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/lightbox/dist/ekko-lightbox.min.js')); ?>"></script>
<script type="text/javascript">
	$(".select2").select2();
	jQuery('.mydatepicker, #datepicker, .input-group.date').datepicker();
	var studentstable = $('#students-data').DataTable({
		processing: true,
		serverSide: true,
		ajax: '<?php echo e(url('students/json')); ?>',
		columns: [
		{ data: 'nis', name: 'nis' },
		{ data: 'name', name: 'name' },
		{ data: 'rombel', name: 'rombel' },
		]
	});
	$(document).on('click', '[data-toggle="lightbox"]', function(event) {
		event.preventDefault();
		$(this).ekkoLightbox();
	});
	$('#students-data').on( 'click', 'tr', function () {
		var data = studentstable.row(this).data();
		$('#modal-students-data').modal('hide');
		$("#nis").val(data.nis);
	});

	var table = $('#file_export').DataTable();
	$('#rombels').change(function(){
		table.column(2).search(this.value).draw();  
	});
	$('#type').change(function(){
		table.column(3).search(this.value).draw();  
	});
	$('#form-filter').on('hidden.bs.collapse', function(){
		$("#rombels").val('Pilih Rombel..').change();
		$("#type").val('Pilih Type..').change();
		table.column(2).search('').draw();
		table.column(3).search('').draw();
	})
	$('#add-type').on('change', function(){
		val = this.value;
		if (val == 'Tepat Waktu') {
			$('#form-photo').hide();
		}else if(val == 'Terlambat') {
			$('#form-photo').hide();
		}else{
			$('#form-photo').show();
		}
	});
</script>

<script src="<?php echo e(asset('assets/libs/toastr/build/toastr.min.js')); ?>"></script>
<?php if(Session::has('message')): ?>
<script>
	$(function() {
		toastr.<?php echo e(session::get('message_type')); ?>('<?php echo e(session::get('message')); ?>', '<?php echo e(ucwords(session::get('message_type'))); ?>!');
	});
</script>
<?php endif; ?>

<script src="<?php echo e(asset('assets/libs/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>
<script type="text/javascript">
	$('.btn-alpa').click(function(){
		Swal.fire({
			title: 'Sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, do it!'
		}).then((result) => {
			if (result.value) {
				window.location = "<?php echo e(url('absent/mark-students-alpa')); ?>";
			}
		});
	});
	$('.btn-bolos').click(function(){
		Swal.fire({
			title: 'Sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, do it!'
		}).then((result) => {
			if (result.value) {
				window.location = "<?php echo e(url('absent/mark-students-bolos')); ?>";
			}
		});
	});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\absensi\resources\views/absent/students/list.blade.php ENDPATH**/ ?>