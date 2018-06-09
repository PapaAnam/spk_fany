<form class="cmxform" method="post" action="<?=$action?>" enctype="multipart/form-data">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h4>Tambah Jabatan
          <input class="submit btn btn-primary" type="submit" value="Simpan" name="simpan">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </h4>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group form-animate-text">
              <input type="text" class="form-text" name="nama_jabatan" required value="<?= $jab['nama_jabatan'] ?>">
              <span class="bar"></span>
              <label>Nama</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-animate-text">
              <input type="text" class="form-text mask-money" name="gaji_pokok" required value="<?= $jab['gaji_pokok'] ?>">
              <span class="bar"></span>
              <label>Gaji Pokok (Rp)</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-animate-text">
              <input type="text" class="form-text mask-money" name="tunjangan" required value="<?= $jab['tunjangan'] ?>">
              <span class="bar"></span>
              <label>Tunjangan (Rp)</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-animate-text">
              <input type="text" class="form-text mask-money" name="transportasi" required value="<?= $jab['transportasi'] ?>">
              <span class="bar"></span>
              <label>Transportasi</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-animate-text">
              <input type="text" class="form-text mask-money" name="pulsa" required value="<?= $jab['pulsa'] ?>">
              <span class="bar"></span>
              <label>Pulsa</label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>