<form class="cmxform" method="post" action="<?=$action?>" enctype="multipart/form-data">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h4>Tambah Pinjaman
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
              <select class="form-control" name="status_pinjaman">
                <option>Belum Lunas</option>
                <option>Lunas</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-animate-text">
              <input type="text" class="form-text dateAnimate" name="tgl_pinjaman" required value="<?= tglskrng() ?>">
              <span class="bar"></span>
              <label>Tanggal</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-animate-text">
              <input type="text" class="form-text mask-money" name="besar_pinjaman" required >
              <span class="bar"></span>
              <label>Besar Pinjaman (Rp)</label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group form-animate-text">
              <textarea class="form-text" name="keterangan_pinjaman" required ></textarea>
              <span class="bar"></span>
              <label>Keterangan</label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>