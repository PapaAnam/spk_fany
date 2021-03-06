<div id="content">
  <div class="row">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3>Rekap Lembur
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih Aksi
                <span class="fa fa-angle-down"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a target="_blank" href="<?= $this->uri->segment(3)==true?$urlcetak.'/'.$this->uri->segment(3).'/'.$this->uri->segment(4):$urlcetak ?>">Cetak</a></li>
                <li><a target="_blank" href="<?= $this->uri->segment(3)==true?$urlpdf.'/'.$this->uri->segment(3).'/'.$this->uri->segment(4):$urlpdf ?>">PDF</a></li>
              </ul>
            </div>
          </h3>
          Bulan :
          <select class="selectbln" name="">
            <option value="semua" <?= $this->uri->segment(3)=='semua'?'selected':''?>>Semua</option>
            <?php
            for($i=1;$i<=12;$i++) {
              if($i==$this->uri->segment(3)){
                echo '<option value="'.$i.'" selected>'.namabulan($i).'</option>';
              }else{
                echo '<option value="'.$i.'">'.namabulan($i).'</option>';
              }

            }
            ?>
          </select>
          Tahun :
          <select class="selectthn" name="">
            <option value="semua" <?= $this->uri->segment(4)=='semua'?'selected':''?>>Semua</option>
            <?php
            for($i=$this->config->item('tahun_berdiri');$i<=thnskrng();$i++) {
              if($i==$this->uri->segment(4)){
                echo '<option value="'.$i.'" selected>'.$i.'</option>';
              }else{
                echo '<option value="'.$i.'">'.$i.'</option>';
              }

            }
            ?>
          </select>
        </div>
        <div class="panel-body">
          <div class="responsive-table">
            <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID Lembur</th>
                  <th>Karyawan</th>
                  <th>Tanggal</th>
                  <th>Lama Lembur</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($lem as $l){?>
                <tr>
                  <td><?= $l->id_lembur ?></td>
                  <td><?= $l->nip_karyawan.' ('.$l->nama_karyawan.')' ?></td>
                  <td><?= tglIndo($l->tgl_lembur) ?></td>
                  <td><?= koma($l->lama_lembur) ?> jam</td>
                  <td><?= $l->keterangan_lembur ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>