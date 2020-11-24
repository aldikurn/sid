<style>
    #formTambahDataPemantauan {
        display: grid;
        gap: 1rem;
        grid-template-areas:
            'fg-nik  fg-tanggal-pemantauan'
            'fg-tanggal-tiba fg-data-hari-ke'
            'fg-suhu-tubuh fg-kondisi'
            'fg-keluhan-lain fg-keluhan-lain'
            'fg-submit fg-submit';
    }
    
    #fg-nik {
        grid-area: fg-nik;
    }

    #fg-tanggal-pemantauan {
        grid-area: fg-tanggal-pemantauan;
    }

    #fg-tanggal-tiba {
        grid-area: fg-tanggal-tiba;
    }

    #fg-data-hari-ke {
        grid-area: fg-data-hari-ke;
    }

    #fg-suhu-tubuh {
        grid-area: fg-suhu-tubuh;
    }

    #fg-kondisi {
        grid-area: fg-kondisi;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    #fg-kondisi > div .form-check {
        display: inline-block;
        margin-right: 0.3rem;
    }

    #fg-keluhan-lain {
        grid-area: fg-keluhan-lain;
    }

    #fg-submit {
        grid-area: fg-submit;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
    }

    td {
        cursor: default;
    }

</style>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist" style="float: left;">
                        <a class="nav-item nav-link active" id="nav-daftar-pantau-pemudik-tab" data-toggle="tab" href="#nav-daftar-pantau-pemudik" role="tab" aria-controls="nav-home" aria-selected="true">Daftar Pemantauan</a>
                        <a class="nav-item nav-link" id="nav-tambah-pantau-pemudik-tab" data-toggle="tab" href="#nav-tambah-pantau-pemudik" role="tab" aria-controls="nav-profile" aria-selected="false">Tambah Pemantauan</a>
                    </div>
                </nav>
                <div>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-daftar-pantau-pemudik" role="tabpanel" aria-labelledby="nav-home-tab">
                                <table id="table-pantau-pemudik" class="table table-bordered table-hover" style="min-width: 100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Nmr</th>
                                            <th>Aksi</th>
                                            <th>Tanggal Pemantauan</th>
                                            <th>Tanggal Tiba</th>
                                            <th>Hari ke</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Suhu Tubuh</th>
                                            <th>Batuk</th>
                                            <th>Flu</th>
                                            <th>Sesak Nafas</th>
                                            <th>Keluhan Lain</th>
                                            <th>Status COVID19</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-tambah-pantau-pemudik" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <form id="formTambahDataPemantauan" method="post" action="">
                                    <div class="form-group" id="fg-nik">
                                        <label>Pilih Pemudik</label>
                                        <select name="nik" id="nik" class="form-control" required>
                                            <option value="">Pilih Pemudik</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="fg-tanggal-pemantauan">
                                        <label>Tanggal Pemantauan</label>
                                        <input type="datetime-local" name="tanggal_pemantauan" class="form-control" required>
                                    </div>
                                    <div class="form-group" id="fg-tanggal-tiba">
                                        <label>Tanggal Tiba</label>
                                        <input type="text" name="tanggal_tiba" class="form-control" disabled>
                                    </div>
                                    <div class="form-group" id="fg-data-hari-ke">
                                        <label>Data Hari ke-</label>
                                        <input type="text" name="data-hari-ke" class="form-control" disabled>
                                    </div>
                                    <div class="form-group" id="fg-suhu-tubuh">
                                        <label>Suhu Tubuh</label>
                                        <input type="number" name="suhu-tubuh" class="form-control" placeholder="36" min="20" max="50" required>
                                    </div>
                                    <div class="form-group" id="fg-kondisi">
                                        <label>Kondisi Kesehatan</label>
                                        <div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="ya" id="batuk" name="batuk">
                                                <label class="form-check-label" for="batuk">Batuk</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="ya" id="flu" name="flu">
                                                <label class="form-check-label" for="flu">Flu</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="ya" id="sesak-nafas" name="sesak-nafas">
                                                <label class="form-check-label" for="sesak-nafas">Sesak Nafas</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="fg-keluhan-lain">
                                        <label>Keluhan Lain</label>
                                        <textarea name="keluhan-lain" id="keluhan-lain" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group" id="fg-submit">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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

