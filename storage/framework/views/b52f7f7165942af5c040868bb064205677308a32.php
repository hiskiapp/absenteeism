<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white"><?php echo e($page_title); ?></h4>
            </div>
            <form class="form-horizontal">
                <div class="form-body">
                    <div class="card-body">
                        <h4 class="card-title">Info Karyawan</h4>
                    </div>
                    <hr class="m-t-0 m-b-40">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Kode:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e($data->getCode()); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Nama:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e($data->getName()); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Tugas Khusus:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e($data->getPosition()); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <h4 class="card-title mt-5">Alamat</h4>
                    </div>
                    <hr class="m-t-0 m-b-40">
                    <div class="card-body">
                        <div class="row">
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Kota:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e($address->city); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Kecamatan:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e($address->district); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Desa:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e($address->village); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">RT:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e($address->rt); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">RW:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e($address->rw); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-actions">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a href="<?php echo e(url(request()->segment(1))); ?>/edit/<?php echo e($data->getId()); ?>" class="btn btn-danger"> <i class="fa fa-pencil"></i> Edit</a>
                                        <a href="<?php echo e(url(request()->segment(1))); ?>" class="btn btn-dark">Back</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\absensi\resources\views/employees/detail.blade.php ENDPATH**/ ?>