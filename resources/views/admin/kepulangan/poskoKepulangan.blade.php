@extends('admin.mainIndex')
@section('content')

<!-- Main Content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
              @foreach ($getNmBencana as $nmBencana)
                <h1>Posko ({{ $nmBencana->namaBencana }})</h1>
                @php
                    $namaBencana = $nmBencana->namaBencana;
                    $jmlPosko = $nmBencana->jmlPosko;
                @endphp
                @break
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
                        <h3 class="card-title">List Posko</h3>
                        <div class="card-tools">
                            @auth('web')
                            <form id="search" action="{{ route('posko.searchPosko') }}" method="GET">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="search" class="form-control float-right" placeholder="Search">
                                    <input type="text" class="form-control" id="idBencana" name="idBencana" value="{{request()->id}}" hidden required>
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
                                    <input type="text" name="searchPoskoTrc" class="form-control float-right" placeholder="Search">
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

                    <!-- Tambah posko -->
                    <div class="modal fade" id="modal-default">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Posko</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <!-- form start -->
                                    <form action="{{ route('posko.create') }}" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <!-- {{ request()->id }} -->
                                            <div class="form-group">
                                                <!-- <label for="exampleInputId">Nama Posko</label> -->
                                                <input type="text" class="form-control" id="idBencana" name="idBencana" value="{{request()->id}}" hidden required>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputNama">Nama Posko</label>
                                                <input type="text" class="form-control" id="exampleInputnama" name="nama" value="{{$namaBencana}}{{$getIdPosko}}" hidden required>
                                                <input type="text" class="form-control" id="exampleInputnama" name="namas" value="{{$namaBencana}} {{$jmlPosko}}" placeholder="Masukan nama posko" readonly>
                                            </div>

                                            @foreach ($getLokasi as $lokasi)
                                            <div class="form-group">
                                                <label for="exampleInputProvinsi">Lokasi bencana</label>
                                                <input type="text" class="form-control" id="exampleInputnama" placeholder="Masukan provinsi" name="lokasi" value="{{$lokasi->lokasi}}" readonly>
                                            </div>
                                            @break
                                            @endforeach

                                            <div class="form-group">
                                                <label for="exampleInputProvinsi">Detail alamat posko</label>
                                                <input type="text" class="form-control" id="exampleInputnama" placeholder="Masukan detail alamat" name="detail_lokasi" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputKap">Kapasitas</label>
                                                <input type="number" class="form-control" id="exampleInputnama" placeholder="Masukan kapasitas" name="kapasitas" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="trc">TRC</label>
                                                <select class="form-control" id="trc_id" name="trc_id" required>
                                                    <option selected value="" hidden>Pilih TRC</option>
                                                    @foreach ($getTrc as $trc)
                                                   ` <option value="{{ $trc->idAdmin }}">{{ $trc->fullName}}</option>
                                                    <!-- <option value="0">Selesai</option> -->
                                                    @endforeach
                                                    <!-- <option value="">Kosongkan TRC</option> -->
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
                        <a href="#" class="btn btn-success mb-2 " data-toggle="modal" data-target="#modal-default" style="font-size: 14px;">
                            <i class="fas fa-plus mr-1"></i> Tambah Posko
                        </a>
                        <!-- <a href="{{url('/memberTRC')}}" class="btn btn-info mb-2 " style="font-size: 14px;">
                            <i class="fas fa-info mr-1"></i> Cek TRC
                        </a> -->
                        @endauth

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Lokasi</th>
                                    <!-- <th>Detail</th> -->
                                    <th>TRC</th>
                                    @auth('web')
                                    <th>Pengungsi</th>
                                    <th>Sisa Kapasitas</th>
                                    <th>Boleh Pulang</th>
                                    @endauth
                                    <!-- <th>Waktu Pelaporan</th>
                                    <th>Waktu Update</th> -->
                                    <th>Rumah Rusak</th>
                                    <!-- <th>Kondisi Sekitar</th> -->
                                    <!-- <th>Waktu Update</th> -->
                            </thead>
                            <tbody id="result">
                                @auth('web')
                                @foreach($data as $key => $posko)
                                <tr>
                                    <td>{{ $data->firstItem() + $key  }}</td>
                                    <input type="text" class="form-control" id="exampleInputnama" name="nama" value="{{$namaBencana}}{{$getIdPosko}}" hidden required>
                                    <td>{{$posko->namaSamaran }}</td>
                                    <td>{{ $posko->lokasi}}</td>
                                    <td>{{ $posko->fullName}}</td>
                                    <td>
                                        {{ $posko->ttlPengungsi}} orang
                                        <a href="{{url('/listPengungsi')}}/<?php echo $posko->idPosko; ?>/<?php echo $posko->bencana_id; ?>/<?php echo $posko->idTrc; ?>" class="btn btn-primary btn-xs" style="font-size: 14px;"><i class="fas fa-eye"></i> Pengungsi </a>
                                    </td>
                                    <td><?php echo $posko->kapasitas - $posko->ttlPengungsi; ?> orang</td>
                                    <td>
                                        {{ $posko->jmlPengungsiPulang}} orang
                                    </td>
                                    <td>
                                        {{ $posko->jumlahRumahRusak }} kondisi
                                        <a href="{{url('/rumahRusak')}}/<?php echo $posko->idPosko; ?>/<?php echo $posko->bencana_id; ?>/<?php echo $posko->idTrc; ?>"class="btn btn-primary btn-xs" title="Lihat rumah rusak" style="font-size: 14px;"><i class="fas fa-eye"></i> Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                                @endauth

                                @auth('karyawan')
                                <?php $i = 0;?>
                                @foreach($data as $key => $posko)
                                <tr>
                                    <td>{{ $data->firstItem() + $key  }}</td>
                                    <input type="text" class="form-control" id="exampleInputnama" name="nama" value="{{$namaBencana}}{{$getIdPosko}}" hidden required>
                                    <td>{{$posko->namaSamaran }}</td>
                                    <td>{{ $posko->lokasi}}</td>
                                    <td>{{ $posko->fullName}}</td>
                                    <!-- <td>
                                        {{ $posko->ttlPengungsi}} orang
                                        <a href="{{url('/listPengungsi')}}/<?php echo $posko->idPosko; ?>/<?php echo $posko->bencana_id; ?>/<?php echo $posko->idTrc; ?>" class="btn btn-primary btn-xs" style="font-size: 14px;"><i class="fas fa-eye"></i> Pengungsi </a>
                                    </td> -->
                                    <!-- <td><?php echo $posko->kapasitas - $posko->ttlPengungsi; ?> orang</td> -->
                                    <!-- <td>
                                        {{ $posko->jmlPengungsiPulang}} orang
                                    </td> -->
                                    <td>
                                        {{ $posko->jumlahRumahRusak }} kondisi <br>
                                        <a href="{{url('/rumahRusak')}}/<?php echo $posko->idPosko; ?>/<?php echo $posko->bencana_id; ?>/<?php echo $posko->idTrc; ?>"class="btn btn-primary btn-xs" title="Lihat rumah rusak" style="font-size: 14px;"><i class="fas fa-eye"></i> Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                                @endauth

                                @auth('admin')
                                <?php $i = 0;?>
                                @foreach($data as $key => $posko)
                                <tr>
                                    @if($posko->idTrc === auth('karyawan')->user()->id)
                                    <?php $i++;?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $posko->namaPosko }}</td>
                                    <td>{{ $posko->lokasi}}</td>
                                    <td>{{ $posko->fullName}}</td>
                                    <td>
                                        {{ $posko->ttlPengungsi}} orang
                                        <!-- @foreach($ttlPengungsi as $ttl)
                                    {{ $ttl->ttlPengungsi}}
                                    @endforeach -->
                                        <a href="{{url('/listPengungsi')}}/<?php echo $posko->idPosko; ?>" class="btn btn-primary btn-xs"><i class="fas fa-eye"></i> Pengungsi </a>
                                    </td>
                                    <td><?php echo $posko->kapasitas - $posko->ttlPengungsi; ?> orang</td>
                                    <td>{{ $posko->created_at}}</td>
                                    <td>{{ $posko->updated_at}}</td>
                                    @endif
                                </tr>
                                @endforeach
                                @endauth

                                @foreach ($data as $detail)
                                <div class="modal fade" id="modal-edit-{{$detail->idPosko}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Ubah Posko</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- form start -->
                                                <form action="{{ url('posko/edit/'.$detail->idPosko) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="exampleInputNama">Nama Posko</label>
                                                            <input type="text" class="form-control" id="exampleInputnama" name="namas" value="{{$namaBencana}} {{$jmlPosko-1}}" placeholder="Masukan nama posko" readonly>
                                                            <input type="text" class="form-control" id="exampleInputnama" name="nama" placeholder="Masukan nama posko" value="{{$detail->namaPosko}}" hidden readonly>
                                                        </div>

                                                        @foreach ($getLokasi as $lokasi)
                                                        <div class="form-group">
                                                            <label for="exampleInputProvinsi">Lokasi bencana</label>
                                                            <input type="text" class="form-control" id="exampleInputnama" placeholder="Masukan lokasi" name="lokasi" value="{{$detail->lokasi}}" readonly>
                                                        </div>
                                                        @break
                                                        @endforeach

                                                        <div class="form-group">
                                                            <label for="exampleInputProvinsi">Detail alamat posko</label>
                                                            <input type="text" class="form-control" id="exampleInputnama" placeholder="Masukan detail alamat" name="detail_lokasi" value="{{$detail->detail}}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="trc">TRC</label>
                                                            <select class="form-control" id="trc_id" name="trc_id" required>
                                                                <option selected value="{{ $detail->idAdmin }}" hidden>
                                                                    {{ $detail->firstname }}
                                                                </option>
                                                                @foreach ($getTrc as $trc)
                                                                <option value="{{$trc->idAdmin}}">{{ $trc->firstname }}
                                                                </option>
                                                                <!-- <option value="0">Selesai</option> -->
                                                                @endforeach
                                                                <!-- s<option value="">Kosongkan TRC</option> -->
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

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

    <script>
        let form = document.getElementById('search');
        form.addEventListener('beforeinput', e => {
            const formdata = new FormData(form);
            let search = formdata.get('search');
            let url = "{{ route('posko.searchPosko', "search = ")   }}" + search

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