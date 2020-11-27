<style>
    .table-content {
        margin-top: 1rem;
    }

    #dusun-form {
        display: grid;
        gap: 0.25em;
        grid-template-areas:none
            ''
        ;
    }

    td {
        cursor: default;
    }
</style>

<!-- Dusun -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Dusun</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove"></button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <button class="btn btn-success" onclick="tambahDusun()">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Dusun
                </button>
                <div class="table-content">
                    <table id="table-dusun" class="table table-bordered table-hover" style="min-width: 100%">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>Nama Dusun</th>
                                <th>NIK Kepala Dusun</th>
                                <th>Nama Kepala Dusun</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal fade" id="dusun-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="dusun-modal-title"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="dusun-form" method="post">
                                    <div class="form-group" id="fg-nama-dusun">
                                        <label>Nama Dusun</label>
                                        <input type="text" class="form-control" placeholder="Nama Dusun" name="nama_dusun" required>
                                    </div>
                                    <div class="form-group" id="fg-nik-kepala-dusun">
                                        <label>NIK Kepala Dusun</label>
                                        <div class="d-flex">
                                            <input type="text" class="form-control" placeholder="NIK Kepala Dusun" name="nik_kepala_dusun" minlength="16" maxlength="16" required>
                                            <a class="btn btn-default" onclick="cekNIKDusun()" style="flex: 0 0 auto;">Cek NIK</a>
                                        </div>
                                    </div>
                                    <div class="form-group" id="fg-nik-rw">
                                        <label>Nama Kepala Dusun</label>
                                        <input type="text" class="form-control" value="---" name="nama_kepala_dusun" disabled>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success" id="dusun-modal-submit" onclick="processDusun()"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<script>
    const dusunForm = document.forms['dusun-form'];

    dusunForm['nik_kepala_dusun'].addEventListener('keypress', function(event) {
        dusunForm['nama_kepala_dusun'].value = '---';
    });

    function cekNIKDusun() {
        const ajax = new XMLHttpRequest();
        ajax.open('GET', 'services/penduduk.php?action=select&nik=' + dusunForm['nik_kepala_dusun'].value);
        ajax.onload = function() {
            if(ajax.status == 200) {
                try {
                    let response = JSON.parse(ajax.responseText);
                    if(response.code === 0) {
                        dusunForm['nama_kepala_dusun'].value = response.data.nama;
                        toastr.success("Data ditemukan")
                    } else {
                        toastr.error("Data tidak ditemukan")
                        console.log(ajax.responseText);
                        console.log(e.message);
                    }
                } catch (e) {
                    toastr.error("Terjadi Kesalahan")
                    console.log(ajax.responseText);
                    console.log(e.message);
                }
            } else {
                toastr.error("Kesalahan sambungan ke server")
                console.log(ajax.responseText);
                console.log(e.message);
            }
        };
        ajax.send();
    }

    let dusunModalAction = null;

    function tambahDusun() {
        dusunModalAction = 'insert';
        showDusunModal();
    }

    let namaDusunToEdit = null;
    function editDusun(namaDusun) {
        dusunModalAction = 'update';
        showDusunModal(namaDusun);
    }

    function showDusunModal(namaDusun = null) {
        namaDusunToEdit = namaDusun;
        if(dusunModalAction === 'insert') {
            document.getElementById('dusun-modal-title').textContent = 'Tambah Dusun';
            document.getElementById('dusun-modal-submit').innerHTML  = '<i class="fas fa-plus-circle"></i> Simpan';
        } else if(dusunModalAction === 'update') {
            document.getElementById('dusun-modal-title').textContent = 'Ubah Dusun';
            document.getElementById('dusun-modal-submit').innerHTML  =  '<i class="fas fa-edit"></i> Simpan Perubahan';
            fillDusunForm(namaDusun);
        }
        $('#dusun-modal').modal('show');
    }

    function fillDusunForm(namaDusun) {
        const ajax = new XMLHttpRequest();
        ajax.open('GET', 'services/dusun.php?action=select&nama_dusun=' + namaDusun);
        ajax.onload = function() {
            if(ajax.status === 200) {
                try {
                    const response = JSON.parse(ajax.responseText);
                    if(response.code === 0) {
                        dusunForm['nama_dusun'].value = response.data.nama_dusun;
                        dusunForm['nik_kepala_dusun'].value = response.data.nik_kepala_dusun;
                        dusunForm['nama_kepala_dusun'].value = response.data.nama_kepala_dusun;
                    } else {
                        toastr.error('Terjadi Kesalahan');
                        console.log(ajax.responseText);
                    }
                } catch(e) {
                    toastr.error('Terjadi Kesalahan');
                    console.log(e.message);
                    console.log(ajax.responseText);
                }
            } else {
                toastr.error('Masalah sambungan ke server');
                console.log(ajax.responseText);
            }
        }
        ajax.send();
    }

    function processDusun() {
        const event = new Event('submit');
        document.getElementById('dusun-form').dispatchEvent(event);
    }

    function dusunFormOK() {
        return dusunForm['nama_dusun'].value !== '' &&
            dusunForm['nik_kepala_dusun'].value !== '' &&
            dusunForm['nama_kepala_dusun'].value !== '---';
    }

    document.getElementById('dusun-form').addEventListener('submit', function(event) {
        event.preventDefault();

        if(!dusunFormOK()) {
            toastr.warning('Data tidak lengkap');
            return;
        }

        const ajax = new XMLHttpRequest();
        if(dusunModalAction === 'insert') {
            ajax.open('POST', 'services/dusun.php?action=insert');
        } else if(dusunModalAction === 'update') {
            ajax.open('POST', 'services/dusun.php?action=update&nama_dusun=' + namaDusunToEdit);
        }
        ajax.onload = function() {
            if(ajax.status === 200) {
                try {
                    const response = JSON.parse(ajax.responseText);
                    if(response.code === 0) {
                        $('#dusun-modal').modal('hide');
                        $('#table-dusun').DataTable().ajax.reload();
                        toastr.success(response.message);
                        getDusunListRWForm();
                    } else {
                        toastr.error('Terjadi Kesalahan');
                        console.log(ajax.responseText);
                    }
                } catch(e) {
                    toastr.error('Terjadi Kesalahan');
                    console.log(e.message);
                    console.log(ajax.responseText);
                }
            } else {
                toastr.error('Masalah sambungan ke server');
                console.log(ajax.responseText);
            }
        };
        const formData = new FormData(document.getElementById('dusun-form'));
        ajax.send(formData);
    });

    function deleteDusun(namaDusun) {
        Swal.fire({
        title: 'Hapus Dusun?',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Hapus',
        confirmButtonColor: '#d33',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch(`services/dusun.php?action=delete&nama_dusun=${namaDusun}`)
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
                    $('#table-dusun').DataTable().ajax.reload();
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

    function initDusun() {
        let dt = $('#table-dusun').DataTable({
            "ajax": "services/DataTables/getDusun.php",
            "scrollX" : true,
            "columns": [{
                "orderable": false,
                "defaultContent": ""
            },
            {
                "orderable": false,
                "defaultContent": ""
            },
            {
                "data": "nama_dusun"
            },
            {
                "data": "nik_kepala_dusun"
            },
            {
                "data": "nama_kepala_dusun"
            }
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
                cell.innerHTML = "<button type='button' data-toggle='modal' class='btn btn-sm btn-warning' onclick='editDusun(\"" + dt.cell(i, 2).data() + "\")' style=\"margin-right: 0.7em\"><i class='fas fa-edit'></i></button><button type='button' class='btn btn-sm btn-danger' onclick='deleteDusun(\"" + dt.cell(i, 2).data() + "\")'><i class='fas fa-trash'></i></button>";
            });
        });
    }
</script>

<!-- RW -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar RW</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove"></button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <button class="btn btn-success" onclick="tambahRW()">
                    <i class="fas fa-plus-circle"></i>
                    Tambah RW
                </button>
                <div class="table-content">
                    <table id="table-rw" class="table table-bordered table-hover" style="min-width: 100%">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>NIK Kepala RW</th>
                                <th>Nama Kepala RW</th>
                                <th>Nama Dusun</th>
                                <th>Nomor RW</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal fade" id="rw-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="rw-modal-title"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="rw-form" method="post">
                                    <div class="form-group" id="fg-nik-kepala-rw">
                                        <label>NIK Kepala RW</label>
                                        <div class="d-flex">
                                            <input type="text" class="form-control" placeholder="NIK Kepala RW" name="nik_kepala_rw" minlength="16" maxlength="16" required>
                                            <a class="btn btn-default" onclick="cekNIKRW()" style="flex: 0 0 auto;">Cek NIK</a>
                                        </div>
                                    </div>
                                    <div class="form-group" id="fg-nik-kepala-rw">
                                        <label>Nama Kepala RW</label>
                                        <input type="text" class="form-control" value="---" name="nama_kepala_rw" disabled>
                                    </div>
                                    <div class="form-group" id="fg-pilih-dusun">
                                        <label>Pilih Dusun</label>
                                        <select class="form-control" name="dusun" required>
                                            <option value="">Pilih dusun</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="fg-nomor-rw">
                                        <label>Nomor RW</label>
                                        <input type="number" class="form-control" placeholder="Nomor rw" name="nomor" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success" id="rw-modal-submit" onclick="processRW()"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<script>
    const rwForm = document.forms['rw-form'];

    rwForm['nik_kepala_rw'].addEventListener('keypress', function(event) {
        rwForm['nama_kepala_rw'].value = '---';
    });

    function cekNIKRW() {
        const ajax = new XMLHttpRequest();
        ajax.open('GET', 'services/penduduk.php?action=select&nik=' + rwForm['nik_kepala_rw'].value);
        ajax.onload = function() {
            if(ajax.status == 200) {
                try {
                    let response = JSON.parse(ajax.responseText);
                    if(response.code === 0) {
                        rwForm['nama_kepala_rw'].value = response.data.nama;
                        toastr.success("Data ditemukan")
                    } else {
                        toastr.error("Data tidak ditemukan")
                        console.log(ajax.responseText);
                        console.log(e.message);
                    }
                } catch (e) {
                    toastr.error("Terjadi Kesalahan")
                    console.log(ajax.responseText);
                    console.log(e.message);
                }
            } else {
                toastr.error("Kesalahan sambungan ke server")
                console.log(ajax.responseText);
                console.log(e.message);
            }
        };
        ajax.send();
    }

    let RWModalAction = null;

    function tambahRW() {
        RWModalAction = 'insert';
        showRWModal();
    }

    let idRWToEdit = null;
    function editRW(idRW) {
        RWModalAction = 'update';
        showRWModal(idRW);
    }

    function showRWModal(idRW = null) {
        if(RWModalAction === 'insert') {
            document.getElementById('rw-modal-title').textContent = 'Tambah RW';
            document.getElementById('rw-modal-submit').innerHTML  = '<i class="fas fa-plus-circle"></i> Simpan';
        } else if(RWModalAction === 'update') {
            idRWToEdit = idRW;
            document.getElementById('rw-modal-title').textContent = 'Ubah RW';
            document.getElementById('rw-modal-submit').innerHTML  =  '<i class="fas fa-edit"></i> Simpan Perubahan';
            fillRWForm(idRW);
        }
        $('#rw-modal').modal('show');
    }

    function fillRWForm(idRW) {
        const ajax = new XMLHttpRequest();
        ajax.open('GET', 'services/rw.php?action=select&id_rw=' + idRW);
        ajax.onload = function() {
            if(ajax.status === 200) {
                try {
                    const response = JSON.parse(ajax.responseText);
                    if(response.code === 0) {
                        rwForm['nik_kepala_rw'].value = response.data.nik_kepala_rw;
                        rwForm['nama_kepala_rw'].value = response.data.nama_kepala_rw;
                        rwForm['dusun'].value = response.data.id_dusun;
                        rwForm['nomor'].value = response.data.nomor_rw;
                    } else {
                        toastr.error('Terjadi Kesalahan');
                        console.log(ajax.responseText);
                    }
                } catch(e) {
                    toastr.error('Terjadi Kesalahan');
                    console.log(e.message);
                    console.log(ajax.responseText);
                }
            } else {
                toastr.error('Masalah sambungan ke server');
                console.log(ajax.responseText);
            }
        }
        ajax.send();
    }

    function processRW() {
        const event = new Event('submit');
        document.getElementById('rw-form').dispatchEvent(event);
    }
 
    function rwFormOK() {
        return rwForm['nik_kepala_rw'].value !== '' &&
            rwForm['nama_kepala_rw'].value !== '---' &&
            rwForm['nomor'].value !== '' &&
            rwForm['dusun'].value !== '';
            
    }

    document.getElementById('rw-form').addEventListener('submit', function(event) {
        event.preventDefault();

        if(!rwFormOK()) {
            toastr.warning('Data tidak lengkap');
            return;
        }

        const ajax = new XMLHttpRequest();
        if(RWModalAction === 'insert') {
            ajax.open('POST', 'services/rw.php?action=insert');
        } else if(RWModalAction === 'update') {
            ajax.open('POST', 'services/rw.php?action=update&id_rw=' + idRWToEdit);
        }
        ajax.onload = function() {
            if(ajax.status === 200) {
                try {
                    const response = JSON.parse(ajax.responseText);
                    if(response.code === 0) {
                        $('#rw-modal').modal('hide');
                        $('#table-rw').DataTable().ajax.reload();
                        toastr.success(response.message);
                    } else {
                        toastr.error('Terjadi Kesalahan');
                        console.log(ajax.responseText);
                    }
                } catch(e) {
                    toastr.error('Terjadi Kesalahan');
                    console.log(e.message);
                    console.log(ajax.responseText);
                }
            } else {
                toastr.error('Masalah sambungan ke server');
                console.log(ajax.responseText);
            }
        };
        const formData = new FormData(document.getElementById('rw-form'));
        ajax.send(formData);
    });

    function deleteRW(idRW) {
        Swal.fire({
        title: 'Hapus rw?',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Hapus',
        confirmButtonColor: '#d33',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch(`services/rw.php?action=delete&id_rw=${idRW}`)
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
                    $('#table-rw').DataTable().ajax.reload();
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

    function getDusunListRWForm() {
        const ajax = new XMLHttpRequest();
        ajax.open('GET', 'services/dusun.php?action=select');
        ajax.onload = function() {
            if(ajax.status === 200) {
                try {
                    const response = JSON.parse(ajax.responseText);
                    if(response.code === 0) {
                        const select = rwForm['dusun'];
                        const len = select.options.length;
                        for(i = len - 1; i > 0; i--) {
                            select.remove(i);
                        }
                        response.data.forEach((v) => {
                            const option = document.createElement('option');
                            option.value = v.id;
                            option.textContent = v.nama;
                            select.add(option);
                        });
                    } else {
                        console.log(ajax.responseText);
                        toastr.error('Terjadi Kesalahan');
                    }
                } catch(e) {
                    console.log(e.message);
                    toastr.error('Terjadi kesalahan');
                    console.log(ajax.responseText);
                }
            } else {
                toastr.error('Terjadi kesalahan sambungan ke server')
                console.log(ajax.responseText);
            }
        };
        ajax.send();
    }

    function initRW() {
        let dt = $('#table-rw').DataTable({
            "ajax": "services/DataTables/getrw.php",
            "scrollX" : true,
            "columns": [{
                "orderable": false,
                "defaultContent": ""
            },
            {
                "orderable": false,
                "defaultContent": ""
            },
            {
                "data": "nik_kepala_rw"
            },
            {
                "data": "nama_kepala_rw"
            },
            {
                "data": "dusun"
            },
            {
                "data": "nomor_rw"
            }
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
                cell.innerHTML = "<button type='button' data-toggle='modal' class='btn btn-sm btn-warning' onclick='editRW(\"" + dt.ajax.json().data[i].id + "\")' style=\"margin-right: 0.7em\"><i class='fas fa-edit'></i></button><button type='button' class='btn btn-sm btn-danger' onclick='deleteRW(\"" + dt.ajax.json().data[i].id + "\")'><i class='fas fa-trash'></i></button>";
            });
        });
        getDusunListRWForm();
    }
</script>

<!-- RT -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar RT</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove"></button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <button class="btn btn-success" onclick="tambahRT()">
                    <i class="fas fa-plus-circle"></i>
                    Tambah RT
                </button>
                <div class="table-content">
                    <table id="table-rt" class="table table-bordered table-hover" style="min-width: 100%">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>NIK Kepala RT</th>
                                <th>Nama Kepala RT</th>
                                <th>Nama Dusun</th>
                                <th>Nomor RW</th>
                                <th>Nomor RT</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal fade" id="rt-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="rt-modal-title"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="rt-form" method="post">
                                    <div class="form-group" id="fg-nik-kepala-rt">
                                        <label>NIK Kepala RT</label>
                                        <div class="d-flex">
                                            <input type="text" class="form-control" placeholder="NIK Kepala RT" name="nik_kepala_rt" minlength="16" maxlength="16" required>
                                            <a class="btn btn-default" onclick="cekNIKRT()" style="flex: 0 0 auto;">Cek NIK</a>
                                        </div>
                                    </div>
                                    <div class="form-group" id="fg-nik-kepala-rt">
                                        <label>Nama Kepala RT</label>
                                        <input type="text" class="form-control" value="---" name="nama_kepala_rt" disabled>
                                    </div>
                                    <div class="form-group" id="fg-pilih-dusun">
                                        <label>Pilih Dusun</label>
                                        <select class="form-control" name="dusun" required>
                                            <option value="">Pilih dusun</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="fg-pilih-dusun">
                                        <label>Pilih Dusun</label>
                                        <select class="form-control" name="rw" required>
                                            <option value="">Pilih RW</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="fg-nomor-rt">
                                        <label>Nomor RT</label>
                                        <input type="number" class="form-control" placeholder="Nomor RT" name="nomor" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success" id="rt-modal-submit" onclick="processRT()"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<script>
    const rtForm = document.forms['rt-form'];

    rtForm['nik_kepala_rt'].addEventListener('keypress', function(event) {
        rtForm['nama_kepala_rt'].value = '---';
    });

    function cekNIKRT() {
        const ajax = new XMLHttpRequest();
        ajax.open('GET', 'services/penduduk.php?action=select&nik=' + rtForm['nik_kepala_rt'].value);
        ajax.onload = function() {
            if(ajax.status == 200) {
                try {
                    let response = JSON.parse(ajax.responseText);
                    if(response.code === 0) {
                        rtForm['nama_kepala_rt'].value = response.data.nama;
                        toastr.success("Data ditemukan")
                    } else {
                        toastr.error("Data tidak ditemukan")
                        console.log(ajax.responseText);
                        console.log(e.message);
                    }
                } catch (e) {
                    toastr.error("Terjadi Kesalahan")
                    console.log(ajax.responseText);
                    console.log(e.message);
                }
            } else {
                toastr.error("Kesalahan sambungan ke server")
                console.log(ajax.responseText);
                console.log(e.message);
            }
        };
        ajax.send();
    }

    let RTModalAction = null;

    function tambahRT() {
        RTModalAction = 'insert';
        showRTModal();
    }

    let idRTToEdit = null;
    function editRT(idRT) {
        RTModalAction = 'update';
        showRTModal(idRT);
    }

    function showRTModal(idRT = null) {
        rtForm.reset();
        if(RTModalAction === 'insert') {
            document.getElementById('rt-modal-title').textContent = 'Tambah RT';
            document.getElementById('rt-modal-submit').innerHTML  = '<i class="fas fa-plus-circle"></i> Simpan';
        } else if(RTModalAction === 'update') {
            idRTToEdit = idRT;
            document.getElementById('rt-modal-title').textContent = 'Ubah RT';
            document.getElementById('rt-modal-submit').innerHTML  =  '<i class="fas fa-edit"></i> Simpan Perubahan';
            fillRTForm(idRT);
        }
        $('#rt-modal').modal('show');
    }

    function fillRTForm(idRT) {
        const ajax = new XMLHttpRequest();
        ajax.open('GET', 'services/rt.php?action=select&id_rt=' + idRT);
        ajax.onload = function() {
            if(ajax.status === 200) {
                try {
                    const response = JSON.parse(ajax.responseText);
                    if(response.code === 0) {
                        rtForm['nik_kepala_rt'].value = response.data.nik_kepala_rt;
                        rtForm['nama_kepala_rt'].value = response.data.nama_kepala_rt;
                        rtForm['dusun'].value = response.data.id_dusun;
                        getRWListRTForm(response.data.id_rw);
                        rtForm['nomor'].value = response.data.nomor_rt;
                    } else {
                        toastr.error('Terjadi Kesalahan');
                        console.log(ajax.responseText);
                    }
                } catch(e) {
                    toastr.error('Terjadi Kesalahan');
                    console.log(e.message);
                    console.log(ajax.responseText);
                }
            } else {
                toastr.error('Masalah sambungan ke server');
                console.log(ajax.responseText);
            }
        }
        ajax.send();
    }

    function processRT() {
        const event = new Event('submit');
        document.getElementById('rt-form').dispatchEvent(event);
    }

    function rtFormOK() {
        return rtForm['nik_kepala_rt'].value !== '' &&
            rtForm['nama_kepala_rt'].value !== '---' &&
            rtForm['nomor'].value !== '';
            
    }

    document.getElementById('rt-form').addEventListener('submit', function(event) {
        event.preventDefault();

        if(!rtFormOK()) {
            toastr.warning('Data tidak lengkap');
            return;
        }

        const ajax = new XMLHttpRequest();
        if(RTModalAction === 'insert') {
            ajax.open('POST', 'services/rt.php?action=insert');
        } else if(RTModalAction === 'update') {
            ajax.open('POST', 'services/rt.php?action=update&id_rt=' + idRTToEdit);
        }
        ajax.onload = function() {
            if(ajax.status === 200) {
                try {
                    const response = JSON.parse(ajax.responseText);
                    if(response.code === 0) {
                        $('#rt-modal').modal('hide');
                        $('#table-rt').DataTable().ajax.reload();
                        toastr.success(response.message);
                    } else {
                        toastr.error('Terjadi Kesalahan');
                        console.log(ajax.responseText);
                    }
                } catch(e) {
                    toastr.error('Terjadi Kesalahan');
                    console.log(e.message);
                    console.log(ajax.responseText);
                }
            } else {
                toastr.error('Masalah sambungan ke server');
                console.log(ajax.responseText);
            }
        };
        const formData = new FormData(document.getElementById('rt-form'));
        ajax.send(formData);
    });

    function deleteRT(idRT) {
        Swal.fire({
        title: 'Hapus RT?',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Hapus',
        confirmButtonColor: '#d33',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch(`services/rt.php?action=delete&id_rt=${idRT}`)
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
                    $('#table-rt').DataTable().ajax.reload();
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

    function getDusunListRTForm() {
        const ajax = new XMLHttpRequest();
        ajax.open('GET', 'services/dusun.php?action=select');
        ajax.onload = function() {
            if(ajax.status === 200) {
                try {
                    const response = JSON.parse(ajax.responseText);
                    if(response.code === 0) {
                        const select = rtForm['dusun'];
                        const len = select.options.length;
                        for(i = len - 1; i > 0; i--) {
                            select.remove(i);
                        }
                        response.data.forEach((v) => {
                            const option = document.createElement('option');
                            option.value = v.id;
                            option.textContent = v.nama;
                            select.add(option);
                        });
                    } else {
                        console.log(ajax.responseText);
                        toastr.error('Terjadi Kesalahan');
                    }
                } catch(e) {
                    console.log(e.message);
                    toastr.error('Terjadi kesalahan');
                    console.log(ajax.responseText);
                }
            } else {
                toastr.error('Terjadi kesalahan sambungan ke server')
                console.log(ajax.responseText);
            }
        };
        ajax.send();
    }

    rtForm['dusun'].addEventListener('change', function(event) {
        getRWListRTForm();
    }); 

    function getRWListRTForm(idRW = null) {
        if(rtForm['dusun'].value !== '') {
            const ajax = new XMLHttpRequest();
            ajax.open('GET', 'services/rw.php?action=select&id_dusun=' + rtForm['dusun'].value);
            ajax.onload = function() {
                if(ajax.status === 200) {
                    try {
                        const response = JSON.parse(ajax.responseText);
                        if(response.code === 0) {
                            const select = rtForm['rw'];
                            const len = select.options.length;
                            for(i = len - 1; i > 0; i--) {
                                select.remove(i);
                            }
                            response.data.forEach((v) => {
                                const option = document.createElement('option');
                                option.value = v.id;
                                option.textContent = v.nomor;
                                select.add(option);
                            });

                            if(idRW !== null) {
                                select.value = idRW;
                            }
                            
                        } else {
                            console.log(ajax.responseText);
                            toastr.error('Terjadi Kesalahan');
                        }
                    } catch(e) {
                        console.log(e.message);
                        toastr.error('Terjadi kesalahan');
                        console.log(ajax.responseText);
                    }
                } else {
                    toastr.error('Terjadi kesalahan sambungan ke server')
                    console.log(ajax.responseText);
                }
            };
            ajax.send();
        }
    }

    function initRT() {
        let dt = $('#table-rt').DataTable({
            "ajax": "services/DataTables/getRT.php",
            "scrollX" : true,
            "columns": [{
                "orderable": false,
                "defaultContent": ""
            },
            {
                "orderable": false,
                "defaultContent": ""
            },
            {
                "data": "nik_kepala_rt"
            },
            {
                "data": "nama_kepala_rt"
            },
            {
                "data": "dusun"
            },
            {
                "data": "nomor_rw"
            },
            {
                "data": "nomor_rt"
            }
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
                cell.innerHTML = "<button type='button' data-toggle='modal' class='btn btn-sm btn-warning' onclick='editRT(\"" + dt.ajax.json().data[i].id + "\")' style=\"margin-right: 0.7em\"><i class='fas fa-edit'></i></button><button type='button' class='btn btn-sm btn-danger' onclick='deleteRT(\"" + dt.ajax.json().data[i].id + "\")'><i class='fas fa-trash'></i></button>";
            });
        });

        getDusunListRTForm();
    }
</script>

<script>
    $(document).ready(function() {
        initDusun();
        initRW();
        initRT();
    });
</script>