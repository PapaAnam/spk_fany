<form onsubmit="ceksandik(event)" class="cmxform" method="post" action="<?=$action?>" enctype="multipart/form-data">
  <div class="col-md-12">
    <div class="col-md-12 panel">
      <div class="col-md-12 panel-heading">
        <h4>Ubah Sandi
          <input class="submit btn btn-primary" type="submit" value="Simpan" name="simpan">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </h4>
      </div>
      <div class="col-md-12 tabs-area">
        <ul id="tabs-demo6" class="nav nav-tabs nav-tabs-v6" role="tablist">
          <li role="presentation" class="active">
            <a href="#tabs-demo7-area1" id="tabs-demo6-1" role="tab" data-toggle="tab" aria-expanded="true">Identitas</a>
          </li>
        </ul>
        <div id="tabsDemo6Content" class="tab-content tab-content-v6 col-md-12">
          <div role="tabpanel" class="tab-pane fade active in" id="tabs-demo7-area1" aria-labelledby="tabs-demo7-area1">
            <div class="col-md-6">
              <div class="form-group form-animate-text">
                <input minlength="6" maxlength="20" id="sandi" type="password" class="form-text" name="sandibaru" required >
                <span class="bar"></span>
                <label>Sandi baru</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group form-animate-text">
                <input minlength="6" id="sandi2" maxlength="20" type="password" class="form-text" required>
                <span class="bar"></span>
                <div class="notif"></div>
                <label>Konfirmasi</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
