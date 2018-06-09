<form class="cmxform" method="post" action="<?=$action?>" enctype="multipart/form-data">
  <div class="col-md-12">
    <div class="col-md-12 panel">
      <div class="col-md-12 panel-heading">
        <h4>Ubah Lembur
          <input class="submit btn btn-primary" type="submit" value="Simpan" name="simpan">
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
            <div class="col-md-7">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Karyawan</label>
                    <select class="form-control" name="nip_karyawan">
                      <?php
                        foreach ($kar as $k) {
                          if($lem['nip_karyawan'] === $k->nip_karyawan){
                            echo '<option disabled value="'.$k->nip_karyawan.'" selected>'.$k->nip_karyawan.' ('.$k->nama_karyawan.')</option>';
                          }else{
                            echo '<option disabled value="'.$k->nip_karyawan.'">'.$k->nip_karyawan.' ('.$k->nama_karyawan.')</option>';
                          }
                        }
                      ?>
                    </select>
                </div>
              </div>
              <!-- <div class="col-md-12">
                <div class="form-group form-animate-text">
                  <input type="text" class="form-text dateAnimate" name="tgl_lembur" required value="<?= $lem['tgl_lembur'] ?>">
                  <span class="bar"></span>
                  <label>Tanggal</label>
                </div>
              </div> -->
<!--               <div class="col-md-12">
                <div class="form-group form-animate-text">
                  <input type="text" maxlength="4" onkeydown="typelamalembur(event)" id="lamalembur" class="form-text" name="lama_lembur" required value="<?= $lem['lama_lembur'] ?>">
                  <span class="bar"></span>
                  <label>Lama Lembur (jam)</label>
                </div>
              </div> -->
              <div class="col-md-12">
                <div class="form-group form-animate-text">
                  <textarea class="form-text" name="keterangan_lembur" required ><?= $lem['keterangan_lembur'] ?></textarea>
                  <span class="bar"></span>
                  <label>Keterangan</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
