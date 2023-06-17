<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $jmlAnggota }}</h3>
                        <p>Total Pengungsi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-ttlpengungsi">Tampil
                        Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $ttlKpl }}</h3>
                        <p>Total Kepala Keluarga</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-kkeluarga">Tampil
                        Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3 style="color: #ffff;">{{ $ttlBalita }}</h3>
                        <p style="color: #ffff;">Total Balita</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-baby"></i>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-bayi" style="color: #ffff !important;">Tampil Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3 style="color: #ffff;">{{ $ttlLansia }}</h3>
                        <p style="color: #ffff;">Total Lansia</p>
                    </div>
                    <div class="icon">
                        <svg class="icon-statistik" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M272 48c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 
                            48 48 48s48-21.5 48-48zm-8 187.3l47.4 57.1c11.3 13.6 31.5 
                            15.5 45.1 4.2s15.5-31.5 4.2-45.1l-73.7-88.9c-18.2-22-45.3-34.7-73.9-34.7H177.1c-33.7 0-64.9 17.7-82.3 46.6l-58.3 97c-9.1 15.1-4.2 34.8 10.9 43.9s34.8 4.2 43.9-10.9L120 256.9V480c0 17.7 14.3 32 32 32s32-14.3 32-32V352h16V480c0 17.7 14.3 32 32 32s32-14.3 32-32V235.3zM352 
                            376c0-4.4 3.6-8 8-8s8 3.6 8 8V488c0 13.3 10.7 24 24 24s24-10.7 24-24V376c0-30.9-25.1-56-56-56s-56 25.1-56 56v8c0 13.3 10.7 24 24 24s24-10.7 24-24v-8z" />
                        </svg>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-lansia" style="color: #ffff !important;">Tampil Detail <i class="fas fa-arrow-circle-right" style="color: #ffff;"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-difabel">
                    <div class="inner">
                        <h3 style="color: #ffff;">{{ $ttlDifabel }}</h3>
                        <p style="color: #ffff;">Total Difabel</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-wheelchair"></i>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-difabel" style="color: #ffff !important;">Tampil Detail <i class="fas fa-arrow-circle-right" style="color: #ffff;"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-Psakit">
                    <div class="inner">
                        <h3>{{ $ttlSakit }}</h3>
                        <p>Total Pengungsi Sakit</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-hospital"></i>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-sakit" style="color: #ffff !important;">Tampil Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-masuk">
                    <div class="inner">
                        <h3 style="color: #ffff;">{{ $getMasuk }}</h3>
                        <p style="color: #ffff;">Total Pengungsi di Posko</p>
                    </div>
                    <div class="icon">
                        <svg class="icon-statistik" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M352 96h64c17.7 0 32 14.3 32 32V384c0 17.7-14.3 32-32 32H352c-17.7 0-32 14.3-32 32s14.3 32 32 32h64c53 0 96-43 96-96V128c0-53-43-96-96-96H352c-17.7 0-32 14.3-32 32s14.3 32 32 32zm-7.5 177.4c4.8-4.5 7.5-10.8 7.5-17.4s-2.7-12.9-7.5-17.4l-144-136c-7-6.6-17.2-8.4-26-4.6s-14.5 12.5-14.5 22v72H32c-17.7 0-32 14.3-32 32v64c0 17.7 14.3 32 32 32H160v72c0 9.6 5.7 18.2 14.5 22s19 2 26-4.6l144-136z" />
                        </svg>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-masuk" style="color: #ffff !important;">Tampil Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-keluar">
                    <div class="inner">
                        <h3>{{ $getKeluar}}</h3>
                        <p>Total Pengungsi Keluar</p>
                    </div>
                    <div class="icon">
                        <svg class="icon-statistik" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96C43 32 0 75 0 128V384c0 53 43 96 96 96h64c17.7 0 32-14.3 32-32s-14.3-32-32-32H96c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32h64zM504.5 273.4c4.8-4.5 7.5-10.8 7.5-17.4s-2.7-12.9-7.5-17.4l-144-136c-7-6.6-17.2-8.4-26-4.6s-14.5 12.5-14.5 22v72H192c-17.7 0-32 14.3-32 32l0 64c0 17.7 14.3 32 32 32H320v72c0 9.6 5.7 18.2 14.5 22s19 2 26-4.6l144-136z" />
                        </svg>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-keluar">Tampil Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
    </div>
