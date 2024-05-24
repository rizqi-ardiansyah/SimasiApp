@extends('admin.mainIndex')
@section('content')

<!-- Main Content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Member</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Member</li>
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
                        <h3 class="card-title">List Tim TRC</h3>

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
                                    <h4 class="modal-title">Tambah TRC</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- form start -->
                                    <form action="{{ route('member.create') }}" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="namaDepan">Nama Tim</label>
                                                <input type="text" class="form-control" id="namaDepan" placeholder="Masukan nama depan" name="namaDepan" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Username</label>
                                                <input type="text" class="form-control" id="email" placeholder="Masukan username" name="email" required>

                                            </div>

                                            <div class="form-group">
                                                <label for="peran">Peran</label>
                                                <input type="text" class="form-control" id="perans" placeholder="pusdalop" name="peran" value=TRC readonly>
                                                <input type="text" class="form-control" id="peran" placeholder="pusdalop" name="peran" value=2 hidden>
                                            </div>

                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" id="button">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>


                    <!-- List data -->
                    <div class="container mt-2">
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
                    <!-- /.card-header -->


                    <div class="card-body table-responsive2 ">
                        @role('pusdalop')
                        <a href="#" class="btn btn-success mb-2" data-toggle="modal" data-target="#modal-default" style="font-size: 14px;">
                            <i class="fas fa-plus mr-1"></i> Tambah Tim
                        </a>
                        @endrole

                        <!-- <div id="search_list"></div> -->

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Peran</th>
                                    <th>Status</th>
                                    @role('pusdalop')
                                    <th>Aksi</th>
                                    @endrole
                                </tr>
                            </thead>
                            <tbody id="result">

                            <?php
                            $no = 0;
                            ?>

                            @foreach ($trcAktif as $key => $member)

                            <tr>
                                <!-- <td>{{$trcAktif->firstItem() + $key  }}</td> -->
                                <?php $no++;?>
                                <td><?php echo $no; ?></td>
                                <td>{{$member->firstname}}</td>
                                <td>{{$member->email}}</td>
                                <td>{{$member->namaPeran}}</td>
                                <td>
                            <div class="btn-group">
                            <button  class="btn btn-primary btn-sm btn-success" data-offset="-52">
                                <i class="fas fa-info mr-1"></i> Aktif
                            </button>
                                <!-- <a href="#" class="btn btn-success mb-2" data-toggle="modal" data-target="#modal-default" style="font-size: 14px;">
                                        <i class="fas fa-plus mr-1"></i> Tambah Tim
                                </a> -->
                            </div>
                    </td>

    @role('pusdalop')
    <td>
        <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                <i class="fas fa-bars"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-lg" role="menu">
                <a href="#" class="dropdown-item " title="Edit Tim" data-toggle="modal" data-target="#modal-edit-{{$member->idAdmin}}">
                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                    </svg>
                    Edit
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item " title="Hapus Pengungsi" onclick="deleteTrcAktif({{$member->idAdmin}})">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </a>
            </div>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm btn-info" data-toggle="modal" data-target="#modal-cekAnggotaAktif-{{$member->idAdmin}}" data-offset="-52">
                <i class="fas fa-info mr-1"></i> Cek Anggota
            </button>
            <!-- <a href="#" class="btn btn-success mb-2" data-toggle="modal" data-target="#modal-default" style="font-size: 14px;">
                    <i class="fas fa-plus mr-1"></i> Tambah Tim
            </a> -->
        </div>
    </td>
    @endrole

</tr>
@endforeach


@foreach ($trcNonAktif as $key => $member)
<tr>
    <!-- <td>{{$trcAktif->firstItem() + $key  }}</td> -->
    <?php $no++;?>
    <td><?php echo $no; ?></td>
    <td>{{$member->firstname}}</td>
    <td>{{$member->email}}</td>
    <td>{{$member->namaPeran}}</td>
    <td>
<div class="btn-group">
            <button  class="btn btn-primary btn-sm btn-danger" data-offset="-52">
                <i class="fas fa-info mr-1"></i> Nonaktif
            </button>
        </div>
</td>

    @role('pusdalop')
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
                <a href="#" class="dropdown-item " title="Edit Tim" data-toggle="modal" data-target="#modal-edit2-{{$member->idAdmin}}">
                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                    </svg>
                    Edit
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item " title="Hapus Pengungsi" onclick="deleteConfirmation({{$member->idAdmin}})">
                    <i class="fas fa-trash mr-1"></i> Hapus
                </a>
            </div>



        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm btn-info" data-toggle="modal" data-target="#modal-cekAnggotaNonaktif-{{$member->idAdmin}}" data-offset="-52">
                <i class="fas fa-info mr-1"></i> Cek Anggota
            </button>
        </div>
    </td>
    @endrole

