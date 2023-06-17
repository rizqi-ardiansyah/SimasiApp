@extends('admin.mainIndex')
@section('content')


<!-- Main Content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @foreach ($getNama as $nm)
                @foreach ($getNmTrc as $nmTrc)
                <h1>Pos Pengungsi {{ $nm->nama }} ({{ $nmTrc->fullName }})</h1>
                @endforeach
                @endforeach
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="/bencana">Bencana</a></li>
                    <li class="breadcrumb-item active"><a href="{{ url()->previous() }}">Posko</a></li>
                    <li class="breadcrumb-item active">Pengungsi</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

@include('admin.pengungsi.statistikPengungsi')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Pengungsi</h3>
                        <div class="card-tools">
                            <form id="search">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade" id="modal-default">
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
                                            <input type="text" class="form-control" id="posko_id" name="posko_id" value="{{request()->id}}" hidden required>
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
                                                <select class="form-control" id="statKel" name="statKel" onchange="showDivs(this)">
                                                    <option value=0>Kepala Keluarga</option>
                                                    <option value=1>Ibu</option>
                                                    <option value=2 selected>Anak</option>
                                                    <option value=3 selected>Lainnya</option>
                                                </select>
                                            </div>
                                            <!-- script form status keluarga -->
                                            <script type="text/javascript">
                                                // var idForm_1 = document.getElementById('form_1');
                                                // var idForm_2 = document.getElementById('form_2');

                                                function showDivs(selects) {
                                                    console.log(selects);
                                                    if (selects.value == 0) {
                                                        document.getElementById("form_1").style.display = "none";
                                                        document.getElementById("form_2").style.display = "block";
                                                        // idForm_1.style.display = "block";
                                                        // idForm_2.style.display = "none";
                                                    } else if (selects.value == 1 || selects.value == 2) {
                                                        document.getElementById("form_1").style.display = "block";
                                                        document.getElementById("form_2").style.display = "none";
                                                    }
                                                }
                                            </script>
                                            <!-- end -->

                                            <!-- jika pengungsi kepala keluarga sudah ditambahkan -->
                                            <div class="form-group" id="form_1">
                                                <label for="kpl">Kepala Keluarga</label>
                                                <select class="form-control" id="kpl" name="kpl" required>
                                                    @foreach ($kpl as $kplk)
                                                    <option value="{{$kplk->id}}">{{$kplk->nama}} (Kec.
                                                        {{$kplk->kecamatan}}, Kel. {{$kplk->kelurahan}},
                                                        {{ $kplk->detail }})
                                                    </option>
                                                    @endforeach
                                                    <!-- <option value="">Kosongkan dahulu</option> -->
                                                </select>
                                            </div>

                                            <!-- jika belum perlu menambahkan alamat -->
                                            <div class="wrapper-kk" class="hidden" id="form_2" style="display:none;">
                                                <div class="form-group">
                                                    <label for="provinsi">Provinsi</label>
                                                    <input type="text" class="form-control" id="provinsi" placeholder="Masukan provinsi" name="provinsi">
                                                </div>

                                                <div class="form-group">
                                                    <label for="kota">Kota</label>
                                                    <input type="text" class="form-control" id="kota" placeholder="Masukan kota" name="kota">
                                                </div>

                                                <div class="form-group">
                                                    <label for="kecamatan">Kecamatan</label>
                                                    <input type="text" class="form-control" id="kecamatan" placeholder="Masukan kecamatan" name="kecamatan">
                                                </div>

                                                <div class="form-group">
                                                    <label for="kelurahan">Kelurahan</label>
                                                    <input type="text" class="form-control" id="kelurahan" placeholder="Masukan kelurahan" name="kelurahan">
                                                </div>

                                                <div class="form-group">
                                                    <label for="detail">Detail</label>
                                                    <input type="text" class="form-control" id="detail" placeholder="Masukan detail" name="detail">
                                                </div>
                                            </div>

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
                                                    <option value=4>Difabel</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="statPos">Status</label>
                                                <select class="form-control" id="statPos" name="statPos" required>
                                                    <option value=1>Di Posko</option>
                                                    <option value=0>Keluar</option>
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
                        <a href="#" class="btn btn-success mb-2 " data-toggle="modal" data-target="#modal-default" style="font-size: 14px;">
                            <i class="fas fa-plus mr-1"></i> Tambah Pengungsi
                        </a>

                        <table id="example2" class="table table-bordered table-hover">
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
                                    <th>Kondisi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="result">
                                <tr>
                                    @foreach ($data as $key => $pengungsi)
                                    <td>{{ $data->firstItem() + $key  }}</td>
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
                                        } else if ($statKel == 3) {
                                            echo "Lainnya";
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
                                    <td>
                                        <?php
                                        $kondisi = $pengungsi->statKon;
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
                                        $statPos = $pengungsi->statPos;
                                        if ($statPos == 0) {
                                            echo "<span class='badge badge-danger'>Keluar</span>";
                                        } else if ($statPos == 1) {
                                            echo "<span class='badge badge-success'>Di Posko</span>";
                                        }
                                        ?>
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
                                                <a href="#" class="dropdown-item " title="Edit Pengungsi" data-toggle="modal" data-target="#modal-edit-{{$pengungsi->idPengungsi}}">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item " title="Hapus Pengungsi" onclick="deleteConfirmation({{$pengungsi->idPengungsi}})">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </a>
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- <a href="#" class="btn btn-danger btn-sm" title="Hapus Pengungsi">
                                            Hapus
                                        </a> -->
                                    </td>

                                    <div class="modal fade" id="modal-edit-{{$pengungsi->idPengungsi}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Posko</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- form start -->
                                                    <form action="{{ url('pengungsi/edit/'.$pengungsi->idPengungsi) }}" method="POST">
                                                        @csrf
                                                        <div class="card-body">
                                                            <!-- <div class="form-group"> -->
                                                            <input type="text" class="form-control" id="posko_id" name="posko_id" value="{{request()->id}}" hidden required>
                                                            <!-- </div> -->

                                                            <div class="form-group">
                                                                <label for="nama">Nama Pengungsi</label>
                                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama pengungsi" value="{{$pengungsi->nama}}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="telpon">Nomor HP</label>
                                                                <input type="text" class="form-control" id="telpon" name="telpon" placeholder="Masukan nomor telepon" value="{{$pengungsi->telpon}}" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="sKeluarga">Status Keluarga</label>
                                                                <select class="form-control" id="statKel" name="statKel" onchange="showDiv(this)">
                                                                    <?php
                                                                    $getStatKel = $pengungsi->statKel;
                                                                    if ($getStatKel == 0) {
                                                                        $status = "Kepala Keluarga";
                                                                    } else if ($getStatKel == 1) {
                                                                        $status = "Ibu";
                                                                    } else if ($getStatKel == 2) {
                                                                        $status = "Anak";
                                                                    } else if ($getStatKel == 3) {
                                                                        $status = "Lainnya";
                                                                    }

                                                                    ?>
                                                                    <option selected value="{{ $pengungsi->statKel }}" hidden><?php echo $status; ?></option>
                                                                    <option value=0>Kepala Keluarga</option>
                                                                    <option value=1>Ibu</option>
                                                                    <option value=2>Anak</option>
                                                                    <option value=3>Lainnya</option>
                                                                </select>
                                                            </div>
                                                            <!-- script form status keluarga -->
                                                            <script type="text/javascript">
                                                                // var idForm_1 = document.getElementById('form_1');
                                                                // var idForm_2 = document.getElementById('form_2');

                                                                function showDiv(select) {
                                                                    console.log(select);
                                                                    if (select.value == 0) {
                                                                        document.getElementById("form_3").style.display =
                                                                            "none";
                                                                        document.getElementById("form_4").style.display =
                                                                            "block";
                                                                        // idForm_1.style.display = "block";
                                                                        // idForm_2.style.display = "none";
                                                                    } else if (select.value == 1 || select.value == 2) {
                                                                        document.getElementById("form_3").style.display =
                                                                            "block";
                                                                        document.getElementById("form_4").style.display =
                                                                            "none";
                                                                    }
                                                                }
                                                            </script>
                                                            <!-- end -->

                                                            <!-- jika pengungsi kepala keluarga sudah ditambahkan -->
                                                            <div class="form-group" id="form_3">
                                                                <label for="kpl">Kepala Keluarga</label>
                                                                <select class="form-control" id="kpl" name="kpl" required>
                                                                    <option selected value="{{$pengungsi->idKepala}}" hidden>{{$pengungsi->namaKepala}}
                                                                        {{ $pengungsi->lokKel}}
                                                                    </option>
                                                                    @foreach ($kpl as $kplk)
                                                                    <option value="{{$kplk->id}}">{{$kplk->nama}} (Kec.
                                                                        {{$kplk->kecamatan}}, Kel. {{$kplk->kelurahan}},
                                                                        {{$kplk->detail}})
                                                                    </option>
                                                                    @endforeach
                                                                    <!-- <option value="">Kosongkan dahulu</option> -->
                                                                </select>
                                                            </div>

                                                            <!-- jika belum perlu menambahkan alamat -->
                                                            <div class="wrapper-kk" class="hidden" id="form_4" style="display:none;">
                                                                <div class="form-group">
                                                                    <label for="provinsi">Provinsi</label>
                                                                    <input type="text" class="form-control" id="provinsi" placeholder="Masukan provinsi" name="provinsi" value="{{$pengungsi->provinsi}}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="kota">Kota</label>
                                                                    <input type="text" class="form-control" id="kota" placeholder="Masukan kota" name="kota" value="{{$pengungsi->kota}}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="kecamatan">Kecamatan</label>
                                                                    <input type="text" class="form-control" id="kecamatan" placeholder="Masukan kecamatan" name="kecamatan" value="{{$pengungsi->kecamatan}}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="kelurahan">Kelurahan</label>
                                                                    <input type="text" class="form-control" id="kelurahan" placeholder="Masukan kelurahan" name="kelurahan" value="{{$pengungsi->kelurahan}}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="detail">Detail</label>
                                                                    <input type="text" class="form-control" id="detail" placeholder="Masukan detail" name="detail" value="{{$pengungsi->detail}}">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="gender">Jenis Kelamin</label>
                                                                <select class="form-control" id="gender" name="gender" required>
                                                                    <?php
                                                                    $getGender = $pengungsi->gender;
                                                                    if ($getGender == 0) {
                                                                        $statGen = "Perempuan";
                                                                    } else if ($getGender == 1) {
                                                                        $statGen = "Laki-laki";
                                                                    }
                                                                    ?>
                                                                    <option selected value="{{$pengungsi->gender}}" hidden><?php echo $statGen; ?></option>
                                                                    <option value=1>Laki - Laki</option>
                                                                    <option value=0>Perempuan</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="umur">Umur</label>
                                                                <input type="text" class="form-control" id="umur" name="umur" placeholder="Masukan umur" value="{{$pengungsi->umur}}" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="statKon">Kondisi</label>
                                                                <select class="form-control" id="statKon" name="statKon" required>
                                                                    <?php
                                                                    $getKon = $pengungsi->statKon;
                                                                    if ($getKon == 0) {
                                                                        $statKon = "Sehat";
                                                                    } else if ($getKon == 1) {
                                                                        $statKon = "Luka Ringan";
                                                                    } else if ($getKon == 2) {
                                                                        $statKon = "Luka Sedang";
                                                                    } else if ($getKon == 3) {
                                                                        $statKon = "Luka Berat";
                                                                    } else if ($getKon == 4) {
                                                                        $statKon = "Difabel";
                                                                    }
                                                                    ?>
                                                                    <option selected value="{{$pengungsi->statKon}}" hidden><?php echo $statKon; ?></option>
                                                                    <option value=0>Sehat</option>
                                                                    <option value=1>Luka Ringan</option>
                                                                    <option value=2>Luka Sedang</option>
                                                                    <option value=3>Luka Berat</option>
                                                                    <option value=4>Difabel</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="statPos">Status</label>
                                                                <select class="form-control" id="statPos" name="statPos" required>
                                                                    <?php
                                                                    $getPos = $pengungsi->statPos;
                                                                    if ($getPos == 0) {
                                                                        $statPos = "Keluar";
                                                                    } else if ($getPos == 1) {
                                                                        $statPos = "Di Posko";
                                                                    }
                                                                    ?>
                                                                    <option selected value="{{$pengungsi->statPos}}" hidden><?php echo $statPos; ?></option>
                                                                    <option value=1>Di Posko</option>
                                                                    <option value=0>Keluar</option>
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
                                    </td>
                                </tr>
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
                        url: "{{url('pengungsi/delete')}}/" + id,
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
            let url = "{{ route('searchPengungsi', "
            search = ")  }}" + search

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
                                let pengungsi = data[i]
                                let statKel = pengungsi.statKel
                                if (statKel == 0) {
                                    statKel = 'Kepala Keluarga';
                                } else if (statKel == 1) {
                                    statKel = 'Ibu';
                                } else if (statKel == 2) {
                                    statKel = 'Anak';
                                } else if (statKel == 3) {
                                    statKel = 'Lainnya';
                                }
                                let gender = pengungsi.gender
                                if (gender == 0) {
                                    gender = "Perempuan";
                                } else if (gender == 1) {
                                    gender = "Laki-laki";
                                }
                                let kondisi = pengungsi.statKon
                                if (kondisi == 0) {
                                    kondisi = "Sehat";
                                } else if (kondisi == 1) {
                                    kondisi = "Luka Ringan";
                                } else if (kondisi == 2) {
                                    kondisi = "Luka Sedang";
                                } else if (kondisi == 3) {
                                    kondisi = "Luka Berat";
                                } else if (kondisi == 4) {
                                    kondisi = "Difabel";
                                }
                                let statPos = pengungsi.statPos;
                                if (statPos == 0) {
                                    statPos = "<span class='badge badge-danger'>Keluar</span>";
                                } else if (statPos == 1) {
                                    statPos = "<span class='badge badge-success'>Di Posko</span>";
                                }

                                result +=
                                    `<tr>
                                    <td>${i+1}</td>
                                    <td>${pengungsi.nama }</td>
                                    <td>${statKel}</td>
                                    <td>${pengungsi.namaKepala}</td>
                                    <td>${pengungsi.telpon }</td>
                                    <td>${pengungsi.lokasi }</td>
                                    <td>${gender}</td>
                                    <td>${pengungsi.umur }</td>
                                    <td>${kondisi}</td>
                                    <td>${statPos}</td>
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
                                                <a href="#" class="dropdown-item " title="Edit Pengungsi"
                                                    data-toggle="modal"
                                                    data-target="#modal-edit-${pengungsi.idPengungsi}">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item " title="Hapus Pengungsi"
                                                    onclick="deleteConfirmation(${pengungsi.idPengungsi})">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </a>
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- <a href="#" class="btn btn-danger btn-sm" title="Hapus Pengungsi">
                                            Hapus
                                        </a> -->
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