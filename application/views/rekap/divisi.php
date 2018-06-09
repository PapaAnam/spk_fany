<div id="content">
  <div class="row">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3>Rekap Divisi
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih Aksi
                <span class="fa fa-angle-down"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a target="_blank" href="<?= $urlcetak ?>">Cetak</a></li>
                <li><a target="_blank" href="<?= $urlpdf ?>">PDF</a></li>
              </ul>
            </div>
          </h3>
        </div>
        <div class="panel-body">
          <div class="responsive-table">
            <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID Divisi</th>
                  <th>Nama Divisi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach($div as $d){?>
                <tr>
                  <td><?= $d->id_divisi ?></td>
                  <td><?= $d->nama_divisi ?></td>
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