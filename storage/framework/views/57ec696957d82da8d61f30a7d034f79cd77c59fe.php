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
                        <h4 class="card-title">Info Siswa</h4>
                    </div>
                    <hr class="m-t-0 m-b-40">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">NIS:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e($data->getNis()); ?> </p>
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
                                    <label class="control-label text-right col-md-3">Rombel:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e($data->getRombelsId()->getName()); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Rayon:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e($data->getRayonsId()->getName()); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Jenis Kelamin:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e($data->getGender()); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Tempat Lahir:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e($data->getBirthCity()); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Tanggal Lahir:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e(dateFormat($data->getBirthDate())); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Religion:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e($data->getReligion()); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Nama Wali:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e($data->getNameOfGuardian()); ?> </p>
                                    </div>
                                </div>
                            </div>
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
                        <h4 class="card-title mt-5">Statistik Absensi</h4>
                    </div>
                    <hr class="m-t-0 m-b-40">
                    <div class="card-body">
                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Tepat Waktu:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e(absentstatistict($data->getId(),'Tepat Waktu')); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Terlambat:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e(absentstatistict($data->getId(),'Terlambat')); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Sakit:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e(absentstatistict($data->getId(),'Sakit')); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Izin:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e(absentstatistict($data->getId(),'Izin')); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Tanpa Keterangan:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e(absentstatistict($data->getId(),'Tanpa Keterangan')); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Bolos:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php echo e(absentstatistict($data->getId(),'Bolos')); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <h4 class="card-title mt-5">Scan QR Code</h4>
                    </div>
                    <hr class="m-t-0 m-b-40">
                    <div class="card-body">
                        <center><img src="data:image/png;base64, <?php echo base64_encode(QrCode::format('png')->size(250)->generate($qrcode)); ?> "></center>
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
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\absensi\resources\views/students/detail.blade.php ENDPATH**/ ?>