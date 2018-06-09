<div id="content">
  <div class="row">
    <?php if($this->session->userdata('level')!=3){ ?>
    <div class="col-md-6">
      <div class="panel">
        <div class="panel-heading">
          <h3>Data</h3>
        </div>
        <div class="panel-body">
          <div class="responsive-table">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th width="10px">No</th>
                  <th>Master Data</th>
                  <th>Jumlah</th>
                  <?php if($this->session->userdata('level')=='1'){?><th>Aksi</th><?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $datamaster = ['jabatan', 'karyawan', 'pinjaman', 'absensi', 'penggajian'];
                $no = 1;
                foreach ($datamaster as $d) {
                  ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= ucfirst($d) ?></td>
                    <td>
                      <span class="badge badge-danger"><?php eval("echo $".$d.";");?></span>
                    </td>
                    <?php if($this->session->userdata('level')=='1'){?>
                    <td>
                      <a class="btn btn-primary" href="<?= $url.$d ?>">Lihat Data</a>
                    </td>
                    <?php } ?>
                  </tr>
                  <?php $no++;
                } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="panel">
        <div class="panel-heading"><h3>Karyawan Baru</h3></div>
        <div class="panel-body">
          <div class="responsive-table">
            <table class="table table-hover" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIP Karyawan</th>
                  <th>Nama</th>
                  <th>Jabatan</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1;foreach($kar as $k){?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $k->nip_karyawan ?></td>
                  <td><?= $k->nama_karyawan ?></td>
                  <td><?= $k->nama_jabatan ?></td>
                </tr>
                <?php $no++;} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <?php }else{ ?>
    <div class="col-md-6">
      <div class="panel">
        <div class="panel-heading"><h3>Rincian Saya</h3></div>
        <div class="panel-body">
          <div class="responsive-table">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th width="50px">No</th>
                  <th width="250px">Keterangan</th>
                  <th>Jumlah</th>
                  <?php if($this->session->userdata('level')=='1'){?>
                  <th>Aksi</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1. </td>
                  <td>Absensi bulan ini</td>
                  <td>
                    <a class="label label-info" href="<?=$url?>absensi"><?= $absensi ?></a>
                  </td>
                </tr>
                <tr>
                  <td>2. </td>
                  <td>Pinjaman bulan ini</td>
                  <td>
                    <a class="label label-info" href="<?=$url?>pinjaman"><?= rupiah($pinjaman) ?></a>
                  </td>
                </tr>
                <tr>
                  <td>3. </td>
                  <td>Gaji bulan kemarin</td>
                  <td>
                    <a class="label label-info" href="<?=$url?>penggajian"><?= rupiah($gajikemarin) ?></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="panel">
        <div class="panel-heading"><h3>Absensi</h3></div>
        <div class="panel-body">
          <div class="responsive-table">
            <div class="row">
              <div class="col-md-6">
                <div class="absensi-baru"></div>
              </div>
              <div class="col-md-6">
                <?php
                if(count($this->AbsensiModel->cek_absensi_hari_ini())>0){
                  if(count($this->AbsensiModel->cek_absensi_keluar())>0){
                    echo '';
                  }else{
                    ?>
                    <a href="#" onclick="getElementById('absensi-keluar').submit()" class="btn btn-danger"><span class="icons icon-logout"></span> Keluar</a>
                    <form id="absensi-keluar" action="<?=base_url('absensi/absensi_keluar') ?>" method="post">
                      <!-- <input type="hidden" value="Masuk" name="status_absensi"> -->
                    </form>
                    <?php 
                  }
                }else{
                  ?>
                  <a href="#" onclick="getElementById('absensi-masuk').submit()" class="btn btn-primary"><span class="icons icon-login"></span> Masuk</a>
                  <form id="absensi-masuk" action="<?=base_url('absensi/absensi_masuk') ?>" method="post">
                    <input type="hidden" value="Masuk" name="status_absensi">
                  </form>
                  <?php  
                } ?>
              </div>
              <div class="col-md-12">
                <table class="table">
                  <thead>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                  </thead>
                  <tbody>
                    <?php $abs = $this->AbsensiModel->absensi_hari_ini(); ?>
                    <tr>
                      <td><?= $abs->jam_masuk_absensi; ?></td>
                      <td><?= $abs->jam_keluar_absensi ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<?php if($this->session->flashdata('msg_password')){ ?>
<div class="col-md-12">
  <div class="alert alert-success alert-border alert-dismissible fade in" role="alert">
    <h3>
      <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </h3>
    <?= $this->session->flashdata('msg_password') ?>
  </div>
</div>
<?php } ?>