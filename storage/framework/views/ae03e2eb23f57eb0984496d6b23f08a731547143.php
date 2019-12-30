<?php $__env->startPush('head'); ?>
<link href="<?php echo e(asset('assets/libs/toastr/build/toastr.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('assets/libs/sweetalert2/dist/sweetalert2.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- File export -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title"><?php echo e($page_title); ?></h4>
				<div class="table-responsive">
					<table id="file_export" class="table table-striped table-bordered display">
						<thead>
							<tr>
								<th>#</th>
								<th>Title</th>
								<th>Content</th>
								<th width="160px">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($key + 1); ?></td>
								<td><?php echo e($row->getTitle()); ?></td>
								<td><?php echo e($row->getContent()); ?></td>
								<td>
									<button onclick="editRow(<?php echo e($row->getId()); ?>)" class="btn btn-xs btn-warning text-white"><i class="fas fa-pencil-alt"></i></button>
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
<div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="title-edit"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<form action="<?php echo e(url(request()->segment(1))); ?>" id="form-edit" method="POST" enctype="multipart/form-data">
				<?php echo e(csrf_field()); ?>

				<div class="modal-body">
					<div class="form-group">
						<label for="content">Content</label>
						<input required="" value="" name="content" autocomplete="off" type="text" id="content" class="form-control" placeholder="Nama Rombel">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default waves-effect" id="close-modal-edit" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-danger waves-effect waves-light">Execute</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('bottom'); ?>
<script src="<?php echo e(asset('assets/libs/select2/dist/js/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/select2/dist/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/extra-libs/DataTables/datatables.min.js')); ?>"></script>
<script type="text/javascript">
	$(".select2").select2();

	//=============================================//
	//    Data Tables                              //
	//=============================================//
	$('#file_export').DataTable({
		dom: 'frtip',
	});
	$('#close-modal-edit').click(function(){
		$("#edit_id").val('');
		$('#edit_name').val('');
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
<script>
	function editRow(id){
		$.ajax({
			url: "<?php echo e(url(request()->segment(1))); ?>/edit/"+id,
            cache: false,
            dataType: "json",
			success: function(data){
				$('#edit').modal('show');
				$('#edit_name').val(data.name);
				$('#form-edit').attr('action','<?php echo e(url(request()->segment(1))); ?>/edit/'+id);
			},
			error: function(data) { 
				console.log(data);
			}
		});
	}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\absensi\resources\views/users/index.blade.php ENDPATH**/ ?>