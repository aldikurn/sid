<?php
include_once ('services/getRequiredFormPenduduk.php');
?>
<script>
    const rw_data = JSON.parse('<?= json_encode($rw) ?>');
    const rt_data = JSON.parse('<?= json_encode($rt) ?>');
</script>



<style>
    #modal-body-tambah-data-penduduk {
        display: grid;
        grid-template-areas:
            'info-form info-form info-form info-form info-form info-form '
            'preview-foto preview-foto fg-input-foto fg-input-foto fg-input-foto fg-input-foto'
            'preview-foto preview-foto fg-nama fg-nama fg-nama fg-nama'
            'preview-foto preview-foto fg-nik fg-nik fg-nik fg-nik'
            'preview-foto preview-foto fg-kk fg-kk fg-kk fg-kk'
            'fg-jenis-kelamin fg-jenis-kelamin fg-tanggal-lahir fg-tanggal-lahir fg-tempat-lahir fg-tempat-lahir'
            'fg-hubungan-dalam-keluarga fg-hubungan-dalam-keluarga fg-agama fg-agama fg-pendidikan-terakhir fg-pendidikan-terakhir'
            'fg-pekerjaan fg-pekerjaan fg-status-perkawinan fg-status-perkawinan fg-status-penduduk fg-status-penduduk'
            'fg-nik-ayah fg-nik-ayah fg-nik-ayah fg-nama-ayah fg-nama-ayah fg-nama-ayah'
            'fg-nik-ibu fg-nik-ibu fg-nik-ibu fg-nama-ibu fg-nama-ibu fg-nama-ibu'
            'fg-dusun fg-dusun fg-rw fg-rw fg-rt fg-rt';
        gap: 0.5em;
    }

    tr > * {
        text-align: center;
    }

    .info-form {
        font-style: italic;
    }

    #preview-foto {
        position: relative;
        grid-area: preview-foto;
        border: 1px solid #ced4da;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #preview-foto img {
        max-width: 180px;
        max-height: 300px;
    }

    #placeholder-foto {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #ced4da;
        font-size: 2em;
        user-select: none;
        text-align: center;
    }

    #fg-input-foto {
        grid-area: fg-input-foto;
    }

    #fg-nama {
        grid-area: fg-nama;
    }

    #fg-nik {
        grid-area: fg-nik;
    }

    #fg-kk {
        grid-area: fg-kk;
    }

    #fg-jenis-kelamin {
        grid-area: fg-jenis-kelamin;
    }

    #fg-tanggal-lahir {
        grid-area: fg-tanggal-lahir;
    }

    #fg-tempat-lahir {
        grid-area: fg-tempat-lahir;
    }

    #fg-hubungan-dalam-keluarga {
        grid-area: fg-hubungan-dalam-keluarga;
    }

    #fg-agama {
        grid-area: fg-agama;
    }

    #fg-pendidikan-terakhir {
        grid-area: fg-pendidikan-terakhir;
    }

    #fg-pekerjaan {
        grid-area: fg-pekerjaan;
    }

    #fg-status-perkawinan {
        grid-area: fg-status-perkawinan;
    }

    #fg-status-penduduk {
        grid-area: fg-status-penduduk;
    }

    #fg-nik-ayah {
        grid-area: fg-nik-ayah;
    }

    #fg-nama-ayah {
        grid-area: fg-nama-ayah;
    }

    #fg-nik-ibu {
        grid-area: fg-nik-ibu;
    }

    #fg-nama-ibu {
        grid-area: fg-nama-ibu;
    }

    #fg-dusun {
        grid-area: fg-dusun;
    }

    #fg-rw {
        grid-area: fg-rw;
    }

    #fg-rt {
        grid-area: fg-rt;
    }

    @media only screen and (max-width: 991px) {
        #modal-body-tambah-data-penduduk {
            grid-template-areas:
                'preview-foto'
                'fg-input-foto'
                'fg-nama'
                'fg-nik'
                'fg-kk'
                'fg-jenis-kelamin'
                'fg-tanggal-lahir'
                'fg-tempat-lahir'
                'fg-hubungan-dalam-keluarga'
                'fg-agama'
                'fg-pendidikan-terakhir'
                'fg-pekerjaan'
                'fg-status-perkawinan'
                'fg-nik-ayah'
                'fg-nama-ayah'
                'fg-nik-ibu'
                'fg-nama-ibu'
                'fg-dusun'
                'fg-rw'
                'fg-rt' ;
        }

        #preview-foto {
            min-height: 500px;
        }
    }

