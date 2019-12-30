<?php $__env->startPush('head'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="card-group">
    <!-- Card -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="m-r-10">
                    <span class="btn btn-circle btn-lg bg-danger">
                        <i class="ti-clipboard text-white"></i>
                    </span>
                </div>
                <div>
                 Siswa
             </div>
             <div class="ml-auto">
                <h2 class="m-b-0 font-light"><?php echo e($students); ?></h2>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="m-r-10">
                <span class="btn btn-circle btn-lg btn-info">
                    <i class="ti-wallet text-white"></i>
                </span>
            </div>
            <div>
                Guru / Karyawan
            </div>
            <div class="ml-auto">
                <h2 class="m-b-0 font-light"><?php echo e($teachers); ?></h2>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="m-r-10">
                <span class="btn btn-circle btn-lg bg-success">
                    <i class="ti-shopping-cart text-white"></i>
                </span>
            </div>
            <div>
                Rombel
            </div>
            <div class="ml-auto">
                <h2 class="m-b-0 font-light"><?php echo e($rombels); ?></h2>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="m-r-10">
                <span class="btn btn-circle btn-lg bg-warning">
                    <i class="mdi mdi-currency-usd text-white"></i>
                </span>
            </div>
            <div>
                Rayon
            </div>
            <div class="ml-auto">
                <h2 class="m-b-0 font-light"><?php echo e($rayons); ?></h2>
            </div>
        </div>
    </div>
</div>
</div>
<div class="row">
    <!-- Column -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Statistik Absensi Siswa</h4>
                <div>
                    <canvas id="absensi-siswa" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('bottom'); ?>
<script src="<?php echo e(asset('assets/libs/Chart.js/dist/Chart.min.js')); ?>"></script>
<script>
    $(function () {
        "use strict";

        new Chart(document.getElementById("absensi-siswa"), {
          type: 'line',
          data: {
            labels: [<?php echo $dates; ?>],
            datasets: [{ 
                data: [<?php echo $tepat_waktu; ?>],
                label: "Tepat Waktu",
                borderColor: "#22C6AB",
                fill: false
            },
            { 
                data: [<?php echo $terlambat; ?>],
                label: "Terlambat",
                borderColor: "#FFBC34",
                fill: false
            }, { 
                data: [<?php echo $sakit; ?>],
                label: "Sakit",
                borderColor: "#EF6E6E",
                fill: false
            }, { 
                data: [<?php echo $izin; ?>],
                label: "Izin",
                borderColor: "#4798E8",
                fill: false
            }, { 
                data: [<?php echo $alpa; ?>],
                label: "Alpa",
                borderColor: "#7460EE",
                fill: false
            }, { 
                data: [<?php echo $bolos; ?>],
                label: "Bolos",
                borderColor: "#6C757D",
                fill: false
            }
            ]
        },
        options: {
            title: {
              display: true,
              text: '<?php echo e(date('F Y')); ?>'
          }
      }
  });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\absensi\resources\views/dashboard.blade.php ENDPATH**/ ?>