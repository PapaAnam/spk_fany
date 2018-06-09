<form onsubmit="cekkaryawan(event)" class="cmxform" method="post" action="<?=$action?>" enctype="multipart/form-data">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h4>Ubah Karyawan
          <input class="submit btn btn-primary" type="submit" value="Simpan" name="simpan">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </h4>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group form-animate-text">
              <input maxlength="18" type="text" class="form-text" onkeyup="ceknip(this.value)" onkeydown="angkasaja(event)" name="nip_karyawan" required value="<?= $kar['nip_karyawan'] ?>" >
              <span class="bar"></span>
              <label>NIP Karyawan</label>
              <div id="notifnip"></div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group form-animate-text">
              <input maxlength="30" type="text" class="form-text" onkeydown="namaorang(event)" name="nama_karyawan" required value="<?= $kar['nama_karyawan'] ?>">
              <span class="bar"></span>
              <label>Nama</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group form-animate-text">
              <input type="text" class="form-text" name="nik" required value="<?= $kar['nik'] ?>">
              <span class="bar"></span>
              <label>NIK</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group form-animate-text">
              <input type="text" class="form-text" name="no_telp" required value="<?= $kar['no_telp'] ?>">
              <span class="bar"></span>
              <label>No Telp</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Jenis Kelamin</label>
              <select class="form-control" name="jk_karyawan">
                <option <?php if($kar['jk_karyawan']==='Laki-laki'){echo 'selected';}?>>Laki-laki</option>
                <option <?php if($kar['jk_karyawan']==='Perempuan'){echo 'selected';}?>>Perempuan</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Status</label>
              <select class="form-control" name="status_karyawan">
                <option <?php if($kar['status_karyawan']==='Nikah'){echo 'selected';}?>>Nikah</option>
                <option <?php if($kar['status_karyawan']==='Belum Nikah'){echo 'selected';}?>>Belum Nikah</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Jabatan</label>
              <select class="form-control" name="id_jabatan">
                <?php
                foreach ($jab as $j) {
                  if($kar['id_jabatan'] === $d->id_jabatan){
                    echo "<option value='".$j->id_jabatan."' selected>".$j->nama_jabatan."</option>";
                  }else{
                    echo "<option value='".$j->id_jabatan."'>".$j->nama_jabatan."</option>";
                  }
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
