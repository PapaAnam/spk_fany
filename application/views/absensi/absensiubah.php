<form class="cmxform" method="post" action="<?=$action?>" enctype="multipart/form-data">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h4>Ubah Absensi
          <input class="submit btn btn-primary" type="submit" value="Simpan" name="simpan">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </h4>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Karyawan</label>
              <select class="form-control" name="nip_karyawan">
                <?php
                foreach ($kar as $k) {
                  if($abs['nip_karyawan'] === $k->nip_karyawan){
                    echo '<option value="'.$k->nip_karyawan.'" selected>'.$k->nip_karyawan.' ('.$k->nama_karyawan.')</option>';
                  }else{
                    echo '<option value="'.$k->nip_karyawan.'">'.$k->nip_karyawan.' ('.$k->nama_karyawan.')</option>';
                  }
                }
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Status</label>
              <select onchange="typejam(this.value)" id="statusabsensi" class="form-control" name="status_absensi">
                <option <?php if($abs['status_absensi']==='Masuk'){echo 'selected';}?>>Masuk</option>
                <option <?php if($abs['status_absensi']==='Ijin'){echo 'selected';}?>>Ijin</option>
                <option <?php if($abs['status_absensi']==='Cuti'){echo 'selected';}?>>Cuti</option>
                <option <?php if($abs['status_absensi']==='Alpa'){echo 'selected';}?>>Alpa</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group form-animate-text">
              <input type="text" class="form-text dateAnimate" name="tgl_absensi" required value="<?= $abs['tgl_absensi'] ?>">
              <span class="bar"></span>
              <label>Tanggal</label>
            </div>
          </div>
          <div class="col-md-4 jam">
            <div class="form-group form-animate-text">
              <input onblur="cekjam(this.value, this.id)" id="jm" type="text" class="form-text mask-time" name="jam_masuk_absensi" value="<?= $abs['jam_masuk_absensi'] ?>">
              <span class="bar"></span>
              <label>Jam Masuk</label>
            </div>
          </div>
          <div class="col-md-4 jam">
            <div class="form-group form-animate-text">
              <input onblur="cekjam(this.value, this.id)" id="jk" type="text" class="form-text mask-time" name="jam_keluar_absensi" value="<?= $abs['jam_keluar_absensi'] ?>">
              <span class="bar"></span>
              <label>Jam Keluar</label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group form-animate-text">
              <textarea class="form-text" name="keterangan_absensi" ><?= $abs['keterangan_absensi'] ?></textarea>
              <span class="bar"></span>
              <label>Keterangan</label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>