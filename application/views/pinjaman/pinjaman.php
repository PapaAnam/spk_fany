<div id="content">
  <div class="row">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3><?php if($lvl!=3){?>Data Pinjaman 
            <a class="mdl btn btn-primary" id="<?= $url ?>pinjamantambah">Tambah</a>
            <?php }else{echo 'Pinjamanku';} ?>
          </h3>
        </div>
        <div class="panel-body">
          <div class="responsive-table">
            <table id="datatables-example" class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <?php if($lvl!=3){?>
                  <th>ID Pinjaman</th>
                  <th>Peminjam</th>
                  <?php } ?>
                  <th>Tanggal</th>
                  <th>Besar Pinjaman</th>
                  <th>Status</th>
                  <th>Keterangan</th>
                  <?php if($lvl!=3){?>
                  <th width="100px">Aksi</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php foreach($pin as $p){?>
                <tr>
                  <?php if($lvl!=3){?>
                  <td><?= $p->id_pinjaman ?></td>
                  <td><?= $p->nip_karyawan.' ('.$p->nama_karyawan.')' ?></td>
                  <?php } ?>
                  <td><?= tglIndo($p->tgl_pinjaman) ?></td>
                  <td><?= rupiah($p->besar_pinjaman) ?></td>
                  <td><?= $p->status_pinjaman ?></td>
                  <td><?= $p->keterangan_pinjaman ?></td>
                  <?php if($lvl!=3){?>
                  <td>
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pilih Aksi
                        <span class="fa fa-angle-down"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="mdl" id="<?= $url.'pinjamanubah/'.$p->id_pinjaman ?>">Ubah</a></li>
                        <li><a class="mdl" id="<?= $url.'pinjamanhapus/'.$p->id_pinjaman ?>">Hapus</a></li>
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