</section>

<!-- modal anggota keluarga -->
<div class="modal fade" id="modal-kkeluarga">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">List Kepala Keluarga</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah anggota</th>
                                <th>Alamat</th>
                                <!-- <th>Jenis Kelamin</th> -->
                                <!-- <th>Umur</th> -->
                                <!-- <th>Kondisi</th>
                            <th>Status</th> -->
                            </tr>
                        </thead>
                        <?php $k = 0; ?>
                        @foreach($dataKpl as $pengungsi)
                        <tr>
                            <?php $k++; ?>
                            <td>{{ $k }}</td>
                            <td>{{ $pengungsi->nama}}</td>
                            <td>{{ $jmlAnggota }}</td>
                            @foreach($getAlamat as $alamat)
                            <td>{{ $alamat->lokasi }}</td>
                            @endforeach
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end -->

<!-- modal kepala keluarga -->
<div class="modal fade" id="modal-kkeluarga">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">List Kepala Keluarga</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jumlah anggota</th>
                            <th>Alamat</th>
                            <!-- <th>Jenis Kelamin</th> -->
                            <!-- <th>Umur</th> -->
                            <!-- <th>Kondisi</th>
                            <th>Status</th> -->
                        </tr>
                    </thead>
                    <?php $k = 0; ?>
                    @foreach($dataKpl as $pengungsi)
                    <tr>
                        <?php $k++; ?>
                        <td>{{ $k }}</td>
                        <td>{{ $pengungsi->nama}}</td>
                        <td>{{ $jmlAnggota }}</td>
                        @foreach($getAlamat as $alamat)
                        <td>{{ $alamat->lokasi }}</td>
                        @endforeach
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end -->

