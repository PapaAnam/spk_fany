<!-- start:Left Menu -->
<div id="left-menu">
    <div class="sub-left-menu scroll">
        <ul class="nav nav-list">
            <li class="">
                <a class="nav-header" href="<?= base_url() ?>tommy/beranda"><span class="fa-home fa"></span> Beranda
            
          </a>
            </li>
            <li class="ripple">
                <a class="tree-toggle nav-header">
                    <span class="fa-diamond fa"></span> Master Data
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree">
                    <li><a href="<?= $url ?>pengguna">Data Pengguna</a></li>
                    <li><a href="<?= $url ?>divisi">Data Divisi</a></li>
                    <li><a href="<?= $url ?>jabatan">Data Jabatan</a></li>
                    <li><a href="<?= $url ?>karyawan">Data Karyawan</a></li>
                    <li><a href="<?= $url ?>absensi">Data Absensi</a></li>
                    <li><a href="<?= $url ?>pinjaman">Data Pinjaman</a></li>
                    <li><a href="<?= $url ?>lembur">Data Lembur</a></li>
                </ul>
            </li>
            <li class="">
                <a class="nav-header" href="<?= base_url() ?>tommy/penggajian"><span class="fa-edit fa"></span> Penggajian
            
          </a>
            </li>
            <li class="ripple">
                <a class="tree-toggle nav-header">
                    <span class="fa-print fa"></span> Rekap
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree">
                    <li><a href="<?= $url ?>rekapdivisi">Rekap Divisi</a></li>
                    <li><a href="<?= $url ?>rekapjabatan">Rekap Jabatan</a></li>
                    <li><a href="<?= $url ?>rekapkaryawan">Rekap Karyawan</a></li>
                    <li><a href="<?= $url ?>rekapabsensi">Rekap Absensi</a></li>
                    <li><a href="<?= $url ?>rekappinjaman">Rekap Pinjaman</a></li>
                    <li><a href="<?= $url ?>rekaplembur">Rekap Lembur</a></li>
                    <li><a href="<?= $url ?>rekapgaji">Rekap Gaji</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- end: Left Menu -->