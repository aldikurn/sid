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
                <h3>5</h3>

                <p>Wilayah Dusun</p>
            </div>
            <div class="icon">
                <i class="fas fa-map nav-icon"></i>
            </div>
            <a href="#" class="small-box-footer" style="color: white !important">More info <i
                        class="fas fa-arrow-circle-right" style="color: white"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>500</h3>

                <p>Penduduk</p>
            </div>
            <div class="icon">
                <i class="fas fa-user nav-icon"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>100</h3>

                <p>Keluarga</p>
            </div>
            <div class="icon">
                <i class="fas fa-users nav-icon"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>15</h3>

                <p>Perangkat Desa</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-tie nav-icon"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                            <span class="info-box-icon bg-danger elevation-1"><i
                                        class="fas fa-head-side-virus nav-icon"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Positif</span>
                                <span class="info-box-number">10</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
            <span class="info-box-icon bg-info elevation-1"><i
                        class="fas fa-head-side-cough-slash nav-icon"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Pasien Dalam Pengawasan</span>
                                <span class="info-box-number">10</span>
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
                            <span class="info-box-icon bg-success elevation-1"><i
                                        class="fas fa-head-side-mask nav-icon"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Orang Dalam Pemantauan</span>
                                <span class="info-box-number">10</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-head-side-cough nav-icon"
                                                                  style="color: white;"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Orang Dalam Resiko</span>
                                <span class="info-box-number">10</span>
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
                <h5 class="card-title">Statistik Perkembangan COVID19 di Indonesia 7 Hari Terakhir</h5>

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
                        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
                        <script src="https://code.highcharts.com/highcharts.js"></script>
                        <script src="https://code.highcharts.com/modules/data.js"></script>
                        <script src="https://code.highcharts.com/modules/series-label.js"></script>
                        <script src="https://code.highcharts.com/modules/exporting.js"></script>
                        <script src="https://code.highcharts.com/modules/export-data.js"></script>
                        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

                        <style>
                            .highcharts-figure, .highcharts-data-table table {
                                min-width: 360px;
                                max-width: 1100px;
                                margin: 1em auto;
                            }

                            .highcharts-data-table table {
                                font-family: Verdana, sans-serif;
                                border-collapse: collapse;
                                border: 1px solid #EBEBEB;
                                margin: 10px auto;
                                text-align: center;
                                width: 100%;
                                max-width: 500px;
                            }

                            .highcharts-data-table caption {
                                padding: 1em 0;
                                font-size: 1.2em;
                                color: #555;
                            }

                            .highcharts-data-table th {
                                font-weight: 600;
                                padding: 0.5em;
                            }

                            .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
                                padding: 0.5em;
                            }

                            .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
                                background: #f8f8f8;
                            }

                            .highcharts-data-table tr:hover {
                                background: #f1f7ff;
                            }
                        </style>


                        <!-- Additional files for the Highslide popup effect -->
                        <script src="https://www.highcharts.com/samples/static/highslide-full.min.js"></script>
                        <script src="https://www.highcharts.com/samples/static/highslide.config.js"
                                charset="utf-8"></script>
                        <link rel="stylesheet" type="text/css"
                              href="https://www.highcharts.com/samples/static/highslide.css">
                        <script>
                            Highcharts.chart('container', {

                                chart: {
                                    scrollablePlotArea: {
                                        minWidth: 700
                                    }
                                },

                                data: {
                                    csvURL: 'https://cdn.jsdelivr.net/gh/highcharts/highcharts@v7.0.0/samples/data/analytics.csv',
                                    beforeParse: function (csv) {
                                        return csv.replace(/\n\n/g, '\n');
                                    }
                                },

                                title: {
                                    text: ' '
                                },

                                subtitle: {
                                    text: ' '
                                },

                                xAxis: {
                                    tickInterval: 7 * 24 * 3600 * 1000, // one week
                                    tickWidth: 0,
                                    gridLineWidth: 1,
                                    labels: {
                                        align: 'left',
                                        x: 3,
                                        y: -3
                                    }
                                },

                                yAxis: [{ // left y axis
                                    title: {
                                        text: null
                                    },
                                    labels: {
                                        align: 'left',
                                        x: 3,
                                        y: 16,
                                        format: '{value:.,0f}'
                                    },
                                    showFirstLabel: false
                                }, { // right y axis
                                    linkedTo: 0,
                                    gridLineWidth: 0,
                                    opposite: true,
                                    title: {
                                        text: null
                                    },
                                    labels: {
                                        align: 'right',
                                        x: -3,
                                        y: 16,
                                        format: '{value:.,0f}'
                                    },
                                    showFirstLabel: false
                                }],

                                legend: {
                                    align: 'left',
                                    verticalAlign: 'top',
                                    borderWidth: 0
                                },

                                tooltip: {
                                    shared: true,
                                    crosshairs: true
                                },

                                plotOptions: {
                                    series: {
                                        cursor: 'pointer',
                                        point: {
                                            events: {
                                                click: function (e) {
                                                    hs.htmlExpand(null, {
                                                        pageOrigin: {
                                                            x: e.pageX || e.clientX,
                                                            y: e.pageY || e.clientY
                                                        },
                                                        headingText: this.series.name,
                                                        maincontentText: Highcharts.dateFormat('%A, %b %e, %Y', this.x) + ':<br/> ' +
                                                            this.y + ' sessions',
                                                        width: 200
                                                    });
                                                }
                                            }
                                        },
                                        marker: {
                                            lineWidth: 1
                                        }
                                    }
                                },

                                series: [{
                                    name: 'All sessions',
                                    lineWidth: 4,
                                    marker: {
                                        radius: 4
                                    }
                                }, {
                                    name: 'New users'
                                }]
                            });

                        </script>

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