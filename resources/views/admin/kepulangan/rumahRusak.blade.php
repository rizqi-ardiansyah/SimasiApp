@extends('admin.mainIndex')
@section('content')

<!-- Main Content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Daftar Rumah Rusak</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item">Bencana</li>
                    <li class="breadcrumb-item active">Daftar Rumah Rusak</li>
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
                        <h3 class="card-title">Daftar rumah rusak pada bencana <b>{{ $namaBencana }}</b></h3>
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
                                    <form action="{{ route('bencana.create') }}" method="post">
                                        @csrf
                                        <div class="card-body">
                                            <!-- <div class="form-group">
                                                <label for="exampleInputNama">Nama Pemilik</label>
                                                <select class="form-control" id="kelurahan" name="nama" required>
                                                        <option value="" disabled selected>Pilih nama pengungsi</option>
                                                            @foreach($pengungsi as $p)
                                                        <option value="{{ $p->id }}">{{ $p->nama }}({{ $p->lokKel }})</option>
                                                              @endforeach
                                                </select> -->

                                                <!-- <input type="text" class="form-control" id="exampleInputnama" name="namaPemilik" placeholder="Masukan nama pengungsi" required> -->
                                            <!-- </div> -->

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
                                                <label for="exampleInputNama">Pilih pemilik</label>
                                                <select class="form-controll js-example-basic-single" name="carinama[]" multiple="multiple" style="width: 100%;"
                                                onchange="showifEmpty(this)">
                                                <option value="" disabled>Pilih nama pengungsi</option>
                                                        @foreach($pengungsi as $p)
                                                        <option value="{{ $p->id }}">{{ $p->nama }}({{ $p->lokKel }})</option>
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
                                                // var idForm_1 = document.getElementById('form_1');
                                                // var idForm_2 = document.getElementById('form_2');

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
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama pengungsi">
                                            </div>

                                            <div class="form-group" id ="formAlamat">
                                                <label for="alamat">Detail Alamat</label>
                                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan detail alamat pengungsi">
                                            </div>

                                            
                                           
                                            <!-- <div class="form-group">
                                                <label for="exampleInputProvinsi">Alamat Detail</label>
                                                <input type="text" class="form-control" id="exampleInputnama" placeholder="Masukan provinsi" name="provinsi" value="Jawa Timur" required>
                                            </div> -->

                                            <div class="form-group">
                                                <label for="exampleInputPosko">Tanggal</label>
                                                <input type="date" class="form-control" id="exampleInputnama" placeholder="Masukan tanggal" name="tanggal" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputPengungsi">Waktu</label>
                                                <input type="time" class="form-control" id="exampleInputnama" placeholder="Masukan waktu" name="waktu" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputProvinsi">Provinsi</label>
                                                <input type="text" class="form-control" id="exampleInputnama" placeholder="Masukan provinsi" name="provinsi" value="Jawa Timur" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputKota">Kota</label>
                                                <input type="text" class="form-control" id="exampleInputnama" placeholder="Masukan kota" name="kota" value="Batu" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="kecamatan">Kecamatan</label>
                                                <select class="form-control" id="kecamatan" name="kecamatan" required>
                                                    <option selected value="" hidden>Pilih kecamatan</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="kelurahan">Kelurahan</label>
                                                <select class="form-control" id="kelurahan" name="kelurahan" required>
                                                    <option selected value="" hidden>Pilih kelurahan</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" id="status" name="status" required>
                                                    <option selected value="" hidden>Pilih status</option>
                                                    <option value="1">Berjalan</option>
                                                    <option value="0">Selesai</option>
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
                        <a href="#" class="btn btn-success mb-2 " data-toggle="modal" data-target="#tambah" style="font-size: 14px;">
                            <i class="fas fa-plus mr-1"></i> Tambah Data
                        </a>
                        @endrole

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <!-- <th>No</th> -->
                                    <th>Nama Pemilik</th>
                                    <th>Alamat Rumah</th>
                                    <th>Status Pengungsi</th>
                                    <th>Tanggal Peninjauan</th>
                                    <th>Aksi</th>
                                    <!-- @role('pusdalop')
                                    <th>Aksi</th>
                                    @endrole -->
                                </tr>
                            </thead>
                            <tbody id="result">

                                @role('pusdalop')
                                @foreach ($data as $key => $bencana)
                                @if(empty($bencana->namaBencana))
                                    <p>Data kosong</p>
                                    // whatever you need to do here
                                @else

                                <tr>
                                    <!-- <td>{{ $data->firstItem() + $key }}</td>ss -->
                                    <td>{{ $bencana->namaBencana }}</td>
                                    <td>{{ $bencana->waktu }}</td>
                                    <td>{{ $bencana->alamat }}</td>
                                    <!-- <td>{{ $bencana->posko }}</td> -->
                                    <td>{{ $bencana->jmlPosko }} tempat</br>
                                        <a href="{{url('/listPosko')}}/<?php echo $bencana->idBencana; ?>" class="btn btn-primary btn-xs" title="Lihat posko"><i class="fas fa-eye"></i> Posko </a>
                                    </td>
                                    <td>{{ $bencana->ttlPengungsi }} orang</br>
                                    <td>
                                        {{ $bencana->null }} rumah rusak
                                        <a href="{{url('/rumahRusak')}}/<?php echo $bencana->idBencana; ?>" class="btn btn-primary btn-xs" title="Lihat rumah rusak"><i class="fas fa-eye"></i> Detail</a>
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
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                                <i class="fas fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-lg" role="menu">
                                                <!-- <a href="#" class="dropdown-item " data-toggle="modal" data-target="#modal-detail" title="Detail Pengungsi">
                                                    <i class="fas fa-eye mr-1"></i> Detail
                                                </a>
                                                <div class="dropdown-divider"></div> -->
                                                <a href="#" class="dropdown-item " title="Edit Bencana" data-toggle="modal" data-target="#modal-edit-{{$bencana->idBencana}}">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item " title="Hapus Bencana" onclick="deleteConfirmation({{$bencana->idBencana}})">
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
                                <div class="modal fade" id="modal-edit-{{$detail->idBencana}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Ubah Bencana</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- form start -->
                                                <form action="{{ url('/bencana/edit/'.$detail->idBencana) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="exampleInputNama">Nama Bencana</label>
                                                            <input type="text" class="form-control" id="exampleInputnama" name="namaBencana" placeholder="Masukan nama bencana" value="{{$detail->namaBencana}}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputPosko">Tanggal</label>
                                                            <input type="date" class="form-control" id="exampleInputnama" placeholder="Masukan tanggal" name="tanggal" value="{{$detail->tgl}}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputPengungsi">Waktu</label>
                                                            <input type="time" class="form-control" id="exampleInputnama" placeholder="Masukan waktu" name="waktu" value="{{$detail->time}}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputProvinsi">Provinsi</label>
                                                            <input type="text" class="form-control" id="exampleInputnama" placeholder="Masukan provinsi" name="provinsi" value="{{$detail->provinsi}}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputKota">Kota</label>
                                                            <input type="text" class="form-control" id="exampleInputnama" placeholder="Masukan kota" name="kota" value="{{$detail->kota}}" required>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="kecamatan">Kecamatan</label>
                                                            <input type="text" class="form-control" id="exampleInputnama" placeholder="Masukan kota" name="kecamatan" value="{{$detail->kecamatan}}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="kelurahan">Kelurahan</label>
                                                            <input type="text" class="form-control" id="exampleInputnama" placeholder="Masukan kota" name="kelurahan" value="{{$detail->kelurahan}}" required>

                                                        </div>

                                                        <?php
