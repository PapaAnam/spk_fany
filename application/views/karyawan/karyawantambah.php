<form onsubmit="cekkaryawan(event)" class="cmxform" method="post" action="<?=$action?>" enctype="multipart/form-data">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h4>Tambah Karyawan
          <input class="submit btn btn-primary" type="submit" value="Simpan" name="simpan">
          <input type="hidden" value="Simpan" name="simpan">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </h4>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group form-animate-text">
              <input maxlength="18" onkeyup="ceknip(this.value)" onkeydown="angkasaja(event)" type="text" class="form-text" name="nip_karyawan" required >
              <span class="bar"></span>
              <label>NIP Karyawan</label>
              <div id="notifnip"></div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group form-animate-text">
              <input type="text" class="form-text" onkeydown="namaorang(event)" name="nama_karyawan" required >
              <span class="bar"></span>
              <label>Nama</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group form-animate-text">
              <input type="text" class="form-text" name="nik" required>
              <span class="bar"></span>
              <label>NIK</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group form-animate-text">
              <input type="text" class="form-text" name="no_telp" required >
              <span class="bar"></span>
              <label>No Telp</label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Jenis Kelamin</label>
              <select class="form-control" name="jk_karyawan">
                <option>Laki-laki</option>
                <option>Perempuan</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Status</label>
              <select class="form-control" name="status_karyawan">
                <option>Nikah</option>
                <option>Belum Nikah</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Jabatan</label>
              <select class="form-control" name="id_jabatan">
                <?php
                foreach ($jab as $j) {
                  echo "<option value='".$j->id_jabatan."'>".$j->nama_jabatan."</option>";
                }
                ?>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>