<form class="cmxform" method="post" action="<?=$action?>" enctype="multipart/form-data">
  <div class="col-md-12">
    <div class="col-md-12 panel">
      <div class="col-md-12 panel-heading">
        <h4>Profil Saya
          <input id="simpan" class="submit btn btn-primary" type="submit" value="Simpan" name="simpan">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </h4>
      </div>
      <div class="col-md-12 tabs-area">
        <ul id="tabs-demo6" class="nav nav-tabs nav-tabs-v6" role="tablist">
          <li role="presentation" class="active">
            <a href="#tabs-demo7-area1" id="tabs-demo6-1" role="tab" data-toggle="tab" aria-expanded="true">Tentang</a>
          </li>
          <li role="presentation">
            <a href="#tabs-demo7-area2" id="tabs-demo6-2" role="tab" data-toggle="tab" aria-expanded="false">Ubah</a>
          </li>
        </ul>
        <div id="tabsDemo6Content" class="tab-content tab-content-v6 col-md-12">
          <div role="tabpanel" class="tab-pane fade active in" id="tabs-demo7-area1" aria-labelledby="tabs-demo7-area1">
            <div class="col-md-12">
              <div class="col-md-5">
                <div class="form-group">
                  Nama Pengguna
                </div>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <?= $peng['nama_pengguna'] ?>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-5">
                <div class="form-group">
                  Foto Pengguna
                </div>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <img src="<?= base_url().'images/pengguna/'.$peng['foto_pengguna'] ?>" style="max-width: 150px; max-height: 150px;">
                </div>
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane fade in" id="tabs-demo7-area2" aria-labelledby="tabs-demo7-area2">
            <div class="col-md-12">
              <div class="col-md-4">
                <a id="btnubahsandi" class="btn" onclick="ubahsandi()" value="ubah">Ubah Sandi</a>
              </div>
              <div class="col-md-8" id="ubahsandi">

              </div>
            </div>
            <div class="col-md-12" style="margin-bottom: 20px;">
              <div class="col-md-4">
                <a id="btnubahfoto" class="btn" onclick="ubahfoto('pengguna')" value="ubah">Ubah Foto</a>
              </div>
              <div class="col-md-8" id="ubahfoto">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
