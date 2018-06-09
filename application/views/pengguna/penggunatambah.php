<form onsubmit="formpengguna(event)" class="cmxform" method="post" action="<?=$action?>" enctype="multipart/form-data">
  <div class="col-md-12">
    <div class="col-md-12 panel">
      <div class="col-md-12 panel-heading">
        <h4>Tambah Pengguna
          <input id="simpan" class="submit btn btn-primary" type="submit" value="Simpan" name="simpan">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </h4>
      </div>
      <div class="col-md-12 tabs-area">
        <ul id="tabs-demo6" class="nav nav-tabs nav-tabs-v6" role="tablist">
          <li role="presentation" class="active">
            <a href="#tabs-demo7-area1" id="tabs-demo6-1" role="tab" data-toggle="tab" aria-expanded="true">Tentang</a>
          </li>
        </ul>
        <div id="tabsDemo6Content" class="tab-content tab-content-v6 col-md-12">
          <div role="tabpanel" class="tab-pane fade active in" id="tabs-demo7-area1" aria-labelledby="tabs-demo7-area1">
            <div class="col-md-12">
              <div class="col-md-6">
                <div class="form-group form-animate-text">
                  <input id="nama_pengguna" type="text" onkeydown="typeusername(event)" onkeyup="cekusername(this.value)" onchange="cekusername(this.value)" class="form-text" name="nama_pengguna" required>
                  <span class="bar"></span>
                  <label>Nama Pengguna</label>
                  <div id="notifusername"></div>
                </div>
              </div>
            </div>
            <div class="col-md-12" style="margin-bottom: 20px;">
              <div class="col-md-6">
                <div class="input-group fileupload-v1">
                  <input accept="image/png, image/jpg, image/jpeg" type="file" name="foto_pengguna" class="fileupload-v1-file hidden" required>
                  <input type="text" class="form-control fileupload-v1-path" placeholder="Path Foto..." disabled>
                  <span class="input-group-btn">
                    <button onclick="up(this)" class="btn fileupload-v1-btn" type="button"><i id="hapusfoto" class="fa fa-folder"></i> Masukkan Foto</button>
                  </span>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Level</label>
                    <select class="form-control" name="level_pengguna">
                      <option value="1"><?= level('1') ?></option>
                      <option value="2"><?= level('2') ?></option>
                    </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