<script>
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'services/pemudik.php?action=select&nik=all&wajib_pantau=1');
    xhr.onload = function() {
        if(xhr.status === 200) {
            try {
                let response = JSON.parse(xhr.responseText);

                if(response.code === 0) {
                    const len = response.data.length;
                    let nikSelect = document.getElementsByName('nik')[0];
                    for(i = 0; i < len; i++) {
                        let opt = document.createElement('option');
                        opt.value = response.data[i].nik;
                        opt.textContent = response.data[i].nik + ' - ' + response.data[i].nama;
                        nikSelect.appendChild(opt);
                    }
                } else {
                    toastr.error('Terjadi Kesalahan');
                    console.log(xhr.responseText);
                }
            } catch (e) {
                toastr.error('Terjadi kesalahan');
                console.log(e.message);
                console.log(xhr.responseText);

            }
        } else {
            toastr.error('Terjadi kesalahan saat menghubungi server');
            console.log(xhr.responseText);
        }
    }
    xhr.send();

    let form = document.forms['formTambahDataPemantauan'];
    form['nik'].addEventListener('change', function(event) {
        if(this.value !== '') {
            let ajax = new XMLHttpRequest();
            ajax.open('GET', 'services/pemudik.php?action=select&nik=' + this.value);
            ajax.onload = function() {
                if(ajax.status === 200) {
                    try {
                        let response = JSON.parse(ajax.responseText);

                        if(response.code === 0) {
                            form['tanggal_tiba'].value = response.data.tanggal_tiba;
                            form['tanggal_pemantauan'].value = formatDate(response.data.tanggal_tiba);
                            form['tanggal_pemantauan'].setAttribute('min', formatDate(response.data.tanggal_tiba));
                            form['tanggal_pemantauan'].setAttribute('max', formatDate(new Date(formatDate(response.data.tanggal_tiba)).getTime() + (24 * 3600 * 1000 * response.data.durasi)));
                            changeTanggalPemantauan();
                        } else {
                            toastr.error('Terjadi Kesalahan');
                            console.log(ajax.responseText);
                        }
                    } catch (e) {
                        toastr.error('Terjadi kesalahan');
                        console.log(e.message);
                        console.log(ajax.responseText);

                    }
                } else {
                    toastr.error('Terjadi kesalahan saat menghubungi server');
                    console.log(ajax.responseText);
                }
            };
        ajax.send();
        } else {
            form.reset();
        }
    });

    form['tanggal_pemantauan'].addEventListener('change', function() {
        changeTanggalPemantauan();
    });

    function changeTanggalPemantauan() {
        let d1 = new Date(form['tanggal_pemantauan'].value);
        let d2 = new Date(form['tanggal_tiba'].value);
        form['data-hari-ke'].value = Math.round(new Date(d1 - d2).getTime() / (24 * 3600 * 1000));
    }

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const ajax = new XMLHttpRequest();
        ajax.open('POST', 'services/pantau_pemudik.php?action=insert&nik=' + form['nik'].value);
        ajax.onload = function() {
            if(xhr.status === 200) {
                try {
                    let response = JSON.parse(ajax.responseText);

                    if(response.code === 0) {
                        toastr.success(response.message);
                        form.reset();
                        $('#table-pantau-pemudik').DataTable().columns.adjust().draw();
                    } else {
                        toastr.error('Terjadi Kesalahan');
                        console.log(ajax.responseText);
                    }
                } catch (e) {
                    toastr.error('Terjadi kesalahan');
                    console.log(e.message);
                    console.log(ajax.responseText);
                }
            } else {
                toastr.error('Terjadi kesalahan saat menghubungi server');
                console.log(ajax.responseText);
            }
        };
        const formData = new FormData(form);
        ajax.send(formData);
    });

    function deleteDataPemantauan(nik, tanggalPantau) {
        const ajax = new XMLHttpRequest();
        ajax.open('GET', 'services/pantau_pemudik.php?action=delete&nik=' + nik + '&tanggal_pantau=' + tanggalPantau);
        ajax.onload = function() {
            if(ajax.status === 200) {
                try {
                    const response = JSON.parse(ajax.responseText);
                    if(response.code === 0) {
                        $('#table-pantau-pemudik').DataTable().columns.adjust().draw();
                        toastr.success("Berhasil menghapus data");
                    } else {
                        toastr.error('Terjadi kesalahan');
                        console.log(ajax.responseText);
                    }
                } catch(e) {
                    toastr.error('Terjadi kesalahan');
                    console.log(ajax.responseText);
                }
            } else {
                toastr.error('Terjadi kesalahan saat menghubungi server');
                console.log(ajax.responseText);
            }
        }
        ajax.send();
    }

    function formatDate(date) {
        let d = new Date(date);
        let month = d.getMonth() + 1;
        let day = d.getDate();
        let year = d.getFullYear();
        let hour = d.getHours();
        let minute = d.getMinutes();

        if (month < 10) 
            month = '0' + month;
        if (day < 10) 
            day = '0' + day;
        if(hour < 10)
            hour = '0' + hour;
        if(minute < 10)
            minute = '0' + minute;
        let result = [year, month, day].join('-');
        result = result + 'T' + hour + ':' + minute;
        return result;
    }
</script>

<script>
    let dt;

    const refreshTablePantauPemudik = function () {
        dt = $('#table-pantau-pemudik').DataTable({
            "processing": true,
            "serverSide": true,
            "scrollX" : true,
            "lengthMenu": [10, 20],
            "ajax": "services/DataTables/getPantauPemudik.php",
            "columns": [{
                "orderable": false,
                "defaultContent": ""
            },
            {
                "orderable": false,
                "defaultContent": ""
            },
            {
                "data": "tanggal_pantau"
            },
            {
                "data": "tanggal_tiba"
            },
            {
                "data": "data_hari_ke"
            },
            {
                "data": "nik"
            },
            {
                "data": "nama"
            },
            {
                "data": "suhu_tubuh"
            },
            {
                "data": "batuk"
            },
            {
                "data": "flu"
            },
            {
                "data": "sesak_nafas"
            },
            {
                "data": "keluhan_lain"
            },
            {
                "data": "status_covid19"
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
                cell.innerHTML = "<button type='button' class='btn btn-danger' onclick='deleteDataPemantauan(\"" + dt.cell(i, 5).data() + "\",\"" + dt.cell(i, 2).data() + "\")'><i class='fas fa-trash'></i></button>";
            });
        });
    };

    $(document).ready(refreshTablePantauPemudik);
</script>