@extends('admin.mainIndex')
@section('content')
<!-- Main Content -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @foreach ($getNama as $nm)
                @foreach ($getJmlPosko as $jml)
                @foreach ($getNmTrc as $nmTrc)
                <h3>Pos Pengungsi {{ $nm->nama }} {{$jml->jmlPosko}} ({{ $nmTrc->fullName  }})</h1>
                @endforeach
                @endforeach
                @endforeach
            </div>
            <!-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="/bencana">Bencana</a></li>
                    <li class="breadcrumb-item active"><a href="{{ url()->previous() }}">Posko</a></li>
                    <li class="breadcrumb-item active">Pengungsi</li>
                </ol>
            </div> -->
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $getTtlBalita1 }}</h3>
                        <h4>Balita</h4>
                        <p>Usia 0-11 bulan (900 kkal)</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-baby"></i>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-getTtlBalita1">Tampil
                        Menu <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- modal get Balita 1 -->
<div class="modal fade" id="modal-getTtlBalita1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Saran Menu Makanan untuk <b> {{ $getTtlBalita1 }} 
                </b> Porsi Balita Usia 0-11 bulan (900 kkal)
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead style="text-align:center;">
                            <th>Waktu Makan</th>
                            <th>Menu 1</th>
                            <th>Menu 2</th>
                            <th>Menu 3</th>
                            <th>Menu 4</th>
                            <th>Menu 5</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center;">
                        <tr>
                                <td><b>Setiap Waktu</b></td>
                                <td>ASI</td>
                                <td>ASI</td>
                                <td>ASI</td>
                                <td>ASI</td>
                                <td>ASI</td>
                        </tr>
                        <tr>
                                <td><b>Pagi</b></td>
                                <td>Bubur siap saji rasa pisang</td>
                                <td>Bubur siap saji rasa apel</td>
                                <td>Bubur siap saji rasa jeruk</td>
                                <td>Bubur siap saji rasa pisang</td>
                                <td>Bubur siap saji rasa jeruk</td>
                        </tr>
                        <tr>
                                <td><b>Selingan</b></td>
                                <td>Biskuit bayi</td>
                                <td>Biskuit bayi</td>
                                <td>Biskuit bayi</td>
                                <td>Biskuit bayi</td>
                                <td>Biskuit bayi</td>
                        </tr>
                        <tr>
                                <td><b>Siang</b></td>
                                <td>Bubur sumsum</td>
                                <td>Bubur sumsum</td>
                                <td>Bubur sumsum</td>
                                <td>Bubur sumsum</td>
                                <td>Bubur sumsum</td>
                        </tr>
                        <tr>
                                <td><b>Selingan</b></td>
                                <td>Biskuit bayi</td>
                                <td>Biskuit bayi</td>
                                <td>Biskuit bayi</td>
                                <td>Biskuit bayi</td>
                                <td>Biskuit bayi</td>
                        </tr>
                        <tr>
                                <td><b>Sore</b></td>
                                <td>Bubur siap saji rasa ikan</td>
                                <td>Bubur siap saji rasa ayam</td>
                                <td>Bubur siap saji rasa kacang hijau</td>
                                <td>Bubur siap saji rasa daging sapi</td>
                                <td>Bubur siap saji rasa kacang merah</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3 style="color: #ffff;">{{ $getTtlBalita2 }}</h3>
                        <h4 style="color: #ffff;">Balita</h4>
                        <p style="color: #ffff;">Usia 12-23 bulan (1250 kkal)</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-baby"></i>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-getTtlBalita2"
                        style="color: #ffff !important;">Tampil Detail <i class="fas fa-arrow-circle-right"
                            style="color: #ffff;"></i></a>
                </div>
            </div>
            <!-- ./col -->

            <!-- modal get Balita 2 -->
            <div class="modal fade" id="modal-getTtlBalita2">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Saran Menu Makanan untuk <b> {{ $getTtlBalita2 }} 
                </b> Porsi Balita Usia 12-23 bulan (1250 kkal)
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead style="text-align:center;">
                            <th>Waktu Makan</th>
                            <th>Menu 1</th>
                            <th>Menu 2</th>
                            <th>Menu 3</th>
                            <th>Menu 4</th>
                            <th>Menu 5</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center;">
                        <tr>
                                <td><b>Setiap Waktu</b></td>
                                <td>ASI</td>
                                <td>ASI</td>
                                <td>ASI</td>
                                <td>ASI</td>
                                <td>ASI</td>
                        </tr>
                        <tr>
                                <td><b>Pagi</b></td>
                                <td>Bubur beras, abon</td>
                                <td>Nasi, ikan kaleng saus tomat</td>
                                <td>Mie goreng campur, daging kaleng</td>
                                <td>Nasi goreng, abon</td>
                                <td>Nasi uduk, perkedal daging kaleng</td>
                        </tr>
                        <tr>
                                <td><b>Selingan</b></td>
                                <td>Biskuit</td>
                                <td>Buah kaleng</td>
                                <td>Biskuit</td>
                                <td>Buah kaleng</td>
                                <td>Biskuit</td>
                        </tr>
                        <tr>
                                <td><b>Siang</b></td>
                                <td>Nasi, sup jamur kaleng dan teri</td>
                                <td>Nasi, tumis dendeng manis</td>
                                <td>Nasi, sup daging kaleng</td>
                                <td>Nasi, ikan sarden sambal goreng</td>
                                <td>Nasi tim, teri bumbu tomat</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $getTtlBalita3 }}</h3>
                        <h4>Balita</h4>
                        <p>Usia 24-47 bulan (1300 kkal)</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-baby"></i>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-getTtlBalita3">Tampil Detail <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

      <!-- modal get Balita 1 -->
      <div class="modal fade" id="modal-getTtlBalita3">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Saran Menu Makanan untuk <b> {{ $getTtlBalita3 }} 
                </b> Porsi Balita Usia 24-47 bulan (1300 kkal)
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead style="text-align:center;">
                            <th>Waktu Makan</th>
                            <th>Menu 1</th>
                            <th>Menu 2</th>
                            <th>Menu 3</th>
                            <th>Menu 4</th>
                            <th>Menu 5</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center;">
                        <tr>
                                <td><b>Pagi</b></td>
                                <td>Bubur beras, abon, susu </td>
                                <td>Nasi, ikan kaleng saus tomat, susu</td>
                                <td>Mie goreng campur daging, kaleng, susu</td>
                                <td>Nasi goreng, abon, susu</td>
                                <td>Nasi uduk, perkedel daging kaleng, susu</td>
                        </tr>
                        <tr>
                                <td><b>Selingan</b></td>
                                <td>Biskuit, minuman manis (teh, sirup, jus, dll)</td>
                                <td>Buah kaleng, minuman manis (teh, sirup, jus, dll)</td>
                                <td>Biskuit, minuman manis (teh, sirup, jus, dll)</td>
                                <td>Buah kaleng, minuman manis (teh, sirup, jus, dll)</td>
                                <td>Biskuit, minuman manis (teh, sirup, jus, dll)</td>
                        </tr>
                        <tr>
                                <td><b>Siang</b></td>
                                <td>Nasi, ikan tuna kaleng tumis bawang</td>
                                <td>Nasi, daging kaleng bumbu santan</td>
                                <td>Nasi uduk, abon ikan</td>
                                <td>Nasi, sup jamur kaleng dan teri</td>
                                <td>Nasi, tumis dendeng manis</td>
                        </tr>
                        <tr>
                                <td><b>Selingan</b></td>
                                <td>Buah kaleng, minuman manis (teh, sirup, jus, dll)</td>
                                <td>Biskuit, minuman manis (teh, sirup, jus, dll)</td>
                                <td>Buah kaleng, minuman manis (teh, sirup, jus, dll)</td>
                                <td>Biskuit, minuman manis (teh, sirup, jus, dll)</td>
                                <td>Buah kaleng, minuman manis (teh, sirup, jus, dll)</td>
                        </tr>
                        <tr>
                                <td><b>Sore</b></td>
                                <td>Nasi, sup jamur kaleng dan teri, susu</td>
                                <td>Nasi, tumis dendeng manis, susu</td>
                                <td>Nasi, sup daging kaleng, susu</td>
                                <td>Nasi, ikan sarden sambal goreng, susu</td>
                                <td>Nasi tim, teri bumbu tomat, susu</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $getTtlBalita4 }}</h3>
                        <h4>Balita</h4>
                        <p>Usia 48-59 bulan (1750 kkal)</p>
                    </div>
                    <div class="icon">
                        <!-- <svg class="icon-statistik" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"> -->
                            <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <!-- <path
                                d="M543.8 287.6c17 0 32-14 32-32.1c1-9-3-17-11-24L309.5 7c-6-5-14-7-21-7s-15 1-22 8L10 231.5c-7 7-10 15-10 24c0 18 14 32.1 32 32.1h32V448c0 35.3 28.7 64 64 64H230.4l-31.3-52.2c-4.1-6.8-2.6-15.5 3.5-20.5L288 368l-60.2-82.8c-10.9-15 8.2-33.5 22.8-22l117.9 92.6c8 6.3 8.2 18.4 .4 24.9L288 448l38.4 64H448.5c35.5 0 64.2-28.8 64-64.3l-.7-160.2h32z" />
                        </svg> -->
                        <i class="fas fa-baby"></i>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-getTtlBalita4">Tampil Detail <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- modal get Balita 1 -->
            <div class="modal fade" id="modal-getTtlBalita4">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Saran Menu Makanan untuk <b> {{ $getTtlBalita4 }} 
                </b> Porsi Balita Usia 48-59 bulan (1750 kkal)
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead style="text-align:center;">
                            <th>Waktu Makan</th>
                            <th>Menu 1</th>
                            <th>Menu 2</th>
                            <th>Menu 3</th>
                            <th>Menu 4</th>
                            <th>Menu 5</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center;">
                        <tr>
                                <td><b>Pagi</b></td>
                                <td>Bubur beras, abon, susu </td>
                                <td>Nasi, ikan kaleng saus tomat, susu</td>
                                <td>Mie goreng campur daging, kaleng, susu</td>
                                <td>Nasi goreng, abon, susu</td>
                                <td>Nasi uduk, perkedel daging kaleng, susu</td>
                        </tr>
                        <tr>
                                <td><b>Selingan</b></td>
                                <td>Biskuit, minuman manis (teh, sirup, jus, dll)</td>
                                <td>Buah kaleng, minuman manis (teh, sirup, jus, dll)</td>
                                <td>Biskuit, minuman manis (teh, sirup, jus, dll)</td>
                                <td>Buah kaleng, minuman manis (teh, sirup, jus, dll)</td>
                                <td>Biskuit, minuman manis (teh, sirup, jus, dll)</td>
                        </tr>
                        <tr>
                                <td><b>Siang</b></td>
                                <td>Nasi, ikan tuna kaleng tumis bawang</td>
                                <td>Nasi, daging kaleng bumbu santan</td>
                                <td>Nasi uduk, abon ikan</td>
                                <td>Nasi, sup jamur kaleng dan teri</td>
                                <td>Nasi, tumis dendeng manis</td>
                        </tr>
                        <tr>
                                <td><b>Selingan</b></td>
                                <td>Buah kaleng, minuman manis (teh, sirup, jus, dll)</td>
                                <td>Biskuit, minuman manis (teh, sirup, jus, dll)</td>
                                <td>Buah kaleng, minuman manis (teh, sirup, jus, dll)</td>
                                <td>Biskuit, minuman manis (teh, sirup, jus, dll)</td>
                                <td>Buah kaleng, minuman manis (teh, sirup, jus, dll)</td>
                        </tr>
                        <tr>
                                <td><b>Sore</b></td>
                                <td>Nasi, sup jamur kaleng dan teri, susu</td>
                                <td>Nasi, tumis dendeng manis, susu</td>
                                <td>Nasi, sup daging kaleng, susu</td>
                                <td>Nasi, ikan sarden sambal goreng, susu</td>
                                <td>Nasi tim, teri bumbu tomat, susu</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $getHamil }}</h3>
                        <h4>Ibu hamil & menyusui</h4>
                        <p>2200 kkal</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-child"></i>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-getHamil">Tampil
                        Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

                        <!-- modal get Balita 1 -->
                        <div class="modal fade" id="modal-getHamil">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Saran Menu Makanan untuk <b> {{ $getHamil}} 
                </b> Porsi Ibu Hamil & Menyusui (1750 kkal)
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead style="text-align:center;">
                            <th>Waktu Makan</th>
                            <th>Menu 1</th>
                            <th>Menu 2</th>
                            <th>Menu 3</th>
                            <th>Menu 4</th>
                            <th>Menu 5</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center;">
                        <tr>
                                <td><b>Pagi</b></td>
                                <td>Nasi kuning, abon </td>
                                <td>Nasi, ikan kaleng bumbu tomat</td>
                                <td>Mie kuah tumis daging kaleng</td>
                                <td>Nasi goreng, perkedel kornet</td>
                                <td>Nasi uduk, bakwan ikan kaleng</td>
                        </tr>
                        <tr>
                                <td><b>Selingan</b></td>
                                <td>Bola bola mie daging, teh manis</td>
                                <td>Buah kaleng</td>
                                <td>Biskuit, teh manis</td>
                                <td>Buah kaleng</td>
                                <td>Biskuit, teh manis</td>
                        </tr>
                        <tr>
                                <td><b>Siang</b></td>
                                <td>Nasi, ikan asin pedas (cabekering)</td>
                                <td>Nasi, mie goreng, opor daging kaleng</td>
                                <td>Nasi, ikan bumbu kari</td>
                                <td>Nasi, sup bola daging kaleng</td>
                                <td>Nasi, tumis dendeng manis</td>
                        </tr>
                        <tr>
                                <td><b>Selingan</b></td>
                                <td>Buah kaleng</td>
                                <td>Biskuit, teh manis</td>
                                <td>Buah kaleng </td>
                                <td>Martabak mie, teh manis</td>
                                <td>Buah kaleng</td>
                        </tr>
                        <tr>
                                <td><b>Sore</b></td>
                                <td>Nasi tim, ikan kaleng</td>
                                <td>Nasi gurih, dendeng balado</td>
                                <td>Nasi, mie kuah siram daging kaleng</td>
                                <td>Nasi, ikan teri sambal goreng</td>
                                <td>Nasi fuyunghai, mie ikan sarden, saus tomat</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3 style="color: #ffff;">{{ $getDewasa }}</h3>
                        <h4 style="color: #ffff;">Anak anak - dewasa</h4>
                        <p style="color: #ffff;">Usia 5-59 tahun (2100 kkal)</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-child"></i>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-getDewasa"
                        style="color: #ffff !important;">Tampil Detail <i class="fas fa-arrow-circle-right"
                            style="color: #ffff;"></i></a>
                </div>
            </div>
            <!-- ./col -->

            <!-- modal get Balita 1 -->
            <div class="modal fade" id="modal-getDewasa">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Saran Menu Makanan untuk <b> {{ $getDewasa }} 
                </b> Porsi Anak-anak sampai Dewasa Usia 5-59 tahun (2100 kkal)
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                1. Pemilihan bahan makanan disesuaikan dengan ketersediaan bahan
makanan<br>
2. Keragaman menu makanan dan jadwal pemberian disesuaikan
dengan kemampuan tenaga pelaksana. Daftar Menu Harian ditempel
di tempat yang mudah dilihat oleh pelaksana pengolahan makanan <br>
3. Pemberian makanan/minuman suplemen harus didasarkan pada
anjuran petugas kesehatan yang berwewenang<br>
4. Perhitungan kebutuhan gizi korban bencana disusun dengan
mengacu pada rata-rata Angka Kecukupan Gizi yang dianjurkan <br>
5. Menyediakan paket bantuan pangan (ransum) yang cukup untuk
semua pengungsi dengan standar minimal 2.100 kkal, 50 g protein
dan 40 g lemak per orang per hari. Menu makanan disesuaikan
dengan kebiasaan makan setempat, mudah diangkut, disimpan dan
didistribusikan serta memenuhi kebutuhan vitamin dan mineral

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $getLansia }}</h3>
                        <h4>Lansia</h4>
                        <p>2100 kkal</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-getLansia">Tampil Detail <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->


            <div class="modal fade" id="modal-getLansia">
    <div class="modal-dialog modal-l">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Saran Menu Makanan untuk <b> {{ $getLansia }} 
                </b> Porsi Lansia Usia 60 tahun ke atas
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                Usia lanjut, perlu makanan dalam porsi kecil tetapi padat gizi dan
mudah dicerna. Dalam pemberian makanan pada usia lanjut harus
memperhatikan faktor psikologis dan fisiologis agar makanan yang
disajikan dapat dihabiskan. Dalam kondisi tertentu, kelompok usia
lanjut dapat diberikan bubur atau biskuit
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


        </div>
    </div>
</section>

@endsection()