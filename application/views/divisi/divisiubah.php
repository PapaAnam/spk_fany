<form class="cmxform" method="post" action="<?=$action?>" enctype="multipart/form-data">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h4>
          Ubah Divisi 
          <input class="submit btn btn-primary" type="submit" value="Simpan" name="simpan">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </h4>
      </div>
      <div class="panel-body">
        <div class="form-group form-animate-text">
          <input type="text" class="form-text" name="nama_divisi" required value="<?= $div['nama_divisi'] ?>">
          <span class="bar"></span>
          <label>Nama Divisi</label>
        </div>
      </div>
    </div>
  </div>
</form>