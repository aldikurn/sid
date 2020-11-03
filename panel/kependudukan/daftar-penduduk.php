<style>
    #modal-body-tambah-data-penduduk {
        display: grid;
        grid-template-areas:
            'preview-foto preview-foto fg-input-foto fg-input-foto fg-input-foto fg-input-foto'
            'preview-foto preview-foto fg-nama fg-nama fg-nama fg-nama'
            'preview-foto preview-foto fg-nik fg-nik fg-nik fg-nik'
            'preview-foto preview-foto fg-kk fg-kk fg-kk fg-kk'
            'fg-jenis-kelamin fg-jenis-kelamin fg-tanggal-lahir fg-tanggal-lahir fg-tempat-lahir fg-tempat-lahir'
            'fg-hubungan-dalam-keluarga fg-hubungan-dalam-keluarga fg-agama fg-agama fg-pendidikan-terakhir fg-pendidikan-terakhir'
            'fg-pekerjaan fg-pekerjaan fg-pekerjaan fg-status-perkawinan fg-status-perkawinan fg-status-perkawinan'
            'fg-nik-ayah fg-nik-ayah fg-nik-ayah fg-nama-ayah fg-nama-ayah fg-nama-ayah'
            'fg-nik-ibu fg-nik-ibu fg-nik-ibu fg-nama-ibu fg-nama-ibu fg-nama-ibu'
            'fg-dusun fg-dusun fg-rw fg-rw fg-rt fg-rt';
        gap: 0.5em;
    }

    #preview-foto {
        position: relative;
        grid-area: preview-foto;
        border: 1px solid #ced4da;
        border-radius: 5px;
    }

    #label-foto {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #ced4da;
        font-size: 2em;
        user-select: none;
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

</style>
<div class="row">
    <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modalTambahDataPenduduk" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah data penduduk</button>
                    <form method="post" id="formTambahDataPenduduk">
                        <div class="modal fade" id="modalTambahDataPenduduk">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tambah data penduduk</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div id="modal-body-tambah-data-penduduk" class="modal-body">
                                        <div id="preview-foto">
                                            <span id="label-foto">3 X 4</span>
                                        </div>
                                        <div class="form-group" id="fg-input-foto">
                                            <label>Pilih foto</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="foto">
                                                <label class="custom-file-label">IMG_4178.png</label>
                                            </div>
                                        </div>
                                        <div class="form-group" id="fg-nama">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" placeholder="Nama" name="nama">
                                        </div>
                                        <div class="form-group" id="fg-nik">
                                            <label>NIK</label>
                                            <input type="number" class="form-control" placeholder="NIK" name="nik">
                                        </div>
                                        <div class="form-group" id="fg-kk">
                                            <label>Nomor KK</label>
                                            <input type="number" class="form-control" placeholder="Nomor KK" name="kk">
                                        </div>
                                        <div class="form-group" id="fg-jenis-kelamin">
                                            <label>Jenis Kelamin</label>
                                            <select class="form-control" name="jenis_kelamin">
                                                <option>Laki-Laki</option>
                                                <option>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="fg-tanggal-lahir">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" class="form-control" placeholder="Tanggal Lahir" name="tanggal_lahir">
                                        </div>
                                        <div class="form-group" id="fg-tempat-lahir">
                                            <label>Tempat Lahir</label>
                                            <input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir">
                                        </div>
                                        <div class="form-group" id="fg-hubungan-dalam-keluarga">
                                            <label>Hubungan Dalam Keluarga</label>
                                            <select class="form-control"name="hubungan_dalam_keluarga">
                                                <option>Suami</option>
                                                <option>Istri</option>
                                                <option>Anak</option>
                                                <option>Cucu</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="fg-agama">
                                            <label>Agama</label>
                                            <select class="form-control" name="agama">
                                                <option>Islam</option>
                                                <option>Kristen</option>
                                                <option>Khatolik</option>
                                                <option>Hindu</option>
                                                <option>Budha</option>
                                                <option>Konghucu</option>
                                                <option>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="fg-pendidikan-terakhir">
                                            <label>Pendidikan Terakhir</label>
                                            <select class="form-control" name="pendidikan_terakhir">
                                                <option>Belum Sekolah</option>
                                                <option>SD</option>
                                                <option>SMP</option>
                                                <option>SMA</option>
                                                <option>D1</option>
                                                <option>D2</option>
                                                <option>S3</option>
                                                <option>S1</option>
                                                <option>S2</option>
                                                <option>S3</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="fg-pekerjaan">
                                            <label>Pekerjaan</label>
                                            <select class="form-control" name="pekerjaan">
                                                <option Value="1">Belum/Tidak Bekerja</option>
                                                <option Value="2">Mengurus Rumah Tangga</option>
                                                <option Value="3">Pelajar/Mahasiswa</option>
                                                <option Value="4">Pensiunan</option>
                                                <option Value="5">Pegawai Negeri Sipil (PNS)</option>
                                                <option Value="6">Tentara Nasional Indonesia (TNI)</option>
                                                <option Value="7">Kepolisian RI (POLRI)</option>
                                                <option Value="8">Wiraswasta</option>
                                                <option Value="9">Wirausaha</option>
                                                <option Value="10">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="fg-status-perkawinan">
                                            <label>Status Perkawinan</label>
                                            <select class="form-control" name="status_perkawinan">
                                                <option>Belum Kawin</option>
                                                <option>Kawin</option>
                                                <option>Cerai Hidup</option>
                                                <option>Cerai Mati</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="fg-nik-ayah">
                                            <label>NIK Ayah</label>
                                            <input type="number" class="form-control" placeholder="NIK Ayah" name="nik_ayah">
                                        </div>
                                        <div class="form-group" id="fg-nama-ayah">
                                            <label>Nama Ayah</label>
                                            <input type="text" class="form-control" placeholder="Nama Ayah" name="nama_ayah">
                                        </div>
                                        <div class="form-group" id="fg-nik-ibu">
                                            <label>NIK Ibu</label>
                                            <input type="number" class="form-control" placeholder="NIK Ibu" name="nik_ibu">
                                        </div>
                                        <div class="form-group" id="fg-nama-ibu">
                                            <label>Nama Ibu</label>
                                            <input type="text" class="form-control" placeholder="Nama Ibu" name="nama_ibu">
                                        </div>
                                        <div class="form-group" id="fg-dusun">
                                            <label>Dusun</label>
                                            <select class="form-control" name="dusun">
                                                <option>Dusun 1</option>
                                                <option>Dusun 2</option>
                                                <option>Dusun 3</option>
                                                <option>Dusun 4</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="fg-rw">
                                            <label>RW</label>
                                            <select class="form-control" name="rw">
                                                <option>RW 1</option>
                                                <option>RW 2</option>
                                                <option>RW 3</option>
                                                <option>RW 4</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="fg-rt">
                                            <label>RT</label>
                                            <select class="form-control" name="rt">
                                                <option>RT 1</option>
                                                <option>RT 2</option>
                                                <option>RT 3</option>
                                                <option>RT 4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                                        <button type="submit" class="btn btn-primary" ><i class="fas fa-save"></i> Simpan</button>
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
                <table id="example" class="table table-bordered table-hover" style="min-width: 100%">
                    <thead class="thead-light">
                    <tr>
                        <th></th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Address</th>
                        <th>Phone</th>
                    </tr>
                    </thead>
                </table>
            </div><!-- /.card-body -->
        </div> <!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->


