@extends('layouts.backend')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">{{ $page_title }}</h4>
            </div>
            <form class="form-horizontal">
                <div class="form-body">
                    <div class="card-body">
                        <h4 class="card-title">Info Guru</h4>
                    </div>
                    <hr class="m-t-0 m-b-40">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Kode:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> {{ $data->getCode() }} </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Nama:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> {{ $data->getName() }} </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Mapel:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static">
                                            <?php
                                            $subjects = explode(',', $data->getSubjects());
                                            ?>

                                            @foreach($subjects as $row)
                                            <span class="btn btn-info btn-xs">{{ $row }}</span>
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Tugas Khusus:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> {{ $data->getPosition() }} </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Hari Kerja:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static">
                                            @foreach($weekdays as $row)
                                            <span class="btn btn-info btn-xs">{{ $row }}</span>
                                            @endforeach
                                        </p>
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
                                        <p class="form-control-static"> {{ $address->city }} </p>
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
                                        <p class="form-control-static"> {{ $address->district }} </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Desa:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> {{ $address->village }} </p>
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
                                        <p class="form-control-static"> {{ $address->rt }} </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">RW:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> {{ $address->rw }} </p>
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
                                    <p class="form-control-static"> 0 </p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Terlambat:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> 0 </p>
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
                                    <p class="form-control-static"> 0 </p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Izin:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> 0 </p>
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
                                    <p class="form-control-static"> 0 </p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Bolos:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> 0 </p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <h4 class="card-title mt-5">Scan QR Code</h4>
                </div>
                <hr class="m-t-0 m-b-40">
                <div class="card-body">
                    <center><img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(250)->generate($qrcode)) !!} "></center>
                </div>
            </div>
            <hr>
            <div class="form-actions">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <a href="{{ url(request()->segment(1)) }}/edit/{{ $data->getId() }}" class="btn btn-danger"> <i class="fa fa-pencil"></i> Edit</a>
                                    <a href="{{ url(request()->segment(1)) }}" class="btn btn-dark">Back</a>
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
@endsection