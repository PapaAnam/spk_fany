<input type="hidden" name="cekgajiurl" value="<?=base_url().'penggajian/cek'?>">
<input type="hidden" name="urlgaji" value="<?=base_url().'penggajian/'?>">
<form class="cmxform" method="post" action="<?=$action?>" enctype="multipart/form-data">
  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading">
        <h4>Ubah Penggajian 
          <input class="submit btn btn-primary" type="submit" value="Simpan" name="simpan">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </h4>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-6">
            <div class="col-md-12">
              <div class="form-group">
                <label>Karyawan</label>
                <select onchange="cekgaji()" class="form-control" name="nip_karyawan" id="nip_karyawan">
                  <?php 
                  foreach ($kar as $k) {
                    if($gaji['nip_karyawan']===$k->nip_karyawan){
                      echo '<option selected value="'.$k->nip_karyawan.'">'.$k->nip_karyawan.' ('.$k->nama_karyawan.')</option>';
                    }else{
                      echo '<option value="'.$k->nip_karyawan.'">'.$k->nip_karyawan.' ('.$k->nama_karyawan.')</option>';
                    }

                  }
                  ?>
                </select>
              </div>
            </div>    
            <div class="col-md-3">
              <div class="form-group form-animate-text">
                <input id="masuk" type="text" class="form-text" required onkeydown="inputmati(event)">
                <span class="bar"></span>
                <label>Masuk</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group form-animate-text">
                <input id="ijin" type="text" class="form-text" required onkeydown="inputmati(event)">
                <span class="bar"></span>
                <label>Ijin</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group form-animate-text">
                <input id="cuti" type="text" class="form-text" required onkeydown="inputmati(event)">
                <span class="bar"></span>
                <label>Cuti</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group form-animate-text">
                <input id="alpa" type="text" class="form-text" required onkeydown="inputmati(event)">
                <span class="bar"></span>
                <label>Alpa</label>
              </div>
            </div>  
            <div class="col-md-12">
              <div class="form-group form-animate-text">
                <input type="text" class="form-text dateAnimate" name="tgl_penggajian" required value="<?= $gaji['tgl_penggajian'] ?>">
                <span class="bar"></span>
                <label>Tanggal</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Bulan</label>
                <select onchange="cekgaji()" class="form-control" name="bulan_penggajian" id="bulan_penggajian">
                  <?php
                  for($i=1;$i<=12;$i++){
                    if($i==$gaji['bulan_penggajian']){
                      echo '<option selected value="'.$i.'">'.namabulan($i).'</option>';
                    }else{
                      echo '<option value="'.$i.'">'.namabulan($i).'</option>';
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Tahun</label>
                <select onchange="cekgaji()" class="form-control" name="tahun_penggajian" id="tahun_penggajian">
                  <?php
                  for($i=2010;$i<=thnskrng();$i++){
                    if($gaji['tahun_penggajian']==$i){
                      echo '<option selected>'.$i.'</option>';
                    }else{
                      echo '<option>'.$i.'</option>';
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <a class="btn btn-primary" onclick="cekgaji()">Cek</a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="col-md-12">
              <div class="form-group form-animate-text">
                <input value="<?= $gaji['gaji_pokok'] ?>" id="gaji_pokok" type="text" class="form-text" required onkeydown="inputmati(event)">
                <span class="bar"></span>
                <label>Gaji Pokok (Rp)</label>
              </div>
            </div>  
            <div class="col-md-12">
              <div class="form-group form-animate-text">
                <input value="<?= $gaji['tunjangan'] ?>" name="tunjangan" id="tunjangan" type="text" class="form-text" required onkeydown="inputmati(event)">
                <span class="bar"></span>
                <label>Tunjangan (Rp)</label>
              </div>
            </div>      
            <div class="col-md-12">
              <div class="form-group form-animate-text">
                <input value="<?= $gaji['transportasi'] ?>" name="transportasi" id="transportasi" type="text" class="form-text" required onkeydown="inputmati(event)">
                <span class="bar"></span>
                <label>Transportasi (Rp)</label>
              </div>
            </div>     
            <div class="col-md-12">
              <div class="form-group form-animate-text">
                <input value="<?= $gaji['pulsa'] ?>" name="pulsa" id="pulsa" type="text" class="form-text" required onkeydown="inputmati(event)">
                <span class="bar"></span>
                <label>Pulsa (Rp)</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group form-animate-text">
                <input value="<?= $gaji['pinjaman'] ?>" name="pinjaman" id="pinjaman" type="text" class="form-text" required onkeydown="inputmati(event)">
                <span class="bar"></span>
                <label>Pinjaman (Rp)</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group form-animate-text">
                <input value="<?= $gaji['gaji_kotor'] ?>" name="gaji_kotor" id="gaji_kotor" type="text" class="form-text" required onkeydown="inputmati(event)">
                <span class="bar"></span>
                <label>Gaji Kotor (Rp)</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group form-animate-text">
                <input value="<?= $gaji['gaji_bersih'] ?>" name="gaji_bersih" id="gaji_bersih" type="text" class="form-text" required onkeydown="inputmati(event)">
                <span class="bar"></span>
                <label>Gaji Bersih (Rp)</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>