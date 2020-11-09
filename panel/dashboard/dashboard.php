<?php
include_once('services/dashboard.php');
?>
<style>
    .info-box-text {
        font-size: 0.8em;
    }
</style>

<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner" style="color: white">
                <h3><?= $info_desa['dusun'] ?></h3>

                <p>Wilayah Dusun</p>
            </div>
            <div class="icon">
                <i class="fas fa-map nav-icon"></i>
            </div>
            <a href="#" onclick="document.forms['vm-daftar-dusun'].submit()" class="small-box-footer" style="color: white !important">
                More info 
                <i class="fas fa-arrow-circle-right"></i>
                <form action="" method="POST" id="vm-daftar-dusun" style="display: none">
                    <input type="text" name="path" value="administrasi-desa/dusun.php">
                </form>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $info_desa['penduduk'] ?></h3>
                <p>Penduduk</p>
            </div>
            <div class="icon">
                <i class="fas fa-user nav-icon"></i>
            </div>
            <a href="#" onclick="document.forms['vm-daftar-penduduk'].submit()" class="small-box-footer">
                More info 
                <i class="fas fa-arrow-circle-right"></i>
                <form action="" method="POST" id="vm-daftar-penduduk" style="display: none">
                    <input type="text" name="path" value="kependudukan/daftar-penduduk.php">
                </form>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $info_desa['keluarga'] ?></h3>
                <p>Keluarga</p>
            </div>
            <div class="icon">
                <i class="fas fa-users nav-icon"></i>
            </div>
            <a href="#" onclick="document.forms['vm-daftar-keluarga'].submit()" class="small-box-footer">
                More info 
                <i class="fas fa-arrow-circle-right"></i>
                <form action="" method="POST" id="vm-daftar-keluarga" style="display: none">
                    <input type="text" name="path" value="kependudukan/daftar-keluarga.php">
                </form>
            </a>
        </div>
    </div>
    <!-- ./col -->

    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $info_desa['perangkat_desa'] ?></h3>
                <p>Perangkat Desa</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-tie nav-icon"></i>
            </div>
            <a href="#" onclick="document.forms['vm-perangkat-desa'].submit()" class="small-box-footer">
                More info 
                <i class="fas fa-arrow-circle-right"></i>
                <form action="" method="POST" id="vm-perangkat-desa" style="display: none">
                    <input type="text" name="path" value="administrasi-desa/perangkat-desa.php">
                </form>
            </a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Status COVID19 di Desa Sugihwaras</h5>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger elevation-1">
                                <i class="fas fa-head-side-virus nav-icon"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">Positif</span>
                                <span class="info-box-number"><?= $covid19_desa['positif'] ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-info elevation-1">
                                <i class="fas fa-head-side-cough-slash nav-icon"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">Pasien Dalam Pengawasan</span>
                                <span class="info-box-number"><?= $covid19_desa['pdp'] ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1">
                                <i class="fas fa-head-side-mask nav-icon"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Orang Dalam Pemantauan</span>
                                <span class="info-box-number"><?= $covid19_desa['odp'] ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1">
                                <i class="fas fa-head-side-cough nav-icon" style="color: white;"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">Orang Dalam Resiko</span>
                                <span class="info-box-number"><?= $covid19_desa['odr'] ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- ./card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Statistik Perkembangan COVID19 di Indonesia 30 Hari Terakhir</h5>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <figure class="highcharts-figure">
                            <div id="container"></div>
                        </figure>
                        <!-- /.chart-responsive -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- ./card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>

<script src="../dependencies/plugins/highcharts/jquery-3.1.1.min.js"></script>
<script src="../dependencies/plugins/highcharts/highcharts.js"></script>
<script src="../dependencies/plugins/highcharts/modules/data.js"></script>


<script>
    Highcharts.chart('container', {

        data: {
            csvURL: '<?= $index_location; ?>/services/HighCharts/getStatistikCovid19Indonesia.php',
            beforeParse: function (csv) {
                return csv.replace(/\n\n/g, '\n');
            }
        },

        title: {
            text: ' '
        },
        subtitle: {
            text: 'Sumber : data.covid19.go.id '
        },

        yAxis: {
            title: {
                text: 'Jumlah'
            }
        },

        legend: {
            align: 'center',
            verticalAlign: 'bottom',
            borderWidth: 0
        },

        tooltip: {
            shared: true,
            crosshairs: true
        },

        chart: {
            scrollablePlotArea: {
                minWidth: 700
            }
        }
    });

</script>