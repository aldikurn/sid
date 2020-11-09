<style>
    #tambahpemudik {
        display: grid;
        grid-template-areas:
            'fg-nik fg-nik'
            'fg-nama fg-ttl'
            'fg-alamat fg-asal'
            'fg-tujuan fg-durasi'
            'fg-status-covid19 fg-wajib-pantau'
            'fg-keluhan-kesehatan fg-keluhan-kesehatan'
            'fg-submit fg-submit';
        gap: 1rem;
    }
    
    #fg-nik {
        grid-area: fg-nik;
        display: grid;
        align-items: end;
        gap: 0.7em;
        grid-template-columns: 1fr 100px;
    }
    
    #fg-ttl {
        grid-area: fg-ttl;
    }

    #fg-alamat {
        grid-area: fg-alamat;
    }

    #fg-asal {
        grid-area: fg-asal;
    }

    #fg-tujuan {
        grid-area: fg-tujuan;
    }

    #fg-durasi {
        grid-area: fg-durasi;
    }

    #fg-status-covid19 {
        grid-area: fg-status-covid19;
    }

    #fg-wajib-pantau {
        grid-area: fg-wajib-pantau;
    }

    #fg-keluhan-kesehatan {
        grid-area: fg-keluhan-kesehatan;
    }

    #fg-submit {
        grid-area: fg-submit;
        display: flex;
        justify-content: flex-end;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <!-- <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-domisili-tab" data-toggle="tab" href="#nav-domisili" role="tab" aria-controls="nav-home" aria-selected="true">Domisili</a>
                        <a class="nav-item nav-link" id="nav-nondomisili-tab" data-toggle="tab" href="#nav-nondomisili" role="tab" aria-controls="nav-profile" aria-selected="false">Non Domisili</a>
                    </div>
                </nav> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-domisili" role="tabpanel" aria-labelledby="nav-home-tab"> -->
                                <form id="tambahpemudik" action="" method="POST">
                                    <div class="form-group" id="fg-nik">
                                        <div>
                                            <label>NIK <em style="font-weight: normal">(masuk menu daftar penduduk untuk melihat daftar nik)</em></label>
                                            <input type="text" class="form-control" placeholder="NIK" name="nik" required>
                                        </div>
                                        <a class="btn btn-default" id="cekdata">Cek Data</a>
                                    </div>
                                    <div class="form-group" id="fg-nama">
                                        <label>Nama</label>
                                        <input type="text" class="form-control"  name="nama" value="---" disabled required>
                                    </div>
                                    <div class="form-group" id="fg-ttl">
                                        <label>Tempat tanggal lahir</label>
                                        <input type="text" class="form-control" name="ttl" value="---" disabled required>
                                    </div>
                                    <div class="form-group" id="fg-alamat">
                                        <label>Alamat</label>
                                        <input type="text" class="form-control" name="alamat" value="---" disabled required>
                                    </div>
                                    <div class="form-group" id="fg-asal">
                                        <label>Kota Asal Pemudik</label>
                                        <input type="text" class="form-control" placeholder="Asal Pemudik" name="asal" required>
                                    </div>
                                    <div class="form-group" id="fg-tujuan">
                                        <label>Tujuan Pemudik</label>
                                        <select  class="form-control" name="tujuan" required>
                                            <option value="" selected disabled>Pilih Tujuan Pemudik</option>
                                            <option value="liburan">Liburan</option>
                                            <option value="menjenguk keluarga">Menjenguk Keluarga</option>
                                            <option value="pulang kampung">Pulang Kampung</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="fg-durasi">
                                        <label>Durasi Mudik (Hari)</label>
                                        <input type="number" class="form-control" name="durasi" value="0" required>
                                    </div>
                                    <div class="form-group" id="fg-status-covid19">
                                        <label>Status COVID19</label>
                                        <select  class="form-control" name="status-covid19" required>
                                            <option value="" selected disabled>Pilih Status COVID19</option>
                                            <option value="positif">Positif</option>
                                            <option value="pdp">Pasien Dalam Pengawasan (PDP)</option>
                                            <option value="odp">Orang Dalam Pemantauan (ODP)</option>
                                            <option value="odr">Orang Dalam Resiko (ODR)</option>
                                            <option value="otg">Orang Tanpa Gejala (OTG)</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="fg-wajib-pantau">
                                        <label>Wajib Pantau</label>
                                        <select  class="form-control" name="wajib-pantau" required>
                                            <option value="ya">Ya</option>
                                            <option value="tidak">Tidak</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="fg-keluhan-kesehatan">
                                        <label>Keluhan Kesehatan</label>
                                        <textarea class="form-control" name="keluhan-kesehatan" id="keluhan-kesehatan" rows="3" ></textarea>
                                    </div>
                                    <div class="form-group" id="fg-submit">
                                        <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                                    </div>
                                </form>
                            <!-- </div> -->
                            <!-- <div class="tab-pane fade" id="nav-nondomisili" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <p>Untuk menambahkan data baru penduduk non domisili, silahkan masuk ke menu daftar penduduk</p>
                                    <form action="" method="POST">
                                        <button type="submit" name="path" value="kependudukan/daftar-penduduk.php" class="btn btn-default">Pergi</button>
                                    </form>
                            </div> -->
                        <!-- </div>
                    </div> -->
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
    let form = document.forms['tambahpemudik'];
    let dataLengkap = false;
    document.getElementById('cekdata').addEventListener('click', function(event) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', '<?= $index_location ?>/services/penduduk.php?action=select&nik=' + form['nik'].value);
        xhr.onload = function() {
            if(xhr.status == 200) {
                try {
                    let response = JSON.parse(xhr.responseText);
                    if(response.code === 0) {
                        form['nama'].value = response.data.nama;
                        form['ttl'].value = response.data.tempat_lahir + ", " + response.data.tanggal_lahir;
                        form['alamat'].value = 'Dusun ' + response.data.nama_dusun + ' RW ' + response.data.nomor_rw + ' RT ' + response.data.nomor_rt;
                        dataLengkap = true;
                        toastr.success("Data ditemukan")
                    } else {
                        toastr.error("Data tidak ditemukan")
                        console.log(xhr.responseText);
                        console.log(e.message);
                    }
                } catch (e) {
                    toastr.error("Terjadi Kesalahan")
                    console.log(xhr.responseText);
                    console.log(e.message);
                }
            } else {
                toastr.error("Kesalahan sambungan ke server")
                console.log(xhr.responseText);
                console.log(e.message);
            }
        };
        xhr.send();
    });

    form['nik'].addEventListener('keypress', function(event) {
       form['nama'].value = '---';
       form['ttl'].value = '---';
       form['alamat'].value = '---';
       dataLengkap = false;
    });

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        if(dataLengkap) {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '<?= $index_location ?>/services/pemudik.php?action=insert&nik=' + form['nik'].value);
            xhr.onload = function() {
                if(xhr.status === 200) {
                    try {
                        let response = JSON.parse(xhr.responseText);
                        if(response.code === 0) {
                            resetForm();
                            toastr.success('Berhasil menambahkan data pemudik');
                        } else {
                            toastr.error("Terjadi Kesalahan")
                            console.log(xhr.responseText);
                        }
                    } catch(e) {
                        toastr.error("Terjadi Kesalahan")
                        console.log(xhr.responseText);
                        console.log(e.message);
                    }
                } else {
                    toastr.error("Terjadi kesalaahan saat menghubungi server")
                    console.log(xhr.responseText);
                    console.log(e.message);
                }
            }
            let formData = new FormData(form);
            xhr.send(formData);
        } else {
            toastr.warning('Data tidak lengkap');
        }
    });

    function resetForm() {
        form['nik'].value = '';
        form['nama'].value = '---';
        form['ttl'].value = '---';
        form['alamat'].value = '---';
        form['asal'].value = '';
        form['tujuan'].selectedIndex = 0;
        form['durasi'].value = 0;
        form['status-covid19'].selectedIndex = 0;
        form['wajib-pantau'].selectedIndex = 0;
        form['keluhan-kesehatan'].value = '';
    }
</script>
