@extends('admin.mainIndex')
@section('content')

<!-- Main Content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Kondisi Rumah Pengungsi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/kepulangan')}}">Bencana</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/poskoKepulangan/' . request()->bencana_id) }}">Posko</a></li>
                    

                    <li class="breadcrumb-item active">Daftar Rumah Rusak</a></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h3 class="card-title">Daftar rumah rusak pada posko <b>{{ $namaPosko }}</b></h3>
                        <div class="card-tools">
                            @auth('web')
                            <form id="search" action="{{ route('searchRumahRusak') }}" method="GET">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="search" class="form-control float-right"
                                        placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @endauth
                            @auth('karyawan')
                            <form id="searchForTrc">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="searchForTrc" class="form-control float-right"
                                        placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @endauth
                        </div>
                    </div>

                    <!-- Tambah bencana -->
                    <div class="modal fade" id="tambah">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- form start -->
                                    <form action="{{ route('rumahRusak.create') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <input type="text" class="form-control" id="posko_id" name="posko_id"
                                                value="{{request()->id}}" hidden required>
                                            <input type="text" class="form-control" id="bencana_id" name="bencana_id"
                                                value="{{request()->bencana_id}}" hidden required>
                                            <input type="text" class="form-control" id="trc_id" name="trc_id"
                                                value="{{request()->trc_id}}" hidden required>

                                            <div class="form-group">
                                                <label for="exampleInputPosko">Tanggal</label>
                                                <input type="date" class="form-control" id="exampleInputnama"
                                                    placeholder="Masukan tanggal" name="tanggal" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputPengungsi">Waktu</label>
                                                <input type="time" class="form-control" id="exampleInputnama"
                                                    placeholder="Masukan waktu" name="waktu" required>
                                            </div>

                                            <style>
                                            .select2-selection--single {
                                                height: 100% !important;
                                            }

                                            /* Input field */
                                            .select2-selection__rendered {
                                                word-wrap: break-word !important;
                                                text-overflow: inherit !important;
                                                white-space: normal !important;
                                            }

                                            .select2-selection__rendered {
                                                color: black;
                                                height: 100% !important;
                                            }

                                            .select2-search input {
                                                color: black
                                            }
                                            </style>

                                            <div class="form-group">
                                                <label for="exampleInputNama">Pilih pemilik</label>
                                                <select class="form-controll js-example-basic-single" name="carinama[]"
                                                    multiple="multiple" style="width: 100%;"
                                                    onchange="showifEmpty(this)">
                                                    <option value="" disabled>Pilih nama pengungsi</option>
                                                    @foreach($pengungsi as $p)
                                                    <option value="{{ $p->idPengungsi }}">
                                                        {{ $p->nama }}({{ $p->lokKel }})</option>
                                                    @php $cachePosko = $p->namaPosko; @endphp
                                                    @endforeach
                                                    <option value=0>Tidak ada</option>
                                                </select>
                                            </div>

                                            <script>
                                            $(document).ready(function() {
                                                $('.js-example-basic-single').select2({
                                                    theme: "classic",
                                                });
                                            });
                                            </script>

                                            <!-- script form jika tidak ada -->
                                            <script type="text/javascript">
                                            function showifEmpty(selects) {
                                                console.log(selects);
                                                if (selects.value != 0 || selects.value == "") {
                                                    document.getElementById("formNama").style.display = "none";
                                                    document.getElementById("formAlamat").style.display = "none";
                                                    // idForm_1.style.display = "block";
                                                    // idForm_2.style.display = "none";
                                                } else if (selects.value == 0) {
                                                    document.getElementById("formAlamat").style.display = "block";
                                                    document.getElementById("formNama").style.display = "block";
                                                }
                                            }
                                            </script>
                                            <!-- end -->

                                            <div class="form-group" id="formNama">
                                                <label for="nama">Masukkan Nama Pemilik</label>
                                                <input type="text" class="form-control" id="nama" name="namaPemilikBaru"
                                                    placeholder="Masukan nama pengungsi">
                                            </div>

                                            <div class="form-group" id="formAlamat">
                                                <label for="alamat">Detail Alamat</label>
                                                <input type="text" class="form-control" id="alamat"
                                                    name="alamatPemilikBaru"
                                                    placeholder="Masukan detail alamat pengungsi">
                                            </div>

                                            <!-- <div class="form-group">
                                                <label for="exampleInputProvinsi">Tambahkan alamat Detail</label>
                                                <input type="text" class="form-control" id="exampleInputnama" placeholder="Masukan provinsi" name="provinsi" value="Jawa Timur" required>
                                            </div> -->

                                            <div class="form-group">
                                                <label for="exampleInputPosko">Posko Pengungsi</label>
                                                <input type="text" class="form-control" id="exampleInputnama"
                                                    placeholder="Masukan nama posko" name="namaPosko"
                                                    value="{{$namaPosko}}" disabled>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputGambar">Upload Gambar Rumah</label>
                                                <input type="file" class="form-control-file" id="exampleInputGambar"
                                                    name="picRumah" required>
                                            </div>

                                            <div class="form-group" id="keterangan">
                                                <label for="keterangan">Keterangan</label>
                                                <input type="text" class="form-control" id="keterangan"
                                                    name="keterangan" placeholder="Tambahkan keterangan">
                                            </div>

                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" id="status" name="status" required>
                                                    <option selected value="" hidden>Pilih status</option>
                                                    <option value="0">Aman</option>
                                                    <option value="1">Rusak ringan</option>
                                                    <option value="2">Rusak sedang</option>
                                                    <option value="3">Rusak berat</option>
                                                </select>
                                            </div>

                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.card-header -->



                    <div class="card-body table-responsive">
                        @if(Auth::guard('web')->check() || Auth::guard('karyawan')->check())
                        <a href="#" class="btn btn-success mb-2 " data-toggle="modal" data-target="#tambah"
                            style="font-size: 14px;">
                            <i class="fas fa-plus mr-1"></i> Tambah Data
                        </a>
                        @endauth

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <!-- <th>No</th> -->
                                    <th>Tanggal Pemeriksaan</th>
                                    <th>Nama Pemilik</th>
                                    <th>Alamat Rumah</th>
                                    <th>Gambar Rumah</th>
                                    <th>Status Kondisi</th>
                                    <th>Keterangan</th>
                                    <th>Waktu Update</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="result">

                                @auth('web')
                                @foreach ($kondisiRumah as $key => $bencana)
                                @if(empty($bencana->kondisiRumah_id))
                                <p>Data kosong</p>
                                // whatever you need to do here
                                @else

                                <tr>
                                    <!-- <td>{{ $data->firstItem() + $key }}</td>ss -->
                                    <td>{{ $bencana->ketWaktu }}</td>
                                    <td>{{ $bencana->namaPengungsi }}</td>
                                    <td>{{ $bencana->lokKel }}</td>

                                    <td>
                                        <img src="{{ asset('storage/images/' . $bencana->picRumah) }}"
                                            alt="Foto Pengungsi" width="100" class="img-thumbnail" data-toggle="modal"
                                            data-target="#imageModal"
                                            onclick="showImage('{{ asset('storage/images/' . $bencana->picRumah) }}')">
                                    </td>

                                    <!-- Modal untuk menampilkan gambar -->

                                    <div class="modal fade" id="imageModal" tabindex="-1"
                                        aria-labelledby="imageModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="imageModalLabel">Preview Gambar</h5>
                                                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img id="modalImage" src="" class="img-fluid" alt="Preview Image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                    function showImage(src) {
                                        document.getElementById("modalImage").src = src;
                                    }
                                    </script>


                                    <!-- <td>{{ $bencana->posko }}</td> -->
                                    <!-- <td>{{ $bencana->status }}</td> -->
                                    <td>
                                        @if($bencana->status == 0)
                                        @php
                                        $value = 'Aman'
                                        @endphp
                                        <span class="badge badge-success"><?php echo $value; ?></span>
                                        @elseif($bencana->status == 1)
                                        @php
                                        $value = 'Rusak ringan'
                                        @endphp
                                        <span class="badge badge-info"><?php echo $value; ?></span>
                                        @elseif($bencana->status == 2)
                                        @php
                                        $value = 'Rusak sedang'
                                        @endphp
                                        <span class="badge badge-info"><?php echo $value; ?></span>
                                        @elseif($bencana->status == 3)
                                        @php
                                        $value = 'Rusak berat'
                                        @endphp
                                        <span class="badge badge-danger"><?php echo $value; ?></span>
                                        @endif
                                    </td>
                                    <td>{{ $bencana->keterangan }}</td>
                                    <td>{{ $bencana->updated_at }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                                data-toggle="dropdown" data-offset="-52">
                                                <i class="fas fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-lg" role="menu">
                                                <!-- <a href="#" class="dropdown-item " data-toggle="modal" data-target="#modal-detail" title="Detail Pengungsi">
                                                    <i class="fas fa-eye mr-1"></i> Detail
                                                </a>
                                                <div class="dropdown-divider"></div> -->
                                                <a href="#" class="dropdown-item " title="Edit Bencana"
                                                    data-toggle="modal" data-target="#modal-edit-{{$bencana->idKr}}">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item " title="Hapus Bencana"
                                                    onclick="deleteConfirmation({{$bencana->idKr}})">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </a>
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- <a href="#" class="btn btn-danger btn-sm" title="Hapus Pengungsi">
                                            Hapus
                                        </a> -->
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                                @endauth

                                @auth('karyawan')
                                <?php $i = 0; ?>
                                @foreach ($kondisiRumah as $key => $bencana)
                                <tr>
                                    <!-- <td>{{ $data->firstItem() + $key }}</td>ss -->
                                    <td>{{ $bencana->ketWaktu }}</td>
                                    <td>{{ $bencana->namaPengungsi }}</td>
                                    <td>{{ $bencana->lokKel }}</td>

                                    <td>
                                        <img src="{{ asset('storage/images/' . $bencana->picRumah) }}"
                                            alt="Foto Pengungsi" width="100" class="img-thumbnail" data-toggle="modal"
                                            data-target="#imageModal"
                                            onclick="showImage('{{ asset('storage/images/' . $bencana->picRumah) }}')">
                                    </td>

                                    <!-- Modal untuk menampilkan gambar -->

                                    <div class="modal fade" id="imageModal" tabindex="-1"
                                        aria-labelledby="imageModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="imageModalLabel">Preview Gambar</h5>
                                                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img id="modalImage" src="" class="img-fluid" alt="Preview Image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                    function showImage(src) {
                                        document.getElementById("modalImage").src = src;
                                    }
                                    </script>


                                    <!-- <td>{{ $bencana->posko }}</td> -->
                                    <!-- <td>{{ $bencana->status }}</td> -->
                                    <td>
                                        @if($bencana->status == 0)
                                        @php
                                        $value = 'Aman'
                                        @endphp
                                        <span class="badge badge-success"><?php echo $value; ?></span>
                                        @elseif($bencana->status == 1)
                                        @php
                                        $value = 'Rusak ringan'
                                        @endphp
                                        <span class="badge badge-info"><?php echo $value; ?></span>
                                        @elseif($bencana->status == 2)
                                        @php
                                        $value = 'Rusak sedang'
                                        @endphp
                                        <span class="badge badge-info"><?php echo $value; ?></span>
                                        @elseif($bencana->status == 3)
                                        @php
                                        $value = 'Rusak berat'
                                        @endphp
                                        <span class="badge badge-danger"><?php echo $value; ?></span>
                                        @endif
                                    </td>
                                    <td>{{ $bencana->keterangan }}</td>
                                    <td>{{ $bencana->updated_at }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                                data-toggle="dropdown" data-offset="-52">
                                                <i class="fas fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-lg" role="menu">
                                                <!-- <a href="#" class="dropdown-item " data-toggle="modal" data-target="#modal-detail" title="Detail Pengungsi">
                                                    <i class="fas fa-eye mr-1"></i> Detail
                                                </a>
                                                <div class="dropdown-divider"></div> -->
                                                <a href="#" class="dropdown-item " title="Edit Bencana"
                                                    data-toggle="modal" data-target="#modal-edit-{{$bencana->idKr}}">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item " title="Hapus Bencana"
                                                    onclick="deleteConfirmation({{$bencana->idKr}})">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </a>
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- <a href="#" class="btn btn-danger btn-sm" title="Hapus Pengungsi">
                                            Hapus
                                        </a> -->
                                    </td>
                                </tr>
                                @endforeach
                                @endauth


                                @auth('admin')
                                <?php $i = 0; ?>
                                @foreach ($data2 as $bencana)
                                <tr>
                                    @if($bencana->trc == auth()->user()->id)
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $bencana->namaBencana }}</td>
                                    <td>{{ $bencana->waktu }}</td>
                                    <!-- <td>{{ $bencana->lokasi }}</td> -->
                                    <!-- <td>{{ $bencana->posko }}</td> -->
                                    <td>{{ $bencana->ttlPosko }} tempat</br>
                                        <a href="{{url('/listPosko')}}/<?php echo $bencana->idBencana; ?>"
                                            class="btn btn-primary btn-xs" title="Lihat posko"><i
                                                class="fas fa-eye"></i> Posko </a>
                                    </td>
                                    <td>{{ $bencana->waktuUpdate }}</td>
                                    <td>
                                        @if($bencana->status == 1)
                                        @php
                                        $value = 'Berjalan'
                                        @endphp
                                        <span class="badge badge-success"><?php echo $value; ?></span>
                                        @else
                                        @php
                                        $value = 'Selesai'
                                        @endphp
                                        <span class="badge badge-danger">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                                @endauth

                                @foreach ($kondisiRumah as $detail)
                                <div class="modal fade" id="modal-edit-{{$detail->idKr}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Ubah Kondisi Rumah</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- form start -->
                                                <form action="{{ url('/rumahRusak/edit/'.$detail->idKr) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body">

                                                        <div class="form-group">
                                                            <label for="exampleInputPosko">Tanggal</label>
                                                            <input type="date" class="form-control"
                                                                id="exampleInputnama" placeholder="Masukan tanggal"
                                                                name="tanggal" value="{{$detail->tanggal}}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputPengungsi">Waktu</label>
                                                            <input type="time" class="form-control"
                                                                id="exampleInputnama" placeholder="Masukan waktu"
                                                                name="waktu" value="{{$detail->waktu}}" required>
                                                        </div>

                                                        <style>
                                                        .select2-selection--single {
                                                            height: 100% !important;
                                                        }

                                                        /* Input field */
                                                        .select2-selection__rendered {
                                                            word-wrap: break-word !important;
                                                            text-overflow: inherit !important;
                                                            white-space: normal !important;
                                                        }

                                                        .select2-selection__rendered {
                                                            color: black;
                                                            height: 100% !important;
                                                        }

                                                        .select2-search input {
                                                            color: black
                                                        }
                                                        </style>

                                                        <div class="form-group">
                                                            <label for="exampleInputNama">Pilih pemilik</label>
                                                            <select class="form-controll js-example-basic-single"
                                                                name="carinama[]" multiple="multiple"
                                                                style="width: 100%;" onchange="showifEmpty(this)">
                                                                <option value="{{$detail->idPengungsi}}" selected>
                                                                    {{$detail->namaPengungsi}}({{ $detail->lokKel }})
                                                                </option>
                                                                @foreach($pengungsi as $p)
                                                                <option value="{{ $p->idPengungsi }}">
                                                                    {{ $p->nama }}({{ $p->lokKel }})</option>
                                                                @php $cachePosko = $p->namaPosko; @endphp
                                                                @endforeach
                                                                <option value=0>Tidak ada</option>
                                                            </select>
                                                        </div>

                                                        <script>
                                                        $(document).ready(function() {
                                                            $('.js-example-basic-single').select2({
                                                                theme: "classic",
                                                            });
                                                        });
                                                        </script>

                                                        <!-- script form status keluarga -->
                                                        <script type="text/javascript">
                                                        function showifEmpty(selects) {
                                                            console.log(selects);
                                                            if (selects.value != 0 || selects.value == "") {
                                                                document.getElementById("formNama").style.display =
                                                                    "none";
                                                                document.getElementById("formAlamat").style.display =
                                                                    "none";
                                                                // idForm_1.style.display = "block";
                                                                // idForm_2.style.display = "none";
                                                            } else if (selects.value == 0) {
                                                                document.getElementById("formAlamat").style.display =
                                                                    "block";
                                                                document.getElementById("formNama").style.display =
                                                                    "block";
                                                            }
                                                        }
                                                        </script>
                                                        <!-- end -->

                                                        <div class="form-group">
                                                            <label for="exampleInputPosko">Posko Pengungsi</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputPosko" placeholder="Masukan provinsi"
                                                                name="namaSamaran" value="{{$namaPosko}}" disabled>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputGambar">Upload Gambar Rumah Jika Ada
                                                                Perubahan</label>
                                                            <input type="file" class="form-control-file"
                                                                id="exampleInputGambar" name="picRumah"
                                                                value="{{$detail->picRumah}}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="status">Status</label>
                                                            <select class="form-control" id="status" name="status"
                                                                required>
                                                                <?php
                                                                    $getKondisi = $detail->status;
                                                                    if ($getKondisi == 0) {
                                                                        $statKon = "Aman";
                                                                    } else if ($getKondisi == 1) {
                                                                        $statKon = "Rusak ringan";
                                                                    } else if ($getKondisi == 2) {
                                                                        $statKon = "Rusak sedang";
                                                                    } else if ($getKondisi == 3) {
                                                                        $statKon = "Rusak berat";
                                                                    }
                                                                    ?>
                                                                <option selected value="{{$detail->status}}" hidden>
                                                                    <?php echo $statKon; ?></option>
                                                                <option value="0">Aman</option>
                                                                <option value="1">Rusak ringan</option>
                                                                <option value="2">Rusak sedang</option>
                                                                <option value="3">Rusak berat</option>


                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPengungsi">Keterangan</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputnama" placeholder="Masukan keterangan"
                                                                name="keterangan" value="{{$detail->keterangan}}"
                                                                required>
                                                        </div>



                                                    </div>

                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary">Perbarui</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                    </div>
                    @endforeach
                    </tbody>
                    </table>
                    <br />
                    {{ $kondisiRumah->links() }}
                    <br />
                </div>



                <!-- /.card-body -->
            </div>
        </div>
    </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputSearch = document.querySelector('input[name="search"]');

        inputSearch.addEventListener('input', function () {
            let search = this.value;

            fetch(`{{ route('searchRumahRusak') }}?search=${search}`)
                .then(response => response.json())
                .then(data => {
                    let result = '';

                    if (data.length === 0) {
                        result += '<tr><td colspan="10">Data tidak ditemukan</td></tr>';
                    } else {
                        data.forEach((kondisiRumah, i) => {
                            let statusLabel = '-';
                            if (kondisiRumah.status == 0) {
                                statusLabel = '<span class="badge badge-success">Aman</span>';
                            } else if (kondisiRumah.status == 1) {
                                statusLabel = '<span class="badge badge-info">Rusak Ringan</span>';
                            } else if (kondisiRumah.status == 2) {
                                statusLabel = '<span class="badge badge-info">Rusak Sedang</span>';
                            } else if (kondisiRumah.status == 3) {
                                statusLabel = '<span class="badge badge-danger">Rusak berat</span>';
                            }

                            result += `
                                <tr>
                                    <td>${kondisiRumah.ketWaktu}</td>
                                    <td>${kondisiRumah.namaPengungsi}</td>
                                    <td>${kondisiRumah.lokKel}</td>
                                    <td>
                                        <img src="http://localhost:8080/simasi/public/storage/images/${kondisiRumah.picRumah}" alt="Foto Pengungsi"
                                            width="100" class="img-thumbnail" data-toggle="modal"
                                            data-target="#imageModal" onclick="showImage('http://localhost:8080/simasi/public/storage/images/${kondisiRumah.picRumah}')">
                                    </td>
                                    <td>${statusLabel}</td>
                                    <td>${kondisiRumah.keterangan}</td>
                                    <td>${kondisiRumah.updated_at}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                                data-toggle="dropdown" data-offset="-52">
                                                <i class="fas fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-lg" role="menu">
                                                <a href="#" class="dropdown-item" title="Edit Bencana"
                                                    data-toggle="modal" data-target="#modal-edit-${kondisiRumah.idKr}">
                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item" title="Hapus Bencana"
                                                    onclick="deleteConfirmation(${kondisiRumah.idKr})">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        });
                    }

                    document.getElementById('result').innerHTML = result;
                })
                .catch(error => console.error('Fetch error:', error));
        });

        document.getElementById('search').addEventListener('submit', function (e) {
            e.preventDefault();
        });
    });

    function showImage(src) {
        document.getElementById("modalImage").src = src;
    }
</script>



    <script type="text/javascript">
    function deleteConfirmation(id) {
        swal.fire({
            title: "Hapus?",
            icon: 'question',
            text: "Apakah Anda yakin?",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Iya, hapus!",
            cancelButtonText: "Batal!",
            reverseButtons: !0
        }).then(function(e) {

            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: "{{url('rumahRusak/delete')}}/" + id,
                    data: {
                        _token: CSRF_TOKEN
                    },
                    dataType: 'JSON',
                    success: function(results) {
                        if (results.success === true) {
                            swal.fire("Berhasil!", results.message, "success");
                            // refresh page after 2 seconds
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        } else {
                            swal.fire("Gagal!", results.message, "error");
                        }
                    }
                });

            } else {
                e.dismiss;
            }

        }, function(dismiss) {
            return false;
        })
    }
    </script>



</section>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>


@endsection()