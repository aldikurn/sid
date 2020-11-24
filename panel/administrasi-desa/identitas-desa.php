<style>

    td {
        cursor: default;
    }



</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Logo Desa</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove"></button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body" style="display: flex; justify-content: center; align-items: center;">
                <img id="preview-logo-desa" style="width: 120px; height: 120px;  object-fit: contain; margin: 0 1rem;">
            </div>

            <div class="card-footer">
                <form id="form-update-logo" style="display: flex; justify-content: space-between; margin-bottom: 0;">
                    <input id="browse-logo" name="logo-desa" type="file" class="btn btn-default" accept="image/*">
                    <button type="submit" id="update-logo" class="btn btn-success">Update logo</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Identitas Desa</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove"></button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="identitas-desa" method="post">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th><label>Nama Desa</label></th>
                                        <td>:</td>
                                        <td><input type="text" class="form-control" name="nama" value="" disabled></td>
                                    </tr>
                                    <tr>
                                        <th><label>Kode Pos</label></th>
                                        <td>:</td>
                                        <td><input type="number" class="form-control" name="kode_pos" value="" disabled></td>
                                    </tr>
                                    <tr>
                                        <th><label>Alamat Kantor</label></th>
                                        <td>:</td>
                                        <td><input type="text" class="form-control" name="alamat-kantor" value="" disabled></td>
                                    </tr>
                                    <tr>
                                        <th><label>Email</label></th>
                                        <td>:</td>
                                        <td><input type="email" class="form-control" name="email" value="" disabled></td>
                                    </tr>
                                    <tr>
                                        <th><label>Telepon</label></th>
                                        <td>:</td>
                                        <td><input type="text" class="form-control" name="telepon" value="" disabled></td>
                                    </tr>
                                    <tr>
                                        <th><label>Kecamatan</label></th>
                                        <td>:</td>
                                        <td><input type="text" class="form-control" name="kecamatan" value="" disabled></td>
                                    </tr>
                                    <tr>
                                        <th><label>Kabupaten</label></th>
                                        <td>:</td>
                                        <td><input type="text" class="form-control" name="kabupaten" value="" disabled></td>
                                    </tr>
                                    <tr>
                                        <th><label>Provinsi</label></th>
                                        <td>:</td>
                                        <td>
                                            <input type="text" class="form-control" name="provinsi" value="" disabled>
                                            <input type="submit" class="d-none">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        <!-- /.chart-responsive -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- ./card-body -->

            <div class="card-footer ">
                <div class="d-flex">
                    <button id="ubah" class="btn btn-warning mr-auto">Ubah</button>
                    <button id="batal" class="btn btn-default mr-2 d-none">Batal</button>
                    <button type="submit" id="simpan" class="btn btn-success d-none">Simpan</button>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<script>
    document.getElementById('browse-logo').addEventListener('change', function(event) {
        document.getElementById('preview-logo-desa').src = window.URL.createObjectURL(this.files[0]);
    });

    document.getElementById('form-update-logo').addEventListener('submit', function(event) {
        event.preventDefault();

        const ajax = new XMLHttpRequest();
        ajax.open('POST', 'services/identitas-desa.php?action=upload_logo');
        ajax.onload = function() {
            if(ajax.status === 200) {
                try {
                    const response = JSON.parse(ajax.responseText);
                    if(response.code === 0) {
                        toastr.success('Berhasil upload logo');
                        console.log(ajax.responseText);
                    } else {
                        toastr.error('Terjadi kesalahan');
                        console.log(ajax.responseText);
                    }
                } catch(e) {
                    toastr.error('Terjadi kesalahan');
                    console.log(e.message);
                    console.log(ajax.responseText);
                }
            } else {
                toastr.error('Gagal menghubungi server');
                console.log(ajax.responseText);
            }
        };
        const formData = new FormData(document.forms['form-update-logo']);
        ajax.send(formData);
    });

    const form = document.forms['identitas-desa'];
    const ubah = document.getElementById('ubah');
    const batal = document.getElementById('batal');
    const simpan = document.getElementById('simpan');
    
    ubah.addEventListener('click', function(event) {
        toggleForm();
    });

    batal.addEventListener('click', function(event) {
        toggleForm();
    });

    simpan.addEventListener('click', function(event) {
        const evt = new Event('submit');
        form.dispatchEvent(evt);
    });

    document.getElementById('identitas-desa').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(form);
        const ajax = new XMLHttpRequest();
        ajax.open('POST', 'services/identitas-desa.php?action=update');
        ajax.onload = function() {
            if(ajax.status === 200) {
                try {
                    const response = JSON.parse(ajax.responseText);
                    if(response.code === 0) {
                        toastr.success('Berhasil mengubah data');
                        toggleForm();
                        console.log(ajax.responseText);
                    } else {
                        toastr.error('Terjadi kesalahan');
                        console.log(ajax.responseText);
                    }
                } catch(e) {
                    toastr.error('Terjadi kesalahan');
                    console.log(e.message);
                    console.log(ajax.responseText);
                }
            } else {
                toastr.error('Gagal menghubungi server');
                console.log(ajax.responseText);
            }
        };
        ajax.send(formData);
    });

    function toggleForm() {
        ubah.toggleAttribute('disabled');
        batal.classList.toggle('d-none');
        simpan.classList.toggle('d-none');

        Array.from(form.elements).forEach((v) => {
            v.toggleAttribute('disabled');
        });
    }

    function getFormData() {
        const ajax = new XMLHttpRequest();
        ajax.open('GET', 'services/identitas-desa.php?action=select');
        ajax.onload = function() {
            if(ajax.status === 200) {
                try {
                    const response = JSON.parse(ajax.responseText);
                    if(response.code === 0) {
                        form['nama'].value = response.data.nama;
                        form['kode_pos'].value = response.data.kode_pos;
                        form['alamat-kantor'].value = response.data.alamat_kantor;
                        form['email'].value = response.data.email;
                        form['telepon'].value = response.data.telepon;
                        form['kecamatan'].value = response.data.kecamatan;
                        form['kabupaten'].value = response.data.kabupaten;
                        form['provinsi'].value = response.data.provinsi;
                        document.getElementById('preview-logo-desa').src = response.data.logo;
                    } else {
                        toastr.error('Terjadi kesalahan');
                        console.log(ajax.responseText);
                    }
                } catch(e) {
                    toastr.error('Terjadi kesalahan');
                    console.log(e.message);
                    console.log(ajax.responseText);
                }
            } else {
                toastr.error('Gagal menghubungi server');
                console.log(ajax.responseText);
            }
        }
        const formData = new FormData(form);
        ajax.send(formData);
    }
    document.addEventListener('DOMContentLoaded', getFormData);
</script>