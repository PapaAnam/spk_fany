<div id="content">
  <div class="row">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3>Rekap Karyawan
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
          Jabatan :
          <select class="selectjabatan" name="">
            <option value="semua" <?= $this->uri->segment(4)=='semua'?'selected':''?>>Semua</option>
            <?php
            foreach ($jabatan as $j) {
              if($j->id_jabatan==$this->uri->segment(4)){
                echo '<option value="'.$j->id_jabatan.'" selected>'.$j->nama_jabatan.'</option>';
              }else{
                echo '<option value="'.$j->id_jabatan.'">'.$j->nama_jabatan.'</option>';
              }
            }
            ?>
          </select>
        </div>
        <div class="panel-body">
          <div class="responsive-table">
            <table id="datatables-example" class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>NIP Karyawan</th>
                  <th>Nama Karyawan</th>
                  <!-- <th>Jenis Karyawan</th> -->
                  <!-- <th>Divisi</th> -->
                  <th>Jabatan</th>
                  <th>Gaji Pokok</th>
                  <th>Tunjangan</th>
                  <!-- <th>Lembur (Per Jam)</th> -->
                  <th>Transportasi</th>
                  <th>Pulsa</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($kar as $k){?>
                <tr>
                  <td><?= $k->nip_karyawan ?></td>
                  <td><?= $k->nama_karyawan ?></td>
                  <td><?= $k->nama_jabatan ?></td>
                  <td><?= rupiah($k->gaji_pokok) ?></td>
                  <td><?= rupiah($k->tunjangan) ?></td>
                  <td><?= rupiah($k->transportasi) ?></td>
                  <td><?= rupiah($k->pulsa) ?></td>
                  <td>
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih Aksi
                        <span class="fa fa-angle-down"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a target="_blank" href="<?= base_url('karyawan/bio/'.$k->nip_karyawan.'/cetak') ?>">Cetak</a></li>
                        <li><a target="_blank" href="<?= base_url('karyawan/bio/'.$k->nip_karyawan.'/pdf') ?>">PDF</a></li>
                      </ul>
                    </div>
                  </td>
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