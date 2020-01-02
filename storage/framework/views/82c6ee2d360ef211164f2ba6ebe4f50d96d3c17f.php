<?php $__env->startPush('head'); ?>
<link href="<?php echo e(asset('assets/libs/toastr/build/toastr.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('assets/libs/sweetalert2/dist/sweetalert2.min.css')); ?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/libs/select2/dist/css/select2.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- File export -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="float-right">
					<a href="<?php echo e(request()->segment(1)); ?>/add" class="btn btn-secondary"><i class="fa fa-plus"></i> Add</a>
					<button class="btn btn-danger" data-toggle="modal" data-target="#import"><i class="fas fa-sign-in-alt"></i> Import</button>
					<button class="btn btn-info" data-toggle="collapse" data-target="#form-filter"><i class="fas fa-filter"></i> Filter</button>
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
											<label for="rayons">Rayon</label>
											<select required="" class="select2 form-control" style="width: 100%; height:36px;" name="rayons" id="rayons">
												<option disabled="" selected="">Pilih Rayon..</option>
												<?php $__currentLoopData = $rayons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option><?php echo e($row->name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="gender">Jenis Kelamin</label>
											<select required="" class="select2 form-control" style="width: 100%; height:36px;" name="gender" id="gender">
												<option disabled="" selected="">Pilih Jenis Kelamin..</option>
												<option value="L">Laki - Laki</option>
												<option value="P">Perempuan</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="religion">Agama</label>
											<select required="" class="select2 form-control" style="width: 100%; height:36px;" name="religion" id="religion">
												<option disabled="" selected="">Pilih Agama..</option>
												<option>Islam</option>
												<option>Kristen</option>
												<option>Buddha</option>
												<option>Katolik</option>
												<option>Hindu</option>
												<option>Konghucu</option>
											</select>
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
								<th>NIS</th>
								<th>Nama</th>
								<th>Rombel</th>
								<th>Rayon</th>
								<th>JK</th>
								<th>Tempat Lahir</th>
								<th>Agama</th>
								<th width="160px">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($row->nis); ?></td>
								<td><?php echo e($row->name); ?></td>
								<td><?php echo e($row->rombels_name); ?></td>
								<td><?php echo e($row->rayons_name); ?></td>
								<td><?php echo e(substr($row->gender, 0, 1)); ?></td>
								<td><?php echo e($row->birth_city); ?></td>
								<td><?php echo e($row->religion); ?></td>
								<td>
									<a href="<?php echo e(request()->segment(1)); ?>/edit/<?php echo e($row->id); ?>" class="btn btn-xs btn-warning text-white"><i class="fas fa-pencil-alt"></i></a>
									<button onclick="deleteRow(<?php echo e($row->id); ?>)" class="btn btn-xs btn-danger text-white"><i class="fas fa-trash-alt"></i></button>
									<a href="<?php echo e(request()->segment(1)); ?>/detail/<?php echo e($row->id); ?>" class="btn btn-xs btn-info text-white"><i class="fas fa-eye"></i></a>
								</td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
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
				<h4 class="modal-title">Import <?php echo e($page_title); ?></h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<form action="<?php echo e(url(request()->segment(1))); ?>/import" method="POST" enctype="multipart/form-data">
				<?php echo e(csrf_field()); ?>

				<div class="modal-body">
					<div class="form-group">
						<label for="recipient-name" class="control-label">File Import:</label>
						<input type="file" required="" accept=".xls,.xlsx" name="file_export" class="form-control-file">
						<span class="form-text text-muted">Download Example <a href="<?php echo e(url('sample/ImportStudents.xlsx')); ?>">Import File Here</a></span>
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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('bottom'); ?>
<script src="<?php echo e(asset('assets/libs/select2/dist/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/extra-libs/DataTables/datatables.min.js')); ?>"></script>
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
				columns: [ 0, 1, 2, 3, 4, 5, 6 ]
			}
		},
		{
			extend: 'csv',
			exportOptions: {
				columns: [ 0, 1, 2, 3, 4, 5, 6 ]
			}
		},
		{
			extend: 'excel',
			exportOptions: {
				columns: [ 0, 1, 2, 3, 4, 5, 6 ]
			}
		},
		{
			extend: 'pdf',
			exportOptions: {
				columns: [ 0, 1, 2, 3, 4, 5, 6 ]
			}
		},
		{
			extend: 'print',
			exportOptions: {
				columns: [ 0, 1, 2, 3, 4, 5, 6 ]
			}
		},
		]
	});
	
	$('.buttons-copy').addClass('btn btn-primary mr-1');
	$('.buttons-csv').addClass('btn btn-success mr-1');
	$('.buttons-print').addClass('btn btn-info mr-1');
	$('.buttons-pdf').addClass('btn btn-warning mr-1');
	$('.buttons-excel').addClass('btn btn-danger mr-1');

	$('#rombels').change(function(){
		table.column(2).search(this.value).draw();  
	});

	$('#rayons').change(function(){
		table.column(3).search(this.value).draw();  
	});

	$('#gender').change(function(){
		table.column(4).search(this.value).draw();  
	});

	$('#religion').change(function(){
		table.column(6).search(this.value).draw();  
	});

	$('#form-filter').on('hidden.bs.collapse', function(){
		table.column(2).search('').draw();
		table.column(3).search('').draw();
	})
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
				window.location = "<?php echo e(url(request()->segment(1))); ?>/delete/"+id;
			}
		});
	}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\absensi\resources\views/students/index.blade.php ENDPATH**/ ?>