<style>
    td {
        cursor: default;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove"></button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <table id="table-kk" class="table table-bordered table-hover" style="min-width: 100%">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Aksi</th>
                            <th>Nomor KK</th>
                            <th>NIK Kepala KK</th>
                            <th>Nama Kepala KK</th>
                            <th>Jumlah Anggota</th>
                            <th>Dusun</th>
                            <th>RW</th>
                            <th>RT</th>
                        </tr>
                    </thead>
                </table>

                <div class="modal fade" id="modalDaftarAnggotaKeluarga">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Daftar Anggota Keluarga</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                            <table id="table-anggota-keluarga" class="table table-bordered table-hover" style="min-width: 100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Aksi</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Hubungan Keluarga</th>
                                    </tr>
                                </thead>
                            </table>
                            </div>
                            <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                            </div>
                            <div id="modal-loading" class="overlay d-flex justify-content-center align-items-center" style="z-index: -9;">
                                <i class="fas fa-2x fa-sync fa-spin"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function lihatAnggota(nomorKK) {
        document.querySelector('#modal-loading').style.zIndex = 9;
        $('#modalDaftarAnggotaKeluarga').modal('show');
        refreshAnggotaKeluargaTable(nomorKK);
        document.querySelector('#modal-loading').style.zIndex = -9;
    }

    function hapusKK(nomorKK) {
        Swal.fire({
        title: 'Hapus KK?',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Hapus',
        confirmButtonColor: '#d33',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch(`services/keluarga.php?action=delete&nomor_kk=${nomorKK}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(response.statusText)
                }
                return response.json()
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: `Request failed: ${error}`
                })
            })
        },
        allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                if (result.value.code === 0) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Data dihapus'
                    })
                    $('#table-kk').DataTable().ajax.reload();
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Terjadi kesalahan',
                        text: result.value
                    })
                }
            }
        })
    }

    function hapusDariKK(nik) {
        Swal.fire({
            title: 'Hapus dari KK?',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            confirmButtonColor: '#d33',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return fetch(`services/keluarga.php?action=delete&nik=${nik}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: `Request failed: ${error}`
                    })
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    if (result.value.code === 0) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data dihapus'
                        })
                        $('#table-anggota-keluarga').DataTable().ajax.reload();
                        $('#table-kk').DataTable().ajax.reload();
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Terjadi kesalahan',
                            text: result.value
                        })
                    }
                }
            })
    }
</script>

<script>
    function refreshAnggotaKeluargaTable(nomorKK) {
        if ($.fn.DataTable.isDataTable("#table-anggota-keluarga")) {
            $('#table-anggota-keluarga').DataTable().clear().destroy();
        }
        let dt = $('#table-anggota-keluarga').DataTable( {
            "ajax": "services/keluarga.php?action=select&nomor_kk=" + nomorKK,
            "scrollX" : true,
            "columns": [
                {
                    "orderable": false,
                    "defaultContent": ""
                },
                {
                    "orderable": false,
                    "defaultContent": ""
                },
                { "data": "nik" },
                { "data": "nama" },
                { "data": "tanggal_lahir" },
                { "data": "jenis_kelamin" },
                { "data": "hubungan_dalam_keluarga" }
            ]
        });

        dt.on('draw', function () {
            dt.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });

            dt.column(1, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = "<button type='button' class='btn btn-sm btn-danger' onclick='hapusDariKK(\"" + dt.cell(i, 2).data() + "\")'><i class='fas fa-trash'></i></button>";
            });
        });
    }

    function refreshTableKK() {
        let dt = $('#table-kk').DataTable({
            "processing": true,
            "serverSide": true,
            "scrollX" : true,
            "lengthMenu": [10, 20],
            "ajax": "services/DataTables/getKeluarga.php",
            "columns": [{
                "orderable": false,
                "defaultContent": ""
            },
            {
                "orderable": false,
                "defaultContent": ""
            },
            {
                "data": "nomor_kk"
            },
            {
                "data": "nik_kepala_keluarga"
            },
            {
                "data": "nama_kepala_keluarga"
            },
            {
                "data": "jumlah_anggota"
            },
            {
                "data": "dusun"
            },
            {
                "data": "rw"
            },
            {
                "data": "rt"
            }
            ],
            "order": [
                [2, 'asc']
            ]
        });

        dt.on('draw', function () {
            dt.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });

            dt.column(1, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = "<button type='button' data-toggle='modal' class='btn btn-sm btn-primary' onclick='lihatAnggota(\"" + dt.cell(i, 2).data() + "\")' style=\"margin-right: 0.7em\"><i class='fas fa-list'></i></button><button type='button' class='btn btn-sm btn-danger' onclick='hapusKK(\"" + dt.cell(i, 2).data() + "\")'><i class='fas fa-trash'></i></button>";
            });
        });
    };

    $(document).ready(function() {
        refreshTableKK();
    });
</script>