</tr>
@endforeach


                            </tbody>
                        </table>


                        <br />
                        {{ $trcNonAktif->links() }}
                        <br />

                    </div>

                    <!-- /.card-body -->
                </div>

                @foreach ($trcAktif as $detail)
                <div class="modal fade" id="modal-edit-{{ $detail->idAdmin }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Tim </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- form start -->
                                <form action="{{ url('/member/edit/'.$detail->idAdmin) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="namaDepan">Nama Tim</label>
                                            <input type="text" class="form-control" id="namaTim" placeholder="Masukan nama tim" name="namaTim" value="{{ $detail->firstname }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Username</label>
                                            <input type="text" class="form-control" id="email" placeholder="Masukan username" name="email" value="{{ $detail->email }}" required>
                                        </div>

                                        <div class="form-group">
                                                <label for="peran">Peran</label>
                                                <input type="text" class="form-control" id="perans" placeholder="pusdalop" name="peran" value=TRC readonly>
                                                <input type="text" class="form-control" id="peran" placeholder="pusdalop" name="peran" value=2 hidden>
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

                @foreach ($trcNonAktif as $detail)
                <div class="modal fade" id="modal-edit2-{{ $detail->idAdmin }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Tim </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- form start -->
                                <form action="{{ url('/member/edit/'.$detail->idAdmin) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="namaDepan">Nama Tim</label>
                                            <input type="text" class="form-control" id="namaTim" placeholder="Masukan nama tim" name="namaTim" value="{{ $detail->firstname }}" required>
                                        </div>

                                        <!-- <div class="form-group">
                                            <label for="namaBelakang">Nama belakang</label>
                                            <input type="text" class="form-control" id="namaBelakang" placeholder="Masukan nama belakang" name="namaBelakang" value="{{ $detail->lastname }}" required>
                                        </div> -->

                                        <div class="form-group">
                                            <label for="email">Username</label>
                                            <input type="text" class="form-control" id="email" placeholder="Masukan username" name="email" value="{{ $detail->email }}" required>
                                        </div>

                                        <!-- <div class="form-group">
                                            <label for="position-option">Peran</label>
                                            <select class="form-control" id="peran" name="peran" required>
                                                <option selected value="{{ $detail->idRole }}" hidden>
                                                    {{ $detail->namaPeran }}
                                                </option>
                                                @foreach ($role as $peran)
                                                <option value="{{ $peran->id }}">{{ $peran->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div> -->

                                        <div class="form-group">
                                                <label for="peran">Peran</label>
                                                <input type="text" class="form-control" id="perans" placeholder="pusdalop" name="peran" value=TRC readonly>
                                                <input type="text" class="form-control" id="peran" placeholder="pusdalop" name="peran" value=2 hidden>
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
            </div>

        </div>
    </div>

@foreach ($trcAktif as $members)
    <!-- modal masuk -->
<div class="modal fade" id="modal-cekAnggotaAktif-{{$members->idAdmin}}">
    <?php
$idAdmin = $members->idAdmin;
?>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cek anggota tim {{ $members->firstname }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            @role('pusdalop')
                        <a href="#" class="btn btn-success mb-2" data-toggle="modal" data-target="#modal-tambahAnggotaTrcAktif-{{$members->idAdmin}}" style="font-size: 14px;">
                            <i class="fas fa-plus mr-1"></i> Tambah Anggota
                        </a>
                        @endrole
                <!-- form start -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No Telepon</th>
                                <th>Alamat</th>
                                <th>Peran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="result1">
                            <tr>
                                <?php $i = 0;?>
                                @foreach ($memberTRC as $member)
                                @if($member->tim == $idAdmin)
                                <?php $i++;?>
                                <!-- <td> {{($data->currentPage() - 1) * $data->perPage() + $loop->iteration}}</td> -->
                                <td>{{ $i }}</td>
                                <td>{{ $member->fullName }}</td>
                                <td>{{ $member->email}}</td>
                                <td>{{ $member->nohp}}</td>
                                <td>{{ $member->alamat }}</td>
                                <td>
                                        <?php
$peran = $member->peran;
if ($peran == 1) {
    echo "Koordinator";
} else if ($peran == 2) {
    echo "Anggota";
}
?>
                                </td>
                                @role('pusdalop')
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
                                                <a href="#" class="dropdown-item " title="Edit Anggota" data-toggle="modal" data-target="#modal-editAnggota-{{$member->idMember}}">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item " title="Hapus Pengungsi" onclick="deleteConfirmation({{$member->idMember}})">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </a>
                                            </div>



                                        </div>
                                    </td>
                                    @endrole
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <br />
                {{ $memberTRC->links() }}
                <br />
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endforeach

@foreach ($trcNonAktif as $members)
    <!-- modal masuk -->
<div class="modal fade" id="modal-cekAnggotaNonaktif-{{$members->idAdmin}}">
    <?php
$idAdmin = $members->idAdmin;
?>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cek anggota tim {{ $members->firstname }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            @role('pusdalop')
                        <a href="#" class="btn btn-success mb-2" data-toggle="modal" data-target="#modal-tambahAnggotaTrcNonaktif-{{$members->idAdmin}}" style="font-size: 14px;">
                            <i class="fas fa-plus mr-1"></i> Tambah Anggota
                        </a>
                        @endrole
                <!-- form start -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No Telepon</th>
                                <th>Alamat</th>
                                <th>Peran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="result1">
                            <tr>
                                <?php $i = 0;?>
                                @foreach ($memberTRC as $member)
                                @if($member->tim == $idAdmin)
                                <?php $i++;?>
                                <!-- <td> {{($data->currentPage() - 1) * $data->perPage() + $loop->iteration}}</td> -->
                                <td>{{ $i }}</td>
                                <td>{{ $member->fullName }}</td>
                                <td>{{ $member->email}}</td>
                                <td>{{ $member->nohp}}</td>
                                <td>{{ $member->alamat }}</td>
                                <td>
                                        <?php
$peran = $member->peran;
if ($peran == 1) {
    echo "Koordinator";
} else if ($peran == 2) {
    echo "Anggota";
}
?>
                                </td>
                                @role('pusdalop')
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
                                                <a href="#" class="dropdown-item " title="Edit Anggota" data-toggle="modal" data-target="#modal-editAnggota-{{$member->idMember}}">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item " title="Hapus Pengungsi" onclick="deleteConfirmation({{$member->idMember}})">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </a>
                                            </div>



                                        </div>
                                    </td>
                                    @endrole
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <br />
                {{ $memberTRC->links() }}
                <br />
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endforeach

@foreach ($trcAktif as $members)
<div class="modal fade" id="modal-tambahAnggotaTrcAktif-{{$members->idAdmin}}">
                        <?php
$idAdmin = $members->idAdmin
?>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Anggota</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- form start -->
                                    <form action="{{ route('memberTeam.create') }}" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <input type="text" class="form-control" id="idAdmin" name="idAdmin" value="{{$members->idAdmin}}" hidden required>
                                            <div class="form-group">
                                                <label for="namaDepan">Nama depan</label>
                                                <input type="text" class="form-control" id="firstname" placeholder="Masukan nama depan" name="firstname" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="namaBelakang">Nama belakang</label>
                                                <input type="text" class="form-control" id="lastname" placeholder="Masukan nama belakang" name="lastname">
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" placeholder="Masukan email" name="email"  required>
                                            </div>

                                            <div class="form-group">
                                                <label for="telepon">No Telepon</label>
                                                <input type="number" class="form-control" id="telepon" placeholder="Masukan nomor" name="telepon" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <input type="text" class="form-control" id="alamat" placeholder="Masukan alamat" name="alamat" required>
                                            </div>

                                            <div class="form-group">
                                            <label for="peran">Peran</label>
                                            <select class="form-control" id="peranAnggota" name="peranAnggota" required>
                                                <option selected value=""> Pilih peran
                                                </option>
                                            @foreach ($memberTRC as $member)
                                                @php
                                                    $cek = 0
                                                @endphp
                                                @if($member->peran == 1 && $member->tim == $idAdmin)
                                                @php
                                                    $cek = 1
                                                @endphp
                                                    @break
                                                @endif
                                            @endforeach
                                            @if($cek == 0)
                                                <option value="1">Koordnator</option>
                                                <option value="2">Anggota</option>
                                            @else
                                                 <option value="2">Anggota</option>
                                            @endif
                                            </select>
                                            </div>

                                            <!-- <div class="form-group">
                                                <label for="position-option">Peran</label>
                                                <select class="form-control" id="peran" name="peran" required>
                                                    @foreach ($role as $peran)
                                                    <option value="{{ $peran->id }}">{{ $peran->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div> -->

                                            <!-- <div class="form-group">
                                                <label for="peran">Peran</label>
                                                <input type="text" class="form-control" id="perans" placeholder="pusdalop" name="peran" value=pusdalop readonly>
                                                <input type="text" class="form-control" id="peran" placeholder="pusdalop" name="peran" value=1 hidden>
                                            </div> -->

                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" id="button">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    @endforeach


                    @foreach ($trcNonAktif as $members)
                    <div class="modal fade" id="modal-tambahAnggotaTrcNonaktif-{{$members->idAdmin}}">
                                            <?php
                    $idAdmin = $members->idAdmin
                    ?>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Anggota</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- form start -->
                                    <form action="{{ route('memberTeam.create') }}" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <input type="text" class="form-control" id="idAdmin" name="idAdmin" value="{{$members->idAdmin}}" hidden required>
                                            <div class="form-group">
                                                <label for="namaDepan">Nama depan</label>
                                                <input type="text" class="form-control" id="firstname" placeholder="Masukan nama depan" name="firstname" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="namaBelakang">Nama belakang</label>
                                                <input type="text" class="form-control" id="lastname" placeholder="Masukan nama belakang" name="lastname">
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" placeholder="Masukan email" name="email"  required>
                                            </div>

                                            <div class="form-group">
                                                <label for="telepon">No Telepon</label>
                                                <input type="number" class="form-control" id="telepon" placeholder="Masukan nomor" name="telepon" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <input type="text" class="form-control" id="alamat" placeholder="Masukan alamat" name="alamat" required>
                                            </div>

                                            <div class="form-group">
                                            <label for="peran">Peran</label>
                                            <select class="form-control" id="peranAnggota" name="peranAnggota" required>
                                                <option selected value=""> Pilih peran
                                                </option>
                                            @foreach ($memberTRC as $member)
                                                @php
                                                    $cek = 0
                                                @endphp
                                                @if($member->peran == 1 && $member->tim == $idAdmin)
                                                @php
                                                    $cek = 1
                                                @endphp
                                                    @break
                                                @endif
                                            @endforeach
                                            @if($cek == 0)
                                                <option value="1">Koordinator</option>
                                                <option value="2">Anggota</option>
                                            @else
                                                 <option value="2">Anggota</option>
                                            @endif
                                            </select>
                                            </div>

                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" id="button">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    @endforeach

                @foreach ($memberTRC as $detail)
                <?php
                $noTim = $detail->tim;
                ?>
                <div class="modal fade" id="modal-editAnggota-{{ $detail->idMember }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Anggota</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- form start -->
                                <form action="{{ url('memberTRC/edit/'.$detail->idMember) }}" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <input type="text" class="form-control" id="idAdmin" placeholder="pusdalop" name="idAdmin" value="{{$noTim}}" hidden required>
                                            <!-- <input type="text" class="form-control" id="idAdmin" placeholder="pusdalop" name="idAdmin" value="{{$detail->idMember}}" required> -->
                                            <div class="form-group">
                                                <label for="namaDepan">Nama depan</label>
                                                <input type="text" class="form-control" id="namaDepan" placeholder="Masukan nama depan" name="firstname" value="{{$detail->firstname}}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="namaBelakang">Nama belakang</label>
                                                <input type="text" class="form-control" id="namaBelakang" placeholder="Masukan nama belakang" name="lastname" value="{{$detail->lastname}}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" placeholder="Masukan email" name="email" value="{{$detail->email}}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="telepon">No Telepon</label>
                                                <input type="number" class="form-control" id="telepon" placeholder="Masukan nomor" name="telepon" value="{{$detail->nohp}}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <input type="text" class="form-control" id="alamat" placeholder="Masukan alamat" name="alamat" value="{{$detail->alamat}}" required>
                                            </div>

                                            <div class="form-group">
                                            <label for="peran">Peran</label>
                                            <select class="form-control" id="peranAnggota" name="peranAnggota" required>
                                                <option selected value="{{$detail->peran}}" hidden>
                                                @if($detail->peran == 1) Koordinator
                                                @else Anggota
                                                @endif
                                                </option>
                                            @foreach ($memberTRC as $member)
                                                @php
                                                    $ceks = 0
                                                @endphp
                                                @if($member->peran == 1 && $member->tim == $noTim)
                                                @php
                                                    $ceks = 1
                                                @endphp
                                                    @break
                                                @endif
                                            @endforeach
                                            @if($ceks == 0)
                                                <option value="1">Koordinator</option>
                                                <option value="2">Anggota</option>
                                            @else
                                                 <option value="2">Anggota</option>
                                            @endif
                                            </select>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" id="button">Submit</button>
                                        </div>
                                    </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                @endforeach

<!-- end -->
<script type="text/javascript">
        function deleteTrcAktif(id) {
            swal.fire({
                title: "TRC Aktif tidak bisa dihapus!",
                icon: 'info',
                type: "warning",
                cancelButtonText: "Batal!",
                reverseButtons: !0
            }), function(dismiss) {
                return false;
            }
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
                        url: "{{url('memberTRC/deleteAnggota')}}/" + id,
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
            let url = "{{ route('searchAdmin', "
            search = ") }}" + search

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
                            let user = data[i]
                            result +=
                                `<tr>
                    <td>${i+1}</td>
                                    <td>${user.fullName}</td>
                                    <td>${user.email}</td>
                                    <td>${user.namaPeran}</td>
                                    @role('pusdalop')
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
                                                    data-target="#modal-edit-${user.idAdmin}">
                                                    <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item " title="Hapus Pengungsi"
                                                    onclick="deleteConfirmation(${user.idAdmin})">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </a>
                                            </div>

                                        </div>
                                    </td>
                                    @endrole

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

@endsection()