<!-- start: Mobile -->
<div id="mimin-mobile" class="reverse">
  <div class="mimin-mobile-menu-list">
    <div class="col-md-12 sub-mimin-mobile-menu-list animated fadeInLeft">
      <ul class="nav nav-list">
        <li>
          <a href="<?= base_url() ?>"><span class="fa-home fa"></span> Beranda</a>
        </li>
        <?php if($this->session->userdata('level')=='1'){?>
        <li class="ripple">
          <a class="tree-toggle nav-header">
            <span class="fa-diamond fa"></span> Master Data
            <span class="fa-angle-right fa right-arrow text-right"></span>
          </a>
          <ul class="nav nav-list tree">
	          <li><a href="<?= $url ?>pengguna">Data Pengguna</a></li>
	          <!-- <li><a href="<?= $url ?>divisi">Data Divisi</a></li> -->
	          <li><a href="<?= $url ?>jabatan">Data Jabatan</a></li>
	          <li><a href="<?= base_url() ?>karyawan">Data Karyawan</a></li>
	          <li><a href="<?= $url ?>absensi">Data Absensi</a></li>
	          <li><a href="<?= $url ?>pinjaman">Data Pinjaman</a></li>
	          <!-- <li><a href="<?= $url ?>lembur">Data Lembur</a></li> -->
          </ul>
        </li>
        <li>
          <a href="<?= base_url() ?>penggajian"><span class="fa fa-dollar"></span> Penggajian</a>
        </li>
        <?php } ?>
        <?php if($this->session->userdata('level')!=3){?>
          <li class="ripple">
            <a class="tree-toggle nav-header">
              <span class="fa-print fa"></span> Rekap Data
              <span class="fa-angle-right fa right-arrow text-right"></span>
            </a>
            <ul class="nav nav-list tree">
  	          <!-- <li><a href="<?= $url ?>rekapdivisi">Rekap Divisi</a></li> -->
                <li><a href="<?= $url ?>rekapjabatan">Rekap Jabatan</a></li>
                <li><a href="<?= $url ?>rekapkaryawan">Rekap Karyawan</a></li>
                <li><a href="<?= $url ?>rekapabsensi">Rekap Absensi</a></li>
                <li><a href="<?= $url ?>rekappinjaman">Rekap Pinjaman</a></li>
                <!-- <li><a href="<?= $url ?>rekaplembur">Rekap Lembur</a></li> -->
                <li><a href="<?= $url ?>rekapgaji">Rekap Gaji</a></li>
            </ul>
          </li>
        <?php } ?>
        <?php if($this->session->userdata('level')=='3'){?>
          <li class="ripple">
            <a class="tree-toggle nav-header">
              <span class="fa fa-database"></span> Informasi Data
              <span class="fa-angle-right fa right-arrow text-right"></span>
            </a>
            <ul class="nav nav-list tree">
              <li><a href="<?= $url ?>absensi">Absensiku</a></li>
              <li><a href="<?= $url ?>pinjaman">Pinjamanku</a></li>
              <!-- <li><a href="<?= $url ?>lembur">Lemburku</a></li> -->
              <li><a href="<?= $url ?>penggajian">Gajiku</a></li>
            </ul>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>       
</div>
<button id="mimin-mobile-menu-opener" class="animated rubberBand btn btn-circle btn-danger">
  <span class="fa fa-bars"></span>
</button>
 <!-- end: Mobile -->