<script>
    //window.onload = function() {
    //    const ajax = new XMLHttpRequest();
    //    ajax.onload = function() {
    //        if(ajax.status === 200) {
    //
    //        } else {
    //            //toastr.error('Gagal, error code : ' + ajax.status);
    //        }
    //    };
    //    ajax.open("GET", "http://<?//= $index_location ?>///services/ajax/getRequiredFieldDataPenduduk.php");
    //    ajax.send();
    //}

    document.querySelector('#formTambahDataPenduduk').addEventListener('submit', function(event) {
       event.preventDefault();

        const ajax = new XMLHttpRequest();
        ajax.onload = function () {
            if(ajax.status === 200) {
                setTimeout(function() {
                    document.querySelector('#modal-loading-tambah-data-penduduk').style.zIndex = -1;
                    $('#modalTambahDataPenduduk').modal('hide');
                    toastr.success('Berhasil menambahkan data penduduk <br>' + ajax.responseText);
                }, 300);
            } else {
                document.querySelector('#modal-loading-tambah-data-penduduk').style.zIndex = -1;
                toastr.error('Gagal, error code : <br>' + ajax.responseText);
            }
        };

        document.querySelector('#modal-loading-tambah-data-penduduk').style.zIndex = 1;
        ajax.open("POST", "http://<?= $index_location ?>/services/ajax/simpanDataPenduduk.php");
        ajax.send();
    });
</script>

<!--DataTables-->
<script>
    function format(d) {
        return '<div class="dt-row-detail">' +
            '<button type="button" class="dt-btn-row-detail btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</button>' +
            '<button type="button" class="dt-btn-row-detail btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button></div>';

    }

    $(document).ready(function () {

        var dt = $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "scrollX" : true,
            "ajax": "services/ajax/getPendudukDT.php",
            "columns": [{
                "class": "details-control",
                "orderable": false,
                "data": null,
                "defaultContent": ""
            },
                {
                    "data": "first_name"
                },
                {
                    "data": "last_name"
                },
                {
                    "data": "address"
                },
                {
                    "data": "phone"
                }
            ],
            "order": [
                [1, 'asc']
            ]
        });


        // Array to track the ids of the details displayed rows
        var detailRows = [];

        $('#example tbody').on('click', 'tr', function () {
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
    });
</script>
<script src="../dependencies/plugins/toastr/toastr.min.js"></script>