<?php $__env->startPush('head'); ?>
<link href="<?php echo e(asset('assets/libs/toastr/build/toastr.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- File export -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="form-horizontal r-separator" method="POST" action="<?php echo e(url(request()->segment(1))); ?>/add" enctype="multipart/form-data">
				<?php echo e(csrf_field()); ?>

				<div class="card-body">
					<div class="form-group row align-items-center m-b-0">
						<label for="name" class="col-3 text-right control-label col-form-label">Nama</label>
						<div class="col-9 border-left p-b-10 p-t-10">
							<input autocomplete="off" required="" value="<?php echo e($data->name); ?>" type="text" name="name" class="form-control" id="title" placeholder="Nama">
						</div>
					</div>
					<div class="form-group row align-items-center m-b-0">
						<label for="email" class="col-3 text-right control-label col-form-label">Email</label>
						<div class="col-9 border-left p-b-10 p-t-10">
							<input autocomplete="off" required="" value="<?php echo e($data->email); ?>" type="email" name="email" class="form-control" id="email" placeholder="Email">
						</div>
					</div>
					<div class="form-group row align-items-center m-b-0">
						<label for="image" class="col-3 text-right control-label col-form-label">Photo</label>
						<div class="col-9 border-left p-b-10 p-t-10">
							<input autocomplete="off" type="file" name="image" class="form-control-file" id="image" placeholder="Photo">
						</div>
					</div>
				</div>
				<div class="card-body bg-light">
					<div class="form-group row align-items-center m-b-0">
						<label for="password_confirmation" class="col-3 text-right control-label col-form-label">Konfirmasi Password</label>
						<div class="col-9 border-left p-b-10 p-t-10">
							<input autocomplete="off" required="" type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Password">
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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('bottom'); ?>
<script src="<?php echo e(asset('assets/libs/toastr/build/toastr.min.js')); ?>"></script>
<?php if(Session::has('message')): ?>
<script>
	$(function() {
		toastr.<?php echo e(session::get('message_type')); ?>('<?php echo e(session::get('message')); ?>', '<?php echo e(ucwords(session::get('message_type'))); ?>!');
	});
</script>
<?php endif; ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\absensi\resources\views/users/index.blade.php ENDPATH**/ ?>