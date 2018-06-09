<div id="content">
  <div class="row">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3>
            <?php if($lvl!=3){
              ?>
              Data Lembur 
              <?php 
            }else{
              echo 'Lemburku';
            }
            ?>
          </h3>
        </div>
        <div class="panel-body">
          <div class="responsive-table">
            <table id="datatables-example" class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <?php if($lvl!=3){?>
                  <th>ID Lembur</th>
                  <th>Karyawan</th>
                  <?php } ?>
                  <th>Tanggal</th>
                  <th>Lama Lembur</th>
                  <th>Keterangan</th>
                  <?php if($lvl!=3){?>
                  <th>Aksi</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php foreach($lem as $l){?>
                <tr>
                  <?php if($lvl!=3){?>
                  <td><?= $l->id_lembur ?></td>
                  <td><?= $l->nip_karyawan.' ('.$l->nama_karyawan.')' ?></td>
                  <?php } ?>
                  <td><?= tglIndo($l->tgl_lembur) ?></td>
                  <td><?= koma($l->lama_lembur) ?> jam</td>
                  <td><?= $l->keterangan_lembur ?></td>
                  <?php if($lvl!=3){?>
                  <td>
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pilih Aksi
                        <span class="fa fa-angle-down"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="mdl" id="<?= $url.'lemburubah/'.$l->id_lembur ?>">Ubah</a></li>
                        <li><a class="mdl" id="<?= $url.'lemburhapus/'.$l->id_lembur ?>">Hapus</a></li>
                      </ul>
                    </div>
                  </td>
                  <?php } ?>
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