<!-- modal bayi -->
<div class="modal fade" id="modal-bayi">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">List Pengungsi Balita</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kepala Keluarga</th>
                            <!-- <th>No Telepon</th> -->
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Umur</th>
                            <th>Kondisi</th>
                            <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $l = 0; ?>
                            @foreach($data as $balita)
                            @if ($balita->umur < 5) <?php $l++; ?> <tr>
                                <td>{{ $l }}</td>
                                <td>{{ $balita->nama }}</td>
                                <td>{{ $balita->namaKepala }}</td>
                                <td>{{ $balita->lokasi }}</td>
                                <?php
                                $getGender = $pengungsi->gender;
                                if ($getGender == 0) {
                                    $gender = "Perempuan";
                                } else if ($getGender == 1) {
                                    $gender = "Laki-laki";
                                }
                                ?>
                                <td><?php echo $gender; ?></td>
                                <td>{{ $balita->umur }}</td>
                                <td>
                                    <?php
                                    $kondisi = $balita->statKon;
                                    if ($kondisi == 0) {
                                        echo "Sehat";
                                    } else if ($kondisi == 1) {
                                        echo "Luka Ringan";
                                    } else if ($kondisi == 2) {
                                        echo "Luka Sedang";
                                    } else if ($kondisi == 3) {
                                        echo "Luka Berat";
                                    } else if ($kondisi == 4) {
                                        echo "Difabel";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $statPos = $balita->statPos;
                                    if ($statPos == 0) {
                                        echo "<span class='badge badge-danger'>Keluar</span>";
                                    } else if ($statPos == 1) {
                                        echo "<span class='badge badge-success'>Di Posko</span>";
                                    }
                                    ?>
                                </td>
                                </tr>

                                @endif
                                @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end -->

<!-- modal lansia -->
<div class="modal fade" id="modal-lansia">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">List Pengungsi Lansia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kepala Keluarga</th>
                                <th>No Telepon</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>Umur</th>
                                <th>Kondisi</th>
                                <th>Status</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $m = 0; ?>
                            @foreach($data as $lansia)
                            @if ($lansia->umur > 60)
                            <?php $m++; ?>
                            <tr>
                                <td>{{ $m }}</td>
                                <td>{{ $lansia->nama }}</td>
                                <td>{{ $lansia->namaKepala }}</td>
                                <td>{{ $lansia->telpon }}</td>
                                <td>{{ $lansia->lokasi }}</td>
                                <?php
                                $getGender = $lansia->gender;
                                if ($getGender == 0) {
                                    $gender = "Perempuan";
                                } else if ($getGender == 1) {
                                    $gender = "Laki-laki";
                                }
                                ?>
                                <td><?php echo $gender; ?></td>
                                <td>{{ $lansia->umur }}</td>
                                <td>
                                    <?php
                                    $kondisi = $lansia->statKon;
                                    if ($kondisi == 0) {
                                        echo "Sehat";
                                    } else if ($kondisi == 1) {
                                        echo "Luka Ringan";
                                    } else if ($kondisi == 2) {
                                        echo "Luka Sedang";
                                    } else if ($kondisi == 3) {
                                        echo "Luka Berat";
                                    } else if ($kondisi == 4) {
                                        echo "Difabel";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $statPos = $lansia->statPos;
                                    if ($statPos == 0) {
                                        echo "<span class='badge badge-danger'>Keluar</span>";
                                    } else if ($statPos == 1) {
                                        echo "<span class='badge badge-success'>Di Posko</span>";
                                    }
                                    ?>
                                </td>
                            </tr>

                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end -->

<!-- modal difabel -->
<div class="modal fade" id="modal-difabel">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">List Difabel</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kepala Keluarga</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Umur</th>
                            <th>Kondisi</th>
                            <th>Status</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 0; ?>
                        @foreach($data as $sakit)
                        @if ($sakit->statKon == 4)
                        <?php $n++; ?>
                        <tr>
                            <td>{{ $n }}</td>
                            <td>{{ $sakit->nama }}</td>
                            <td>{{ $sakit->namaKepala }}</td>
                            <td>{{ $sakit->telpon }}</td>
                            <td>{{ $sakit->lokasi }}</td>
                            <?php
                            $getGender = $sakit->gender;
                            if ($getGender == 0) {
                                $gender = "Perempuan";
                            } else if ($getGender == 1) {
                                $gender = "Laki-laki";
                            }
                            ?>
                            <td><?php echo $gender; ?></td>
                            <td>{{ $sakit->umur }}</td>
                            <td>
                                <?php
                                $kondisi = $sakit->statKon;
                                if ($kondisi == 0) {
                                    echo "Sehat";
                                } else if ($kondisi == 1) {
                                    echo "Luka Ringan";
                                } else if ($kondisi == 2) {
                                    echo "Luka Sedang";
                                } else if ($kondisi == 3) {
                                    echo "Luka Berat";
                                } else if ($kondisi == 4) {
                                    echo "Difabel";
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                $statPos = $sakit->statPos;
                                if ($statPos == 0) {
                                    echo "<span class='badge badge-danger'>Keluar</span>";
                                } else if ($statPos == 1) {
                                    echo "<span class='badge badge-success'>Di Posko</span>";
                                }
                                ?>
                            </td>
                        </tr>

                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end -->

<!-- modal sakit -->
<div class="modal fade" id="modal-sakit">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">List Kondisi Sakit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kepala Keluarga</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Umur</th>
                            <th>Kondisi</th>
                            <th>Status</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 0; ?>
                        @foreach($data as $sakit)
                        @if ($sakit->statKon > 0 && $sakit->statKon != 4)
                        <?php $n++; ?>
                        <tr>
                            <td>{{ $n }}</td>
                            <td>{{ $sakit->nama }}</td>
                            <td>{{ $sakit->namaKepala }}</td>
                            <td>{{ $sakit->telpon }}</td>
                            <td>{{ $sakit->lokasi }}</td>
                            <?php
                            $getGender = $sakit->gender;
                            if ($getGender == 0) {
                                $gender = "Perempuan";
                            } else if ($getGender == 1) {
                                $gender = "Laki-laki";
                            }
                            ?>
                            <td><?php echo $gender; ?></td>
                            <td>{{ $sakit->umur }}</td>
                            <td>
                                <?php
                                $kondisi = $sakit->statKon;
                                if ($kondisi == 0) {
                                    echo "Sehat";
                                } else if ($kondisi == 1) {
                                    echo "Luka Ringan";
                                } else if ($kondisi == 2) {
                                    echo "Luka Sedang";
                                } else if ($kondisi == 3) {
                                    echo "Luka Berat";
                                } else if ($kondisi == 4) {
                                    echo "Difabel";
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                $statPos = $sakit->statPos;
                                if ($statPos == 0) {
                                    echo "<span class='badge badge-danger'>Keluar</span>";
                                } else if ($statPos == 1) {
                                    echo "<span class='badge badge-success'>Di Posko</span>";
                                }
                                ?>
                            </td>
                        </tr>

                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end -->

<!-- modal masuk -->
<div class="modal fade" id="modal-masuk">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">List Pengungsi Di Posko</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Status Keluarga</th>
                                <th>Kepala Keluarga</th>
                                <th>No Telepon</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>Umur</th>
                                <th>Tanggal masuk</th>
                            </tr>
                        </thead>
                        <tbody id="result1">
                            <tr>
                                <?php $i = 0; ?>
                                @foreach ($data as $pengungsi)
                                @if($pengungsi->statPos == 1)
                                <?php $i++; ?>
                                <!-- <td> {{($data->currentPage() - 1) * $data->perPage() + $loop->iteration}}</td> -->
                                <td>{{ $i }}</td>
                                <td>{{ $pengungsi->nama }}</td>
                                <td>
                                    <?php
                                    $statKel = $pengungsi->statKel;
                                    if ($statKel == 0) {
                                        echo "Kepala Keluarga";
                                    } else if ($statKel == 1) {
                                        echo "Ibu";
                                    } else if ($statKel == 2) {
                                        echo "Anak";
                                    }
                                    ?>
                                </td>
                                <td>{{ $pengungsi->namaKepala}}</td>
                                <td>{{ $pengungsi->telpon }}</td>
                                <td>{{ $pengungsi->lokasi }}</td>
                                <td>
                                    <?php
                                    $gender = $pengungsi->gender;
                                    if ($gender == 0) {
                                        echo "Perempuan";
                                    } else if ($gender == 1) {
                                        echo "Laki-laki";
                                    }
                                    ?>
                                </td>
                                <td>{{ $pengungsi->umur }}</td>
                                <td>{{ $pengungsi->tglMasuk }}</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <br />
                {{ $data->links() }}
                <br />
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end -->

<!-- modal masuk -->
<div class="modal fade" id="modal-keluar">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">List Pengungsi Keluar Posko</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Status Keluarga</th>
                                <th>Kepala Keluarga</th>
                                <th>No Telepon</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>Umur</th>
                                <!-- <th>Awal masuk</th> -->
                            </tr>
                        </thead>
                        <tbody id="result2">
                            <tr>
                                <?php $j = 0 ?>
                                @foreach ($data as $keys => $pengungsis)
                                @if($pengungsis->statPos == 0)
                                <?php $j++; ?>
                                <td>{{ $j }}</th>
                                <td>{{ $pengungsis->nama }}</td>
                                <td>
                                    <?php
                                    $statKel = $pengungsi->statKel;
                                    if ($statKel == 0) {
                                        echo "Kepala Keluarga";
                                    } else if ($statKel == 1) {
                                        echo "Ibu";
                                    } else if ($statKel == 2) {
                                        echo "Anak";
                                    }
                                    ?>
                                </td>
                                <td>{{ $pengungsis->namaKepala}}</td>
                                <td>{{ $pengungsis->telpon }}</td>
                                <td>{{ $pengungsis->lokasi }}</td>
                                <td>
                                    <?php
                                    $gender = $pengungsis->gender;
                                    if ($gender == 0) {
                                        echo "Perempuan";
                                    } else if ($gender == 1) {
                                        echo "Laki-laki";
                                    }
                                    ?>
                                </td>
                                <td>{{ $pengungsis->umur }}</td>
                                <!-- <td>{{ $pengungsis->tglMasuk }}</td> -->
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <br />
                {{ $data->links() }}
                <br />
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end -->