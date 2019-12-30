<?php $__env->startPush('head'); ?>
<link href="<?php echo e(asset('assets/libs/toastr/build/toastr.min.css')); ?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/libs/select2/dist/css/select2.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<button class="btn btn-info float-right" data-toggle="collapse" data-target="#form-filter"><i class="fas fa-filter"></i> Filter</button>
				<h4 class="card-title"><?php echo e($page_title); ?></h4>
				<h6 class="card-subtitle"><?php echo e($page_description); ?></h6>
				<div class="row collapse<?php echo e(g('year') ? ' show' : ''); ?>" id="form-filter">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Filter</h4>
								<hr>
								<form action="" method="GET">
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label for="rombels_id">Rombel</label>
												<select required="" class="select2 form-control" style="width: 100%; height:36px;" name="rombels_id" id="rombels_id">
													<option disabled="" selected="">Pilih Rombel..</option>
													<?php $__currentLoopData = $rombels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option<?php echo e($row->id == g("rombels_id") ? ' selected' : ''); ?> value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="month">Bulan</label>
												<select required="" class="select2 form-control" style="width: 100%; height:36px;" name="month" id="month">
													<option disabled="" selected="">Pilih Bulan..</option>
													<?php $__currentLoopData = $all_month; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option<?php echo e($key == g("month") ? ' selected' : ''); ?> value="<?php echo e($key); ?>"><?php echo e(dt('2011-'.$key.'-01')->format('F')); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select>
											</div>
										</div>
										<div class="col-md-5">
											<div class="form-group">
												<label for="year">Tahun</label>
												<div class='input-group mb-3'>
													<select required="" class="select2 form-control" name="year" id="year" style="width: 40%;height:36px;">
														<option disabled="" selected="">Pilih Tahun..</option>
														<?php $__currentLoopData = $all_year; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<option<?php echo e($key == g("year") ? ' selected' : ''); ?> value="<?php echo e($key); ?>"><?php echo e($key); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</select>
													<?php if(!g('year')): ?>
													<button type="button" class="btn btn-secondary waves-effect ml-3" data-toggle="collapse" data-target="#form-filter">Cancel</button>
													<?php else: ?>
													<a class="btn btn-secondary waves-effect ml-3" href="<?php echo e(url(request()->segment(1).'/'.request()->segment(2))); ?>">Reset</a>
													<?php endif; ?>
													<button type="submit" class="btn btn-danger waves-effect waves-light ml-2">Submit</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-sm table-bordered">
						<thead>
							<tr>
								<th style="vertical-align : middle;text-align:center;" rowspan="2">No</th>
								<th style="vertical-align : middle;text-align:center;" rowspan="2">Nama</th>
								<th colspan="<?php echo e(count($dates)); ?>"><center>Desember</center></th>
							</tr>
							<tr>
								<?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<th<?php echo $d->isWeekend() == 1 ? ' style="background-color: #F2F2F2;"' : ''; ?>><?php echo e($d->format('d')); ?></th>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($key + 1); ?></td>
								<td style="min-width: 225px;"><?php echo e($row->name); ?></td>
								<?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<td<?php echo $d->isWeekend() == 1 ? ' style="background-color: #F2F2F2"' : (colorabsent($row->id,$d) != '' ? ' style="background-color: '.colorabsent($row->id,$d).'"' : '' ); ?>></td>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
				</div>
				<div class="row mt-3">
					<div class="col-md-3">
						<h5>Keterangan</h5>
						<hr>
						<table class="table table-bordered table-sm">
							<tr>
								<th>Warna</th>
								<th>Keterangan</th>
							</tr>
							<tr>
								<td align="center"><span class="badge badge-success">&nbsp&nbsp&nbsp&nbsp</span></td>
								<td>Tepat Waktu</td>
							</tr>
							<tr>
								<td align="center"><span class="badge badge-warning">&nbsp&nbsp&nbsp&nbsp</span></td>
								<td>Terlambat</td>
							</tr>
							<tr>
								<td align="center"><span class="badge badge-danger">&nbsp&nbsp&nbsp&nbsp</span></td>
								<td>Sakit</td>
							</tr>
							<tr>
								<td align="center"><span class="badge badge-info">&nbsp&nbsp&nbsp&nbsp</span></td>
								<td>Izin</td>
							</tr>
							<tr>
								<td align="center"><span class="badge badge-primary">&nbsp&nbsp&nbsp&nbsp</span></td>
								<td>Tanpa Keterangan</td>
							</tr>
							<tr>
								<td align="center"><span class="badge badge-secondary">&nbsp&nbsp&nbsp&nbsp</span></td>
								<td>Bolos</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('bottom'); ?>
<script src="<?php echo e(asset('assets/libs/select2/dist/js/select2.min.js')); ?>"></script>
<script type="text/javascript">
	$(".select2").select2();
</script>

<script src="<?php echo e(asset('assets/libs/toastr/build/toastr.min.js')); ?>"></script>
<?php if(Session::has('message')): ?>
<script>
	$(function() {
		toastr.<?php echo e(session::get('message_type')); ?>('<?php echo e(session::get('message')); ?>', '<?php echo e(ucwords(session::get('message_type'))); ?>!');
	});
</script>
<?php endif; ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\absensi\resources\views/absent/students/calendar.blade.php ENDPATH**/ ?>