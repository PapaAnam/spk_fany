<div id="content">
  <div class="row">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3><?php if($this->session->userdata('level')!=3){?>Data Absensi 
            <a class="mdl btn btn-primary" id="<?= $url ?>absensitambah">Tambah</a>
            <?php }else{echo 'Absensiku';} ?>
          </h3>
        </div>
        <div class="panel-body">
          <div class="responsive-table">
            <table id="datatables-example" class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <?php if($lvl!=3){?>
                  <th>ID Absensi</th>
                  <th>NIP Karyawan (Nama)</th>
                  <?php } ?>
                  <th>Tanggal</th>
                  <th>Status</th>
                  <th>Jam Masuk</th>
                  <th>Jam Keluar</th>
                  <?php 
                  if($this->session->userdata('level')!=3){
                    echo '<th width="100px">Aksi</th>';
                  }
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach($abs as $a){?>
                <tr>
                  <?php if($lvl!=3){?>
                  <td><?= $a->id_absensi ?></td>
                  <td><?= $a->nip_karyawan.' ('.$a->nama_karyawan.')' ?></td>
                  <?php } ?>
                  <td><?= tglIndo($a->tgl_absensi) ?></td>
                  <td><?= $a->status_absensi ?></td>
                  <td><?= cekjam($a->jam_masuk_absensi) ?></td>
                  <td><?= cekjam($a->jam_keluar_absensi) ?></td>
                  <?php if($this->session->userdata('level')!=3){?>
                  <td>
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pilih Aksi
                        <span class="fa fa-angle-down"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="mdl" id="<?= $url.'absensiubah/'.$a->id_absensi ?>">Ubah</a></li>
                        <li><a class="mdl" id="<?= $url.'absensihapus/'.$a->id_absensi ?>">Hapus</a></li>
                      </ul>
                    </div>
                  </td>
                  <?php } ?>
                </tr>
                <?php $no++; } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>