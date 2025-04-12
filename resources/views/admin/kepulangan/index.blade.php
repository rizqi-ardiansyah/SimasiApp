@extends('admin.mainIndex')
@section('content')

<!-- Main Content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Bencana</h1>
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
                        <h3 class="card-title">List Bencana</h3>
                        <div class="card-tools">
                            @role('pusdalop')
                            <form id="search" action="{{ route('bencana.searchBencana') }}" method="GET">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="search" class="form-control float-right" placeholder="Search">
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
                                    <input type="text" name="searchForTrc" class="form-control float-right" placeholder="Search">
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

                    <!-- Data yang di dalam kurung [] tidak terpakai -->
                    <script>
var subjectObject = {
  "Batu": {
    "Oro-oro Ombo": ["Links", "Images", "Tables", "Lists"],
    "Pesanggrahan": ["Borders", "Margins", "Backgrounds", "Float"],
    "Sumberejo": ["Variables", "Operators", "Functions", "Conditions"],
    "Ngaglik": ["Variables", "Operators", "Functions", "Conditions"],
    "Sisir": ["Variables", "Operators", "Functions", "Conditions"],
    "Songgokerto": ["Variables", "Operators", "Functions", "Conditions"],
    "Temas": ["Variables", "Operators", "Functions", "Conditions"],
  },
  "Bumiaji": {
    "Bulukerto": ["Variables", "Strings", "Arrays"],
    "Bumiaji": ["SELECT", "UPDATE", "DELETE"],
    "Giripurno": ["Borders", "Margins", "Backgrounds", "Float"],
    "Gunungsari": ["Variables", "Operators", "Functions", "Conditions"],
    "Pandanrejo": ["Variables", "Operators", "Functions", "Conditions"],
    "Punten": ["Variables", "Operators", "Functions", "Conditions"],
    "Sumbergondo": ["Borders", "Margins", "Backgrounds", "Float"],
    "Tulungrejo": ["Variables", "Operators", "Functions", "Conditions"],
    "Sumber Brantas": ["Variables", "Operators", "Functions", "Conditions"],
  },
  "Junrejo": {
    "Beji": ["Links", "Images", "Tables", "Lists"],
    "Dadaprejo": ["Borders", "Margins", "Backgrounds", "Float"],
    "Junrejo": ["Variables", "Operators", "Functions", "Conditions"],
    "Mojorejo": ["Variables", "Operators", "Functions", "Conditions"],
    "Pendem": ["Variables", "Operators", "Functions", "Conditions"],
    "Tlekung": ["Variables", "Operators", "Functions", "Conditions"],
    "Torongrejo": ["Variables", "Operators", "Functions", "Conditions"],
  },
}
window.onload = function() {
  var subjectSel = document.getElementById("kecamatan");
  var topicSel = document.getElementById("kelurahan");

  for (var x in subjectObject) {
    subjectSel.options[subjectSel.options.length] = new Option(x, x);
  }
    subjectSel.onchange = function() {
//empty Chapters- and Topics- dropdowns
    // chapterSel.length = 1;
    topicSel.length = 1;
    //display correct values
    for (var y in subjectObject[this.value]) {
        topicSel.options[topicSel.options.length] = new Option(y, y);
    }
  }
}
</script>

                    <div class="card-body table-responsive">
                        <!-- @role('pusdalop')
                        <a href="#" class="btn btn-success mb-2 " data-toggle="modal" data-target="#tambah" style="font-size: 14px;">
                            <i class="fas fa-plus mr-1"></i> Tambah Bencana
                        </a>
                        @endrole -->

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <!-- <th>No</th> -->
                                    <th>Nama</th>
                                    <th>Waktu</th>
                                    <th>Lokasi</th>
                                    <th>Posko</th>
                                    <th>Pengungsi</th>
                                    <th>Kondisi Rumah</th>
                                    <th>Kondisi Sekitar</th>
                                    <th>Waktu Update</th>
                                    <th>Status</th>
                                    <!-- @role('pusdalop')
                                    <th>Aksi</th>
                                    @endrole -->
                                </tr>
                            </thead>
                            <tbody id="result">
                            @role('pusdalop')
                                @php
                                    // Cek apakah ada data dengan status 3
                                    $isAllowedToReturn = false;
                                    foreach ($data as $bencana) {
                                        if ($bencana->status == 3) {
                                            $isAllowedToReturn = true;
                                            break;
                                        }
                                    }
                                @endphp
                                @if (!$isAllowedToReturn)
                                    <tr>
                                        <td colspan="11" style="text-align: center;">Belum ada pengungsi yang diperbolehkan pulang</td>
                                    </tr>
                                @else
                                @foreach ($data as $key => $bencana)
                                @if(!empty($bencana->namaBencana) && $bencana->status ==3)
                                <tr>
                                    <!-- <td>{{ ($data->perPage() * ($data->currentPage() - 1)) + $loop->iteration }}</td> -->
                                    <!-- <td>{{ ($data->firstItem() - 1) + $loop->iteration }}</td> -->
                                    <!-- <td>{{ $data->firstItem() + $key }}</td> -->
                                    <!-- <td>{{ ($data->firstItem() ?: 1) + $loop->index }}</td> -->
                                    <!-- <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td> -->
                                    <td>{{ $bencana->namaBencana }}</td>
                                    <td>{{ $bencana->waktu }}</td>
                                    <td>{{ $bencana->alamat }}</td>
                                    <!-- <td>{{ $bencana->posko }}</td> -->
                                    <td>{{ $bencana->jmlPosko }} tempat</br>
                                    <!-- url('/poskoKepulangan' -->
                                        <a href="{{url('/poskoKepulangan')}}/<?php echo $bencana->idBencana; ?>" class="btn btn-primary btn-xs" title="Lihat posko"><i class="fas fa-eye"></i> Posko </a>
                                    </td>
                                    <td>{{ $bencana->ttlPengungsi }} orang</br>
                                    <td>
                                        {{ $bencana->jumlahRumahRusak }} kondisi
                                        <!-- <a href="{{url('/rumahRusak')}}/<?php echo $bencana->idBencana; ?>" class="btn btn-primary btn-xs" title="Lihat rumah rusak"><i class="fas fa-eye"></i> Detail</a> -->
                                        <a href="#" class="btn btn-primary btn-xs" title="Tmbah kondisi" data-toggle="modal" data-target="#modal-tambah-{{$bencana->idBencana}}" style="font-size: 14px;"><i class="fas fa-plus"></i> Tambah</a>
                                    </td>
                                    <td>
                                        {{ $bencana->null }} area rusak
                                        <a href="{{url('/listPosko')}}/<?php echo $bencana->idBencana; ?>" class="btn btn-primary btn-xs" title="Lihat posko"><i class="fas fa-eye"></i> Detail</a>
                                    </td>
                                    <td>{{ $bencana->waktuUpdate }}</td>
                                    <td>
                                        @if($bencana->status == 1)
                                        @php
                                        $value = 'Siaga'
                                        @endphp
                                        <span class="badge badge-danger"><?php echo $value; ?></span>
                                        @elseif($bencana->status == 2)
                                        @php
                                        $value = 'Tanggap Darurat'
                                        @endphp
                                        <span class="badge badge-danger"><?php echo $value; ?></span>
                                        @elseif($bencana->status == 3)
                                        @php
                                        $value = 'Pemulihan'
                                        @endphp
                                        <span class="badge badge-success"><?php echo $value; ?></span>
                                        @elseif($bencana->status == 0)
                                        @php
                                        $value = 'Selesai'
                                        @endphp
                                        <span class="badge badge-info">Selesai</span>
                                        @endif
                                    </td>
                                    <!-- <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                                <i class="fas fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-lg" role="menu"> -->
                                                <!-- <a href="#" class="dropdown-item " data-toggle="modal" data-target="#modal-detail" title="Detail Pengungsi">
                                                    <i class="fas fa-eye mr-1"></i> Detail
                                                </a>
                                                <div class="dropdown-divider"></div> -->
                                                <!-- <a href="#" class="dropdown-item " title="Edit Bencana" data-toggle="modal" data-target="#modal-edit-{{$bencana->idBencana}}">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item " title="Hapus Bencana" onclick="deleteConfirmation({{$bencana->idBencana}})">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </a>
                                            </div> -->
                                            <!-- /.modal-dialog -->
                                        <!-- </div> -->
                                        <!-- <a href="#" class="btn btn-danger btn-sm" title="Hapus Pengungsi">
                                            Hapus
                                        </a> -->
                                    <!-- </td> -->
                                </tr>
                                @endif
                                @endforeach
                                @endif
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
                                        <a href="{{url('/listPosko')}}/<?php echo $bencana->idBencana; ?>" class="btn btn-primary btn-xs" title="Lihat posko"><i class="fas fa-eye"></i> Posko </a>
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
                                        <a href="{{url('/listPosko')}}/<?php echo $bencana->idBencana; ?>" class="btn btn-primary btn-xs" title="Lihat posko"><i class="fas fa-eye"></i> Posko </a>
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

                                @foreach ($data as $detail)
                                    <div class="modal fade" id="modal-tambahh-{{$detail->idBencana}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Pengungsi</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- form start -->
                                    <form action="{{ route('pengungsi.create') }}" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <!-- <div class="form-group"> -->
                                            <!-- {{request()->id}}
                                            {{request()->trc_id}} -->
                                            <input type="text" class="form-control" id="posko_id" name="posko_id" value="{{request()->id}}" hidden required>
                                            <input type="text" class="form-control" id="bencana_id" name="bencana_id" value="{{request()->bencana_id}}" hidden required>
                                            <input type="text" class="form-control" id="trc_id" name="trc_id" value="{{request()->trc_id}}" hidden required>
                                            <!-- </div> -->

                                            <div class="form-group">
                                                <label for="nama">Nama Pengungsi</label>
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama pengungsi">
                                            </div>

                                            <div class="form-group">
                                                <label for="telpon">Nomor HP</label>
                                                <input type="number" class="form-control" id="telpon" name="telpon" placeholder="Masukan nomor telepon" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="sKeluarga">Status Keluarga</label>
                                                <select class="form-control" id="statKel" name="statKel"onchange="showDivs(this, '{{$detail->idBencana}}')">
                                                    <option value=0>Kepala Keluarga</option>
                                                    <option value=1>Ibu</option>
                                                    <option value=2>Anak</option>
                                                    <option value=3 selected>Lainnya</option>
                                                </select>
                                            </div>
                                            <!-- script form status keluarga -->
                                            <script type="text/javascript">
                                                // var idForm_1 = document.getElementById('form_1');
                                                // var idForm_2 = document.getElementById('form_2');



    function showDivs(selects, id) {
        const formAlamat = document.getElementById("formAlamatt-" + id);

        if (selects.value == 0) {
            formAlamat.style.display = "none";
        } else if (selects.value == 1 || selects.value == 2) {
            formAlamat.style.display = "block";
        }
    }
                                            </script>
                                            <!-- end -->

                                            <div class="form-group" id ="formAlamatt-{{$detail->idBencana}}">
                                                <label for="alamat">Detail Alamat</label>
                                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan detail alamat pengungsi">
                                            </div>


                                            <!-- end -->



                                            <div class="form-group">
                                                <label for="gender">Jenis Kelamin</label>
                                                <select class="form-control" id="gender" name="gender" required>
                                                    <option value=1>Laki - Laki</option>
                                                    <option value=0>Perempuan</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="umur">Umur</label>
                                                <input type="text" class="form-control" id="umur" name="umur" placeholder="Masukan umur" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="statKon">Kondisi</label>
                                                <select class="form-control" id="statKon" name="statKon" required>
                                                    <option value=0>Sehat</option>
                                                    <option value=1>Luka Ringan</option>
                                                    <option value=2>Luka Sedang</option>
                                                    <option value=3>Luka Berat</option>
                                                    <option value=4>Hamil atau menyusui</option>
                                                    <option value=5>Difabel</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="statPos">Status</label>
                                                <select class="form-control" id="statPos" name="statPos" required>
                                                    <option value=1>Di Posko</option>
                                                    <option value=0>Keluar</option>
                                                    <option value=2>Pencarian</option>
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
                    @endforeach




                                @foreach ($data as $detail)
                                <div class="modal fade" id="modal-tambah-{{$detail->idBencana}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambah Kondisi Rumah</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- form start -->
                                                <form action="{{ route('rumahRusak.create') }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body">
                                                        <!-- <input type="text" class="form-control" id="posko_id" name="posko_id" value="{{request()->id}}" hidden required> -->
                                                        <input type="text" class="form-control" id="bencana_id" name="bencana_id" value="{{$detail->idBencana}}" hidden required>
                                                        <input type="text" class="form-control" id="trc_id" name="trc_id" value="{{$detail->trc_id}}" hidden required>

                                                        <div class="form-group">
                                                            <label for="exampleInputPosko">Tanggal</label>
                                                            <input type="date" class="form-control" id="exampleInputtanggal" placeholder="Masukan tanggal" name="tanggal" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputPengungsi">Waktu</label>
                                                            <input type="time" class="form-control" id="exampleInputwaktu" placeholder="Masukan waktu" name="waktu" required>
                                                        </div>

                                                        <div class="form-group">
                                                        <label for="exampleInputPosko">Posko</label>
                                                       <!-- Dropdown Posko -->
                                                        <select id="poskoSelect-{{$detail->idBencana}}" name="posko_id" class="form-control">
                                                        <option value="" disabled selected>Pilih Posko</option>
                                                        @php $namaPoskoUnik = []; @endphp
                                                        @foreach ($posko as $poskos)
                                                            @if (!in_array($poskos->namaPosko, $namaPoskoUnik))
                                                                <option value="{{ $poskos->idPosko }}">{{ $poskos->namaPosko }}</option>
                                                                @php $namaPoskoUnik[] = $poskos->namaPosko; @endphp
                                                            @endif
                                                        @endforeach
                                                        <option value="0">Tidak ada</option>
                                                    </select>
                                                    </div>

                                                    <style>
                                                        .select2-selection--single {
                                                        height: 100% !important;
                                                        }
                                                        /* Input field */
                                                        .select2-selection__rendered{
                                                        word-wrap: break-word !important;
                                                        text-overflow: inherit !important;
                                                        white-space: normal !important;
                                                        }

                                                        .select2-selection__rendered {
                                                            color: black;
                                                            height: 100% !important;
                                                        }

                                                            .select2-search input { color: black }
                                                    </style>

                                                    <div class="form-group">
                                                    <label for="exampleInputPosko">Pilih Pemilik</label>
                                                        <!-- Dropdown Pengungsi -->
                                                    <!-- <select class="form-controll js-example-basic-single" id="pengungsiSelect-{{$detail->idBencana}}" name="carinama[]" multiple="multiple"
                                                    style="width: 100%;" onchange="showifEmpties(this)" disabled>
                                                    </select> -->
                                                    <select class="form-controll js-example-basic-single" id="pengungsiSelect-{{$detail->idBencana}}" name="carinama[]" multiple="multiple"
                                                    style="width: 100%;" disabled>
                                                        <!-- <option value="" disabled selected>Pilih Pemilik</option> -->
                                                    </select>

                                                    <script>
                                                    $(document).ready(function() {
                                                        $('.js-example-basic-single').select2({
                                                            theme: "classic",
                                                    });
                                                    });
                                                    </script>

                                                        <!-- Data Pengungsi (Disembunyikan dan Digunakan untuk JS) -->
                                                        @php
                                                            $dataPengungsi = [];
                                                            foreach ($pengungsi as $p) {
                                                                $dataPengungsi[$p->idPosko][] = [
                                                                    'id' => $p->idPengungsi,
                                                                    'nama' => $p->nama,
                                                                    'lokasi' => $p->lokKel ?? 'Tidak diketahui'
                                                                ];
                                                            }
                                                        @endphp


                                                    <script>
                                                        document.addEventListener("DOMContentLoaded", function () {
                                                        var pengungsiData = @json($dataPengungsi);

                                                        var poskoSelect = document.getElementById('poskoSelect-{{$detail->idBencana}}');
                                                        var pengungsiSelect = document.getElementById('pengungsiSelect-{{$detail->idBencana}}');

                                                        poskoSelect.addEventListener('change', function () {

                                                            var poskoId = this.value;

                                                            // Reset isi dropdown
                                                            pengungsiSelect.innerHTML = '';
                                                            pengungsiSelect.disabled = true;

                                                            // Tambahkan opsi "Tidak ada" sebagai default
                                                            var noDataOption = document.createElement('option');
                                                            noDataOption.value = 0;
                                                            noDataOption.textContent = 'Tidak ada';
                                                            // noDataOption.selected = true;
                                                            pengungsiSelect.appendChild(noDataOption);

                                                            // Jika ada data pengungsi untuk posko yang dipilih
                                                            if (pengungsiData.hasOwnProperty(poskoId) && pengungsiData[poskoId].length > 0) {
                                                                pengungsiData[poskoId].forEach(function (pengungsi) {
                                                                    var option = document.createElement('option');
                                                                    option.value = pengungsi.id;
                                                                    option.textContent = pengungsi.nama + ' - ' + pengungsi.lokasi;
                                                                    pengungsiSelect.appendChild(option);

                                                                    if(option.value == "0"){
                                                                        document.getElementById("formNama-{{$detail->idBencana}}").style.display = "block";
                                                                    }
                                                                });

                                                            }

                                                            pengungsiSelect.disabled = false;
                                                        });

                                                        $(pengungsiSelect).on('change', function () {
                                                            let selected = $(this).val(); // array of selected values
                                                            let showForm = selected && selected.includes("0");

                                                            $("#formNama-{{$detail->idBencana}}").toggle(showForm);
                                                            $("#formAlamat-{{$detail->idBencana}}").toggle(showForm);
                                                        });

                                                            });

                                                    </script>


                                                    </div>

                                                    <div class="form-group" id="formNama-{{$detail->idBencana}}" style="display: none;">
                                                        <label for="nama">Masukkan Nama Pemilik </label>
                                                        <input type="text" class="form-control" id="nama" name="namaPemilikBaru" placeholder="Masukan nama pengungsi">
                                                    </div>

                                                    <div class="form-group" id ="formAlamat-{{$detail->idBencana}}" style="display: none;">
                                                        <label for="alamat">Detail Alamat</label>
                                                        <input type="text" class="form-control" id="alamat" name="alamatPemilikBaru" placeholder="Masukan detail alamat pengungsi">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputGambar">Upload Gambar Rumah</label>
                                                        <input type="file" class="form-control-file" id="exampleInputGambar" name="picRumah" required>
                                                    </div>

                                                    <div class="form-group" id ="keterangan">
                                                        <label for="keterangan">Keterangan</label>
                                                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Tambahkan keterangan">
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

                                                     <!-- pengungsiSelect.addEventListener('change', function () {
                                                            let selectedValues = $(pengungsiSelect).val();
                                                            let showForm = selectedValues && selectedValues.includes("0");

                                                            document.getElementById("formNama-{{$detail->idBencana}}").style.display = showForm ? "block" : "none";
                                                            document.getElementById("formAlamat-{{$detail->idBencana}}").style.display = showForm ? "block" : "none";
                                                        }); -->



                                                     <!-- script form jika tidak ada -->
                                                     <!-- <script type="text/javascript">
                                                        function showifEmpties(selects) {
                                                            console.log(selects);
                                                            if (selects.value != 0 || selects.value == "") {
                                                                document.getElementById("formNama-{{$detail->idBencana}}").style.display = "none";
                                                                document.getElementById("formAlamat-{{$detail->idBencana}}").style.display = "none";
                                                                // idForm_1.style.display = "block";
                                                                // idForm_2.style.display = "none";
                                                            } else if (selects.value == 0) {
                                                                document.getElementById("formAlamat-{{$detail->idBencana}}").style.display = "block";
                                                                document.getElementById("formNama-{{$detail->idBencana}}").style.display = "block";
                                                            }
                                                        }
                                                    </script> -->
                                                    <!-- end -->

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
                    </div>
                    <div>
                        <input type="text" class="form-control" id="bencana_id" name="bencana_id" value="{{request()->user()->id}}" hidden required>
                    </div>
                    @endforeach
                    </tbody>
                    </table>
                    <br />
                    {{ $data->links() }}
                    <br />
                </div>

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
                        url: "{{url('bencana/delete')}}/" + id,
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>


</section>


@endsection()