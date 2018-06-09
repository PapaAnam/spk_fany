<body id="mimin" class="dashboard topnav">
  <input type="hidden" value="<?=$url ?>" class="url">
  <!-- start: Header -->
  <nav class="navbar navbar-default header navbar-fixed-top">
    <div class="col-md-12 nav-wrapper">
      <div class="navbar-header" style="width:100%;">
        <div class="navbar-brand">
          <div style="background-color: transparent; margin-top: -20px; box-shadow: 1px 1px 10px black; border-radius: 0 0 20px 20px; border: 5px solid #ee3333;">
            <a href="index.html" style="margin-top: -10px;">
              <img style="border-radius: 0 0 20px 20px;" src="<?=base_url().'images/app/logo.png' ?>" width="100px" height="100px">
            </a>
          </div>
        </div>
        <ul class="nav navbar-nav search-nav">
          <li
            <?php
            $a = ['beranda'];
            if(in_array($this->uri->segment(2), $a) || $this->uri->segment(2)==false){
              echo 'class="active"';
            }
            ?>>
            <a href="<?= base_url() ?>"><span class="fa-home fa"></span> Beranda</a>
          </li>
          <?php if($this->session->userdata('level')=='1'){?>
            <li class="dropdown
              <?php
              $b = ['pengguna', 'divisi', 'jabatan', 'karyawan', 'absensi', 'pinjaman', 'lembur'];
              if(in_array($this->uri->segment(2), $b)){
                echo 'active';
              }
              ?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-database"></span> Master Data <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?= $url ?>pengguna">Data Pengguna</a></li>
                <li><a href="<?= $url ?>jabatan">Data Jabatan</a></li>
                <li><a href="<?= base_url() ?>karyawan">Data Karyawan</a></li>
                <li><a href="<?= $url ?>absensi">Data Absensi</a></li>
                <li><a href="<?= $url ?>pinjaman">Data Pinjaman</a></li>
              </ul>
            </li>
            <li
              <?php
              $b = ['penggajian'];
              if(in_array($this->uri->segment(2), $b)){
                echo 'class="active"';
              }
              ?>>
              <a class="nav-header" href="<?= base_url() ?>penggajian"><span class="fa fa-dollar"></span> Penggajian</a>
            </li>
          <?php } ?>
          <?php if($this->session->userdata('level')=='3'){?>
            <li class="dropdown
              <?php
              $b = ['absensi', 'pinjaman', 'lembur', 'penggajian'];
              if(in_array($this->uri->segment(2), $b)){
                echo 'active';
              }
              ?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-database"></span> Informasi Data <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?= $url ?>absensi">Absensiku</a></li>
                <li><a href="<?= $url ?>pinjaman">Pinjamanku</a></li>
                <!-- <li><a href="<?= $url ?>lembur">Lemburku</a></li> -->
                <li><a href="<?= base_url() ?>penggajian">Gajiku</a></li>
              </ul>
            </li>
          <?php } ?>
          <?php if($this->session->userdata('level')==2){?>
            <li class="dropdown
              <?php
              $c = ['rekapdivisi', 'rekapjabatan', 'rekapkaryawan', 'rekapabsensi', 'rekappinjaman', 'rekaplembur', 'rekapgaji'];
              if(in_array($this->uri->segment(2), $c)){
                echo 'active';
              }
              ?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-print"></span> Rekap Data <span class="caret"></span></a>
              <ul class="dropdown-menu">
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
        </ul>
        <ul class="nav navbar-nav navbar-right user-nav">
          <li class="user-name">
            <span>Selamat Datang <?= $nickname?>  
            </span>
          </li>
          <li class="dropdown avatar-dropdown">
            <?php 
            if(!file_exists('images/pengguna/'.$this->session->userdata('foto_pengguna')) OR $this->session->userdata('foto_pengguna') == ''){
              $this->load->helper('dummy');
              $foto_pengguna = base_url('images/users/'.random(range(1,9)).'.png');
            }
              ?>
            <img src="<?= $foto_pengguna ?>" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
            <ul class="dropdown-menu user-dropdown">
              <li><a class="mdl" id="<?= $myprofil?>">
                <span class="fa fa-edit"></span> Profil Saya</a>
              </li>
              <?php if($lvl==3){?>
                <li><a class="mdl" id="<?=$url?>ubahsandi/">
                  <span class="fa fa-lock"></span> Ubah Sandi</a>
                </li>
              <?php } ?>
              <li><a href="<?= $url ?>keluar"><span class="fa fa-power-off "></span> Keluar</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="row" style="margin-top: 70px;">
    <div class="col-md-8 col-md-offset-2">
      <div class="alert alert-danger">
        <h4 class="text-center">Selamat Datang Di Sistem Penggajian Karyawan</h4>
      </div>
    </div>
  </div>
<!-- end: Header -->
<!--modal-->
<div id="mymodal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php 
if($this->config->item('full_view')):
  ?>
<div class="container-fluid">
<?php else :
?>
<div class="container">
<?php endif?>