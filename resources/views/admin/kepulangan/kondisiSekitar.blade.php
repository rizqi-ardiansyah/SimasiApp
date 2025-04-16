@extends('admin.mainIndex')
@section('content')

<!-- Main Content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Kondisi Sekitar Bencana</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Bencana</a></li>
                    <li class="breadcrumb-item"><a href="#">Posko</a></li>
                    <li class="breadcrumb-item active">Kondisi Sekitar Bencana</a></li>
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
                        <h3 class="card-title">Kondisi sekitar bencana <b>{{ $namaBencana }}</b></h3>
                        <div class="card-tools">
                            @role('pusdalop')
                            <form id="search" action="{{ route('bencana.searchBencana') }}" method="GET">
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
                            @endrole
                            @role('trc')
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
                            @endrole
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
                                    <form action="{{ route('kondisiSekitar.create') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <!-- <input type="text" class="form-control" id="posko_id" name="posko_id" value="{{request()->id}}" hidden required> -->
                                            <input type="text" class="form-control" id="bencana_id" name="bencana_id"
                                                value="{{request()->bencana_id}}" hidden required>
                                            <!-- <input type="text" class="form-control" id="trc_id" name="trc_id" value="{{request()->trc_id}}" hidden required> -->

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
                                                <label for="inputAlamat">Pilih alamat</label>
                                                <select class="form-controll js-example-basic-single"
                                                    name="cariAlamat[]" multiple="multiple" style="width: 100%;"
                                                    onchange="showifEmpty(this)">
                                                    <option value="" disabled>Pilih alamat</option>
                                                    @foreach($pengungsi->unique('lokKel') as $p)
                                                    @if(!empty($p->lokKel))
                                                    <option value="{{ $p->kpl_id }}">{{ $p->lokKel }}</option>
                                                    @endif
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
                                                    // document.getElementById("formNama").style.display = "none";
                                                    document.getElementById("formAlamat").style.display = "none";
                                                    // idForm_1.style.display = "block";
                                                    // idForm_2.style.display = "none";
                                                } else if (selects.value == 0) {
                                                    document.getElementById("formAlamat").style.display = "block";
                                                    // document.getElementById("formNama").style.display = "block";
                                                }
                                            }
                                            </script>
                                            <!-- end -->

                                            <!-- <div class="form-group" id="formNama">
                                                <label for="nama">Masukkan Nama Pemilik</label>
                                                <input type="text" class="form-control" id="nama" name="namaPemilikBaru" placeholder="Masukan nama pengungsi">
                                            </div> -->

                                            <div class="form-group" id="formAlamat">
                                                <label for="alamat">Detail Alamat</label>
                                                <input type="text" class="form-control" id="alamat" name="alamatBaru"
                                                    placeholder="Masukan detail alamat pengungsi">
                                            </div>

                                            <!-- <div class="form-group">
                                                <label for="exampleInputProvinsi">Tambahkan alamat Detail</label>
                                                <input type="text" class="form-control" id="exampleInputnama" placeholder="Masukan provinsi" name="provinsi" value="Jawa Timur" required>
                                            </div> -->

                                            <!-- <div class="form-group">
                                                <label for="exampleInputPosko">Posko Pengungsi</label>
                                                <input type="text" class="form-control" id="exampleInputnama" placeholder="Masukan nama posko" name="namaPosko" value="{{$namaPosko}}" disabled>
                                            </div> -->

                                            <div class="form-group">
                                                <label for="exampleInputGambar">Upload Kondisi Sekitar</label>
                                                <input type="file" class="form-control-file" id="exampleInputGambar"
                                                    name="picLokasi" required>
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
                        @role('pusdalop')
                        <a href="#" class="btn btn-success mb-2 " data-toggle="modal" data-target="#tambah"
                            style="font-size: 14px;">
                            <i class="fas fa-plus mr-1"></i> Tambah Data
                        </a>
                        @endrole

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <!-- <th>No</th> -->
                                    <th>Tanggal Pemeriksaan</th>
                                    <th>Alamat</th>
                                    <th>Gambar</th>
                                    <th>Status Kondisi</th>
                                    <th>Keterangan</th>
                                    <th>Waktu Update</th>
                                    <th>Aksi</th>
                                    <!-- @role('pusdalop')
                                    <th>Aksi</th>
                                    @endrole -->
                                </tr>
                            </thead>
                            <tbody id="result">

                                @role('pusdalop')
                                @php
                                $shown = [];
                                @endphp

                                @foreach ($kondisiSekitar as $key => $bencana)
                                @if (!is_null($bencana->kondisiSekitar_id))
                                @php
                                $uniqueKey = $bencana->kondisiSekitar_id;
                                @endphp

                                @if (!in_array($uniqueKey, $shown))
                                @php $shown[] = $uniqueKey; @endphp

                                <tr>
                                    <td>{{ $bencana->ketWaktu }}</td>
                                    <td>
                                        @if ($bencana->lokKel)
                                            {{ $bencana->lokKel }}
                                        @else
                                            {{ $bencana->alamatBaru ?? '-' }}
                                        @endif
                                    </td>

                                    <td>
                                        <img src="{{ asset('storage/images/' . $bencana->picLokasi) }}"
                                            alt="Foto Lokasi" width="100" class="img-thumbnail" data-toggle="modal"
                                            data-target="#imageModal"
                                            onclick="showImage('{{ asset('storage/images/' . $bencana->picLokasi) }}')">
                                    </td>

                                    <!-- Modal -->
                                    <div class="modal fade" id="imageModal" tabindex="-1"
                                        aria-labelledby="imageModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Preview Gambar</h5>
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

                                    <td>
                                        @php
                                        $statusLabel = 'Tidak diketahui';
                                        $statusClass = 'badge-secondary';

                                        if ($bencana->status == 0) {
                                        $statusLabel = 'Aman';
                                        $statusClass = 'badge-success';
                                        } elseif ($bencana->status == 1) {
                                        $statusLabel = 'Rusak ringan';
                                        $statusClass = 'badge-info';
                                        } elseif ($bencana->status == 2) {
                                        $statusLabel = 'Rusak sedang';
                                        $statusClass = 'badge-info';
                                        } elseif ($bencana->status == 3) {
                                        $statusLabel = 'Rusak berat';
                                        $statusClass = 'badge-danger';
                                        }
                                        @endphp

                                        <span class="badge {{ $statusClass }}">{{ $statusLabel }}</span>
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
                                                <a href="#" class="dropdown-item" title="Edit Kondisi"
                                                    data-toggle="modal" data-target="#modal-edit-{{$bencana->idKr}}">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item" title="Hapus Bencana"
                                                    onclick="deleteConfirmation({{$bencana->idKr}})">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @endif
                                @endforeach
                                @endrole


                                @role('trc')
                                <?php $i = 0; ?>
                                @foreach ($data2 as $key => $bencana)
                                <tr>
                                    @if($bencana->trc == auth()->user()->id)
                                    <?php $i++; ?>
                                    <td>{{ $data2->firstItem() + $key }}</td>
                                    <td>{{ $bencana->namaBencana }}</td>
                                    <td>{{ $bencana->waktu }}</td>
                                    <td>{{ $bencana->alamat }}</td>
                                    <!-- <td>{{ $bencana->posko }}</td> -->
                                    <td>{{ $bencana->jmlPosko }} tempat</br>
                                        <a href="{{url('/listPosko')}}/<?php echo $bencana->idBencana; ?>"
                                            class="btn btn-primary btn-xs" title="Lihat posko"><i
                                                class="fas fa-eye"></i> Posko </a>
                                    </td>
                                    <td>{{ $bencana->jmlPengungsi }} orang</br>
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
                                @endrole


                                @role('relawan')
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
                                @endrole

                                @foreach ($kondisiSekitar as $detail)
                                <div class="modal fade" id="modal-edit-{{$detail->idKr}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Ubah Kondisi Sekitar</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- form start -->
                                                <form action="{{ url('/kondisiSekitar/edit/'.$detail->idKr) }}"
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
                                                            <label for="inputAlamat">Pilih alamat</label>
                                                            <select class="form-controll js-example-basic-single"
                                                                name="cariAlamat[]" multiple="multiple"
                                                                style="width: 100%;" onchange="showifEmpties(this)">
                                                                <option value="{{$detail->idKepala}}" selected>
                                                                    {{$detail->lokKel}}</option>
                                                                <option value="" disabled>Pilih alamat</option>
                                                                @foreach($pengungsi->unique('lokKel') as $p)
                                                                @if(!empty($p->lokKel))
                                                                <option value="{{ $p->kpl_id }}">{{ $p->lokKel }}
                                                                </option>
                                                                @endif
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
                                                        function showifEmpties(selects) {
                                                            console.log(selects);
                                                            if (selects.value != 0 || selects.value == "") {
                                                                // document.getElementById("formNama").style.display = "none";
                                                                document.getElementById("formAlamat2").style.display =
                                                                    "none";
                                                                // idForm_1.style.display = "block";
                                                                // idForm_2.style.display = "none";
                                                            } else if (selects.value == 0) {
                                                                document.getElementById("formAlamat2").style.display =
                                                                    "block";
                                                                // document.getElementById("formNama").style.display = "block";
                                                            }
                                                        }
                                                        </script>
                                                        <!-- end -->

                                                        <!-- <div class="form-group" id="formNama">
                                                <label for="nama">Masukkan Nama Pemilik</label>
                                                <input type="text" class="form-control" id="nama" name="namaPemilikBaru" placeholder="Masukan nama pengungsi">
                                            </div> -->

                                                        <div class="form-group" id="formAlamat2">
                                                            <label for="alamat">Detail Alamat (Isi kalau tidak ada di list)</label>
                                                            <input type="text" class="form-control" id="alamat"
                                                                name="alamatBaru" value="{{ $bencana->lokKel ? '' : ($bencana->alamatBaru ?? '') }}"
                                                                placeholder="Masukan detail alamat pengungsi">
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
                                                                    } else if ($getKondisi == 1) {
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
                                                                name="keterangan" value="{{$detail->keterangan}}" required>
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
                    <div>
                        <input type="text" class="form-control" id="bencana_id" name="bencana_id"
                            value="{{request()->user()->id}}" hidden required>
                    </div>
                    @endforeach
                    </tbody>
                    </table>
                    <br />
                    {{ $kondisiSekitar->links() }}
                    <br />
                </div>



                <!-- /.card-body -->
            </div>
        </div>
    </div>
    </div>

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
                    url: "{{url('kondisiSekitar/delete')}}/" + id,
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