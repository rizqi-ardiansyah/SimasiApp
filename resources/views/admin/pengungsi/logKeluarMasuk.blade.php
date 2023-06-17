<!-- Main Content -->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pengungsi Masuk</h3>
                        <div class="card-tools">
                            <form id="searchPengMasuk">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="searchPengMasuk" class="form-control float-right"
                                        placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
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
                        <br />
                        {{ $data->links() }}
                        <br />
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pengungsi Keluar</h3>
                        <div class="card-tools">
                            <form id="searchPengKeluar">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="searchPengKeluar" class="form-control float-right"
                                        placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
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
                        <br />
                        {{ $data->links() }}
                        <br />
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>

<script>
let form2 = document.getElementById('searchPengMasuk');
form2.addEventListener('beforeinput', e => {
    const formdata = new FormData(form2);
    let search = formdata.get('searchPengMasuk');
    let url = "{{ route('searchPengMasuk', "search=")  }}" + search

    if (url === "") {
        result1;
    } else {
        fetch(url)
            .then(response => response.json())
            .then(data => {
                {
                    let i;
                    let result1 = "";
                    if (data.length === 0) {
                        result1 += 'Data tidak ditemukan'
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
                        }
                        let gender = pengungsi.gender
                        if (gender == 0) {
                            gender = "Perempuan";
                        } else if (gender == 1) {
                            gender = "Laki-laki";
                        }
                        result1 +=
                            `<tr>
                                    <td>${i+1}</td>
                                    <td>${pengungsi.nama }</td>
                                    <td>${statKel}</td>
                                    <td>${pengungsi.namaKepala}</td>
                                    <td>${pengungsi.telpon }</td>
                                    <td>${pengungsi.lokasi }</td>
                                    <td>${gender}</td>
                                    <td>${pengungsi.umur }</td>

                           </tr>`;
                    }
                    document.getElementById('result1').innerHTML = result1;

                }
            }).catch((err) => console.log(err))
    }
});
</script>

<script>
let form3 = document.getElementById('searchPengKeluar');
form3.addEventListener('beforeinput', e => {
    const formdata = new FormData(form3);
    let search = formdata.get('searchPengKeluar');
    let url = "{{ route('searchPengKeluar', "search=")  }}" + search

    if (url === "") {
        result2;
    } else {
        fetch(url)
            .then(response => response.json())
            .then(data => {
                {
                    let i;
                    let result2 = "";
                    if (data.length === 0) {
                        result2 += 'Data tidak ditemukan'
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
                        }
                        let gender = pengungsi.gender
                        if (gender == 0) {
                            gender = "Perempuan";
                        } else if (gender == 1) {
                            gender = "Laki-laki";
                        }
                        result2 +=
                            `<tr>
                                    <td>${i+1}</td>
                                    <td>${pengungsi.nama }</td>
                                    <td>${statKel}</td>
                                    <td>${pengungsi.namaKepala}</td>
                                    <td>${pengungsi.telpon }</td>
                                    <td>${pengungsi.lokasi }</td>
                                    <td>${gender}</td>
                                    <td>${pengungsi.umur }</td>

                           </tr>`;
                    }
                    document.getElementById('result2').innerHTML = result2;

                }
            }).catch((err) => console.log(err))
    }
});
</script>