$value = $detail->status;
if ($value == 1) {
    $value = 'Siaga';
} elseif ($value == 2) {
    $value = 'Tanggap Darurat';
} elseif ($value == 3) {
    $value = 'Pemulihan';
} elseif ($value == 0) {
    $value = 'Selesai';
}
// if()
?>

                                                        <div class="form-group">
                                                            <label for="status">Status</label>
                                                            <select class="form-control" id="status" name="status" required>
                                                                <option selected value="{{$detail->status}}" hidden>
                                                                    <?php echo $value; ?>
                                                                </option>
                                                                <option value="1">Siaga</option>
                                                                <option value="2">Tanggap Darurat</option>
                                                                <option value="3">Pemulihan</option>
                                                                <option value="0">Selesai</option>
                                                            </select>
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
                        <input type="text" class="form-control" id="bencana_id" name="bencana_id" value="{{request()->user()->id}}" hidden required>
                    </div>
                    @endforeach
                    </tbody>
                    </table>
                    <br />
                    {{ $data->links() }}
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

    <script>
        let form = document.getElementById('search');
        form.addEventListener('beforeinput', e => {
            const formdata = new FormData(form);
            let search = formdata.get('search');

            if (url === "") {
                result;
            } else {
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        let i;
                        let result = "";
                        if (data.length === 0) {
                            result += 'Data kosong'
                        }
                        for (i = 0; i < data.length; i++) {
                            let bencana = data[i]
                            result +=
                                `<tr>
                                   <td>${i+1}</td>
                                    <td>${bencana.namaBencana }</td>
                                    <td>${bencana.time}</td>
                                    <td>${bencana.alamat}</td>
                                    <td>${bencana.jmlPosko} tempat</br>
                                        <a href="{{url('/listPosko')}}/${bencana.idBencana}"
                                            class="btn btn-primary btn-xs" title="Lihat posko"><i
                                                class="fas fa-eye"></i> Posko </a>
                                    </td>
                                    <td>${bencana.ttlPengungsi }</td>
                                    <td>${bencana.waktuUpdate }</td>
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
                                                data-target="#modal-edit-${bencana.idBencana}">
                                                <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                                                </svg>
                                                Edit
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item " title="Hapus Pengungsi"
                                                onclick="deleteConfirmation(${bencana.idBencana})">
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

                    }).catch((err) => console.log(err))
            }
        });
    </script>

    <script>
        let form2 = document.getElementById('searchForTrc');
        form2.addEventListener('beforeinput', e => {
            const formdata = new FormData(form2);
            let search = formdata.get('searchForTrc');
            let url2 = document.getElementById('bencana_id').value;
            let url = "{{url('/search/bencanaTrc')}}/"+url2+"?search="+search

            // let data = url;
            // alert(data);

            if (url === "") {
                result;
            } else {
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        let i;
                        let result = "";
                        if (data.length === 0) {
                            result += 'Data tidak ditemukan'
                        }
                        for (i = 0; i < data.length; i++) {
                            let bencana = data[i]
                            result +=
                                `<tr>
                                    <td>${i+1}</td>
                                    <td>${bencana.namaBencana }</td>
                                    <td>${bencana.waktu}</td>
                                    <td>${bencana.lokasi}</td>
                                    <!-- <td>{{ $bencana->posko }}</td> -->
                                    <td>${bencana.ttlPosko} tempat</br>
                                        <a href="{{url('/listPosko')}}/${bencana.idBencana}"
                                            class="btn btn-primary btn-xs" title="Lihat posko"><i
                                                class="fas fa-eye"></i> Posko </a>
                                    </td>
                                    <td>${bencana.waktuUpdate }</td>
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

                                        <!-- /.modal-dialog -->
                                    </div>

                                </td>

                </tr>`;
                        }
                        document.getElementById('result').innerHTML = result;

                    }).catch((err) => console.log(err))
            }
        });
    </script>

</section>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>


@endsection()