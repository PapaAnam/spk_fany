<div id="content">
  <div id="mymodal" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-primary alert-outline alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <strong>Catatan!</strong> <br />
        1. Nama Pengguna bersifat permanen, tidak bisa diubah<br />
        2. Kata sandi untuk penambahan pengguna baru sama dengan nama pengguna<br />
        3. Kata sandi bisa diubah setelah melakukan login di bagian pojok kanan atas<br />
        4. Penghapusan pengguna hanya bisa dilakukan di level admin<br />
      </div>
    </div>
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3>Data Pengguna <a class="mdl btn btn-primary" id="<?= $url ?>penggunatambah">Tambah</a></h3>
        </div>
        <div class="panel-body">
          <div class="responsive-table">
            <table id="datatables-example" class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID Pengguna</th>
                  <th>Nama Pengguna</th>
                  <th>Level</th>
                  <th width="100px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach($peng as $p){?>
                <tr>
                  <td><?= $p->id_pengguna ?></td>
                  <td><?= $p->nama_pengguna ?></td>
                  <td><?= level($p->level_pengguna) ?></td>
                  <td>
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pilih Aksi
                        <span class="fa fa-angle-down"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="mdl" id="<?= $url.'penggunahapus/'.$p->id_pengguna ?>">Hapus</a></li>
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
