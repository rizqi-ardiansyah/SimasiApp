<!DOCTYPE html>
<html>

<head>
    <style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }
    </style>
</head>

<body>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- ./col -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header laporan-title">
                            @foreach ($data as $key => $bencana)
                            @if($key < 1) <h3>

                                <center>{{$bencana->namaBencana}}</center>

                                </h3>

                                <center> {{ Carbon\Carbon::parse($bencana->tgl)->format('d/m/Y') }},
                                    {{$bencana->lokasi}}</center>
                                <br><br>
                                <b>Jenis bencana</B> : {{$bencana->namaBencana}}<br>
                                <b>Waktu</b> : {{ Carbon\Carbon::parse($bencana->tgl)->format('d/m/Y') }},
                                {{$bencana->time}}<br>
                                <b>Lokasi</b> : {{$bencana->lokasi}}</br>

                                <br>
                                <b>Total posko : {{ $bencana->ttlPosko }}</b><br>
                                @endif
                                @endforeach
                                @foreach ($data as $key => $bencana)
                                @if($key < 1) <b>{{$key+=1}}. {{$bencana->namaPosko}}</b> : {{ $jmlPeng }} orang
                                    ({{ $ttlBalita }} balita, {{ $ttlDewasa }} dewasa, {{ $ttlLansia }} lansia,
                                    {{ $ttlDifabel }} difabel)</br>
                                    @endif
                                    @endforeach

                        </div>
                        <!-- /.card-header -->

                    </div>
                </div>
            </div>
        </div>

    </section>

    <h4>
        <center>Data Pengungsi<center>
    </h4>
    <table id="customers" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>StatKel</th>
                <th>KepKel</th>
                <th>No Telepon</th>
                <th>Alamat</th>
                <th>JK</th>
                <th>Umur</th>
                <th>Kond</th>
                <!-- <th>Status</th>
                <th>Aksi</th> -->
            </tr>
            <?php
$no = 1;
?>
        </thead>
        <tbody id="result">
            @foreach ($data as $pengungsi)
            <tr>
                <td>{{$no++}}</td>
                </td>
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
    echo "P";
} else if ($gender == 1) {
    echo "L";
}
?>
                </td>
                <td>{{ $pengungsi->umur }}</td>
                <td>
                    <?php
$kondisi = $pengungsi->statKon;
if ($kondisi == 0) {
    echo "S";
} else if ($kondisi == 1) {
    echo "LR";
} else if ($kondisi == 2) {
    echo "LS";
} else if ($kondisi == 3) {
    echo "LB";
} else if ($kondisi == 4) {
    echo "D";
}
?>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>