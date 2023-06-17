@extends('admin.mainIndex')
@section('content')
<!-- Main Content -->

<section class="content mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $ttlRP }}</h3>
                        <p>Total Pusdalop</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-kkeluarga">Tampil
                        Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3 style="color: #ffff;">{{ $ttlRT }}</h3>
                        <p style="color: #ffff;">Total TRC</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-lansia"
                        style="color: #ffff !important;">Tampil Detail <i class="fas fa-arrow-circle-right"
                            style="color: #ffff;"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $ttlBB }}</h3>
                        <p>Total Bencana Berjalan</p>
                    </div>
                    <div class="icon">
                        <svg class="icon-statistik" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M543.8 287.6c17 0 32-14 32-32.1c1-9-3-17-11-24L309.5 7c-6-5-14-7-21-7s-15 1-22 8L10 231.5c-7 7-10 15-10 24c0 18 14 32.1 32 32.1h32V448c0 35.3 28.7 64 64 64H230.4l-31.3-52.2c-4.1-6.8-2.6-15.5 3.5-20.5L288 368l-60.2-82.8c-10.9-15 8.2-33.5 22.8-22l117.9 92.6c8 6.3 8.2 18.4 .4 24.9L288 448l38.4 64H448.5c35.5 0 64.2-28.8 64-64.3l-.7-160.2h32z" />
                        </svg>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-bayi">Tampil Detail <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $ttlBS }}</h3>
                        <p>Total Bencana Selesai</p>
                    </div>
                    <div class="icon">
                        <svg class="icon-statistik" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M543.8 287.6c17 0 32-14 32-32.1c1-9-3-17-11-24L309.5 7c-6-5-14-7-21-7s-15 1-22 8L10 231.5c-7 7-10 15-10 24c0 18 14 32.1 32 32.1h32V448c0 35.3 28.7 64 64 64H230.4l-31.3-52.2c-4.1-6.8-2.6-15.5 3.5-20.5L288 368l-60.2-82.8c-10.9-15 8.2-33.5 22.8-22l117.9 92.6c8 6.3 8.2 18.4 .4 24.9L288 448l38.4 64H448.5c35.5 0 64.2-28.8 64-64.3l-.7-160.2h32z" />
                        </svg>
                    </div>
                    <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-sakit">Tampil Detail <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <!-- AREA CHART -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Grafik Bencana & Pengungsi per Tahun</h3>
                        <br>
                        <!-- sampel logika khusus bencana 2022 tapi -->
                        <?php 
                        //  $j = 0;
                        //  $k = 0;
                        //  $l = 0;
                        //  $m = 0;
                        //  $n = 0;
                        //  $o = 0;
                        //     foreach($ttlP2018 as $i){
                        //         $m++;
                        //         $l = $o;
                        //         $k = $i->idBencana; 

                        //         if($i->idBencana == $k && $m == 1){
                        //         $j = $j + $i->ttlPengungsi;
                                
                        //         }
                        //         else if($i->idBencana == $l){
                        //             $n = $i->ttlPengungsi + $j;//3
                        //             echo $n;
                        //             echo $i->namaBencana;

                        //         }else{
                        //         echo $i->namaBencana;
                        //         echo $i->ttlPengungsi;

                        //         }
                        //         $o = $i->idBencana;
                        //     }
                            
                        ?>
                        <div class="card-tools">
                            <!-- Dropdown -->
                            <select class="form-control" id="thn" name="thn" onchange="showDivs(this)">
                                <option value=2014 selected>2014</option>
                                <option value=2018>2018</option>
                                <option value=2022>2022</option>
                                <!-- <option value=2023>2023</option> -->
                            </select>
                        </div>
                    </div>
                    <!-- end -->

                    <script>
                    $(function() {
                        var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
                        var areaChartData = {
                            // Menyajikan nama bencana
                            labels: [
                                @foreach($ttlP2014 as $i)['{{ $i->namaBencana }}'],
                                @endforeach
                            ], //data bisa angka dan huruf(harus dikasih petik)

                            datasets: [{
                                label: 'Digital Goods',
                                backgroundColor: 'rgba(60,141,188,0.9)',
                                borderColor: 'rgba(60,141,188,0.8)',
                                pointRadius: false,
                                pointColor: '#3b8bba',
                                pointStrokeColor: 'rgba(60,141,188,1)',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(60,141,188,1)',
                                // Menyajikan data jumlah pengungsi
                                data: [
                                    <?php
                                                foreach ($ttlP2014 as $i) 
                                                {
                                                    echo ($i->ttlPengungsi) . ',';
                                            }
                                            ?>
                                ] //data harus angka dan sesuai jumlah label
                            }, ]
                        }

                        var areaChartOptions = {
                            maintainAspectRatio: false,
                            responsive: true,
                            legend: {
                                display: false
                            },
                            scales: {
                                xAxes: [{
                                    gridLines: {
                                        display: false,
                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                        stepSize: 1
                                    },
                                    gridLines: {
                                        display: false,
                                    }
                                }]
                            }
                        }

                        new Chart(areaChartCanvas, {
                            type: 'line',
                            data: areaChartData,
                            options: areaChartOptions
                        })
                    });
                    </script>


                    <!-- form_4 digunakan untuk pendeteksian -->
                    <div class="card-body" id="form_4">
                        <div class="chart">
                            <canvas id="areaChart" style="min-height: 250px; height: 250px;
                             max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>

                    <script type="text/javascript">
                    function showDivs(selects) {
                        console.log(selects);

                        // Jika berada pada tahun 2014
                        if (selects.value == 2014) {
                            // Data akan tampil
                            document.getElementById("form_4").style.display = "block";
                            // Proses chart
                            $(function() {
                                var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
                                var areaChartData = {
                                    // Menyajikan nama bencana
                                    labels: [
                                        @foreach($ttlP2014 as $i)['{{ $i->namaBencana }}'],
                                        @endforeach
                                    ], //data bisa angka dan huruf(harus dikasih petik)

                                    datasets: [{
                                        label: 'Digital Goods',
                                        backgroundColor: 'rgba(60,141,188,0.9)',
                                        borderColor: 'rgba(60,141,188,0.8)',
                                        pointRadius: false,
                                        pointColor: '#3b8bba',
                                        pointStrokeColor: 'rgba(60,141,188,1)',
                                        pointHighlightFill: '#fff',
                                        pointHighlightStroke: 'rgba(60,141,188,1)',
                                        // Menyajikan data jumlah pengungsi
                                        data: [
                                            <?php
                                                foreach ($ttlP2014 as $i) {echo $i->ttlPengungsi . ',';
                                            }
                                            ?>
                                        ] //data harus angka dan sesuai jumlah label
                                    }, ]
                                }

                                var areaChartOptions = {
                                    maintainAspectRatio: false,
                                    responsive: true,
                                    legend: {
                                        display: false
                                    },
                                    scales: {
                                        xAxes: [{
                                            gridLines: {
                                                display: false,
                                            }
                                        }],
                                        yAxes: [{
                                            ticks: {
                                                stepSize: 1
                                            },
                                            gridLines: {
                                                display: false,
                                            }
                                        }]
                                    }
                                }

                                new Chart(areaChartCanvas, {
                                    type: 'line',
                                    data: areaChartData,
                                    options: areaChartOptions
                                })
                            });

                            // Jika pada tahun 2018
                        } else if (selects.value == 2018) {

                            document.getElementById("form_4").style.display = "block";

                            $(function() {
                                var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
                                var areaChartData = {
                                    labels: [
                                        @foreach($ttlP2018 as $i)['{{ $i->namaBencana }}'],
                                        @endforeach
                                    ], //data bisa angka bisa huruf(harus dikasih petik)

                                    datasets: [{
                                        label: 'Digital Goods',
                                        backgroundColor: 'rgba(60,141,188,0.9)',
                                        borderColor: 'rgba(60,141,188,0.8)',
                                        pointRadius: false,
                                        pointColor: '#3b8bba',
                                        pointStrokeColor: 'rgba(60,141,188,1)',
                                        pointHighlightFill: '#fff',
                                        pointHighlightStroke: 'rgba(60,141,188,1)',
                                        data: [
                                            <?php
                                                        foreach ($ttlP2018 as $i) {echo $i->ttlPengungsi . ',';
                                                    }
                                                    ?>

                                        ] //data harus angka dan sesuai jumlah label
                                    }, ]
                                }

                                var areaChartOptions = {
                                    maintainAspectRatio: false,
                                    responsive: true,
                                    legend: {
                                        display: false
                                    },
                                    scales: {
                                        xAxes: [{
                                            gridLines: {
                                                display: false,
                                            }
                                        }],
                                        yAxes: [{
                                            ticks: {
                                                stepSize: 1
                                            },
                                            gridLines: {
                                                display: false,
                                            }
                                        }]
                                    }
                                }

                                new Chart(areaChartCanvas, {
                                    type: 'line',
                                    data: areaChartData,
                                    options: areaChartOptions
                                })
                            });

                            // Jika data di tahun 2022
                        } else if (selects.value == 2022) {

                            document.getElementById("form_4").style.display = "block";

                            $(function() {
                                var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
                                var areaChartData = {
                                    labels: [
                                        @foreach($ttlP2022 as $i)['{{ $i->namaBencana }}'],
                                        @endforeach
                                    ], //data bisa angka bisa huruf(harus dikasih petik)

                                    datasets: [{
                                        label: 'Digital Goods',
                                        backgroundColor: 'rgba(60,141,188,0.9)',
                                        borderColor: 'rgba(60,141,188,0.8)',
                                        pointRadius: false,
                                        pointColor: '#3b8bba',
                                        pointStrokeColor: 'rgba(60,141,188,1)',
                                        pointHighlightFill: '#fff',
                                        pointHighlightStroke: 'rgba(60,141,188,1)',
                                        data: [
                                            <?php
                                                    foreach ($ttlP2022 as $i) {echo $i->ttlPengungsi . ',';
                                                 }
                                                ?>

                                        ] //data harus angka dan sesuai jumlah label
                                    }, ]
                                }

                                var areaChartOptions = {
                                    maintainAspectRatio: false,
                                    responsive: true,
                                    legend: {
                                        display: false
                                    },
                                    scales: {
                                        xAxes: [{
                                            gridLines: {
                                                display: false,
                                            }
                                        }],
                                        yAxes: [{
                                            ticks: {
                                                stepSize: 1
                                            },
                                            gridLines: {
                                                display: false,
                                            }
                                        }]
                                    }
                                }

                                new Chart(areaChartCanvas, {
                                    type: 'line',
                                    data: areaChartData,
                                    options: areaChartOptions
                                })
                            });

                            //tahun 2023
                        } else if (selects.value == 2023) {

                            document.getElementById("form_4").style.display = "block";

                            $(function() {
                                var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
                                var areaChartData = {
                                    labels: [
                                        @foreach($ttlP2023 as $i)['{{ $i->namaBencana }}'],
                                        @endforeach
                                    ], //data bisa angka bisa huruf(harus dikasih petik)

                                    datasets: [{
                                        label: 'Digital Goods',
                                        backgroundColor: 'rgba(60,141,188,0.9)',
                                        borderColor: 'rgba(60,141,188,0.8)',
                                        pointRadius: false,
                                        pointColor: '#3b8bba',
                                        pointStrokeColor: 'rgba(60,141,188,1)',
                                        pointHighlightFill: '#fff',
                                        pointHighlightStroke: 'rgba(60,141,188,1)',
                                        data: [
                                            <?php
                                            foreach ($ttlP2023 as $i) {echo $i->ttlPengungsi . ',';
                                        }
                                        ?>

                                        ] //data harus angka dan sesuai jumlah label
                                    }, ]
                                }

                                var areaChartOptions = {
                                    maintainAspectRatio: false,
                                    responsive: true,
                                    legend: {
                                        display: false
                                    },
                                    scales: {
                                        xAxes: [{
                                            gridLines: {
                                                display: false,
                                            }
                                        }],
                                        yAxes: [{
                                            ticks: {
                                                stepSize: 1
                                            },
                                            gridLines: {
                                                display: false,
                                            }
                                        }]
                                    }
                                }

                                new Chart(areaChartCanvas, {
                                    type: 'line',
                                    data: areaChartData,
                                    options: areaChartOptions
                                })
                            });

                            // Jika data di tahun 2022
                        
                        } else {
                            document.getElementById("form_4").style.display = "none";

                        }
                    }
                    </script>


                    <!-- <script>
                            document.getElementById("form_4").style.display = "none";

                    </script> -->
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
        </div>
    </div>
</section>



</div>



@endsection()