<?php
include_once('PageReference.php');
include_once('PageReferenceComposite.php');

$pages = array(
    new PageReference('Dashboard', 'dashboard/dashboard.php', 'nav-icon fas fa-home'),
    new PageReferenceComposite('Isolasi COVID19 Desa', 'nav-icon fas fa-virus',
        array(
            new PageReference('Tambah Pemudik', 'covid19/tambah-pemudik.php', 'fas fa-table nav-icon'),
            new PageReference('Pantau Pemudik', 'covid19/pemantauan.php', 'fas fa-user-cog nav-icon')
        )
    ),
    new PageReferenceComposite('Administrasi Desa', 'nav-icon fas fa-toolbox',
        array(
            new PageReference('Identitas Desa', 'administrasi-desa/identitas-desa.php', 'fas fa-id-card nav-icon'),
            new PageReference('Dusun', 'administrasi-desa/dusun.php', 'fas fa-map nav-icon'),
            new PageReference('Perangkat Desa', 'administrasi-desa/perangkat-desa.php', 'fas fa-user-tie nav-icon')
        )
    ),
    new PageReferenceComposite('Kependudukan', 'nav-icon fas fa-users-cog',
        array(
            new PageReference('Daftar Penduduk', 'kependudukan/daftar-penduduk.php', 'fas fa-user nav-icon'),
            new PageReference('Daftar Keluarga', 'kependudukan/daftar-keluarga.php', 'fas fa-users nav-icon')
        )
    ),
    new PageReference('History Aktivitas', 'history-aktifitas/history-aktifitas.php', 'nav-icon fas fa-history'),
    new PageReferenceComposite('Statistik', 'nav-icon fas fa-chart-line',
        array(
            new PageReference('Umur', 'statistik-penduduk/umur.php', 'far fa-circle nav-icon'),
            new PageReference('Pendidikan', 'statistik-penduduk/pendidikan.php', 'far fa-circle nav-icon'),
            new PageReference('Pekerjaan', 'statistik-penduduk/pekerjaan.php', 'far fa-circle nav-icon'),
            new PageReference('Status Perkawinan', 'statistik-penduduk/status-perkawinan.php', 'far fa-circle nav-icon'),
            new PageReference('Agama', 'statistik-penduduk/agama.php', 'far fa-circle nav-icon'),
            new PageReference('Jenis Kelamin', 'statistik-penduduk/jenis-kelamin.php', 'far fa-circle nav-icon'),
            new PageReference('Hubungan dalam KK', 'statistik-penduduk/hubungan-dalam-kk.php', 'far fa-circle nav-icon')
        )
    ),
    new PageReference('Laporan Bulanan', 'laporan-bulanan/laporan-bulanan.php', 'fas fa-file-medical-alt nav-icon'),
);

function printPages($pages) {
    foreach ($pages as $page) :
        if($page instanceof PageReferenceComposite) {
            echo '<strong>' . $page->title . '</strong><br>';
            printPages($page->subMenu);
        } else {
            echo $page->title . '<br>';
        }
    endforeach;
}

