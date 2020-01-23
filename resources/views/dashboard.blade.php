@extends('layouts.backend')
@push('head')

@endpush
@section('content')
<!-- ============================================================== -->
<!-- Welcome back  -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-lg-12">
        <div class="card  bg-light no-card-border">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="m-r-10">
                        <img src="{{ url(Auth::user()->photo) }}" alt="user" width="60" class="rounded-circle" />
                    </div>
                    <div>
                        <h3 class="m-b-0">Welcome back!</h3>
                        <span>{{ now()->format('l, d F Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-group">
    <!-- Card -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="m-r-10">
                    <span class="btn btn-circle btn-lg bg-danger">
                        <i class="ti-user text-white"></i>
                    </span>
                </div>
                <div>
                   Siswa
               </div>
               <div class="ml-auto">
                <h2 class="m-b-0 font-light">{{ $students }}</h2>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="m-r-10">
                <span class="btn btn-circle btn-lg btn-info">
                    <i class="ti-direction text-white"></i>
                </span>
            </div>
            <div>
                Guru / Karyawan
            </div>
            <div class="ml-auto">
                <h2 class="m-b-0 font-light">{{ $teachers }}</h2>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="m-r-10">
                <span class="btn btn-circle btn-lg bg-success">
                    <i class="ti-bookmark-alt text-white"></i>
                </span>
            </div>
            <div>
                Rombel
            </div>
            <div class="ml-auto">
                <h2 class="m-b-0 font-light">{{ $rombels }}</h2>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="m-r-10">
                <span class="btn btn-circle btn-lg bg-warning">
                    <i class="ti-layout text-white"></i>
                </span>
            </div>
            <div>
                Rayon
            </div>
            <div class="ml-auto">
                <h2 class="m-b-0 font-light">{{ $rayons }}</h2>
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
                <h4 class="card-title">Statistik Absensi</h4>
                <h6 class="card-subtitle">Siswa SMK Wikrama 1 Jepara</h6>
                <div>
                    <canvas id="absensi-siswa" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('bottom')
<script src="{{ asset('assets/libs/Chart.js/dist/Chart.min.js') }}"></script>
<script>
    $(function(){
        "use strict";

        new Chart(document.getElementById("absensi-siswa"), {
          type: 'line',
          data: {
            labels: [{!! $dates !!}],
            datasets: [{ 
                data: [{!! $tepat_waktu !!}],
                label: "Tepat Waktu",
                borderColor: "#22C6AB",
                fill: false
            },
            { 
                data: [{!! $terlambat !!}],
                label: "Terlambat",
                borderColor: "#FFBC34",
                fill: false
            }, { 
                data: [{!! $sakit !!}],
                label: "Sakit",
                borderColor: "#EF6E6E",
                fill: false
            }, { 
                data: [{!! $izin !!}],
                label: "Izin",
                borderColor: "#4798E8",
                fill: false
            }, { 
                data: [{!! $alpa !!}],
                label: "Alpa",
                borderColor: "#7460EE",
                fill: false
            }, { 
                data: [{!! $bolos !!}],
                label: "Bolos",
                borderColor: "#6C757D",
                fill: false
            }
            ]
        },
        options: {
            title: {
              display: true,
              text: '{{ now()->format('F Y') }}'
          }
      }
  });
    });
</script>
@endpush