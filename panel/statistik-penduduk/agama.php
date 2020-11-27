<style>
    .highcharts-figure, .highcharts-data-table table {
        min-width: 320px;
        max-width: 800px;
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


    input[type="number"] {
        min-width: 50px;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Statistik Umur Penduduk</h5>

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
                    <div class="col-md-12" style="overflow: auto">
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
<script src="../dependencies/plugins/highcharts/modules/exporting.js"></script>
<script src="../dependencies/plugins/highcharts/modules/export-data.js"></script>
<script src="../dependencies/plugins/highcharts/modules/accessibility.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function(event) {
        const ajax = new XMLHttpRequest();
        ajax.open('GET', 'services/HighCharts/getStatistikAgama.php');
        ajax.onload = function() {
            if(ajax.status === 200) {
                const response = JSON.parse(ajax.responseText);
                
                Highcharts.chart('container', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Statistik Agama di Desa Sugihwaras'
                    },
                    series: [{
                        name: 'Jumlah',
                        colorByPoint: true,
                        data: response
                    }]
                });
            } else {
                toastr.error('Gagal mendapatkan data');
            }
        }
        ajax.send();
    });
</script>