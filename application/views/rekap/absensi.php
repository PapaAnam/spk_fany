<div id="content">
  <div class="row">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3>Rekap Absensi
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih Aksi
                <span class="fa fa-angle-down"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a target="_blank" href="<?= $this->uri->segment(3)==true?$urlcetak.'/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5):$urlcetak  ?>">Cetak</a></li>
                <li><a target="_blank" href="<?= $this->uri->segment(3)==true?$urlpdf.'/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5):$urlpdf  ?>">PDF</a></li>
              </ul>
            </div>
          </h3>
          Bulan :
          <select onchange="to()" id="bulan" name="">
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
          <select onchange="to()" id="tahun" name="">
            <option value="semua" <?= $this->uri->segment(4)=='semua'?'selected':''?>>Semua</option>
            <?php
            for($i=2010;$i<=thnskrng();$i++) {
              if($i==$this->uri->segment(4)){
                echo '<option value="'.$i.'" selected>'.$i.'</option>';
              }else{
                echo '<option value="'.$i.'">'.$i.'</option>';
              }

            }
            ?>
          </select>
          Status :
          <select onchange="to()" id="status" name="">
            <option value="semua" <?= $this->uri->segment(5)=='semua'?'selected':''?>>Semua</option>
            <option value="masuk" <?= $this->uri->segment(5)=='masuk'?'selected':''?>>Masuk</option>
            <option value="ijin" <?= $this->uri->segment(5)=='ijin'?'selected':''?>>Ijin</option>
            <option value="cuti" <?= $this->uri->segment(5)=='cuti'?'selected':''?>>Cuti</option>
            <option value="alpa" <?= $this->uri->segment(5)=='alpa'?'selected':''?>>Alpa</option>
            <option value="libur" <?= $this->uri->segment(5)=='libur'?'selected':''?>>Libur</option>
            <option value="terlambat" <?= $this->uri->segment(5)=='terlambat'?'selected':''?>>Terlambat</option>
          </select>
        </div>
        <div class="panel-body">
          <div class="responsive-table">
            <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID Absensi</th>
                  <th>NIP Karyawan (Nama)</th>
                  <th>Tanggal</th>
                  <th>Status</th>
                  <th>Jam Masuk</th>
                  <th>Jam Keluar</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($abs as $a){?>
                <tr>
                  <td><?= $a->id_absensi ?></td>
                  <td><?= $a->nip_karyawan.' ('.$a->nama_karyawan.')' ?></td>
                  <td><?= tglIndo($a->tgl_absensi) ?></td>
                  <td><?= $a->status_absensi ?></td>
                  <td><?= cekjam($a->jam_masuk_absensi) ?></td>
                  <td><?= cekjam($a->jam_keluar_absensi) ?></td>
                  <td><?= $a->keterangan_absensi ?></td>
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