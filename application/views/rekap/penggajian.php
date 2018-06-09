<div id="content">
  <div class="row">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3>Rekap Gaji
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
                  <th>ID Penggajian</th>
                  <th>Karyawan</th>
                  <th>Tanggal</th>
                  <th>Periode</th>
                  <th>Gaji Bersih</th>
                  <th>Slip Gaji</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1;foreach($pen as $g){?>
                <tr>
                  <td><?= $g->id_penggajian ?></td>
                  <td><?= $g->nip_karyawan.' ('.$g->nama_karyawan.')' ?></td>
                  <td><?= tglIndo($g->tgl_penggajian) ?></td>
                  <td><?= namaBulan($g->bulan_penggajian).' '.$g->tahun_penggajian ?></td>
                  <td><?= rupiah($g->gaji_bersih) ?></td>
                  <td>
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pilih Aksi
                        <span class="fa fa-angle-down"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a target="_blank" href="<?= $slipcetak.'/'.$g->id_penggajian ?>">Cetak</a></li>
                        <li><a target="_blank" href="<?= $slippdf.'/'.$g->id_penggajian ?>">PDF</a></li>
                      </ul>
                    </div>
                  </td>
                </tr>
                <?php $no++;} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>