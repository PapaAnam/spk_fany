<div id="content">
  <div class="row">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3><?php if($lvl!=3){?>Data Penggajian 
            <a class="mdl btn btn-primary" id="<?= base_url() ?>penggajian/tambah">Tambah</a>
            <?php }else{echo 'Gajiku';} ?>
          </h3>
        </div>
        <div class="panel-body">
          <div class="responsive-table">
            <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <?php if($lvl!=3){?>
                  <th>ID Penggajian</th>
                  <th>Karyawan</th>
                  <?php } ?>
                  <th>Tanggal</th>
                  <th>Periode</th>
                  <th>Gaji Bersih</th>
                  <th width="200px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach($gaji as $g){?>
                <tr>
                  <?php if($lvl!=3){?>
                  <td><?= $g->id_penggajian ?></td>
                  <td><?= $g->nip_karyawan.' ('.$g->nama_karyawan.')' ?></td>
                  <?php } ?>
                  <td><?= tglIndo($g->tgl_penggajian) ?></td>
                  <td><?= namaBulan($g->bulan_penggajian).' '.$g->tahun_penggajian ?></td>
                  <td><?= rupiah($g->gaji_bersih) ?></td>
                  
                  <td>
                    <?php if($lvl!=3){?>
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pilih Aksi
                        <span class="fa fa-angle-down"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="mdl" id="<?= base_url().'penggajian/ubah/'.$g->id_penggajian.'/'.$g->nip_karyawan ?>">Ubah</a></li>
                        <li><a class="mdl" id="<?= base_url().'penggajian/hapus/'.$g->id_penggajian ?>">Hapus</a></li>
                      </ul>
                    </div>
                    <?php } ?>
                    <a href="<?= base_url().'rekap/slipgajicetak/'.$g->id_penggajian; ?>" class="btn btn-primary" target="_blank">Slip Gaji</a>
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