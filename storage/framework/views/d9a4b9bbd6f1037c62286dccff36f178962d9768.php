<?php $__env->startPush('head'); ?>
<link href="<?php echo e(asset('assets/libs/toastr/build/toastr.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- File export -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title"><?php echo e($page_title); ?></h4>
				<form class="form-horizontal r-separator" method="POST" action="">
				<?php echo e(csrf_field()); ?>

				<div class="card-body">
					<div class="form-group row align-items-center m-b-0">
						<label for="code" class="col-3 text-right control-label col-form-label">Judul Website</label>
						<div class="col-9 border-left p-b-10 p-t-10">
							<input autocomplete="off" required="" value="<?php echo e(getSettings('title')); ?>" type="text" name="code" class="form-control" id="code" placeholder="A">
						</div>
					</div>
					<div class="form-group row align-items-center m-b-0">
						<label for="name" class="col-3 text-right control-label col-form-label">Jam Masuk</label> 
						<div class="col-9 border-left p-b-10 p-t-10">
							<!-- Form Disini -->
						</div>
					</div>
					<div class="form-group row align-items-center m-b-0">
						<label for="position" class="col-3 text-right control-label col-form-label">Jam Keluar</label> 
						<div class="col-9 border-left p-b-10 p-t-10">
							<!-- Form Disini -->
						</div>
					</div>
					<div class="form-group row align-items-center m-b-0">
						<label for="position" class="col-3 text-right control-label col-form-label">Jam Set Tanpa Keterangan</label> 
						<div class="col-9 border-left p-b-10 p-t-10">
							<!-- Form Disini -->
						</div>
					</div>
					<div class="form-group row align-items-center m-b-0">
						<label for="position" class="col-3 text-right control-label col-form-label">Jam Set Bolos</label> 
						<div class="col-9 border-left p-b-10 p-t-10">
							<!-- Form Disini -->
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="form-group m-b-0 text-right">
						<button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
						<a href="<?php echo e(url(request()->segment(1))); ?>" class="btn btn-dark waves-effect waves-light">Cancel</a>
					</div>
				</div>
			</form>
			</div>
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
	$('#file_export').DataTable();
	$('#close-modal-edit').click(function(){
		$("#content").val('');
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
				$('#content').val(data.content);
				$('#form-edit').attr('action','<?php echo e(url(request()->segment(1))); ?>/edit/'+id);
				$('#title-edit').html('Edit '+data.title).change();
			},
			error: function(data) { 
				console.log(data);
			}
		});
	}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\absensi\resources\views/settings/index.blade.php ENDPATH**/ ?>