<style>
    td {
        cursor: default;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <nav class="card-title">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist" style="float: left;">
                        <a class="nav-item nav-link active" id="nav-daftar-perangkat-desa-tab" data-toggle="tab" href="#nav-daftar-perangkat-desa" role="tab" aria-controls="nav-home" aria-selected="true">Daftar Perangkat Desa</a>
                        <a class="nav-item nav-link" id="nav-form-perangkat-desa-tab" data-toggle="tab" href="#nav-form-perangkat-desa" role="tab" aria-controls="nav-profile" aria-selected="false">Tambah Perangkat Desa</a>
                    </div>
                </nav>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove"></button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-daftar-perangkat-desa" role="tabpanel" aria-labelledby="nav-home-tab">
                        <button type="button" id="insert-button" class="btn btn-success mb-2"><i class="fas fa-plus-circle"></i> Tambah Data</button>
                        <div>
                            <table id="table-perangkat-desa" class="table table-bordered table-hover" style="min-width: 100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Aksi</th>
                                        <th>NIK</th>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Tanggal Pengangkatan</th>
                                        <th>Masa Jabatan (Tahun)</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-form-perangkat-desa" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <form action="post" id="form-perangkat-desa">
                            <div class="form-group" id="fg-nik">
                                <label>NIK Perangkat Desa</label>
                                <div class="d-flex">
                                    <input type="text" class="form-control" placeholder="NIK Perangkat Desa" name="nik" minlength="16" maxlength="16" required>
                                    <a class="btn btn-default" onclick="cekNIK()" style="flex: 0 0 auto;">Cek NIK</a>
                                </div>
                            </div>
                            <div class="form-group" id="fg-nama">
                                <label>Nama Perangkat Desa</label>
                                <input type="text" class="form-control" value="---" name="nama" disabled>
                            </div>
                            <div class="form-group" id="fg-nip">
                                <label>NIP</label>
                                <input type="text" class="form-control" placeholder="NIP" name="nip" minlength="18" maxlength="18" required>
                            </div>
                            <div class="form-group" id="fg-jabatan">
                                <label>Jabatan</label>
                                <input type="text" class="form-control" placeholder="Jabatan" name="jabatan" required>
                            </div>
                            <div class="form-group" id="fg-tanggal-pengangkatan">
                                <label>Tanggal Pengangkatan</label>
                                <input type="date" class="form-control" name="tanggal_pengangkatan" required>
                            </div>
                            <div class="form-group" id="fg-masa">
                                <label>Masa Jabatan</label>
                                <input type="number" class="form-control" placeholder="0" name="masa_jabatan" required>
                            </div>
                            <div class="form-group" id="fg-status">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="" selected disabled>Pilih Status</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let form = document.forms['form-perangkat-desa'];

    document.getElementById('insert-button').addEventListener('click', function(event) {
        showForm('insert');
    });

    function editPerangkatDesa(nik) {
        showForm('edit', nik);
    }

    function showForm(action, nik = null) {
        let navTabTitle;
        let submitIcon;
        let submitText;

        if(action === 'insert') {

        } else if(action === 'edit') {
             
        }
    }

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        

    });

    form['nik'].addEventListener('keypress', function(event) {
        form['nama'].value = '---';
    });

    function cekNIK() {
        const ajax = new XMLHttpRequest();
        ajax.open('GET', 'services/penduduk.php?action=select&nik=' + form['nik'].value);
        ajax.onload = function() {
            if(ajax.status == 200) {
                try {
                    let response = JSON.parse(ajax.responseText);
                    if(response.code === 0) {
                        form['nama'].value = response.data.nama;
                        toastr.success("Data ditemukan")
                    } else {
                        toastr.error("Data tidak ditemukan")
                        console.log(ajax.responseText);
                    }
                } catch (e) {
                    toastr.error("Terjadi Kesalahan")
                    console.log(ajax.responseText);
                    console.log(e.message);
                }
            } else {
                toastr.error("Kesalahan sambungan ke server")
                console.log(ajax.responseText);
            }
        };
        ajax.send();
    }

    function deletePerangkatDesa(nik) {
        Swal.fire({
            title: 'Hapus Dusun?',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            confirmButtonColor: '#d33',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return fetch(`services/perangkat-desa.php?action=delete&nik=${nik}`)
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
                    $('#table-perangkat-desa').DataTable().ajax.reload();
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
    document.addEventListener('DOMContentLoaded', function(event) {
        let dt = $('#table-perangkat-desa').DataTable({
            "ajax": "services/DataTables/getPerangkatDesa.php",
            "scrollX": true,
            "columns": [{
                    "orderable": false,
                    "defaultContent": ""
                },
                {
                    "className": "text-nowrap",
                    "orderable": false,
                    "defaultContent": ""
                },
                {
                    "data": "nik"
                },
                {
                    "data": "nip"
                },
                {
                    "data": "nama"
                },
                {
                    "data": "jabatan"
                },
                {
                    "data": "tanggal_pengangkatan"
                },
                {
                    "data": "masa_jabatan"
                },
                {
                    "data": "status"
                }
            ]
        });

        dt.on('draw', function() {
            dt.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });

            dt.column(1, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = `
                    <button type='button' data-toggle='modal' class='btn btn-sm btn-warning d-inline-block' onclick='editPerangkatDesa("${dt.cell(i, 2).data()}")' style="margin-right: 0.7em;"><i class='fas fa-edit'></i></button>
                    <button type='button' class='btn btn-sm btn-danger d-inline-block' onclick='deletePerangkatDesa("${dt.cell(i, 2).data()}")'><i class='fas fa-trash'></i></button>
                `;
            });
        });
    });
</script>