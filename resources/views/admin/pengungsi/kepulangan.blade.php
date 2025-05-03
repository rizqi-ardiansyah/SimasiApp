@extends('admin.mainIndex')
@section('content')

<!-- Main Content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @foreach ($getNmPosko as $nm)
                @foreach ($getJmlPosko as $jml)
                @foreach ($getNmTrc as $nmTrc)
                <!-- <h3>Pos Pengungsi {{ $nm->namaPosko }} {{$jml->jmlPosko}} ({{ $nmTrc->fullName  }})</h1> -->
                <h3>Pos Pengungsi {{ $nm->namaPosko }} ({{ $nmTrc->fullName  }})</h1>
                    @endforeach
                    @endforeach
                    @endforeach
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/kepulangan')}}">Bencana</a></li>
                    <li class="breadcrumb-item active">Posko</li>
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
                        <h3 class="card-title">List Pegungsi yang Boleh Pulang</h3>
                        <div class="card-tools">
                            @auth('web')
                            <form id="search" action="{{ route('posko.searchPosko') }}" method="GET">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="search" class="form-control float-right"
                                        placeholder="Search">
                                    <input type="text" class="form-control" id="idBencana" name="idBencana"
                                        value="{{request()->id}}" hidden required>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @endauth

                            @auth('karyawan')
                            <form id="searchPoskoTrc">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="searchPoskoTrc" class="form-control float-right"
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


                    <div class="container mt-3">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>

                    <!-- Tabel Posko -->
                    <div class="card-body table-responsive">
                        @auth('web')
                        <!-- <a href="#" class="btn btn-success mb-2 " data-toggle="modal" data-target="#modal-default" style="font-size: 14px;">
                                <i class="fas fa-plus mr-1"></i> Tambah Posko
                            </a> -->
                        <!-- <a href="{{url('/memberTRC')}}" class="btn btn-info mb-2 " style="font-size: 14px;">
                            <i class="fas fa-info mr-1"></i> Cek TRC
                        </a> -->
                        @endauth

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <!-- <th>Telepon</th> -->
                                    <th>Alamat</th>
                                    <th>Umur</th>
                                    <th>Kondisi Bencana</th>
                                    <th>Kondisi Fisik</th>
                                    <th>Kondisi Rumah</th>
                                    <th>Kondisi Sekitar Rumah</th>
                                    <th>Kondisi Psikologis</th>
                                    <th>Status Pulang</th>
                                </tr>
                            </thead>
                            <tbody id="result">
                                @auth('web')
                                @foreach($kepulangan as $key => $psiko)
                                <tr>
                                    <td>{{ $kepulangan->firstItem() + $key  }}</td>
                                    <td>{{ $psiko->nama }}</td>
                                    <!-- <td>{{ $psiko->telpon}}</td> -->
                                    <td>{{ $psiko->lokKel ?: $psiko->alamatPengungsi }}</td>
                                    <td>{{ $psiko->umur}}</td>
                                    <!-- <td>{{ $psiko->statusBencana}}</td> -->
                                    <td>
                                        <div style="margin-bottom: 6px;">
                                            <?php
                                            $statBen = $psiko->statusBencana;
                                            if ($statBen === 1) {
                                                echo "<span class='badge badge-danger' style='font-size: 14px'>Siaga</span>";
                                            } else if ($statBen == 2) {
                                                echo "<span class='badge badge-danger' style='font-size: 14px' >Tanggap Darurat</span>";
                                            }else if ($statBen == 3) {
                                                echo "<span class='badge badge-success' style='font-size: 14px' >Pemulihan</span>";
                                            }else if ($statBen == 0) {
                                                echo "<span class='badge badge-info' style='font-size: 14px' >Selesai</span>";
                                            }else{
                                                echo "-";
                                            }
                                            ?>
                                        </div>
                                        <a href="{{url('/bencana')}}" class="btn btn-primary btn-xs"
                                            title="Update Bencana" style='font-size: 14px'><i class="fas fa-eye"></i>
                                            Update</a>
                                    </td>
                                    <td>
                                        <div style="margin-bottom: 6px;">
                                            <?php
                                            $statFis = $psiko->statusFisik;
                                            if ($statFis === 0) {
                                                echo "<span class='badge badge-success' style='font-size: 14px'>Sehat</span>";
                                            } else if ($statFis == 1) {
                                                echo "<span class='badge badge-info' style='font-size: 14px'>Luka Ringan</span>";
                                            } else if ($statFis == 2) {
                                                echo "<span class='badge badge-info' style='font-size: 14px'>Luka Sedang</span>";
                                            } else if ($statFis == 3) {
                                                echo "<span class='badge badge-danger' style='font-size: 14px'>Luka Berat</span>";
                                            } else if ($statFis== 4) {
                                                echo "<span class='badge badge-info' style='font-size: 14px'>Hamil atau Menyusui</span>";
                                            } else if ($statFis == 5) {
                                                echo "<span class='badge badge-info' style='font-size: 14px'>Difabel</span>";
                                            }else{
                                                echo "-";
                                            }
                                            ?>
                                        </div>
                                        <a href="#" class="btn btn-primary btn-xs" title="Update Fisik"
                                            data-toggle="modal" data-target="#modal-edit-{{$psiko->idPengungsi}}"
                                            style='font-size: 14px'><i class="fas fa-eye"></i> Update</a>

                                    </td>

                                    <div class="modal fade" id="modal-edit-{{$psiko->idPengungsi}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Perbarui Kondisi Fisik</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- form start -->
                                                    <form action="{{ url('kepulangan/edit/'.$psiko->idPengungsi) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="exampleInputNama">Nama Pengungsi</label>
                                                                <!-- <input type="text" class="form-control" id="exampleInputnama" name="nama" placeholder="Masukan nama pengungsi" value="{{$psiko->idPengungsi}}" readonly> -->
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputnama" name="nama"
                                                                    placeholder="Masukan nama pengungsi"
                                                                    value="{{$psiko->nama}}" readonly>
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="statKon">Kondisi</label>
                                                                <select class="form-control" id="statKon" name="statKon"
                                                                    required>
                                                                    <?php
                                                            $getKonFis = $psiko->statusFisik;
                                                            if ($getKonFis === 0) {
                                                                $statKonFis = "Sehat";
                                                            } else if ($getKonFis == 1) {
                                                                $statKonFis = "Luka Ringan";
                                                            } else if ($getKonFis == 2) {
                                                                $statKonFis = "Luka Sedang";
                                                            } else if ($getKonFis == 3) {
                                                                $statKonFis = "Luka Berat";
                                                            } else if ($getKonFis == 4) {
                                                                $statKonFis = "Hamil atau menyusui";
                                                            } else if ($getKonFis == 5) {
                                                                $statKonFis = "Difabel";
                                                            } else{
                                                                $statKonFis = "Belum dipilih";
                                                            }
                                                            ?>
                                                                    <option selected value="{{$psiko->statusFisik}}"
                                                                        hidden><?php echo $statKonFis; ?></option>
                                                                    <option value=0>Sehat</option>
                                                                    <option value=1>Luka Ringan</option>
                                                                    <option value=2>Luka Sedang</option>
                                                                    <option value=3>Luka Berat</option>
                                                                    <option value=4>Hamil atau menyusui</option>
                                                                    <option value=5>Difabel</option>
                                                                </select>
                                                            </div>

                                                        </div>

                                                        <div class="card-footer">
                                                            <button type="submit"
                                                                class="btn btn-primary">Perbarui</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                    <td>
                                        <div style="margin-bottom: 6px;">
                                            <?php
                                            $statRum = $psiko->statusRumah;
                                            if ($statRum === 0) {
                                                echo "<span class='badge badge-success' style='font-size: 14px'>Aman</span>";
                                            } else if ($statRum == 1) {
                                                echo "<span class='badge badge-info' style='font-size: 14px'>Rusak Ringan</span>";
                                            } else if ($statRum == 2) {
                                                echo "<span class='badge badge-info' style='font-size: 14px'>Rusak Sedang</span>";
                                            } else if ($statFis == 3) {
                                                echo "<span class='badge badge-danger' style='font-size: 14px'>Rusak Berat</span>";
                                            } else{
                                                echo "-";
                                            }
                                            ?>
                                        </div>
                                        <a href="#" class="btn btn-primary btn-xs" title="Update Rumah"
                                            data-toggle="modal" data-target="#modal-editKonrum-{{$psiko->idPengungsi}}"
                                            style='font-size: 14px'><i class="fas fa-eye"></i> Update</a>
                                    </td>

                                    <div class="modal fade" id="modal-editKonrum-{{$psiko->idPengungsi}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Perbarui Kondisi Rumah</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- form start -->
                                                    <form action="{{ url('editKonRum/edit/'.$psiko->idPengungsi) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="text" class="form-control" id="exampleInputnama"
                                                            name="idPengungsi" placeholder="Masukan nama pengungsi"
                                                            value="{{$psiko->idPengungsi}}" hidden readonly>
                                                        <!-- <input type="text" class="form-control" id="exampleInputnama" name="idKonRum" placeholder="Masukan nama pengungsi" value="{{$psiko->idKonRum}}" readonly> -->

                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="exampleInputNama">Nama Pengungsi</label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputnama" name="nama"
                                                                    placeholder="Masukan nama pengungsi"
                                                                    value="{{$psiko->nama}}" readonly>
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="exampleInputPosko">Posko Pengungsi</label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputPosko"
                                                                    placeholder="Masukan provinsi" name="namaSamaran"
                                                                    value="{{$psiko->namaPosko}}" disabled>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputGambar">Upload Gambar Rumah Jika
                                                                    Ada Perubahan</label>
                                                                <input type="file" class="form-control-file"
                                                                    id="exampleInputGambar-{{$psiko->idPengungsi}}"
                                                                    name="picRumah"
                                                                    onchange="previewImage(event, {{$psiko->idPengungsi}})">

                                                                <div class="mt-2">
                                                                    @if($psiko->picRumah)
                                                                    <img id="currentPreview-{{$psiko->idPengungsi}}"
                                                                        src="{{ asset('storage/images/'.$psiko->picRumah) }}"
                                                                        alt="Gambar Rumah" width="200"
                                                                        class="img-thumbnail" style="cursor: zoom-in;"
                                                                        data-toggle="modal"
                                                                        data-target="#imageModal-{{$psiko->idPengungsi}}">
                                                                    <p id="noImageText-{{$psiko->idPengungsi}}"
                                                                        style="display: none;" class="text-muted">Belum
                                                                        ada gambar</p>
                                                                    @else
                                                                    <img id="currentPreview-{{$psiko->idPengungsi}}"
                                                                        src="#" alt="Preview Gambar"
                                                                        style="display: none;" width="200"
                                                                        class="img-thumbnail" data-toggle="modal"
                                                                        data-target="#imageModal-{{$psiko->idPengungsi}}">
                                                                    <p id="noImageText-{{$psiko->idPengungsi}}"
                                                                        class="text-muted">Belum ada gambar</p>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <!-- Modal -->
                                                            <div class="modal fade"
                                                                id="imageModal-{{$psiko->idPengungsi}}" tabindex="-1"
                                                                role="dialog"
                                                                aria-labelledby="imageModalLabel-{{$psiko->id}}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg"
                                                                    role="document">
                                                                    <div class="modal-content bg-white">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="imageModalLabel-{{$psiko->id}}">
                                                                                Pratinjau Gambar Rumah</h5>
                                                                            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button> -->
                                                                        </div>
                                                                        <div class="modal-body text-center">
                                                                            <img src="{{ asset('storage/images/'.$psiko->picRumah) }}"
                                                                                alt="Preview Besar"
                                                                                class="img-fluid rounded">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <script>
                                                            function previewImage(event, id) {
                                                                var reader = new FileReader();
                                                                reader.onload = function() {
                                                                    var output = document.getElementById(
                                                                        'currentPreview-' + id);
                                                                    var text = document.getElementById(
                                                                        'noImageText-' + id);
                                                                    output.src = reader.result;
                                                                    output.style.display = 'block';
                                                                    if (text) text.style.display = 'none';

                                                                    // Juga ganti src modal agar realtime preview
                                                                    let modalImage = document.querySelector(
                                                                        '#imageModal-' + id + ' .modal-body img'
                                                                    );
                                                                    if (modalImage) modalImage.src = reader.result;
                                                                };
                                                                reader.readAsDataURL(event.target.files[0]);
                                                            }
                                                            </script>


                                                            <div class="form-group">
                                                                <label for="status">Status</label>
                                                                <select class="form-control" id="status" name="status"
                                                                    required>
                                                                    <?php
                                                                    $getKondisi = $psiko->statusRumah;
                                                                    if ($getKondisi === 0) {
                                                                        $statKon = "Aman";
                                                                    } else if ($getKondisi == 1) {
                                                                        $statKon = "Rusak ringan";
                                                                    } else if ($getKondisi == 2) {
                                                                        $statKon = "Rusak sedang";
                                                                    } else if ($getKondisi == 3) {
                                                                        $statKon = "Rusak berat";
                                                                    } else{
                                                                         $statKon = "Belum dipilih";
                                                                    }
                                                                    ?>
                                                                    <option selected value="{{$psiko->statusRumah}}"
                                                                        hidden>
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
                                                                    id="exampleInputnama"
                                                                    placeholder="Masukan keterangan" name="keterangan"
                                                                    value="{{$psiko->ketRum}}" required>
                                                            </div>

                                                        </div>


                                                        <div class="card-footer" style="background-color: white;">
                                                            <button type="submit"
                                                                class="btn btn-primary">Perbarui</button>
                                                        </div>
                                                    </form>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

                                        <td>
                                            <div style="margin-bottom: 6px;">
                                                <?php
                                        $statSek = $psiko->statusSekitar;
                                        if ($statSek === 0) {
                                            echo "<span class='badge badge-success' style='font-size: 14px'>Aman</span>";
                                        } else if ($statSek == 1) {
                                            echo "<span class='badge badge-info' style='font-size: 14px'>Rusak Ringan</span>";
                                        } else if ($statSek == 2) {
                                            echo "<span class='badge badge-info' style='font-size: 14px'>Rusak Sedang</span>";
                                        } else if ($statSek == 3) {
                                            echo "<span class='badge badge-danger' style='font-size: 14px'>Rusak Berat</span>";
                                        } else{
                                            echo "-";
                                        }
                                        ?>
                                            </div>
                                            <a href="#" class="btn btn-primary btn-xs" title="Update Kondisi Sekitar"
                                                data-toggle="modal"
                                                data-target="#modal-editSekKonRum-{{$psiko->idPengungsi}}"
                                                style='font-size: 14px'><i class="fas fa-eye"></i> Update</a>
                                        </td>

                                        <div class="modal fade" id="modal-editSekKonRum-{{$psiko->idPengungsi}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Perbarui Kondisi Sekitar Rumah</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- form start -->
                                                        <form
                                                            action="{{ url('editSekKonRum/edit/'.$psiko->idPengungsi) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="text" class="form-control"
                                                                id="exampleInputnama" name="idPengungsi"
                                                                placeholder="Masukan nama pengungsi"
                                                                value="{{$psiko->idPengungsi}}" hidden readonly>

                                                            <input type="text" class="form-control"
                                                                id="exampleInputnama" name="idKepala"
                                                                placeholder="Masukan nama pengungsi"
                                                                value="{{$psiko->idKepala}}" hidden readonly>

                                                            <!-- <input type="text" class="form-control" id="exampleInputnama" name="idKonRum" placeholder="Masukan nama pengungsi" value="{{$psiko->idKonRum}}" readonly> -->

                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="exampleInputNama">Nama Pengungsi</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputnama" name="nama"
                                                                        placeholder="Masukan nama pengungsi"
                                                                        value="{{$psiko->nama}}" readonly>
                                                                </div>


                                                                <div class="form-group">
                                                                    <label for="exampleInputPosko">Posko
                                                                        Pengungsi</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputPosko"
                                                                        placeholder="Masukan provinsi"
                                                                        name="namaSamaran" value="{{$psiko->namaPosko}}"
                                                                        disabled>
                                                                </div>

                                                                <div class="form-group" id="formAlamat">
                                                                    <label for="alamat">Alamat</label>
                                                                    <input type="text" class="form-control" id="alamat"
                                                                        name="alamat" value="{{ $psiko->lokKel ?: $psiko->alamatPengungsi }}"
                                                                        placeholder="Masukan detail alamat pengungsi"
                                                                        readonly>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputGambar">Upload Gambar
                                                                        Kondisi Sekitar
                                                                        Jika Ada Perubahan</label>
                                                                    <input type="file" class="form-control-file"
                                                                        id="exampleInputGambarLokasi-{{$psiko->idPengungsi}}"
                                                                        name="picLokasi"
                                                                        onchange="previewImageLokasi(event, {{$psiko->idPengungsi}})">

                                                                    <div class="mt-2">
                                                                        @if($psiko->picLokasi)
                                                                        <img id="currentPreviewLokasi-{{$psiko->idPengungsi}}"
                                                                            src="{{ asset('storage/images/'.$psiko->picLokasi) }}"
                                                                            alt="Gambar Rumah" width="200"
                                                                            class="img-thumbnail"
                                                                            style="cursor: zoom-in;" data-toggle="modal"
                                                                            data-target="#imageModalLokasi-{{$psiko->idPengungsi}}">
                                                                        <p id="noImageTextLokasi-{{$psiko->idPengungsi}}"
                                                                            style="display: none;" class="text-muted">
                                                                            Belum ada gambar</p>
                                                                        @else
                                                                        <img id="currentPreviewLokasi{{$psiko->idPengungsi}}"
                                                                            src="#" alt="Preview Gambar"
                                                                            style="display: none;" width="200"
                                                                            class="img-thumbnail" data-toggle="modal"
                                                                            data-target="#imageModalLokasi-{{$psiko->idPengungsi}}">
                                                                        <p id="noImageTextLokasi-{{$psiko->idPengungsi}}"
                                                                            class="text-muted">Belum ada gambar</p>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <!-- Modal -->
                                                                <div class="modal fade"
                                                                    id="imageModalLokasi-{{$psiko->idPengungsi}}"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="imageModalLabelLokasi-{{$psiko->id}}"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-lg"
                                                                        role="document">
                                                                        <div class="modal-content bg-white">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="imageModalLabelLokasi-{{$psiko->id}}">
                                                                                    Pratinjau Lokasi Sekitar</h5>
                                                                                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button> -->
                                                                            </div>
                                                                            <div class="modal-body text-center">
                                                                                <img src="{{ asset('storage/images/'.$psiko->picLokasi) }}"
                                                                                    alt="Preview Besar"
                                                                                    class="img-fluid rounded">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <script>
                                                                function previewImage(event, id) {
                                                                    var reader = new FileReader();
                                                                    reader.onload = function() {
                                                                        var output = document.getElementById(
                                                                            'currentPreviewLokasi-' + id);
                                                                        var text = document.getElementById(
                                                                            'noImageTextLokasi-' + id);
                                                                        output.src = reader.result;
                                                                        output.style.display = 'block';
                                                                        if (text) text.style.display = 'none';

                                                                        // Juga ganti src modal agar realtime preview
                                                                        let modalImage = document.querySelector(
                                                                            '#imageModalLokasi-' + id +
                                                                            ' .modal-body img');
                                                                        if (modalImage) modalImage.src = reader
                                                                            .result;
                                                                    };
                                                                    reader.readAsDataURL(event.target.files[0]);
                                                                }
                                                                </script>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="exampleInputPengungsi">Keterangan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputnama"
                                                                        placeholder="Masukan keterangan"
                                                                        name="keterangan" value="{{$psiko->ketLok}}"
                                                                        required>
                                                                </div>


                                                                <div class="form-group">
                                                                    <label for="status">Status</label>
                                                                    <select class="form-control" id="status"
                                                                        name="status" required>
                                                                        <?php
                                                                    $getKondisi = $psiko->statusSekitar;
                                                                    if ($getKondisi === 0) {
                                                                        $statKon = "Aman";
                                                                    } else if ($getKondisi == 1) {
                                                                        $statKon = "Rusak ringan";
                                                                    } else if ($getKondisi == 2) {
                                                                        $statKon = "Rusak sedang";
                                                                    } else if ($getKondisi == 3) {
                                                                        $statKon = "Rusak berat";
                                                                    } else{
                                                                         $statKon = "Belum dipilih";
                                                                    }
                                                                    ?>
                                                                        <option selected value="{{$psiko->statusRumah}}"
                                                                            hidden>
                                                                            <?php echo $statKon; ?></option>
                                                                        <option value="0">Aman</option>
                                                                        <option value="1">Rusak ringan</option>
                                                                        <option value="2">Rusak sedang</option>
                                                                        <option value="3">Rusak berat</option>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="card-footer" style="background-color: white;">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Perbarui</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>



                                            <td>
                                            <div style="margin-bottom: 6px;">
                                                <?php
                                                $statPsiko = $psiko->statusPsikologis;
                                                if ($statPsiko === 0) {
                                                    echo "<span class='badge badge-danger' style='font-size: 14px'>Belum Baik</span>";
                                                } else if ($statPsiko == 1) {
                                                    echo "<span class='badge badge-success' style='font-size: 14px'>Baik</span>";
                                                } else {
                                                    echo "-";
                                                }
                                                ?>
                                            </div>
                                                 <a href="#" class="btn btn-primary btn-xs"
                                                    title="Update Kondisi Psikologis" data-toggle="modal"
                                                    data-target="#modal-editPsiko-{{$psiko->idPengungsi}}"
                                                    style='font-size: 14px'><i class="fas fa-eye"></i> Update</a>
                                            </td>
                                            

                                            <div class="modal fade" id="modal-editPsiko-{{$psiko->idPengungsi}}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Tes Psikologi untuk
                                                                {{ $pengungsi->nama ?? 'Pengungsi' }}
                                                            </h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form action="{{ route('kondisiPsikologis.create')  }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="idPengungsi"
                                                                value="{{ $psiko->idPengungsi }}">

                                                            <div class="modal-body">

                                                                <div class="form-group">
                                                                    <label for="exampleInputNama">Nama Pengungsi</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputnama" name="nama"
                                                                        placeholder="Masukan nama pengungsi"
                                                                        value="{{$psiko->nama}}" readonly>
                                                                </div>


                                                                <div class="form-group">
                                                                    <label for="exampleInputPosko">Posko
                                                                        Pengungsi</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputPosko"
                                                                        placeholder="Masukan provinsi"
                                                                        name="namaSamaran" value="{{$psiko->namaPosko}}"
                                                                        disabled>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>1. Apakah Anda merasa cemas akhir-akhir
                                                                        ini?</label><br>
                                                                    @foreach([0 => 'Tidak Pernah', 1 => 'Sedikit', 2 =>
                                                                    'Beberapa Kali', 3 =>
                                                                    'Sering', 4 => 'Selalu'] as $val => $label)
                                                                    <label><input type="radio" name="jawaban1"
                                                                            value="{{ $val }}"
                                                                            {{ $psiko->jawaban1 == $val ? 'checked' : '' }}>
                                                                        {{ $label }}</label><br>
                                                                    @endforeach
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>2. Apakah Anda mengalami kesulitan
                                                                        tidur?</label><br>
                                                                    @foreach([0 => 'Tidak Pernah', 1 => 'Sedikit', 2 =>
                                                                    'Beberapa Kali', 3 =>
                                                                    'Sering', 4 => 'Selalu'] as $val => $label)
                                                                    <label><input type="radio" name="jawaban2"
                                                                            value="{{ $val }}"
                                                                            {{ $psiko->jawaban2 == $val ? 'checked' : '' }}>
                                                                        {{ $label }}</label><br>
                                                                    @endforeach
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>3. Apakah Anda merasa sedih
                                                                        berkepanjangan?</label><br>
                                                                    @foreach([0 => 'Tidak Pernah', 1 => 'Sedikit', 2 =>
                                                                    'Beberapa Kali', 3 =>
                                                                    'Sering', 4 => 'Selalu'] as $val => $label)
                                                                    <label><input type="radio" name="jawaban3"
                                                                            value="{{ $val }}"
                                                                            {{ $psiko->jawaban3 == $val ? 'checked' : '' }}>
                                                                        {{ $label }}</label><br>
                                                                    @endforeach
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>4. Apakah Anda mudah marah atau
                                                                        tersinggung?</label><br>
                                                                    @foreach([0 => 'Tidak Pernah', 1 => 'Sedikit', 2 =>
                                                                    'Beberapa Kali', 3 =>
                                                                    'Sering', 4 => 'Selalu'] as $val => $label)
                                                                    <label><input type="radio" name="jawaban4"
                                                                            value="{{ $val }}"
                                                                            {{ $psiko->jawaban4 == $val ? 'checked' : '' }}>
                                                                        {{ $label }}</label><br>
                                                                    @endforeach
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>5. Apakah Anda mengalami kehilangan minat
                                                                        dalam aktivitas
                                                                        sehari-hari?</label><br>
                                                                    @foreach([0 => 'Tidak Pernah', 1 => 'Sedikit', 2 =>
                                                                    'Beberapa Kali', 3 =>
                                                                    'Sering', 4 => 'Selalu'] as $val => $label)
                                                                    <label><input type="radio" name="jawaban5"
                                                                            value="{{ $val }}"
                                                                            {{ $psiko->jawaban5 == $val ? 'checked' : '' }}>
                                                                        {{ $label }}</label><br>
                                                                    @endforeach
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>6. Apakah Anda merasa kesulitan
                                                                        berkonsentrasi?</label><br>
                                                                    @foreach([0 => 'Tidak Pernah', 1 => 'Sedikit', 2 =>
                                                                    'Beberapa Kali', 3 =>
                                                                    'Sering', 4 => 'Selalu'] as $val => $label)
                                                                    <label><input type="radio" name="jawaban6"
                                                                            value="{{ $val }}"
                                                                            {{ $psiko->jawaban6 == $val ? 'checked' : '' }}>
                                                                        {{ $label }}</label><br>
                                                                    @endforeach
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Simpan
                                                                        Jawaban</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </form>



                                                    </div>
                                                </div>
                                            </div>

                                            <td>
                                                <?php
                                                    $bolehPulang = false;

                                                    // Cek apakah semua status tidak null
                                                    if (
                                                        !is_null($psiko->statusBencana) &&
                                                        !is_null($psiko->statusFisik) &&
                                                        !is_null($psiko->statusRumah) &&
                                                        !is_null($psiko->statusSekitar) &&
                                                        !is_null($psiko->statusPsikologis)
                                                    ) {
                                                        // Lanjutkan cek logika boleh pulang
                                                        if (
                                                            $psiko->statusBencana == 3 &&
                                                            $psiko->statusFisik != 3 &&
                                                            $psiko->statusRumah != 3 &&
                                                            $psiko->statusSekitar != 3 &&
                                                            $psiko->statusPsikologis == 1
                                                        ) {
                                                            $bolehPulang = true;
                                                        }
                                                    }

                                                    // Tampilkan badge
                                                    if ($bolehPulang) {
                                                        echo "<span class='badge badge-success' style='font-size: 14px'>Boleh Pulang</span>";
                                                    } else {
                                                        echo "<span class='badge badge-danger' style='font-size: 14px'>Belum Pulang</span>";
                                                    }
                                                ?>
                                            </td>
                                </tr>
                                @endforeach
                                @endauth

                                @auth('karyawan')
                                <?php $i = 0;?>
                                @foreach($kepulangan as $key => $psiko)
                                <tr>
                                    @if($posko->idTrc === auth()->user()->id)
                                    <?php $i++;?>
                                    <td>{{ $kepulangan->firstItem() + $key  }}</td>
                                    <!-- <input type="text" class="form-control" id="exampleInputnama" name="nama" value="{{$namaBencana}}{{$getIdPosko}}" hidden required> -->
                                    <!-- <td>{{$namaBencana}} {{ $data->firstItem() + $key  }}</td> -->
                                    <td>{{$psiko->nama }}</td>
                                    <td>{{ $psiko->telpon}}</td>
                                    <td>{{ $psiko->lokKel}}</td>
                                    <!-- <td>{{ $posko->detail}}</td> -->
                                    <!-- <td>{{ $psiko->alamat}}</td> -->
                                    <td>{{ $psiko->umur}}</td>
                                    <td>{{ $psiko->statusBencana}}</td>
                                    <td>{{ $psiko->statusFisik}}</td>
                                    <td>{{ $psiko->statusRumah}}</td>
                                    <td>{{ $psiko->statusSekitar}}</td>
                                    <td>{{ $psiko->statusPsikologis}}</td>
                                    @endif
                                </tr>
                                @endforeach
                                @endauth

                                @auth('admin')
                                <?php $i = 0;?>
                                @foreach($data as $key => $posko)
                                <tr>
                                    @if($posko->idTrc === auth()->user()->id)
                                    <?php $i++;?>
                                    <td>{{ $i }}</td>
                                    <!-- <td>{{ $kepulangan->firstItem() + $key  }}</td> -->
                                    <!-- <input type="text" class="form-control" id="exampleInputnama" name="nama" value="{{$namaBencana}}{{$getIdPosko}}" hidden required> -->
                                    <!-- <td>{{$namaBencana}} {{ $data->firstItem() + $key  }}</td> -->
                                    <td>{{$psiko->nama }}</td>
                                    <td>{{ $psiko->telpon}}</td>
                                    <td>{{ $psiko->lokKel}}</td>
                                    <!-- <td>{{ $posko->detail}}</td> -->
                                    <!-- <td>{{ $psiko->alamat}}</td> -->
                                    <td>{{ $psiko->umur}}</td>
                                    <td>{{ $psiko->statusBencana}}</td>
                                    <td>{{ $psiko->statusFisik}}</td>
                                    <td>{{ $psiko->statusRumah}}</td>
                                    <td>{{ $psiko->statusSekitar}}</td>
                                    <td>{{ $psiko->statusPsikologis}}</td>
                                    @endif
                                </tr>
                                @endforeach
                                @endauth
                            </tbody>
                        </table>
                        <br />
                        {{ $kepulangan->links() }}
                        <br />

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Delete -->
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
                    url: "{{url('/posko/delete')}}/" + id,
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

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

    <script>
    let form = document.getElementById('search');
    form.addEventListener('beforeinput', e => {
        const formdata = new FormData(form);
        let search = formdata.get('search');
        let url = "{{ route('posko.searchPosko', "
        search = ")   }}" + search

        // let data = url;
        // alert(data);

        if (url === "") {
            result;
        } else {
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    {
                        let i;
                        let result = "";
                        if (data.length === 0) {
                            result += 'Data tidak ditemukan'
                        }
                        for (i = 0; i < data.length; i++) {
                            let posko = data[i]
                            let trc = posko.fullName;
                            if (trc == null) {
                                trc = ' ';
                            } else {
                                trc = posko.fullName
                            }
                            let dateCreate = new Date(posko.created_at);
                            dateCreate = dateCreate.toLocaleString();
                            let dateUpdate = new Date(posko.updated_at);
                            dateUpdate = dateUpdate.toLocaleString();
                            result +=
                                `<tr>
                <td>${i+1}</td>
                                    <td>${posko.namaPosko }</td>
                                    <td>${posko.lokasi}</td>
                                    <td>${trc}</td>
                                    <td>${posko.ttlPengungsi} orang</br>
                                        <a href="{{url('/listPengungsi')}}/${posko.idPosko}"
                                            class="btn btn-primary btn-xs" title="Lihat pengungsi"><i
                                                class="fas fa-eye"></i> Posko </a>
                                    </td>
                                    <td>${posko.kapasitas - posko.ttlPengungsi} orang</td>
                                    <td>${dateCreate}</td>
                                    <td>${dateUpdate}</td>
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
                                                data-toggle="modal"
                                                data-target="#modal-edit-${posko.idPosko}">
                                                <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                                                </svg>
                                                Edit
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item " title="Hapus Pengungsi"
                                                onclick="deleteConfirmation(${posko.idPosko})">
                                                <i class="fas fa-trash mr-1"></i> Hapus
                                            </a>
                                        </div>

                                    </div>
                                </td>

                                        <!-- /.modal-dialog -->
                                    </div>

                                </td>

                </tr>`;
                        }
                        document.getElementById('result').innerHTML = result;

                    }
                }).catch((err) => console.log(err))
        }
    });
    </script>


    <script>
    let form2 = document.getElementById('searchPoskoTrc');
    form2.addEventListener('beforeinput', e => {
        const formdata = new FormData(form2);

        let search = formdata.get('searchPoskoTrc');
        let url2 = document.getElementById('idTrc').value;
        let url = "{{url('/search/poskoTrc')}}/" + url2 + "?search=" + search

        // let data = url;


        if (url === "") {
            result;
        } else {
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    {
                        let i;
                        let result = "";
                        if (data.length === 0) {
                            result += 'Data tidak ditemukan'
                        }
                        for (i = 0; i < data.length; i++) {
                            let posko = data[i]
                            let trc = posko.fullName;
                            if (trc == null) {
                                trc = ' ';
                            } else {
                                trc = posko.fullName
                            }
                            let dateCreate = new Date(posko.created_at);
                            dateCreate = dateCreate.toLocaleString();
                            let dateUpdate = new Date(posko.updated_at);
                            dateUpdate = dateUpdate.toLocaleString();
                            result +=
                                `<tr>
                                    <td>${i+1}</td>
                                    <td>${posko.namaPosko }</td>
                                    <td>${posko.lokasi}</td>
                                    <td>${trc}</td>
                                    <td>${posko.ttlPengungsi} orang</br>
                                        <a href="{{url('/listPengungsi')}}/${posko.idPosko}"
                                            class="btn btn-primary btn-xs" title="Lihat pengungsi"><i
                                                class="fas fa-eye"></i> Posko </a>
                                    </td>
                                    <td>${posko.kapasitas - posko.ttlPengungsi} orang</td>
                                    <td>${dateCreate}</td>
                                    <td>${dateUpdate}</td>


                                        <!-- /.modal-dialog -->
                                    </div>

                                </td>

                </tr>`;
                        }
                        document.getElementById('result').innerHTML = result;

                    }
                }).catch((err) => console.log(err))
        }
    });
    </script>


</section>

@endsection()