</style>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false" onclick="showForm('insert')" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah data penduduk</button>
                <form method="post" id="formTambahDataPenduduk">
                    <div class="modal fade" id="modalTambahDataPenduduk">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah data penduduk</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div id="modal-body-tambah-data-penduduk" class="modal-body">
                                    <p class="info-form">(*) Wajib diisi</p>
                                    <div id="preview-foto">
                                        <span id="placeholder-foto">Ukuran rekomendasi 3 X 4</span>
                                    </div>
                                    <div class="form-group" id="fg-input-foto">
                                        <label>Pilih foto</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="input-file-foto" name="foto" accept="image/*">
                                            <label class="custom-file-label" id="label-file-foto"></label>
                                        </div>
                                    </div>
                                    <div class="form-group" id="fg-nama">
                                        <label>Nama*</label>
                                        <input type="text" class="form-control" placeholder="Nama" name="nama" required>
                                    </div>
                                    <div class="form-group" id="fg-nik">
                                        <label>NIK*</label>
                                        <input type="text" class="form-control" placeholder="NIK" name="nik" minlength="16" maxlength="16" required>
                                    </div>
                                    <div class="form-group" id="fg-kk">
                                        <label>Nomor KK*</label>
                                        <input type="text" class="form-control" placeholder="Nomor KK" name="nomor_kk"  minlength="16" maxlength="16" required>
                                    </div>
                                    <div class="form-group" id="fg-jenis-kelamin">
                                        <label>Jenis Kelamin*</label>
                                        <select class="form-control" name="jenis_kelamin" required>
                                            <option value="-1" selected disabled>Pilih jenis kelamin</option>
                                            <?php
                                            foreach($jenis_kelamin as $row) {
                                                echo '<option value="' . $row['id']  . '">' .  $row['nama'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group" id="fg-tanggal-lahir">
                                        <label>Tanggal Lahir*</label>
                                        <input type="date" class="form-control" placeholder="Tanggal Lahir" name="tanggal_lahir" required>
                                    </div>
                                    <div class="form-group" id="fg-tempat-lahir">
                                        <label>Tempat Lahir*</label>
                                        <input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir" required>
                                    </div>
                                    <div class="form-group" id="fg-hubungan-dalam-keluarga">
                                        <label>Hubungan Dalam Keluarga*</label>
                                        <select class="form-control"name="hubungan_dalam_keluarga" required>
                                            <option value="-1" selected disabled>Pilih hubungan dalam keluarga</option>
                                            <?php
                                            foreach($hubungan_dalam_keluarga as $row) {
                                                echo '<option value="' . $row['id']  . '">' .  $row['nama'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group" id="fg-agama">
                                        <label>Agama*</label>
                                        <select class="form-control" name="agama" required>
                                            <option value="-1" selected disabled>Pilih agama</option>
                                            <?php
                                            foreach($agama as $row) {
                                                echo '<option value="' . $row['id']  . '">' .  $row['nama'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group" id="fg-pendidikan-terakhir">
                                        <label>Pendidikan Terakhir*</label>
                                        <select class="form-control" name="pendidikan_terakhir" required>
                                            <option value="-1" selected disabled>Pilih pendidikan terakhir</option>
                                            <?php
                                            foreach($pendidikan_terakhir as $row) {
                                                echo '<option value="' . $row['id']  . '">' .  $row['nama'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group" id="fg-pekerjaan">
                                        <label>Pekerjaan*</label>
                                        <select class="form-control" name="pekerjaan" required>
                                            <option value="-1" selected disabled>Pilih pekerjaan</option>
                                            <?php
                                            foreach($pekerjaan as $row) {
                                                echo '<option value="' . $row['id']  . '">' .  $row['nama'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group" id="fg-status-perkawinan">
                                        <label>Status Perkawinan*</label>
                                        <select class="form-control" name="status_perkawinan" required>
                                            <option value="-1" selected disabled>Pilih status perkawinan</option>
                                            <?php
                                            foreach($status_perkawinan as $row) {
                                                echo '<option value="' . $row['id']  . '">' .  $row['nama'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group" id="fg-status-penduduk">
                                        <label>Status Penduduk*</label>
                                        <select class="form-control" name="status_penduduk" required>
                                            <option value="-1" selected disabled>Pilih status penduduk</option>
                                            <?php
                                            foreach($status_penduduk as $row) {
                                                echo '<option value="' . $row['id']  . '">' .  $row['nama'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group" id="fg-nik-ayah">
                                        <label>NIK Ayah</label>
                                        <input type="text" class="form-control" placeholder="NIK Ayah" name="nik_ayah" minlength="16" maxlength="16">
                                    </div>
                                    <div class="form-group" id="fg-nama-ayah">
                                        <label>Nama Ayah</label>
                                        <input type="text" class="form-control" placeholder="Nama Ayah" name="nama_ayah">
                                    </div>
                                    <div class="form-group" id="fg-nik-ibu">
                                        <label>NIK Ibu</label>
                                        <input type="text" class="form-control" placeholder="NIK Ibu" name="nik_ibu" minlength="16" maxlength="16">
                                    </div>
                                    <div class="form-group" id="fg-nama-ibu">
                                        <label>Nama Ibu</label>
                                        <input type="text" class="form-control" placeholder="Nama Ibu" name="nama_ibu">
                                    </div>
                                    <div class="form-group" id="fg-dusun">
                                        <label>Dusun*</label>
                                        <select class="form-control" name="dusun" id="dusun" required>
                                            <option selected disabled value="-1">Pilih dusun</option>
                                            <?php
                                            foreach($dusun as $row) {
                                                echo '<option value="' . $row['id']  . '">' .  $row['nama'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group" id="fg-rw">
                                        <label>RW*</label>
                                        <select class="form-control" name="rw" id="rw" required>
                                            <option selected disabled value="-1">Pilih RW</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="fg-rt">
                                        <label>RT*</label>
                                        <select class="form-control" name="rt" id="rt" required>
                                            <option selected disabled value="-1">Pilih RT</option>
                                        </select>
                                    </div>


                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                                    <button type="submit" class="btn btn-success" ></button>
                                </div>
                                <div id="modal-loading-tambah-data-penduduk" class="overlay d-flex justify-content-center align-items-center" style="z-index: -1;">
                                    <i class="fas fa-2x fa-sync fa-spin"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tabel-penduduk" class="table table-bordered table-hover" style="min-width: 100%">
                    <thead class="thead-light">
                    <tr>
                        <th>Nmr</th>
                        <th>NIK</th>
                        <th>Nomor KK</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Tempat Lahir</th>
                        <th>Hubungan Dalam Keluarga</th>
                        <th>Agama</th>
                        <th>Pendidikan Terakhir</th>
                        <th>Pekerjaan</th>
                        <th>Status Perkawinan</th>
                        <th>Status Penduduk</th>
                        <th>NIK Ayah</th>
                        <th>Nama Ayah</th>
                        <th>NIK Ibu</th>
                        <th>Nama Ibu</th>
                        <th>Dusun</th>
                        <th>RW</th>
                        <th>RT</th>
                        <th>Tanggal Rekam</th>
                    </tr>
                    </thead>
                </table>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Yakin ingin menghapus data?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger" onclick="processDelete()">Hapus Data</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.card-body -->
        </div> <!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->


<script>
    function changeDusun() {
        let dusunSelect = document.getElementsByName('dusun')[0];
        let rwSelect = document.getElementsByName('rw')[0];
        let rtSelect = document.getElementsByName('rt')[0];
        removeOption(rwSelect);
        removeOption(rtSelect);
        for(let rw of rw_data) {
            if(dusunSelect.value == rw.id_dusun) {
                let opt = document.createElement('option');
                opt.value = rw.id;
                opt.innerText = rw.nomor;
                rwSelect.add(opt);

            }
        }
    }

    function changeRW() {
        let rwSelect = document.getElementsByName('rw')[0];
        let rtSelect = document.getElementsByName('rt')[0];
        removeOption(rtSelect);
        for(let rt of rt_data) {
            if(rwSelect.value == rt.id_rw) {
                let opt = document.createElement('option');
                opt.value = rt.id;
                opt.innerText = rt.nomor;
                rtSelect.add(opt);
            }
        }
    }

    document.getElementsByName('dusun')[0].addEventListener('change', changeDusun);
    document.getElementsByName('rw')[0].addEventListener('change', changeRW);

    function removeOption(select) {
        const len = select.options.length;
        for(i = len; i > 0; i--) {
            select.remove(i);
        }
    }

    let lastAction;
    let lastNikToEdit;

    function showForm(data) {
        if(data === 'insert') {
            if(lastAction !== 'insert') {
                resetForm();
            }
            lastAction = 'insert';
            let submitButton = document.querySelector('#formTambahDataPenduduk button[type="submit"]');
            submitButton.innerHTML = '<i class="fas fa-save"></i> Simpan';
            $('#modalTambahDataPenduduk').modal('show');
        } else {
            if(lastAction === 'insert') {
                resetForm();
            }
            lastAction = 'edit';
            if(lastNikToEdit !== data) {
                resetForm();
            }
            lastNikToEdit = data;
            let submitButton = document.querySelector('#formTambahDataPenduduk button[type="submit"]');
            submitButton.innerHTML = '<i class="fas fa-edit"></i> Simpan Perubahan';
            $('#modalTambahDataPenduduk').modal('show');

            const ajax = new XMLHttpRequest();
            ajax.onload = function() {
                setTimeout(function () {
                    try {
                        let response = JSON.parse(ajax.responseText);
                        if(ajax.status === 200) {
                            if(response.code === 0) {
                                document.querySelector('#modal-loading-tambah-data-penduduk').style.zIndex = -1;
                                let form = document.forms['formTambahDataPenduduk'];
                                form['nama'].value = response.data.nama;
                                form['nik'].value = response.data.nik;
                                form['nomor_kk'].value = response.data.nomor_kk;
                                form['jenis_kelamin'].value = response.data.id_jenis_kelamin;
                                form['tanggal_lahir'].value = response.data.tanggal_lahir;
                                form['tempat_lahir'].value = response.data.tempat_lahir;
                                form['hubungan_dalam_keluarga'].value = response.data.id_hubungan_dalam_keluarga;
                                form['agama'].value = response.data.id_agama;
                                form['pendidikan_terakhir'].value = response.data.id_pendidikan_terakhir;
                                form['pekerjaan'].value = response.data.id_pekerjaan;
                                form['status_perkawinan'].value = response.data.id_status_perkawinan;
                                form['status_penduduk'].value = response.data.id_status_penduduk;
                                form['nik_ayah'].value = response.data.nik_ayah;
                                form['nama_ayah'].value = response.data.nama_ayah;
                                form['nik_ibu'].value = response.data.nik_ibu;
                                form['nama_ibu'].value = response.data.nama_ibu;
                                form['dusun'].value = response.data.id_dusun;
                                changeDusun();
                                form['rw'].value = response.data.id_rw;
                                changeRW();
                                form['rt'].value = response.data.id_rt;
                                if(typeof response.data.foto !== 'undefined') {
                                    let pic = document.getElementById('preview-foto');
                                    while (pic.lastChild.id !== 'placeholder-foto') {
                                        pic.removeChild(pic.lastChild);
                                    }
                                    document.getElementById('placeholder-foto').style.display = "none";
                                    const img = document.createElement("img");
                                    img.classList.add("obj");
                                    img.src = response.data.foto;
                                    pic.appendChild(img);
                                }
                            } else {
                                toastr.error('Gagal mendapatkan data');
                                console.log(ajax.responseText);
                            }
                        } else {
                            toastr.error('Gagal mendapatkan data');
                            console.log(ajax.responseText);
                        }
                    } catch(e) {
                        toastr.error('Terjadi kesalahan');
                        console.log(e.message);
                        console.log(ajax.responseText);
                    }
                    document.querySelector('#modal-loading-tambah-data-penduduk').style.zIndex = -1;
                }, 600);
            };
            ajax.open("GET", "<?= $index_location ?>/services/penduduk.php?action=select&nik=" + data);
            ajax.send();
            document.querySelector('#modal-loading-tambah-data-penduduk').style.zIndex = 1;
        }
    }

    // preview thumbnail foto
    document.getElementById('input-file-foto').onchange = function () {
        let pic = document.getElementById('preview-foto');
        while (pic.lastChild.id !== 'placeholder-foto') {
            pic.removeChild(pic.lastChild);
        }
        document.getElementById('placeholder-foto').style.display = "none";

        const file = this.files[0];
        const img = document.createElement("img");
        img.classList.add("obj");
        img.file = file;
        document.getElementById('preview-foto').appendChild(img);

        const reader = new FileReader();
        reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
        reader.readAsDataURL(file);

        document.getElementById('label-file-foto').innerText = file.name;
    }

    function formIsValid() {
        let form = document.forms['formTambahDataPenduduk'];
        let valid =
            form['jenis_kelamin'].value != -1 &&
            form['hubungan_dalam_keluarga'].value != -1 &&
            form['agama'].value != -1 &&
            form['pendidikan_terakhir'].value != -1 &&
            form['pekerjaan'].value != -1 &&
            form['status_perkawinan'].value != -1 &&
            form['status_penduduk'].value != -1 &&
            form['dusun'].value != -1 &&
            form['rw'].value != -1 &&
            form['rt'].value != -1;
        return valid;
    }

    //Submit form tambah penduduk
    document.querySelector('#formTambahDataPenduduk').addEventListener('submit', function(event) {
        event.preventDefault();

        if(!formIsValid()) {
            toastr.warning('Data tidak lengkap');
            return;
        }
        let form = document.querySelector('#formTambahDataPenduduk');
        const ajax = new XMLHttpRequest();
        if(lastAction ==='insert') {
            ajax.open("POST", "<?= $index_location ?>/services/penduduk.php?action=insert&nik=" + form['nik'].value);
        } else {
            ajax.open("POST", "<?= $index_location ?>/services/penduduk.php?action=update&nik=" + lastNikToEdit);
        }

        ajax.onload = function () {
            setTimeout(function () {
                try {
                    let response = JSON.parse(ajax.responseText);
                    if(ajax.status === 200) {
                        if(response.code === 0) {
                            document.querySelector('#modal-loading-tambah-data-penduduk').style.zIndex = -1;
                            $('#modalTambahDataPenduduk').modal('hide');
                            if(lastAction ==='insert') {
                                toastr.success('Berhasil menambahkan data penduduk');
                            } else {
                                toastr.success('Berhasil mengubah data penduduk');
                            }
                            let table = $('#tabel-penduduk').DataTable();
                            $('#tabel-penduduk').DataTable().columns.adjust().draw();
                            resetForm();
                        } else if(response.code === -1) {
                            toastr.warning('Data sama, tidak ada yang diubah');
                            console.log(ajax.responseText);
                        }
                    } else {
                        toastr.error('Terjadi kesalahan');
                        console.log(ajax.responseText);
                    }
                } catch(e) {
                    toastr.error('Terjadi kesalahan');
                    console.log(e.message);
                    console.log(ajax.responseText);
                }
                document.querySelector('#modal-loading-tambah-data-penduduk').style.zIndex = -1;
            }, 300);
        };

        document.querySelector('#modal-loading-tambah-data-penduduk').style.zIndex = 1;
        let data = new FormData(form);
        ajax.send(data);
    });

    function resetForm() {
        document.getElementById('formTambahDataPenduduk').reset();
        document.getElementById('placeholder-foto').style.display = "block";
        let pic = document.getElementById('preview-foto');
        while (pic.lastChild.id !== 'placeholder-foto') {
            pic.removeChild(pic.lastChild);
        }
        document.getElementById('label-file-foto').innerText = "";
    }

    let idToDelete = null;

    function showDeleteConfirmation(id) {
        $('#deleteModal').modal('show');
        idToDelete = id;
    }

    function processDelete() {
        let xhr = new XMLHttpRequest();
        xhr.onload = function() {
            if(xhr.status === 200) {
                let response = JSON.parse(xhr.responseText);
                if (response.code == 0) {
                    $('#tabel-penduduk').DataTable().columns.adjust().draw();

                    $('#deleteModal').modal('hide');
                    Swal.fire(
                        'Sukses',
                        'Data berhasil dihapus',
                        'success'
                    );

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: xhr.responseText
                    });
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: xhr.responseText
                });
            }
        }
        xhr.open('GET', '<?= $index_location ?>/services/penduduk.php?action=delete&nik=' + idToDelete);
        xhr.send();
    }
</script>

<!--DataTables-->
<script>
    function format(d) {
        return '<div class="dt-row-detail">' +
            '<button type="button" class="dt-btn-row-detail btn btn-sm btn-warning" onclick="showForm(\'' + d.nik +'\')"><i class="fas fa-edit"></i> Edit</button>' +
            '<button type="button" class="dt-btn-row-detail btn btn-sm btn-danger" data-toggle="modal" onclick="showDeleteConfirmation(\'' + d.nik + '\')"><i class="fas fa-trash"></i> Hapus</button></div>';
    }

    let dt;

    const refreshTablePenduduk = function () {
        dt = $('#tabel-penduduk').DataTable({
            "processing": true,
            "serverSide": true,
            "scrollX" : true,
            "lengthMenu": [ 10, 20, 40, 80],
            "ajax": "services/DataTables/getPenduduk.php",
            "columns": [{
                "class": "details-control",
                "orderable": false,
                "data": null,
                "defaultContent": ""
            },
                {
                    "data": "nik"
                },
                {
                    "data": "nomor_kk"
                },
                {
                    "data": "nama"
                },
                {
                    "data": "jenis_kelamin"
                },
                {
                    "data": "tanggal_lahir"
                },
                {
                    "data": "tempat_lahir"
                },
                {
                    "data": "hubungan_dalam_keluarga"
                },
                {
                    "data": "agama"
                },
                {
                    "data": "pendidikan_terakhir"
                },
                {
                    "data": "pekerjaan"
                },
                {
                    "data": "status_perkawinan"
                },
                {
                    "data": "status_penduduk"
                },
                {
                    "data": "nik_ayah"
                },
                {
                    "data": "nama_ayah"
                },
                {
                    "data": "nik_ibu"
                },
                {
                    "data": "nama_ibu"
                },
                {
                    "data": "rt"
                },
                {
                    "data": "rw"
                },
                {
                    "data": "dusun"
                },
                {
                    "data": "tanggal_rekam"
                }

            ],
            "order": [
                [1, 'asc']
            ]
        });


        // Array to track the ids of the details displayed rows
        var detailRows = [];

        $('#tabel-penduduk tbody').on('click', 'tr[id^="row"]', function () {
            var tr = $(this).closest('tr');
            var row = dt.row(tr);
            var idx = $.inArray(tr.attr('id'), detailRows);

            if (row.child.isShown()) {
                tr.removeClass('details');
                row.child.hide();

                // Remove from the 'open' array
                detailRows.splice(idx, 1);
            } else {
                tr.addClass('details');
                row.child(format(row.data())).show();

                // Add to the 'open' array
                if (idx === -1) {
                    detailRows.push(tr.attr('id'));
                }
            }
        });

        // On each draw, loop over the `detailRows` array and show any child rows
        dt.on('draw', function () {
            dt.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
            $.each(detailRows, function (i, id) {
                $('#' + id + ' td.details-control').trigger('click');
            });
        });
    };

    $(document).ready(refreshTablePenduduk);
</script>
<script src="../dependencies/plugins/toastr/toastr.min.js"></script>