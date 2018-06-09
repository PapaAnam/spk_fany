<div id="content">
  <div class="row">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3>
            Data Divisi
            <a class="mdl btn btn-primary" id="<?= $url ?>divisitambah">Tambah</a>
          </h3>
        </div>
        <div class="panel-body">
          <div class="responsive-table">
            <table id="datatables-example" class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID Divisi</th>
                  <th>Nama Divisi</th>
                  <th width="100px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach($div as $d){?>
                <tr>
                  <td><?= $d->id_divisi ?></td>
                  <td><?= $d->nama_divisi ?></td>
                  <td>
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pilih Aksi
                        <span class="fa fa-angle-down"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="mdl" id="<?= $url.'divisiubah/'.$d->id_divisi ?>">Ubah</a></li>
                        <li><a class="mdl" id="<?= $url.'divisihapus/'.$d->id_divisi ?>">Hapus</a></li>
                      </ul>
                    </div>
                  </td>
                </tr>
                <?php $no++; } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>