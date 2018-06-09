<form class="cmxform" method="post" action="<?=$action?>" enctype="multipart/form-data">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h4>Tambah Absensi
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
                  echo '<option value="'.$k->nip_karyawan.'">'.$k->nip_karyawan.' ('.$k->nama_karyawan.')</option>';
                }
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Status</label>
              <select onchange="typejam(this.value)" id="statusabsensi" class="form-control" name="status_absensi">
                <option>Masuk</option>
                <option>Ijin</option>
                <option>Cuti</option>
                <option>Alpa</option>
                <option>Libur</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group form-animate-text">
              <input type="text" class="form-text dateAnimate" name="tgl_absensi" required value="<?= tglskrng() ?>">
              <span class="bar"></span>
              <label>Tanggal</label>
            </div>
          </div>
          <div class="col-md-4 jam">
            <div class="form-group form-animate-text">
              <input type="text" onblur="cekjam(this.value, this.id)" id="jm" class="form-text mask-time" name="jam_masuk_absensi">
              <span class="bar"></span>
              <label>Jam Masuk</label>
            </div>
          </div>
          <div class="col-md-4 jam">
            <div class="form-group form-animate-text">
              <input type="text" onblur="cekjam(this.value, this.id)" id="jk" class="form-text mask-time" name="jam_keluar_absensi">
              <span class="bar"></span>
              <label>Jam Keluar</label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group form-animate-text">
              <textarea class="form-text" name="keterangan_absensi"  ></textarea>
              <span class="bar"></span>
              <label>Keterangan</label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>